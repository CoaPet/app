<?php

namespace App\Twig;

use App\Entity\User;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TruncateTextExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('truncateText', [$this, 'truncateText']),
        ];
    }

    public function truncateText($text, $words, $end)
    {
        $array = explode(' ', $text);
        $result = '';
        if (count($array)<$words) {
            $result = implode(' ', $array);
        } else {
            for ($i=0; $i<$words; $i++) {
                $result = $result . ' ' . $array[$i];
            }
            $result = $result . $end;
        }

        return $result;
    }
}
