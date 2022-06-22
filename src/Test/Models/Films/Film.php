<?php

namespace Test\Models\Films;

use Test\Exceptions\FilmsByFileException;
use Test\Exceptions\InvalidArgumentException;
use Test\Exceptions\NotFoundException;
use Test\Models\ActiveRecordEntity;

class Film extends ActiveRecordEntity
{
    protected $title;
    protected $release;
    protected $format;

    /**
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'films';
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param int $release
     */
    public function setRelease(int $release): void
    {
        $this->release = $release;
    }

    /**
     * @return int
     */
    public function getRelease(): int
    {
        return $this->release;
    }

    /**
     * @param string $format
     */
    public function setFormat(string $format): void
    {
        $this->format = $format;
    }

    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @param string $fullName
     * @return void
     */
    public function setStarsFullName(string $fullName): void
    {
        $checkStar = Star::getByFullName($fullName);

        if (!empty($checkStar)) {
            $filmsAndStars = new FilmsAndStars();
            $filmsAndStars->setFilmId($this->id);
            $filmsAndStars->setStarId($checkStar->getId());

            $filmsAndStars->save();
        } else {
            $newStar = new Star();
            $newStar->setFullName($fullName);
            $newStar->save();

            $filmsAndStars = new FilmsAndStars();
            $filmsAndStars->setFilmId($this->id);
            $filmsAndStars->setStarId($newStar->getId());

            $filmsAndStars->save();
        }
    }

    /**
     * @return string|null
     */
    public function getStarsFullName(): ?string
    {
        $filmsAndStars = FilmsAndStars::findAllByFilmId($this->id);

        if ($filmsAndStars === null) {
            return null;
        }

        $starsId = [];
        foreach ($filmsAndStars as $filmAndStar) {
            $starsId[] = $filmAndStar->getStarId();
        }

        if ($starsId === null) {
            return null;
        }

        $result = [];
        foreach ($starsId as $starId) {
            $star = Star::getById($starId);

            if (!empty($star)) {
                $result[] = $star->getFullName();
            }
        }

        return !empty($result) ? implode(', ', $result) : null;
    }

    /**
     * @param string $link
     * @return void
     */
    public function setImageLink(int $filmId, string $link): void
    {
        $image = new FilmImage();
        $image->setFilmId($filmId);
        $image->setLink($link);
        $image->save();
    }

    /**
     * @return string|null
     */
    public function getImageLink(): ?string
    {
        $link = FilmImage::getByFilmId($this->getId());

        return !empty($link) ? $link->getLink() : null;
    }


    /**
     * @return array|null
     */
    public static function getAllByTitleAsc(): ?array
    {
        $result = self::findAllGroupByColumnAsc('title');

        return !empty($result) ? $result : null;
    }

    /**
     * @param array $filmData
     * @return static|null
     * @throws InvalidArgumentException
     */
    public static function addNew(array $filmData): ?self
    {
        if (empty($filmData['title'])) {
            throw new InvalidArgumentException('Заповніть Назва фільму');
        }

        if (!preg_match('~^[АаБбВвГгҐґДдЕеЄєЖжЗзИиІіЇїЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЬьЮюЯя\'\-,a-zA-Z]+$~',
            str_replace(' ', '', trim($filmData['title'])))) {
            throw new InvalidArgumentException('Назва фільму може мати тільки англійські та українські літери');
        }

        if (empty($filmData['release'])) {
            throw new InvalidArgumentException('Заповність Реліз року');
        }

        if (!preg_match('~^[0-9]+$~', $filmData['release'])) {
            throw new InvalidArgumentException('Реліз може мати тільки арабські цифри');
        }

        if(($filmData['release'] < 1850) || ($filmData['release'] > 2030)) {
            throw new InvalidArgumentException('Реліз фільму має бути в діапазоні 1850-2030 рр.');
        }

        if (empty($filmData['format'])) {
            throw new InvalidArgumentException('Виберіть формат');
        }

        if (empty($filmData['stars'])) {
            throw new InvalidArgumentException('Заповніть Авторів');
        }


        if (!preg_match('~^[АаБбВвГгҐґДдЕеЄєЖжЗзИиІіЇїЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЬьЮюЯя\'\-,a-zA-Z]+$~',
            str_replace(' ', '', trim($filmData['stars'])))) {
            throw new InvalidArgumentException('Актори можуть мати тільки англійські та українські літери');
        }

        $films = self::findAll();

        if (!empty($films)) {
            foreach ($films as $oneFilm) {
                if (trim($filmData['title']) === trim($oneFilm->getTitle())
                    && trim($filmData['release']) === trim($oneFilm->getRelease())
                    && trim($filmData['stars']) === trim($oneFilm->getStarsFullName())) {
                    throw new InvalidArgumentException('Фільм з такими данними вже існує');
                }
            }
        }

        if (empty($filmData['link'])) {
            throw new InvalidArgumentException('Добавте посилання на постер');
        }

        $film = new Film();
        $film->setTitle(trim($filmData['title']));
        $film->setRelease(trim($filmData['release']));
        $film->setFormat(trim($filmData['format']));
        $film->save();

        $film->setImageLink($film->getId(), trim($filmData['link']));

        $stars = explode(', ', trim($filmData['stars']));

        foreach ($stars as $starFullName) {
            $film->setStarsFullName($starFullName);
        }

        return $film;
    }

    /**
     * @return void
     */
    public function deleteFilm(): void
    {
        self::delete($this->getId());

        $filmsAndStars = FilmsAndStars::findAllByFilmId($this->getId());

        if (!empty($filmsAndStars)) {
            foreach ($filmsAndStars as $filmAndStar) {
                $filmAndStar->deleteConnections();
            }
        }

        FilmImage::delete($this->getId());
    }

    /**
     * @param string $search
     * @return array|null
     * @throws NotFoundException
     */
    public static function searchByInput(string $search): ?array
    {
        $films = Film::getAllByTitleAsc();

        if (empty($films)) {
            throw new NotFoundException('Помилка пошуку всіх фільмів');
        }

        $foundedFilms = [];

        foreach ($films as $film) {
            preg_match('~^.*'. $search .'.*$~', $film->getTitle(), $matchesByTitle);
            preg_match('~^.*'. $search .'.*$~', strtolower($film->getTitle()), $matchesByTitle);

            if (!empty($matchesByTitle)) {
                $foundedFilms[] = $film;
            }
        }

        if (!empty($foundedFilms)) {
            return $foundedFilms;
        }

        $stars = Star::findAll();

        foreach ($stars as $star) {
            preg_match('~^.*'. $search .'.*$~', $star->getFullName(), $matchesByStar);

            if (!empty($matchesByStar)) {
                $foundedStars[] = $star;
            }
        }

        if (!empty($foundedStars)) {
            foreach ($foundedStars as $foundedStar) {
                $filmsAndStars = FilmsAndStars::findAllByStarId($foundedStar->getId());
            }
        }

        if (!empty($filmsAndStars)) {
            $filmsId = [];
            foreach ($filmsAndStars as $filmAndStar) {
                $filmsId[] = $filmAndStar->getFilmId();
            }

            foreach ($filmsId as $filmId) {
                $foundedFilms[] = Film::getById($filmId);
            }
        }

        return !empty($foundedFilms) ? $foundedFilms : null;
    }

    /**
     * @param string $pathFile
     * @return int
     * @throws FilmsByFileException
     */
    public static function addFilmsByFile(string $pathFile): int
    {
        $filmsData = file($pathFile);

        $titles = [];
        $release = [];
        $format = [];
        $stars = [];

        foreach ($filmsData as $filmData) {
            preg_match('~^Title:(.*)$~', $filmData, $matchesByTitle);

            if (!empty($matchesByTitle)) {
                $titles[] = trim($matchesByTitle[1]);
                continue;
            }

            preg_match('~^Release Year:(.*)$~', $filmData, $matchesByRelease);

            if (!empty($matchesByRelease)) {
                $release[] = trim($matchesByRelease[1]);
                continue;
            }

            preg_match('~^Format:(.*)$~', $filmData, $matchesByFormat);


            if (!empty($matchesByFormat)) {
                $format[] = trim($matchesByFormat[1]);
                continue;
            }
            preg_match('~^Stars:(.*)$~', $filmData, $matchesByStars);


            if (!empty($matchesByStars)) {
                $stars[] = trim($matchesByStars[1]);
            }
        }

        if (!empty($titles) && !empty($release) && !empty($format) && !empty($stars)) {
            if (count($titles) !== count($release) ||
                count($release) !== count($format) ||
                count($format) !== count($stars)) {
                throw new FilmsByFileException('Некоректно прописан файл');
            }

            for ($i = 0; $i <= count($titles); $i++) {
                $dataFilms[$i] = $titles[$i] . '&' . $release[$i] . '&' .
                    $format[$i] . '&' . $stars[$i];
            }

            if (!empty($dataFilms)) {
                foreach ($dataFilms as $dataFilm) {
                    [$filmTitle, $filmRelease, $filmFormat, $filmStars] = explode('&', $dataFilm, 4);
                    if (!empty($filmTitle) && !empty($filmRelease) &&
                        !empty($filmFormat) && !empty($filmStars)) {

                        $filmByFile = new Film();
                        $filmByFile->setTitle($filmTitle);
                        $filmByFile->setRelease($filmRelease);
                        $filmByFile->setFormat($filmFormat);
                        $filmByFile->save();

                        $arrayStars = explode(', ', $filmStars);

                        if (!empty($arrayStars)) {
                            foreach ($arrayStars as $starFullName) {
                                $filmByFile->setStarsFullName($starFullName);
                            }
                        }

                        $countByFile[] = $filmByFile;
                    }
                }
                $countFilms = count($countByFile);
            }
        } else {
            throw new FilmsByFileException('Некоректно прописаний файл');
        }

        return $countFilms;
    }
}