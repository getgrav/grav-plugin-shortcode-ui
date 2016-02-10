<?php

namespace Grav\Plugin\Shortcodes;

use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;


class AnimatedTextShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('ui-animated-text', function(ShortcodeInterface $sc) {

            // Add assets
            $this->shortcode->addAssets('css', 'plugin://shortcode-ui/css/ui-atext.css');
            $this->shortcode->addAssets('js', 'plugin://shortcode-ui/js/ui-atext.js');

            $content = $sc->getContent();
            $animation = $sc->getParameter('animation', 'rotate-1');
            $words = $sc->getParameter('words', 'cool, funky, fresh');
            $visible = $sc->getParameter('visible', 1);


            if (Utils::contains($content, '%WORDS%')) {
                $content = explode('%WORDS%', $content);
            } else {
                $content = (array) $content;
            }

            if (intval($visible) > count($words)) {
                $visible = 1;
            }

            $output = $this->twig->processTemplate('partials/ui-atext.html.twig', [
                'content' => $content,
                'words' => explode(',', $words),
                'animation' => $animation,
                'element' => $sc->getParameter('element', 'h1'),
                'wrapper_extra' => Utils::contains($animation, 'type') ? ' waiting' : '',
                'visible' => $visible,
            ]);

            return $output;
        });
    }
}