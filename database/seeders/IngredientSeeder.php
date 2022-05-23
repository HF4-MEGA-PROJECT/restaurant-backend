<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Product;
use App\Models\ProductIngredient;
use Faker\Provider\DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    private array $productsWithIngredients = [
        'Nachos Supreme' => [
            'Tortillachips',
            'Kylling',
            'Jalapeños',
            'Ost',
            'Salsa',
            'Guacamole',
            'Creme fraiche',
        ],
        'Cæsar Salat' => [
            'Kylling',
            'Hjertesalat',
            'Cæsardressing',
            'Parmesan',
            'Croutoner',
        ],
        'Tigerrejesalat' => [
            'Tigerrejer',
            'Kålsalat',
            'Nudler',
            'Agurk',
            'Gulerod',
            'Edamame bønner',
            'Mynte',
            'Cashewnødder',
            'Gomadressing',
        ],
        'Vegetar Salat' => [
            'Sweet potato',
            'Falafel',
            'Babyspinat',
            'Granatæble',
            'Bulgur',
            'Feta',
            'Tomat',
            'Edamame bønner',
            'Basilikumspesto',
            'Græskarkerner',
            'Mynte',
        ],
        'Club Sandwich' => [
            'Kylling',
            'Bacon',
            'Karrymayonnaise',
            'Tomat',
            'Salat',
            'Pommes frites',
            'Mayonnaise',
        ],
        'Laksesandwich' => [
            'Laks',
            'Salat',
            'Avocado',
            'Rødløg',
            'Pommes frites',
            'Mayonnaise',
        ],
        'Spicy Steak Sandwich' => [
            'Oksestrimler',
            'Salat',
            'Guacamole',
            'Jalapeños',
            'Rødløg',
            'Chilimayonnaise',
            'Pommes frites',
            'Chilimayonnaise',
        ],
        'Tunsandwich' => [
            'Tunmoussé',
            'Salat',
            'Avocado',
            'Rødløg',
            'Basilikumspesto',
            'Pommes frites',
            'Mayonnaise',
        ],
        'Vesuvius Burger' => [
            'Oksekød',
            'Briochebolle',
            'Salat',
            'Pickles',
            'Tomat',
            'Rødløg',
            'Burgerdressing',
            'Pommes frites',
            'Mayonnaise',
        ],
        'Spicy Burger' => [
            'Oksekød',
            'Briochebolle',
            'Salat',
            'Tomat',
            'Jalapeños',
            'Rødløg',
            'Chilimayonnaise',
            'Pommes frites',
            'Chilimayonnaise',
        ],
        'Crispy Chicken Burger' => [
            'Kylling',
            'Briochebolle',
            'Salat',
            'Tomat',
            'Rødløg',
            'Chilimayonnaise',
            'Jalapeños',
            'Guacamole',
            'Pommes frites',
            'Chilimayonnaise',
        ],
        'Tomatsuppe' => [
            'Tomat',
            'Creme fraiche',
            'Basilikum',
            'Brød',
            'Smør',
        ],
        'Pasta med Kylling' => [
            'Pasta',
            'Kylling',
            'Svampe',
            'Parmesan',
        ],
        'Pasta med Oksemørbrad' => [
            'Pasta',
            'Oksemørbrad',
            'Svampe',
            'Parmesan',
        ],
        'Pasta med Tigerrejer' => [
            'Pasta',
            'Tigerrejer',
            'Tomatsauce',
            'Parmesan',
            'Basilikum',
        ],
        // Drinks
        'Aperol Spritz' => [
            'Aperol',
            'Prosecco',
            'Danskvand',
            'Appelsinskive',
        ],
        'Espresso Martini' => [
            'Vodka',
            'Tequila',
            'Kahlua',
            'Espresso',
            'Vanilje',
        ],
        'Dark n stormy' => [
            'Mørk rom',
            'Gingerbeer',
            'Limesat',
            'Sirup',
        ],
        'Mojito' => [
            'Rom',
            'Mynte',
            'Rørsukker',
            'Limesaft',
            'Limeskiver',
        ],
        'Gin Tonic' => [
            'Gin',
            'Tonic',
            'Citronskive',
        ],
        'Moscow Mule' => [
            'Vodka',
            'Limesaft',
            'Gingerbeer',
        ],
        'Strawberry Daquiri' => [
            'Lys rom',
            'Jordbær',
            'Lime',
            'Sirup',
        ],
        'Gin Hass' => [
            'Gin',
            'Mangojuice',
            'Lime',
            'Lemon',
        ],
        'Raspberry Love' => [
            'Vodka',
            'Cointreau',
            'Hindbær',
            'Lime',
            'Honning',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertIngredients();
        $this->insertRelations();
    }

    /**
     * Merge all the ingredient lists into one ingredient list with no duplicates.
     * Loop through all ingredients and add them to DB in one query.
     *
     * @return void
     */
    private function insertIngredients(): void
    {
        /**
         * Merge all the ingredient lists into one ingredient list with no duplicates.
         */
        $notUniqueIngredientArray = [];
        foreach($this->productsWithIngredients as $ingredientArray) {
            $notUniqueIngredientArray = array_merge($notUniqueIngredientArray, $ingredientArray);
        }
        $uniqueIngredientArray = array_unique($notUniqueIngredientArray, SORT_STRING);

        /**
         * Loop through all ingredients and add them to DB in one query.
         */
        $ingredients = [];
        foreach($uniqueIngredientArray as $ingredientName){
            $ingredient = new Ingredient();
            $ingredient->name = $ingredientName;
            $ingredient->is_in_stock = true;
            $ingredients[] = $ingredient->attributesToArray();
        }
        Ingredient::insert($ingredients);
    }


    /**
     * Loop through all products w/ ingredients.
     * Find the product id of the loop
     * Find the ingredient ids of the loop
     *
     * Insert all relations is one big query.
     *
     * @return void
     */
    private function insertRelations(): void
    {
        $productIngredients = [];


        foreach($this->productsWithIngredients as $productName => $productIngredientNames){
            // Find product id of current loop
            $productId = Product::where(['name' => $productName])->first()->id;

            foreach($productIngredientNames as $productIngredientName) {
                // Find ingredient id of current loop
                $ingredientId = Ingredient::where(['name' => $productIngredientName])->first()->id;

                $productIngredient = new ProductIngredient();
                $productIngredient->product_id = $productId;
                $productIngredient->ingredient_id = $ingredientId;
                $productIngredients[] = $productIngredient->attributesToArray();
            }
        }
        ProductIngredient::insert($productIngredients);
    }
}
