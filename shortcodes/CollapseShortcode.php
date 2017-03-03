<?php

namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;


class CollapseShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('ui-collapse', function(ShortcodeInterface $sc) {

            // Add assets
            $this->shortcode->addAssets('js', 'plugin://shortcode-ui/js/ui-collapse.js');
            $this->shortcode->addAssets('css', 'plugin://shortcode-ui/css/ui-collapse.css');

            $hash    = $this->shortcode->getId($sc);
            $content = $sc->getContent();
            $title   = $sc->getParameter('title', 'default');

            $output = $this->twig->processTemplate('partials/ui-collapse.html.twig',
            [
                'hash'    => $hash,
                'content' => $content,
                'title'   => $title,
            ]);

            return $output;
        });
    }
}