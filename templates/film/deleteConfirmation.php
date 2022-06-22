<?php include __DIR__ . '/../header.php' ?>
<div class="container delete-confirmation">
    <h2>Ви впевнені, що хочете видалити фільм
        <a href="/film/<?= $film->getId() ?>" class="film-title" target="_blank"><?= $film->getTitle() ?></a>
    </h2>
    <div class="delete-confirmation-action">
        <a href="/film/<?= $film->getId() ?>/delete" class="submit">Так</a>
        <a href="/film/<?= $film->getId() ?>" class="submit">Ні</a>
    </div>
</div>
<?php include __DIR__ . '/../footer.php' ?>
