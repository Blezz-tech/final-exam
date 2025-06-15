# Доработка пользователя

Добавить в миграцию users.

```php
$table->string('login');
$table->boolean('is_admin')->nullable()->default(false);
```

Добавить дополнительны поля в миграцию какие нужны

Добавить текст ниже в файле `app/Models/User.php` в массив `$fillable`

```php
'login',
'is_admin',
```

Добавить дополнительные поля, которые добавили в миграции

Добавить в `database/factories/UserFactory.php` в функцию `definition` в массив

```php
'login' => fake()->name(),
```

И иные нужные поля для генерации

В `database/seeders/DatabaseSeeder.php` в метод `run` добавить

```php
$this->call([
    UserSeeder::class,
]);
```

Прописать в консоли

Скопировать `UserSeeder.php` в `database/seeders/`

```bash
php artisan make:seeder UserSeeder
```

ВАЖНАЯ ВЕЩЬ

В файле `config/app.php`

Чтобы было

```php
'locale' => 'ru',
'faker_locale' => 'ru_RU',
```
