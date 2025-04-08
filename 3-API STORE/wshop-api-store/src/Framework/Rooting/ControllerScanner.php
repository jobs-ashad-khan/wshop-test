<?php

namespace App\Framework\Rooting;

class ControllerScanner
{
    public static function scan(string $directory, string $namespace = 'App\\Controller'): array
    {
        $controllers = [];

        foreach (scandir($directory) as $file) {
            if (preg_match('/^[A-Z].*Controller\.php$/', $file)) {
                $className = $namespace . '\\' . pathinfo($file, PATHINFO_FILENAME);
                if (class_exists($className)) {
                    $controllers[] = $className;
                }
            }
        }

        return $controllers;
    }
}