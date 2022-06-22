<?php

return [
    '~^$~' => [\Test\Controllers\FilmsController::class, 'viewAll'],
    '~^film-search$~' => [\Test\Controllers\FilmsController::class, 'search'],
    '~^film/(\d+)$~' => [\Test\Controllers\FilmsController::class, 'viewById'],
    '~^film/(\d+)/delete/confirmation~' => [\Test\Controllers\FilmsController::class, 'deleteConfirmation'],
    '~^film/(\d+)/delete$~' => [\Test\Controllers\FilmsController::class, 'delete'],
    '~^film/add$~' => [\Test\Controllers\FilmsController::class, 'add'],
    '~^film/add-by-file$~' => [\Test\Controllers\FilmsController::class, 'addByFile'],
    '~^sign-in$~' => [\Test\Controllers\UsersController::class, 'signIn'],
    '~^logout$~' => [\Test\Controllers\UsersController::class, 'logOut'],
];