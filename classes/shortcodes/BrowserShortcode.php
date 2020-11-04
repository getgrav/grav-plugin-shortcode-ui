<?php

namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class BrowserShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('ui-browser', function(ShortcodeInterface $sc) {
            // Add assets
            $this->shortcode->addAssets('css', 'plugin://shortcode-ui/css/ui-browser.css');

            return $this->twig->processTemplate(
                'partials/ui-browser.html.twig',
                [
                    'address' => $sc->getParameter('address', 'http://localhost'),
                    'class' => $sc->getParameter('class', null),
                    'shortcode' => $sc,
                ]
            );
        });
    }
}