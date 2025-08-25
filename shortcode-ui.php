<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;
use Grav\Plugin\ShortcodeUi\ShortcodeUiTwigExtension;
use RocketTheme\Toolbox\Event\Event;

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
            'onEditorProShortcodeRegister' => ['onEditorProShortcodeRegister', 0],
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

    /**
     * Register shortcodes with Editor Pro
     */
    public function onEditorProShortcodeRegister(Event $event)
    {
        $shortcodes = $event['shortcodes'];
        
        // UI Accordion - Block shortcode with parent-child relationship
        $shortcodes[] = [
            'name' => 'ui-accordion',
            'title' => 'UI Accordion',
            'description' => 'Collapsible accordion sections',
            'type' => 'block',
            'hasContent' => true,
            'category' => 'ui',
            'group' => 'Shortcode UI',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2v14a2 2 0 0 0 2 2h14"></path><path d="M18 22V8a2 2 0 0 0-2-2H2"></path></svg>',
            'attributes' => [
                'independent' => [
                    'type' => 'select',
                    'title' => 'Independent',
                    'options' => ['false', 'true'],
                    'default' => 'false',
                    'required' => false,
                    'description' => 'Allow multiple sections open (true) or single section only (false)'
                ],
                'open' => [
                    'type' => 'string',
                    'default' => 'none',
                    'required' => false,
                    'description' => 'Which sections to open by default (all, none, or index number)'
                ]
            ],
            'allowedChildren' => ['ui-accordion-item'],
            'restrictContent' => true,
            'titleBarAttributes' => ['independent', 'open'],
            'cssTemplate' => null,
            'plugin' => 'shortcode-ui'
        ];

        // UI Accordion Item - Child shortcode
        $shortcodes[] = [
            'name' => 'ui-accordion-item',
            'title' => 'Accordion Item',
            'description' => 'Individual accordion section',
            'type' => 'block',
            'hasContent' => true,
            'category' => 'ui',
            'group' => 'Shortcode UI',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>',
            'parentOnly' => true,
            'attributes' => [
                'title' => [
                    'type' => 'string',
                    'default' => '',
                    'required' => true,
                    'description' => 'Title of the accordion section'
                ]
            ],
            'titleBarAttributes' => ['title'],
            'cssTemplate' => null,
            'plugin' => 'shortcode-ui'
        ];

        // UI Animated Text - Inline shortcode
        $shortcodes[] = [
            'name' => 'ui-animated-text',
            'title' => 'Animated Text',
            'description' => 'Text with animated word transitions',
            'type' => 'inline',
            'hasContent' => true,
            'category' => 'ui',
            'group' => 'Shortcode UI',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9.5 5.5 11 4 12.5 5.5"></polyline><line x1="11" y1="4" x2="11" y2="9.5"></line><polyline points="14.5 18.5 13 20 11.5 18.5"></polyline><line x1="13" y1="20" x2="13" y2="14.5"></line><polyline points="5.5 14.5 4 13 5.5 11.5"></polyline><line x1="4" y1="13" x2="9.5" y2="13"></line><polyline points="18.5 9.5 20 11 18.5 12.5"></polyline><line x1="20" y1="11" x2="14.5" y2="11"></line><path d="M2 12a10 10 0 1 0 20 0a10 10 0 1 0 -20 0"></path></svg>',
            'attributes' => [
                'words' => [
                    'type' => 'string',
                    'default' => 'cool, funky, fresh',
                    'required' => false,
                    'description' => 'Comma-separated list of words to animate'
                ],
                'element' => [
                    'type' => 'select',
                    'title' => 'Element',
                    'options' => ['h1', 'h2', 'h3', 'h4', 'span', 'div'],
                    'default' => 'h1',
                    'required' => false,
                ],
                'animation' => [
                    'type' => 'select',
                    'title' => 'Animation',
                    'options' => ['type', 'loading-bar', 'slide', 'scale', 'clip', 'zoom', 'push', 'rotate-1', 'rotate-2', 'rotate-3'],
                    'default' => 'rotate-1',
                    'required' => false,
                ],
                'visible' => [
                    'type' => 'number',
                    'default' => 1,
                    'required' => false,
                    'description' => 'Number of words visible at once'
                ]
            ],
            'titleBarAttributes' => ['animation', 'words'],
            'cssTemplate' => 'display: inline-block; font-weight: bold;',
            'plugin' => 'shortcode-ui'
        ];

        // UI Browser - Block shortcode
        $shortcodes[] = [
            'name' => 'ui-browser',
            'title' => 'Browser Window',
            'description' => 'Content styled as a browser window',
            'type' => 'block',
            'hasContent' => true,
            'category' => 'ui',
            'group' => 'Shortcode UI',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>',
            'attributes' => [
                'address' => [
                    'type' => 'string',
                    'default' => 'http://localhost',
                    'required' => false,
                    'description' => 'URL to display in browser address bar'
                ],
                'class' => [
                    'type' => 'string',
                    'default' => '',
                    'required' => false,
                    'description' => 'Additional CSS classes'
                ]
            ],
            'titleBarAttributes' => ['address'],
            'cssTemplate' => 'border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);',
            'plugin' => 'shortcode-ui'
        ];

        // UI Callout - Block shortcode with parent-child relationship
        $shortcodes[] = [
            'name' => 'ui-callout',
            'title' => 'UI Callout',
            'description' => 'Interactive callout points on content',
            'type' => 'block',
            'hasContent' => true,
            'category' => 'ui',
            'group' => 'Shortcode UI',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>',
            'attributes' => [
                'class' => [
                    'type' => 'string',
                    'default' => '',
                    'required' => false,
                    'description' => 'Additional CSS classes'
                ]
            ],
            'allowedChildren' => ['ui-callout-item'],
            'restrictContent' => true,
            'titleBarAttributes' => ['class'],
            'cssTemplate' => 'position: relative; display: inline-block;',
            'plugin' => 'shortcode-ui'
        ];

        // UI Callout Item - Child shortcode
        $shortcodes[] = [
            'name' => 'ui-callout-item',
            'title' => 'Callout Item',
            'description' => 'Individual callout point',
            'type' => 'block',
            'hasContent' => true,
            'category' => 'ui',
            'group' => 'Shortcode UI',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="10" r="3"></circle><path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 6.9 8 11.7z"></path></svg>',
            'parentOnly' => true,
            'attributes' => [
                'title' => [
                    'type' => 'string',
                    'default' => '',
                    'required' => true,
                    'description' => 'Tooltip title'
                ],
                'position' => [
                    'type' => 'string',
                    'default' => '0,0',
                    'required' => false,
                    'description' => 'Position coordinates (x,y)'
                ]
            ],
            'titleBarAttributes' => ['title', 'position'],
            'cssTemplate' => 'position: absolute; background: #007cba; color: white; padding: 4px 8px; border-radius: 3px;',
            'plugin' => 'shortcode-ui'
        ];

        // UI Image Compare - Block shortcode
        $shortcodes[] = [
            'name' => 'ui-image-compare',
            'title' => 'Image Compare',
            'description' => 'Before/after image comparison slider',
            'type' => 'block',
            'hasContent' => true,
            'category' => 'ui',
            'group' => 'Shortcode UI',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"></path><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"></path><path d="M8 16H3v5"></path><path d="M16 8h5v5"></path></svg>',
            'attributes' => [],
            'titleBarAttributes' => [],
            'cssTemplate' => 'position: relative; display: inline-block; overflow: hidden;',
            'plugin' => 'shortcode-ui'
        ];

        // UI Polaroid - Block shortcode
        $shortcodes[] = [
            'name' => 'ui-polaroid',
            'title' => 'Polaroid Frame',
            'description' => 'Content styled as a polaroid photo',
            'type' => 'block',
            'hasContent' => true,
            'category' => 'ui',
            'group' => 'Shortcode UI',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"></path><circle cx="12" cy="13" r="3"></circle></svg>',
            'attributes' => [
                'class' => [
                    'type' => 'string',
                    'default' => '',
                    'required' => false,
                    'description' => 'Additional CSS classes'
                ]
            ],
            'titleBarAttributes' => ['class'],
            'cssTemplate' => 'background: white; padding: 10px 10px 50px 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.3); transform: rotate(-2deg);',
            'plugin' => 'shortcode-ui'
        ];

        // UI Tabs - Block shortcode with parent-child relationship
        $shortcodes[] = [
            'name' => 'ui-tabs',
            'title' => 'UI Tabs',
            'description' => 'Tabbed content sections',
            'type' => 'block',
            'hasContent' => true,
            'category' => 'ui',
            'group' => 'Shortcode UI',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 6a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6z"></path></svg>',
            'attributes' => [
                'active' => [
                    'type' => 'number',
                    'default' => 0,
                    'required' => false,
                    'description' => 'Which tab is active by default (0-based index)'
                ],
                'position' => [
                    'type' => 'select',
                    'title' => 'Position',
                    'options' => ['top-left', 'top-right', 'bottom-left', 'bottom-right'],
                    'default' => 'top-left',
                    'required' => false,
                ],
                'theme' => [
                    'type' => 'string',
                    'default' => 'default',
                    'required' => false,
                    'description' => 'Theme name'
                ]
            ],
            'allowedChildren' => ['ui-tab'],
            'restrictContent' => true,
            'titleBarAttributes' => ['active', 'position', 'theme'],
            'cssTemplate' => 'border: 1px solid #ddd; border-radius: 4px;',
            'plugin' => 'shortcode-ui'
        ];

        // UI Tab - Child shortcode
        $shortcodes[] = [
            'name' => 'ui-tab',
            'title' => 'Tab',
            'description' => 'Individual tab content',
            'type' => 'block',
            'hasContent' => true,
            'category' => 'ui',
            'group' => 'Shortcode UI',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path><path d="M14 2v4a2 2 0 0 0 2 2h4"></path></svg>',
            'parentOnly' => true,
            'attributes' => [
                'title' => [
                    'type' => 'string',
                    'default' => '',
                    'required' => true,
                    'description' => 'Tab title'
                ]
            ],
            'titleBarAttributes' => ['title'],
            'cssTemplate' => 'padding: 15px;',
            'plugin' => 'shortcode-ui'
        ];
        
        $event['shortcodes'] = $shortcodes;
    }
}
