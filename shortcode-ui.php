<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Utils;
use RocketTheme\Toolbox\Event\Event;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;


class ShortcodeUiPlugin extends Plugin
{
    protected $handlers;
    protected $assets;

    protected $child_states;

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
    }

    public function onTwigExtensions()
    {
        require_once(__DIR__ . '/twig/ShortcodeUITwigExtension.php');
        $this->grav['twig']->twig->addExtension(new ShortcodeUiTwigExtension());
    }

    /**
     * Initialize configuration
     *
     * @param Event $e
     */
    public function onShortcodeHandlers(Event $e)
    {
        $this->handlers = $e['handlers'];
        $this->assets = $e['assets'];

        $this->addTabsHandler();
        $this->addBrowserHandler();
        $this->addCalloutHander();
        $this->addImageCompareHandler();
        $this->addAnimatedTextHandler();
    }

    private function addTabsHandler()
    {
        $this->handlers->add('ui-tabs', function(ShortcodeInterface $shortcode) {

            // Add assets
            $this->assets->add('js', ['jquery', 101]);
            $this->assets->add('js', 'plugin://shortcode-ui/js/ui-tabs.js');
            $this->assets->add('css', 'plugin://shortcode-ui/css/ui-tabs.css');

            $hash = $this->getShortcodeId($shortcode);

            $output = $this->grav['twig']->processTemplate('partials/ui-tabs.html.twig', [
                'hash' => $hash,
                'active' => $shortcode->getParameter('active', 0),
                'position' => $shortcode->getParameter('position', 'top-left'),
                'theme' => $shortcode->getParameter('theme', $this->grav['config']->get('plugins.shortcode-ui.theme.tabs', 'default')),
                'child_tabs' => $this->child_states[$hash],
            ]);

            return $output;
        });

        $this->handlers->add('ui-tab', function(ShortcodeInterface $shortcode) {
            // Add tab to tab state using parent tabs id
            $hash = $this->getShortcodeId($shortcode->getParent());
            $this->child_states[$hash][] = $shortcode;
            return;
        });
    }

    private function addBrowserHandler()
    {
        $this->handlers->add('ui-browser', function(ShortcodeInterface $shortcode) {

            // Add assets
            $this->assets->add('css', 'plugin://shortcode-ui/css/ui-browser.css');

            $output = $this->grav['twig']->processTemplate('partials/ui-browser.html.twig', [
                'address' => $shortcode->getParameter('address', 'http://localhost'),
                'shortcode' => $shortcode,
            ]);

            return $output;
        });
    }

    private function addCalloutHander()
    {
        $this->handlers->add('ui-callout', function(ShortcodeInterface $shortcode) {

            // Add assets
            $this->assets->add('js', ['jquery', 101]);
            $this->assets->add('js', 'plugin://shortcode-ui/js/ui-tooltips.js');
            $this->assets->add('css', 'plugin://shortcode-ui/css/ui-tooltips.css');
            $this->assets->add('css', 'plugin://shortcode-ui/css/ui-callouts.css');

            $hash = $this->getShortcodeId($shortcode);

            $output = $this->grav['twig']->processTemplate('partials/ui-callouts.html.twig', [
                'hash' => $hash,
                'shortcode' => $shortcode,
                'callouts' => $this->child_states[$hash],
            ]);

            return $output;
        });

        $this->handlers->add('ui-callout-item',  function(ShortcodeInterface $shortcode) {
            // Add tab to tab state using parent tabs id
            $hash = $this->getShortcodeId($shortcode->getParent());
            $this->child_states[$hash][] = $shortcode;
            return;
        });
    }

    private function addImageCompareHandler()
    {
        $this->handlers->add('ui-image-compare', function(ShortcodeInterface $shortcode) {

            // Add assets
            $this->assets->add('css', 'plugin://shortcode-ui/css/ui-cslider.css');
            $this->assets->add('js', 'plugin://shortcode-ui/js/ui-cslider.js');

            $content = $shortcode->getContent();

            preg_match_all('/<img.*(?:alt="(.*?)").*\/>/', $content, $matches);

            if (sizeof($matches) == 2 && sizeof($matches[0]) == 2) {
                $output = $this->grav['twig']->processTemplate('partials/ui-cslider.html.twig', [
                    'matches' => $matches,
                ]);

                return $output;
            }


        });
    }

    private function addAnimatedTextHandler()
    {
        $this->handlers->add('ui-animated-text', function(ShortcodeInterface $shortcode) {

            // Add assets
            $this->assets->add('css', 'plugin://shortcode-ui/css/ui-atext.css');
            $this->assets->add('js', 'plugin://shortcode-ui/js/ui-atext.js');

            $content = $shortcode->getContent();
            $animation = $shortcode->getParameter('animation', 'rotate-1');
            $words = $shortcode->getParameter('words', 'cool, funky, fresh');
            $visible = $shortcode->getParameter('visible', 1);


            if (Utils::contains($content, '%WORDS%')) {
                $content = explode('%WORDS%', $content);
            } else {
                $content = (array) $content;
            }

            if (intval($visible) > count($words)) {
                $visible = 1;
            }

            $output = $this->grav['twig']->processTemplate('partials/ui-atext.html.twig', [
                'content' => $content,
                'words' => explode(',', $words),
                'animation' => $animation,
                'element' => $shortcode->getParameter('element', 'h1'),
                'wrapper_extra' => Utils::contains($animation, 'type') ? ' waiting' : '',
                'visible' => $visible,
            ]);

            return $output;
        });
    }

    private function getShortcodeId($shortcode)
    {
        return substr(md5($shortcode->getShortcodeText()), -10);
    }
}
