<!doctype html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/styles.css">
    <title><?= $title ?? 'Тестове завдання' ?></title>
</head>
<body>

<header>
    <div class="container">
        <div class="header-title">Тестове завдання для <a href="https://webbylab.com/en/careers"
                                                          target="_blank">WebbyLab</a></div>
        <nav class="header-menu">
            <ul>
                <li><a href="/">Головна</a></li>
                <li><a href="#footer-contacts">Контакти</a></li>
                <? if (!empty($user)): ?>
                    <? if ($user->isAdmin()): ?>
                        <li><a href="/film/add">Додати</a></li>
                        <li><a href="/film/add-by-file">Файл</a></li>
                    <? endif; ?>
                <? endif; ?>
            </ul>
        </nav>

        <? if (!empty($user)): ?>
            <div class="header-hello">Привіт, <span class="header-nickname"><?= $user->getNickname() ?></span>
                <a href="/logout" class="submit">Вийти</a>
            </div>
        <? else: ?>
            <div class="sign-in">
                <a href="/sign-in" class="submit">Увійти</a>
            </div>
        <? endif; ?>

    </div>
</header>