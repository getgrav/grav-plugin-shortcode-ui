<?php

namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class AccordionsShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('ui-accordion', function(ShortcodeInterface $sc) {
            // Add assets
            $this->shortcode->addAssets('css', 'plugin://shortcode-ui/css/ui-accordion.css');

            $hash = $this->shortcode->getId($sc);

            $independent = filter_var($sc->getParameter('independent', false), FILTER_VALIDATE_BOOLEAN);

            $output = $this->twig->processTemplate(
                'partials/ui-accordion.html.twig',
                [
                    'hash' => $hash,
                    'open' => $sc->getParameter('open'),
                    'type' => $independent ? 'checkbox' : 'radio',
                    'accordion_items' => $this->shortcode->getStates($hash),
                ]
            );

            return $output;
        });

        $this->shortcode->getHandlers()->add('ui-accordion-item', function(ShortcodeInterface $sc) {
            // Add accordion to accordion state using parent accordion id
            $hash = $this->shortcode->getId($sc->getParent());
            $this->shortcode->setStates($hash, $sc);

            return '';
        });
    }
}