<?php include __DIR__ . '/../header.php' ?>
<div class="container">
    <? if (!empty($error)): ?>
        <div class="error"><?= $error ?></div>
    <? endif; ?>
    <div class="page-film">
        <a href="/film/<?= $film->getId()?>/delete" class="button">Видалити</a>
        <h2><?= $film->getTitle() ?></h2>
        <div class="page-film-information">
            <img src="<?= $film->getImageLink()?>" alt="Film Image">
            <div class="page-film-information-main">
                <div>Рік виходу: <span id="page-film-information-main-realese"><?= $film->getRelease() ?? 'Невідомо'?></span></div>
                <div>Формат: <span id="page-film-information-main-format"><?= $film->getFormat() ?? 'Невідомо'?></span></div>
                <div>Актори: <span id="page-film-information-main-stars"><?= $film->getStarsFullName() ?? 'Невідомо'?></span></div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php' ?>
