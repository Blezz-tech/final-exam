<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use ReflectionClass;
use ReflectionMethod;

class ListControllers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:list-controllers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Вывести список контроллеров, их методов и описаний';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $controllersPath = app_path('Http/Controllers');
        $files = scandir($controllersPath);

        foreach ($files as $file) {
            // Пропускаем '.' и '..' и файл Controller.php
            if ($file === '.' || $file === '..' || $file === 'Controller.php') {
                continue;
            }

            // Проверяем, что это PHP-файл
            if (pathinfo($file, PATHINFO_EXTENSION) !== 'php') {
                continue;
            }

            // Формируем полное имя класса с namespace
            $className = 'App\Http\Controllers\\' . pathinfo($file, PATHINFO_FILENAME);

            if (!class_exists($className)) {
                // Если класс не загружен, пробуем автозагрузить
                require_once $controllersPath . DIRECTORY_SEPARATOR . $file;
            }

            if (!class_exists($className)) {
                $this->error("Класс $className не найден.");
                continue;
            }

            $reflection = new ReflectionClass($className);

            // Пропускаем абстрактные классы и интерфейсы
            if ($reflection->isAbstract() || $reflection->isInterface()) {
                continue;
            }

            $this->info("Контроллер: " . $reflection->getName());

            // Получаем все публичные методы, объявленные в этом классе (исключая унаследованные)
            $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
            foreach ($methods as $method) {
                if ($method->getDeclaringClass()->getName() !== $reflection->getName()) {
                    continue; // метод унаследован, пропускаем
                }

                // Получаем PHPDoc комментарий метода
                $docComment = $method->getDocComment();

                $description = cleanDocComment($docComment);

                $lines = explode("\n", $description);
                $lines = array_map(fn($line) => '  ' . $line, $lines);
                $description = implode("\n", $lines);

                $this->line("");
                $this->line("- " . $method->getName());
                $this->line($description ?: 'Отсутствует');
            }

            $this->line(''); // пустая строка для разделения контроллеров
        }
    }
}

function cleanDocComment(string $docComment): string
{
    // Разбиваем комментарий на строки
    $lines = explode("\n", $docComment);

    // Удаляем первую и последнюю строки (/** и */)
    array_shift($lines);
    array_pop($lines);

    // Очищаем каждую строку от ведущих пробелов и символа '*'
    $cleanedLines = array_map(function($line) {
        return ltrim($line, " \t*");
    }, $lines);

    // Объединяем обратно в строку
    return trim(implode("\n", $cleanedLines));
}

