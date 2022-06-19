<?php

return [
    '~^$~' => [\Test\Controllers\FilmsController::class, 'viewAll'],
    '~^film-search$~' => [\Test\Controllers\FilmsController::class, 'search'],
    '~^film/(\d+)$~' => [\Test\Controllers\FilmsController::class, 'viewById'],
    '~^film/(\d+)/delete$~' => [\Test\Controllers\FilmsController::class, 'delete'],
    '~^film/add$~' => [\Test\Controllers\FilmsController::class, 'add'],
    '~^test$~' => [\Test\Controllers\FilmsController::class, 'test'],
    '~^sign-in$~' => [\Test\Controllers\UsersController::class, 'signIn'],
    '~^logout$~' => [\Test\Controllers\UsersController::class, 'logOut'],
];