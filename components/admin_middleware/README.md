# Промежуточная обработка. Проверка на админа

Добавление в файле `app/Http/Kernel.php` в `$routeMiddleware`

```php
'admin' => \App\Http\Middleware\AdminMiddleware::class,
```

Ввести в консоль

```bash
php artisan make:middleware AdminMiddleware
```

Заменить метод `handle` в `app/Http/Middleware/AdminMiddleware.php` 

```php
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }
        abort('404');
    }
```

В этом же файле нужно добавить импорт

```php
use Illuminate\Support\Facades\Auth;
```
