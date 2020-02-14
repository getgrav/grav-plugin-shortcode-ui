<?php

namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class CalloutShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('ui-callout', function(ShortcodeInterface $sc) {
            // Add assets
            $this->shortcode->addAssets('js', ['jquery', 101]);
            $this->shortcode->addAssets('js', 'plugin://shortcode-ui/js/ui-tooltips.js');
            $this->shortcode->addAssets('css', 'plugin://shortcode-ui/css/ui-tooltips.css');
            $this->shortcode->addAssets('css', 'plugin://shortcode-ui/css/ui-callouts.css');

            $hash = $this->shortcode->getId($sc);

            $output = $this->twig->processTemplate(
                'partials/ui-callouts.html.twig',
                [
                    'hash' => $hash,
                    'shortcode' => $sc,
                    'classes' => $sc->getParameter('class'),
                    'callouts' => $this->shortcode->getStates($hash),
                ]
            );

            return $output;
        });

        $this->shortcode->getHandlers()->add('ui-callout-item',  function(ShortcodeInterface $sc) {
            // Add tab to tab state using parent tabs id
            $hash = $this->shortcode->getId($sc->getParent());
            $this->shortcode->setStates($hash, $sc);

            return '';
        });
    }
}