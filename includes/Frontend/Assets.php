<?php
namespace Woobooking\Frontend;

class Assets
{

    /**
     * Class constructor
     */
    function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'register_assets']);
        add_action('admin_enqueue_scripts', [$this, 'register_assets']);
    }

    /**
     * All available scripts
     *
     * @return array
     */
    public function get_scripts()
    {
        return [
            'woobooking-script' => [
                'src'     => WOOBOOKING_ASSETS . '/js/woobooking-script.js',
                'version' => filemtime(WOOBOOKING_PATH . '/assets/js/woobooking-script.js'),
                'deps'    => ['jquery'],
            ],
            // Register flatpickr JavaScript (from CDN)
            'flatpickr'         => [
                'src'     => 'https://cdn.jsdelivr.net/npm/flatpickr',
                'version' => null, // No versioning required for CDN
                'deps'    => ['jquery'],
            ],
        ];
    }

    /**
     * All available styles
     *
     * @return array
     */
    public function get_styles()
    {
        return [
            'woobooking-style' => [
                'src'     => WOOBOOKING_ASSETS . '/css/woobooking-style.css',
                'version' => filemtime(WOOBOOKING_PATH . '/assets/css/woobooking-style.css'),
            ],
            'flatpickr'        => [
                'src'     => 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css',
                'version' => null, // No versioning required for CDN
            ],
        ];
    }

    /**
     * Register scripts and styles
     *
     * @return void
     */
    public function register_assets()
    {
        $scripts = $this->get_scripts();
        $styles  = $this->get_styles();

        foreach ($scripts as $handle => $script) {
            $deps = isset($script['deps']) ? $script['deps'] : false;

            wp_register_script($handle, $script['src'], $deps, $script['version'], true);
        }

        foreach ($styles as $handle => $style) {
            $deps = isset($style['deps']) ? $style['deps'] : false;

            wp_register_style($handle, $style['src'], $deps, $style['version']);
        }
    }
}
