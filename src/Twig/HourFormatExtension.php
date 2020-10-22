<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class HourFormatExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('formatHour', [$this, 'formatHour']),
        ];
    }

    public function formatHour($value)
    {
        $hour = '';
        $value = strval($value);
        $array = explode('.', $value);
        if (count($array) != 1) {
            $data = intval($array[1]);
            $array[1] = $data*60/100;
            if ($array[1] < 10) {
                $array[1] = intval($array[1])*10;
            }
        }
        $array[0] .= "h";
        $hour = implode('', $array);
        return $hour;
    }
}
