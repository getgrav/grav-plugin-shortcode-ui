<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;
use Grav\Plugin\ShortcodeUi\ShortcodeUiTwigExtension;

class ShortcodeUiPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => [
                ['autoload', 100001],
            ],
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            'onTwigExtensions' => ['onTwigExtensions', 0],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
        ];
    }

    /**
     * [onPluginsInitialized:100000] Composer autoload.
     *
     * @return ClassLoader
     */
    public function autoload()
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    /**
     * Add current directory to twig lookup paths.
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    public function onTwigExtensions()
    {
        $this->grav['twig']->twig->addExtension(new ShortcodeUiTwigExtension());
    }

    /**
     * Initialize configuration
     */
    public function onShortcodeHandlers()
    {
        $this->grav['shortcode']->registerAllShortcodes(__DIR__ . '/classes/shortcodes');
    }
}
