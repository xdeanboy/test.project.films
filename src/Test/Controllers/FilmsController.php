<?php

namespace Test\Controllers;

use Test\Exceptions\FilmsByFileException;
use Test\Exceptions\ForbiddenException;
use Test\Exceptions\InvalidArgumentException;
use Test\Exceptions\NotFoundException;
use Test\Exceptions\UnauthorizedException;
use Test\Models\Films\Film;

class FilmsController extends AbstractController
{
    /**
     * @return void
     * @throws UnauthorizedException
     */
    public function viewAll(): void
    {
        if (empty($this->user)) {
            throw new UnauthorizedException();
        }

        try {
            $films = Film::getAllByTitleAsc();

            if ($films === null) {
                throw new NotFoundException('Фільми не знайдені');
            }

            $this->view->renderHtml('main.php',
                ['title' => 'Головна сторінка',
                    'films' => $films]);
            return;
        } catch (NotFoundException $e) {
            $this->view->renderHtml('main.php',
                ['title' => 'Не знайдено',
                    'error' => $e->getMessage()], 404);
            return;
        }
    }

    /**
     * @param int $filmId
     * @return void
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function viewById(int $filmId): void
    {
        if (empty($this->user)) {
            throw new UnauthorizedException();
        }

        $film = Film::getById($filmId);

        if ($film === null) {
            throw new NotFoundException('Фільм не знайдено');
        }

        $this->view->renderHtml('film/view.php',
            ['film' => $film]);

    }

    /**
     * @return void
     * @throws ForbiddenException
     * @throws UnauthorizedException
     */
    public function add(): void
    {
        if (empty($this->user)) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException();
        }

        if (!empty($_POST)) {
            try {
                $film = Film::addNew($_POST);

                if (!empty($film)) {
                    $this->view->renderHtml('film/addSuccessful.php',
                        ['film' => $film]);
                    return;
                }
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('film/add.php',
                    ['title' => 'Помилка',
                        'error' => $e->getMessage()]);
                return;
            }
        }

        $this->view->renderHtml('film/add.php');
    }

    public function deleteConfirmation(int $filmId): void
    {
        if (empty($this->user)) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException();
        }

        $film = Film::getById($filmId);

        if (empty($film)) {
            throw new NotFoundException('Фільм не знайдено');
        }

        $this->view->renderHtml('film/deleteConfirmation.php',
            ['title' => 'Видалити фільм ' . $filmId,
                'film' => $film]);
    }

    /**
     * @param int $filmId
     * @return void
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete(int $filmId): void
    {
        if (empty($this->user)) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException();
        }

        $film = Film::getById($filmId);

        if (empty($film)) {
            throw new NotFoundException('Фільм не знайдено');
        }

        $film->deleteFilm();

        $this->view->renderHtml('film/deleteSuccessful.php');

    }

    /**
     * @return void
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function search(): void
    {
        if (empty($this->user)) {
            throw new UnauthorizedException();
        }

        try {
            if (empty($_GET['search'])) {
                $films = Film::getAllByTitleAsc();

                $this->view->renderHtml('main.php',
                    ['title' => 'Результат пошуку'
                        , 'films' => $films]);
                return;
            }

            $foundedFilms = Film::searchByInput($_GET['search']);

            if (empty($foundedFilms)) {
                throw new InvalidArgumentException('Нічого не знайдено');
            }

            $this->view->renderHtml('main.php',
                ['title' => 'Результат пошуку',
                    'films' => $foundedFilms]);
        } catch (InvalidArgumentException $e) {
            $this->view->renderHtml('main.php',
                ['title' => 'Помилка пошуку',
                    'error' => $e->getMessage()]);
            return;
        }
    }

    /**
     * @return void
     * @throws FilmsByFileException
     * @throws ForbiddenException
     * @throws UnauthorizedException
     */
    public function addByFile(): void
    {
        if (empty($this->user)) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException();
        }

        if (!empty($_FILES)) {
            $file = $_FILES['file'];

            if (!empty($file['error'])) {
                throw new FilmsByFileException('Помилка завантаження файлу');
            }

            if ($file['size'] === 0) {
                throw new FilmsByFileException('Неможливо завантажити пустий файл');
            }

            $newFileName = $file['name'];

            if (!preg_match('~^.*.txt$~', $newFileName)) {
                throw new FilmsByFileException('Файл повинен бути типу txt');
            }

            $pathNewFile = __DIR__ . '/../../../loadedFiles/' . $newFileName;

            $loadFile = false;
            if (move_uploaded_file($file['tmp_name'], $pathNewFile)) {
                $loadFile = true;
            }

            if (!$loadFile) {
                throw new FilmsByFileException('Помилка загрузки файлу');
            }

            $result = Film::addFilmsByFile($pathNewFile);

            $this->view->renderHtml('film/addByFileSuccessful.php',
                ['title' => 'Успішно опрацьовано',
                    'countFilms' => $result]);
                    return;
        }

        $this->view->renderHtml('film/addByFile.php');
    }
}