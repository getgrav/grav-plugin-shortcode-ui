<?php

namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class PolaroidShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('ui-polaroid', function(ShortcodeInterface $sc) {
            // Add assets
            $this->shortcode->addAssets('css', 'plugin://shortcode-ui/css/ui-polaroid.css');

            return $this->twig->processTemplate(
                'partials/ui-polaroid.html.twig',
                [
                    'shortcode' => $sc,
                ]
            );
        });
    }
}