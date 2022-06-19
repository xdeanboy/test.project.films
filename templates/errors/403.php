<?php include __DIR__ . '/../header.php'?>
<div class="container error-forbidden">
    <h2>Помилка доступу</h2>
    <div class="error"><?= !empty($error) ? $error : 'Доступ заборонено!'?></div>
</div>
<?php include __DIR__ . '/../footer.php'?>
