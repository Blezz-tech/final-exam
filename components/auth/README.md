# Авторизация

Добавь в миграцию users.

```php
$table->string('login');
$table->boolean('is_admin')->nullable()->default(false);
```

Добавить файлы

В файле `routes/web.php`

```php
use App\Http\Controllers\AuthController;

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [AuthController::class, 'createform'])->name('auth.createform');
    Route::post('/register', [AuthController::class, 'store'])->name('auth.store');

    Route::get('/login', [AuthController::class, 'loginform'])->name('auth.loginform');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
```

Закинуть файл AuthController.php в app/Http/Controllers
