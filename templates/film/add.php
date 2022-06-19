<?php include __DIR__ . '/../header.php' ?>
<div class="container">
    <form action="/film/add" method="post" id="form-film-add">
        <h2>Додати фільм</h2>

        <? if (!empty($error)): ?>
            <div class="error"><?= $error ?></div>
        <? endif; ?>

        <input type="text" name="title" value="<?= $_POST['title'] ?? '' ?>" id="form-film-add-release"
               placeholder="Назва фільму" class="input-film-add">

        <input type="text" name="release" value="<?= $_POST['release'] ?? '' ?>" id="form-film-add-release"
               placeholder="Реліз року" class="input-film-add">

        <select name="format" id="form-film-add-format">
            <option disabled selected>Вибрати формат</option>
            <option value="DVD">DVD</option>
            <option value="VHS">VHS</option>
            <option value="Blu-Ray">Blu-Ray</option>
        </select>

        <input type="text" name="stars" value="<?= $_POST['stars'] ?? '' ?>" id="form-film-add-stars"
               placeholder="Імена та прізвища акторів через ," class="input-film-add">

        <input type="text" name="link" value="<?= $_POST['link'] ?? ''?>" id="form-film-add-link"
        placeholder="Посилання на постер" class="input-film-add">

        <input type="submit" value="Додати фільм" class="submit">
    </form>
</div>
<?php include __DIR__ . '/../footer.php' ?>
