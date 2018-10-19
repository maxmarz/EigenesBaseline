<?php

namespace CeresEigenesBaseline\Containers;

use Plenty\Plugin\Templates\Twig;

class CeresEigenesBaselineStyle
{
    public function call(Twig $twig):string
    {
        return $twig->render('CeresEigenesBaseline::CeresEigenesBaselineStyle');
    }
}
