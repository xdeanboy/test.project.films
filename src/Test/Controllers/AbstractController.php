<?php

namespace Test\Controllers;

use Test\Models\Users\UserAuthServices;
use Test\View\View;

abstract class AbstractController
{
    protected $view;
    protected $user;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->user = UserAuthServices::getUserByToken();
        $this->view->setVars('user', $this->user);
    }
}
