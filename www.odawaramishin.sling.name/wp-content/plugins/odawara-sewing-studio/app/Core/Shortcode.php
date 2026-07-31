<?php

namespace OSS\Core;

if (!defined('ABSPATH')) {
    exit;
}

class Shortcode
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        add_shortcode(
            'odawara_sewing_studio',
            [$this, 'render']
        );
    }

    /**
     * ショートコード表示
     */
    public function render(array $atts = []): string
    {
        ob_start();

        $view = OSS_PLUGIN_PATH . 'resources/views/calculator.php';

        if (file_exists($view)) {
            include $view;
        } else {
            echo '<div class="oss-container">';
            echo '<div class="oss-card">';
            echo '<h2>Odawara Sewing Studio</h2>';
            echo '<p>ビューが見つかりません。</p>';
            echo '</div>';
            echo '</div>';
        }

        return ob_get_clean();
    }
}