<?php

namespace OSS\Core;

if (!defined('ABSPATH')) {
    exit;
}

use OSS\Core\AssetManager;
use OSS\Core\Shortcode;

final class Application
{
    /**
     * インスタンス
     */
    private static ?Application $instance = null;

    /**
     * 起動
     */
    public static function boot(): Application
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * コンストラクタ
     */
    private function __construct()
    {
        $this->registerHooks();
    }

    /**
     * WordPressへ登録
     */
    private function registerHooks(): void
    {
        add_action('init', [$this, 'init']);
    }

    /**
     * 初期化
     */
    public function init(): void
    {
        $this->loadCore();
    }

    /**
     * Core起動
     */
    private function loadCore(): void
{
    new AssetManager();
    new Shortcode();
    new Ajax();
}
}