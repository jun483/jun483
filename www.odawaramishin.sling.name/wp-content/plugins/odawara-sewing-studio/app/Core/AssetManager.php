<?php

namespace OSS\Core;

if (!defined('ABSPATH')) {
    exit;
}

class AssetManager
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueueFrontend']);
        add_action('admin_enqueue_scripts', [$this, 'enqueueAdmin']);
    }

    /**
     * フロント側
     */
    public function enqueueFrontend(): void
    {
        wp_enqueue_style(
            'oss-style',
            OSS_PLUGIN_URL . 'resources/css/app.css',
            [],
            OSS_VERSION
        );

        wp_enqueue_script(
            'oss-script',
            OSS_PLUGIN_URL . 'resources/js/app.js',
            [],
            OSS_VERSION,
            true
        );
        wp_enqueue_script(
    'oss-layout-preview',
    OSS_PLUGIN_URL . 'resources/js/layout-preview.js',
    [],
    OSS_VERSION,
    true
);

        wp_localize_script(
            'oss-script',
            'oss',
            [
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('oss_nonce'),
            ]
        );
    }

    /**
     * 管理画面
     */
    public function enqueueAdmin(): void
    {
        wp_enqueue_style(
            'oss-admin',
            OSS_PLUGIN_URL . 'resources/css/admin.css',
            [],
            OSS_VERSION
        );
    }
}