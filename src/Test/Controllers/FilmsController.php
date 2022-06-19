<?php

namespace Test\Controllers;

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

                header('Location: /film/' . $film->getId(), true, 302);
                return;
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('film/add.php',
                    ['title' => 'Помилка',
                        'error' => $e->getMessage()]);
                return;
            }
        }

        $this->view->renderHtml('film/add.php');
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
                throw new InvalidArgumentException('Поле пошуку не може бути пустим');
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
}