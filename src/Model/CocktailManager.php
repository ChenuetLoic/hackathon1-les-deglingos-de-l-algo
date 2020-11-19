<?php

namespace App\Model;

use Symfony\Component\HttpClient\HttpClient;

class CocktailManager
{
    public const ALCOHOL_LIST = ['Vodka', 'Gin', 'Scotch', 'Tequila', 'Rum'];

    public function getCocktails(): array
    {
        $client = HttpClient::create();
        $randomizer = array_rand(self::ALCOHOL_LIST, 1);
        $randomAlcohol = self::ALCOHOL_LIST[$randomizer];
        $response = $client->request(
            'GET',
            'https://www.thecocktaildb.com/api/json/v1/1/filter.php?i=' . $randomAlcohol
        );

        return $response->toArray();
    }

    public function getRandomCocktailById(): array
    {
        $client = HttpClient::create();
        $cocktails = $this->getCocktails();
        $cocktailIds = [];

        foreach ($cocktails as $cocktail) {
            foreach ($cocktail as $cocktailData) {
                $cocktailIds[] = $cocktailData['idDrink'];
            }
        }

        $randomizer = array_rand($cocktailIds, 1);
        $randomCocktailId = $cocktailIds[$randomizer];

        $response = $client->request(
            'GET',
            'https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i=' . $randomCocktailId
        );

        return $response->toArray();
    }

    public function getCocktailData(): array
    {
        $cocktails = $this->getRandomCocktailById();
        $cocktailsInfos = [];

        foreach ($cocktails as $cocktail) {
            foreach ($cocktail as $cocktailData) {
                $cocktailsInfos['name'] = $cocktailData['strDrink'];
                $cocktailsInfos['image'] = $cocktailData['strDrinkThumb'];
                $cocktailsInfos['ingredient1'] = $cocktailData['strIngredient1'];
                $cocktailsInfos['ingredient2'] = $cocktailData['strIngredient2'];
                $cocktailsInfos['ingredient3'] = $cocktailData['strIngredient3'];
                $cocktailsInfos['ingredient4'] = $cocktailData['strIngredient4'];
                $cocktailsInfos['ingredient5'] = $cocktailData['strIngredient5'];
            }
        }
        return $cocktailsInfos;
    }
}