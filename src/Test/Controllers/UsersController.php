<?php

namespace Test\Controllers;

use Test\Exceptions\ForbiddenException;
use Test\Exceptions\InvalidArgumentException;
use Test\Models\Users\User;
use Test\Models\Users\UserAuthServices;

class UsersController extends AbstractController
{
    /**
     * @return void
     * @throws ForbiddenException
     */
    public function signIn(): void
    {
        if (!empty($this->user)) {
            throw new ForbiddenException();
        }

        if (!empty($_POST)) {
            try {
                $user = User::signIn($_POST);

                if (!empty($user)) {
                    UserAuthServices::setAuthTokenForUser($user);
                }

            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('user/signIn.php',
                ['title' => 'Помилка авторизації',
                    'error' => $e->getMessage()]);
                return;
            }
            header('Location: /', true, 302);
            return;
        }

        $this->view->renderHtml('user/signIn.php',
        ['title' => 'Авторизація']);
    }

    /**
     * @return void
     * @throws ForbiddenException
     */
    public function logOut(): void
    {
        if (empty($this->user)) {
            throw new ForbiddenException();
        }

        User::logOut();

        header('Location: /sign-in', true, 302);
        return;
    }
}