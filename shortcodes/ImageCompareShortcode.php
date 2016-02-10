<?php

namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;


class ImageCompareShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('ui-image-compare', function(ShortcodeInterface $sc) {

            // Add assets
            $this->shortcode->addAssets('css', 'plugin://shortcode-ui/css/ui-cslider.css');
            $this->shortcode->addAssets('js', 'plugin://shortcode-ui/js/ui-cslider.js');

            $content = $sc->getContent();

            preg_match_all('/<img.*(?:alt="(.*?)").*\/>/', $content, $matches);

            if (sizeof($matches) == 2 && sizeof($matches[0]) == 2) {
                $output = $this->twig->processTemplate('partials/ui-cslider.html.twig', [
                    'matches' => $matches,
                ]);

                return $output;
            }
        });
    }
}