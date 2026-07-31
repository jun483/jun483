<?php

namespace OSS\Core;

if (!defined('ABSPATH')) {
    exit;
}

class Autoloader
{
    /**
     * 名前空間
     */
    private const PREFIX = 'OSS\\';

    /**
     * ベースディレクトリ
     */
    private static string $baseDir;

    /**
     * オートローダー登録
     */
    public static function register(): void
    {
        self::$baseDir = dirname(__DIR__) . DIRECTORY_SEPARATOR;

        spl_autoload_register([self::class, 'autoload']);
    }

    /**
     * クラス読み込み
     */
    private static function autoload(string $class): void
    {
        if (strpos($class, self::PREFIX) !== 0) {
            return;
        }

        $relative = substr($class, strlen(self::PREFIX));

        $relative = str_replace('\\', DIRECTORY_SEPARATOR, $relative);

        $file = self::$baseDir . $relative . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    }
}