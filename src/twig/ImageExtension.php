<?php

namespace App\twig;

use App\Repository\CategorieRecetteRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ImageExtension extends AbstractExtension
{

    public function getFunctions(): array
    {
        return [
            new TwigFunction('image', [$this, 'image']),
        ];
    }

    public function image($blob): string
    {
        return base64_encode(stream_get_contents($blob));
    }
}
