# Авторизация

В файле `routes/web.php`

```php
use App\Http\Controllers\AuthController;

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [AuthController::class, 'create'])->name('auth.create');
    Route::post('/register', [AuthController::class, 'store'])->name('auth.store');

    Route::get('/login', [AuthController::class, 'loginform'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
```

Закинуть файл AuthController.php в app/Http/Controllers
