<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;


class ShortcodeUiPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            'onTwigExtensions' => ['onTwigExtensions', 0],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
        ];
    }

    /**
     * Add current directory to twig lookup paths.
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';

        $custom_shortcodes = $this->config->get('plugins.shortcode-ui.custom_shortcodes');
        if (isset($custom_shortcodes)) {
            $this->grav['twig']->twig_paths[] = GRAV_ROOT . $custom_shortcodes.'/templates';
        }

    }

    public function onTwigExtensions()
    {
        require_once(__DIR__ . '/twig/ShortcodeUITwigExtension.php');
        $this->grav['twig']->twig->addExtension(new ShortcodeUiTwigExtension());
    }

    /**
     * Initialize configuration
     */
    public function onShortcodeHandlers()
    {
        $this->grav['shortcode']->registerAllShortcodes(__DIR__.'/shortcodes');
        $custom_shortcodes = $this->config->get('plugins.shortcode-ui.custom_shortcodes');
        if (isset($custom_shortcodes)) {
            $this->grav['shortcode']->registerAllShortcodes(GRAV_ROOT . $custom_shortcodes.'/shortcodes');
        }
    }
}
