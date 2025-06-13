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
'is_admin'
```

Добавить дополнительные поля, которые добавили в миграции

Добавить в `database/factories/UserFactory.php` в функцию `definition` в массив

```php
'login' => fake()->name(),
```

И иные нужные поля для генерации

В `database/seeders/DatabaseSeeder.php` добавить

```php
UserSeeder::class,
```

Прописать в консоли

```bash
php artisan make:seeder UserSeeder
```

В `database/seeders/UserSeeder` в функции run добавить генерацию пользователей

```php
// admin для удобства
User::factory()->create([
    'login' => 'admin1',
    'email' => 'admin1@admin.admin',
    'password' =>  Hash::make('123'),
    'is_admin' => 1,
]);

// admin по заданию !!! Важно, чтобы всё совпадало с заданием
User::factory()->create([
    'login' => 'help',
    'email' => 'admin@admin.admin',
    'password' =>  Hash::make('helpme'),
    'is_admin' => 1,
]);

// Создаём пользователя, которого будем тестировать
$user = User::factory()->create([
    'login' => 'user',
    'email' => 'user@user.user',
    'password' =>  Hash::make('123'),
]);

// Создаём ещё 10 случный пользователей
User::factory()->count(10)->create([
    'password' => Hash::make('123'),
]);
```
