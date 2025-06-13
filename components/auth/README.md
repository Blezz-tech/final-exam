# Авторизация

В файле `routes/web.php`

```php
use App\Http\Controllers\AuthController;

// Удлаить старый welcome.blade.php
// Удалить старый Route /

Route::get('/', function () {
    return view('pages.home');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [AuthController::class, 'createform'])->name('auth.createform');
    Route::post('/register', [AuthController::class, 'store'])->name('auth.store');

    Route::get('/login', [AuthController::class, 'loginform'])->name('auth.loginform');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::middleware(['admin'])->group(function () {
    // Запросы, которые может делать только админ
    // И страницы админа
});
```

Закинуть файл `AuthController.php` в `app/Http/Controllers`

Доработать валидацию дополнительныз полей в store в `AuthController.php`

Закинуть файлы `create.blade.php` и `login.blade.php` в `resources/views/auth/`

Доработать форму регистрации пользователя с дополнительными данными.
