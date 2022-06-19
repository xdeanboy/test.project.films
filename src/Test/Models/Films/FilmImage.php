<?php

namespace Test\Models\Films;

use Test\Models\ActiveRecordEntity;

class FilmImage extends ActiveRecordEntity
{
    protected $link;

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

    protected static function getTableName(): string
    {
        return 'films_image';
    }
}