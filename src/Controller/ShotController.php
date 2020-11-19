<?php

namespace App\Controller;

use App\Model\CocktailManager;

class ShotController extends AbstractController
{
    public function show()
    {
        $cocktailManager = new CocktailManager();

        $cocktails = $cocktailManager->getCocktailData();
        $cocktailsAliases = [
            'Vodka' => 'Potato Alcohol',
            'Gin' => 'Bathtub Gin',
            'Rum' => 'Beet Alcohol',
            'Tequila' => 'Fermented Salsa Sauce',
            'Scotch' => 'Gasoline'
        ];

        if (array_key_exists($cocktails['ingredient1'], $cocktailsAliases)) {
            $name = $cocktails['ingredient1'];
            $cocktails['ingredient1'] = $cocktailsAliases[$name];
        }
        if (array_key_exists($cocktails['ingredient2'], $cocktailsAliases)) {
            $name = $cocktails['ingredient2'];
            $cocktails['ingredient2'] = $cocktailsAliases[$name];
        }
        if (array_key_exists($cocktails['ingredient3'], $cocktailsAliases)) {
            $name = $cocktails['ingredient3'];
            $cocktails['ingredient3'] = $cocktailsAliases[$name];
        }
        if (array_key_exists($cocktails['ingredient4'], $cocktailsAliases)) {
            $name = $cocktails['ingredient4'];
            $cocktails['ingredient4'] = $cocktailsAliases[$name];
        }
        if (array_key_exists($cocktails['ingredient5'], $cocktailsAliases)) {
            $name = $cocktails['ingredient5'];
            $cocktails['ingredient5'] = $cocktailsAliases[$name];
        }

        return $this->twig->render('ShotGenerator/generate.html.twig', [
            'cocktails' => $cocktails,
            'cocktailsAliases' => $cocktailsAliases,
        ]);
    }
}
