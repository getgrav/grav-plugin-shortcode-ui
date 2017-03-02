<?php

namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;


class AccordianShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('ui-accordian', function(ShortcodeInterface $sc) {

            // Add assets
            $this->shortcode->addAssets('css', 'plugin://shortcode-ui/css/ui-accordian.css');

            $hash = $this->shortcode->getId($sc);

            $independent = filter_var($sc->getParameter('independent', false), FILTER_VALIDATE_BOOLEAN);

            $output = $this->twig->processTemplate('partials/ui-accordian.html.twig', [
                'hash' => $hash,
                'open' => $sc->getParameter('open'),
                'type' => $independent ? 'checkbox' : 'radio',
                'accordian_items' => $this->shortcode->getStates($hash),
            ]);

            return $output;
        });

        $this->shortcode->getHandlers()->add('ui-accordian-item', function(ShortcodeInterface $sc) {
            // Add accordian to accordian state using parent accordian id
            $hash = $this->shortcode->getId($sc->getParent());
            $this->shortcode->setStates($hash, $sc);
            return;
        });
    }
}