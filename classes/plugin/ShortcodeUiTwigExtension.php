<?php
namespace Grav\Plugin\ShortcodeUi;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ShortcodeUiTwigExtension extends AbstractExtension
{
    /**
     * Returns extension name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'ShortcodeUiExtension';
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('shortcodeui_parsePosition', [$this, 'parsePositionFunc']),
        ];
    }

    public function parsePositionFunc($position)
    {
        preg_match('/(.+), *(.+), *(\w+)/', $position, $matches);

        $position = [
            'location' => 'top:' . $matches[1] . ';left:' . $matches[2] . ';',
            'coords'   => $matches[3] ?? 'nw',
            ];

        return $position;
    }

}
