<?php include __DIR__ . '/../header.php' ?>
    <div class="container">
        <div class="not-found">
            <h2>Не знайдено!</h2>
            <? if (!empty($error)): ?>
                <div class="error"><?= $error ?></div>
            <? else: ?>
            <div class="error">Роутинг не знайдено. Сторінка відсутня!</div>
            <? endif; ?>
        </div>
    </div>
<?php include __DIR__ . '/../footer.php' ?>