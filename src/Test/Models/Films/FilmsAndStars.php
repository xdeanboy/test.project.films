<?php

namespace Test\Models\Films;

use Test\Models\ActiveRecordEntity;

class FilmsAndStars extends ActiveRecordEntity
{
    protected $filmId;
    protected $starId;

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
     * @param int $starId
     */
    public function setStarId(int $starId): void
    {
        $this->starId = $starId;
    }

    /**
     * @return int
     */
    public function getStarId(): int
    {
        return $this->starId;
    }

    /**
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'films_and_stars';
    }

    /**
     * @param int $filmId
     * @return array|null
     */
    public static function findAllByFilmId(int $filmId): ?array
    {
        $result = self::findAllByColumn('film_id', $filmId);

        return !empty($result) ? $result : null;
    }

    /**
     * @param int $starId
     * @return array|null
     */
    public static function findAllByStarId(int $starId): ?array
    {

        $result = self::findAllByColumn('star_id', $starId);

        return !empty($result) ? $result : null;
    }

    /**
     * @return void
     */
    public function deleteConnections(): void
    {
        self::delete($this->getId());
    }
}