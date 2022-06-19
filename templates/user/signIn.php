<?php include __DIR__ . '/../header.php'?>
<div class="container page-sign-in">
        <h2>Авторизація</h2>
        <form action="/sign-in" method="post" id="form-sign-in">
            <input type="email" name="email" value="<?= $_POST['email'] ?? ''?>" placeholder="Введіть свій email"
            id="form-sign-in-email" class="form-input">

            <input type="text" name="password" placeholder="Введіть свій пароль"
                   id="form-sign-in-password" class="form-input">

            <input type="submit" value="Увійти" class="submit">
        </form>
</div>
<?php include __DIR__ . '/../footer.php'?>
