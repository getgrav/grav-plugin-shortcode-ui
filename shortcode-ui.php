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
            'registerNextGenEditorPlugin' => ['registerNextGenEditorPluginShortcodes', 0],
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

    public function registerNextGenEditorPluginShortcodes($event) {
        $plugins = $event['plugins'];

        $plugins['js'][] = 'plugin://shortcode-ui/nextgen-editor/shortcodes/shortcode-ui.js';
        $plugins['js'][] = 'plugin://shortcode-ui/nextgen-editor/shortcodes/ui-accordion/ui-accordion.js';
        $plugins['js'][] = 'plugin://shortcode-ui/nextgen-editor/shortcodes/ui-tabs/ui-tabs.js';
        $plugins['js'][] = 'plugin://shortcode-ui/nextgen-editor/shortcodes/ui-browser/ui-browser.js';
        $plugins['js'][] = 'plugin://shortcode-ui/nextgen-editor/shortcodes/ui-polaroid/ui-polaroid.js';
        $plugins['js'][] = 'plugin://shortcode-ui/nextgen-editor/shortcodes/ui-animated-text/ui-animated-text.js';
        $plugins['js'][] = 'plugin://shortcode-ui/nextgen-editor/shortcodes/ui-image-compare/ui-image-compare.js';

        $event['plugins']  = $plugins;
        return $event;
    }
}
