<?php

namespace Test\Models\Films;

use Test\Models\ActiveRecordEntity;

class Star extends ActiveRecordEntity
{
    protected $surname;
    protected $name;

    protected static function getTableName(): string
    {
        return 'stars';
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->getName() . ' ' . $this->getSurname();
    }

    /**
     * @param string $nameAndSurname
     * @return void
     */
    public function setFullName(string $nameAndSurname): void
    {
        [$name, $surname] = explode(' ', $nameAndSurname, 2);

        if (!empty($name) && !empty($surname)) {
            $this->setName($name);
            $this->setSurname($surname);
        }
    }

    /**
     * @param string $fullName
     * @return static|null
     */
    public static function getByFullName(string $fullName): ?self
    {
        [$name, $surname] = explode(' ', $fullName, 2);

        $starsBySurname = self::findAllByColumn('surname', $surname);

        if (empty($starsBySurname)) {
            return null;
        }

        $starsByName = self::findAllByColumn('name', $name);

        if (empty($starsByName)) {
            return null;
        }

        $idBySurnames = [];
        foreach ($starsBySurname as $starBySurname) {
            $idBySurnames[] = $starBySurname->getId();
        }

        $idByNames = [];
        foreach ($starsByName as $starByName) {
            $idByNames[] = $starByName->getId();
        }

        $idIntersect = array_intersect($idBySurnames, $idByNames);

        if (empty($idIntersect)) {
            return null;
        }

        $starById = self::getById(array_shift($idIntersect));

        if ($starById->getFullName() !== $fullName) {
            return null;
        }

        return  $starById;
    }
}