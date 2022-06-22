Для того, щоб розвернути проект на своєму ПК, потрібен OpenServer.
Після встановлення та налаштування OpenServer, потрібно зайти в PHPMyAdmin та перевірити Логін і пароль для входа
root root . Після входу створюємо БД з назвою test_project_films за допомогою команди CREATE DATABASE `test_project_films`.
Далі імпортуємо файл з папки upload для завантаження всіх таблиць та данних з них.

Є два юзера, їх данні нижче. Різниця в доступі до функцій видалення та додавання фільмів

User "Admin"
Email: admin@gmail.com
password: 123456789a
role: admin

User "User"
Email: user@gmail.com
password: 123456789u
role: user