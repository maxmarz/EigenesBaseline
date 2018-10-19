<?php

namespace CeresEigenesBaseline\Containers;

use Plenty\Plugin\Templates\Twig;

class CeresEigenesBaselineScript
{
    public function call(Twig $twig):string
    {
        return $twig->render('CeresEigenesBaseline::CeresEigenesBaselineScript');
    }
}
