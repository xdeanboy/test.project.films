<?php include __DIR__ . '/header.php' ?>
<section class="container">
    <form class="search_film" action="/film-search" method="get">
        <input type="search" name="search" placeholder="Пошук фільму" id="search-film-input">
    </form>
    <div class="block_films">
        <? if (!empty($error)): ?>
            <div class="error">
                <?= $error ?>
            </div>
        <? endif; ?>

        <? if (!empty($films)): ?>
            <? foreach ($films as $film): ?>
                <div class="block_film">
                    <a href="/film/<?= $film->getId() ?>"><img src="<?= $film->getImageLink() ?>" alt="Image films"></a>
                    <div class="film-title">
                        <a href="/film/<?= $film->getId() ?>"><?= $film->getTitle() ?></a>
                    </div>
                </div>
            <? endforeach; ?>
        <? endif; ?>
    </div>
</section>
<?php include __DIR__ . '/footer.php' ?>
