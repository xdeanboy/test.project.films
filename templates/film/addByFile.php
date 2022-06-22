<?php include __DIR__ . '/../header.php'?>
<div class="container add-film-file">
    <h2>Завантажити фільми з файлу</h2>
    <form action="/film/add-by-file" enctype="multipart/form-data" method="post">
        <input type="file" name="file" class="button">
        <input type="submit" value="Завантажити" class="button">
    </form>
</div>
<?php include __DIR__ . '/../footer.php'?>
