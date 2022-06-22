<?php

namespace Test\Models\Films;

use Test\Models\ActiveRecordEntity;

class FilmImage extends ActiveRecordEntity
{
    protected $filmId;
    protected $link;

    /**
     * @param int $filmId
     */
    public function setFilmId(int $filmId): void
    {
        $this->filmId = $filmId;
    }

    /**
     * @return int
     */
    public function getFilmId(): int
    {
        return $this->filmId;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'films_image';
    }

    /**
     * @param int $filmId
     * @return static|null
     */
    public static function getByFilmId(int $filmId): ?self
    {
        $result = self::findOneByColumn('film_id', $filmId);

        return !empty($result) ? $result : null;
    }
}