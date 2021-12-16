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

            preg_match_all("/<img\s[^>]*?alt\s*=\s*['\"]([^'\"]*?)['\"][^>]*?>/", $content, $matches);

            if (count($matches) === 2 && count($matches[0]) === 2) {
                return $this->twig->processTemplate(
                    'partials/ui-cslider.html.twig',
                    [
                        'matches' => $matches,
                    ]
                );
            }

            return '';
        });
    }
}