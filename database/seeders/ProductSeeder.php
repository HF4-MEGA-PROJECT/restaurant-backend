<?php

namespace Database\Seeders;

use Faker\Provider\DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Nachos Supreme',
            'description' => 'Varme tortillachips med crispy kylling, jalapeños, gratineret med ost, serveres med salsa, guacamole og creme fraiche.',
            'category_id' => 4,
            'type' => 'food',
            'price' => 129,
            'photo_path' => 'https://hips.hearstapps.com/hmg-prod/images/nachos-supreme-horizontal-1547669254.png',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Cæsar Salat',
            'description' => 'Stegt kyllingebryst, hjertesalat vendt med cæsardressing, parmesanflager og croutoner.',
            'category_id' => 5,
            'type' => 'food',
            'price' => 139,
            'photo_path' => 'https://www.valdemarsro.dk/wp-content/2017/03/ceasarsalat.jpg',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Tigerrejesalat',
            'description' => 'Stegte tigerrejer med kålsalat, avocado, nudler, agurk, gulerod, edamame bønner, mynte, cashewnødder og gomadressing.',
            'category_id' => 5,
            'type' => 'food',
            'price' => 139,
            'photo_path' => 'https://d17kbh9lfpylmy.cloudfront.net/base_recipes/pictures/000/000/613/original/shutterstock_348192446.png?1640291079',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Vegetar Salat',
            'description' => 'Sweet potato, falafel, babyspinat, granatæble, bulgur, feta, tomater, edamame bønner, hjemmelavet basilikumspesto, græskarkerner og mynte.',
            'category_id' => 5,
            'type' => 'food',
            'price' => 119,
            'photo_path' => 'https://live.nemligstatic.com/scommerce/images/NEJ_Arabisk-salat-med-blomkaal-og-solmodne-tomater_opskrfit_98001694_Mette-Moelbak_vegetar.jpg?i=%7B49C7F3B8-C124-4EA0-80CE-672CAACB55BF%7D&v=AD8JvcRJ&w=1105&h=621&mode=crop',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Club Sandwich',
            'description' => 'Stegt kyllingebryst, sprød bacon, karrymayonnaise, tomat og salat. Serveres med pommes frites og mayonnaise.',
            'category_id' => 4,
            'type' => 'food',
            'price' => 139,
            'photo_path' => 'https://realfood.tesco.com/media/images/RFO-1400x919-ChickenClubSandwich-0ee77c05-5a77-49ac-a3bd-4d45e3b4dca7-0-1400x919.jpg',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Laksesandwich',
            'description' => 'Sandwich med røget laks, hjemmelavet basilikumspesto, salat, avocado og syltet rødløg. Serveres med pommes frites og mayonnaise.',
            'category_id' => 3,
            'type' => 'food',
            'price' => 149,
            'photo_path' => 'https://www.royalgreenland.com/globalassets/x-b2c/opskrifter---billeder/roget-laksesandwich-med-gourmettrim-roget-laks-og-mozzarella.jpg?transform=downfill&quality=80&h=ca04674ea8366273c8b06664e60804a17385a378',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Spicy Steak Sandwich',
            'description' => 'Sandwich med oksestrimler, salat, guacamole, jalapeños, syltede rødløg og spicy chilimayonnaise. Serveres med pommes frites og chilimayonnaise.',
            'category_id' => 4,
            'type' => 'food',
            'price' => 149,
            'photo_path' => 'https://images.ctfassets.net/qu53tdnhexvd/6N94IPvuNOW6kS2auIiOcE/47e215e38234db4a6610457c4f3319c7/spicy-steak-sandwich.jpg?fm=jpg&fl=progressive&q=80&w=1300',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Tunsandwich',
            'description' => ' Sandwich med tunmoussé, salat, avocado, syltede rødløg og hjemmelavet basilikumspesto. Serveres med pommes frites og mayonnaise.',
            'category_id' => 4,
            'type' => 'food',
            'price' => 139,
            'photo_path' => 'https://dk-spisbedre-production.imgix.net/images/recipes/tunsandwich-med-avocado_10777.jpg?fit=crop&crop=focalpoint&fp-x=0.48178823897354&fp-y=0.59845204545248&fp-z=1.0935626808082&w=1200&h=628',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Vesuvius Burger',
            'description' => 'Bøf af hakket oksekød i briochebolle med salat, pickles, tomat, syltede rødløg og burgerdressing. Serveres med pommes frites og mayonnaise.',
            'category_id' => 4,
            'type' => 'food',
            'price' => 139,
            'photo_path' => 'https://images.arla.com/recordid/054299bb31924893a697ab1b0094d3ea/klassisk-burger.jpg?crop=(0,450,0,-373)&w=1200&h=630&scale=both&format=jpg&quality=80&ak=6826258c&hm=ed724373',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Spicy Burger',
            'description' => 'Bøf af hakket oksekød i briochebolle med salat, tomat, jalapeños, syltede rødløg og chilimayonnaise. Serveres med pommes frites og chilimayonnaise.',
            'category_id' => 4,
            'type' => 'food',
            'price' => 149,
            'photo_path' => 'https://www.sargento.com/assets/Uploads/Recipe/Image/smashburger__FillWzExNzAsNTgzXQ.jpg',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Crispy Chicken Burger',
            'description' => 'Sprød kylling i briochebolle med salat, tomat, syltede rødløg, chilimayonnaise, jalapeños og guacamole. Serveres med pommes frites og mayonnaise.',
            'category_id' => 4,
            'type' => 'food',
            'price' => 139,
            'photo_path' => 'https://shepskitchen.ie/wp-content/uploads/2021/03/Chicken-burger-1.jpg',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Tomatsuppe',
            'description' => 'Tomatsuppe med creme fraiche og frisk basilikum. Serveres med brød og smør.',
            'category_id' => 1,
            'type' => 'food',
            'price' => 99,
            'photo_path' => 'https://cdn-rdb.arla.com/Files/arla-dk/4247719622/bd03bdc2-4525-4b40-a1ce-af1063af44ae.jpg?crop=(0,296,0,-656)&w=1200&h=630&scale=both&format=jpg&quality=80&ak=6826258c&hm=6f4be496',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Pasta med Kylling',
            'description' => 'Pasta med kylling, blandede svampe og parmesan.',
            'category_id' => 1,
            'type' => 'food',
            'price' => 169,
            'photo_path' => 'https://usercontent.one/wp/www.majspassion.dk/wp-content/uploads/2020/09/pastaret-med-kylling-og-svampe.jpg',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Pasta med Oksemørbrad',
            'description' => 'Pasta med grilllet oksemørbrad, blandede svampe og parmesan.',
            'category_id' => 4,
            'type' => 'food',
            'price' => 179,
            'photo_path' => 'https://opskrifteradmin.coop.dk/media/recipeimages/11676/23095/1920/img_0106.jpg?width=850&upscale=false&format=jpg&quality=90',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Pasta med Tigerrejer',
            'description' => 'Pasta med tigerrejer, tomatsauce, parmesan og basilikum.',
            'category_id' => 4,
            'type' => 'food',
            'price' => 179,
            'photo_path' => 'https://madenimitliv.dk/wp-content/uploads/2018/03/DSC_0003-1.jpg',
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Aperol Spritz',
            'description' => 'Aperol, prosecco, danskvand, appelsinskive. Klassiskeren til en varm sommerdag. Eller bare fordi...',
            'category_id' => 7,
            'type' => 'drinks',
            'price' => 85,
            'photo_path' => null,
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Espresso Martini',
            'description' => 'Vodka/tequila, kahlua, espresso, vanilje. En klassiker med et twist, vælg mellem vodka eller tequila.',
            'category_id' => 7,
            'type' => 'drinks',
            'price' => 85,
            'photo_path' => null,
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Dark n stormy',
            'description' => 'Mørk rom, gingerbeer, friskpresset limesat og gomme sirup.',
            'category_id' => 7,
            'type' => 'drinks',
            'price' => 85,
            'photo_path' => null,
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Mojito',
            'description' => 'Rom, mynte, rørsukker, friskpresset limesaft, limeskiver.',
            'category_id' => 7,
            'type' => 'drinks',
            'price' => 85,
            'photo_path' => null,
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Gin Tonic',
            'description' => 'Gin, tonic, citronskive.',
            'category_id' => 7,
            'type' => 'drinks',
            'price' => 85,
            'photo_path' => null,
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Moscow Mule',
            'description' => 'Vodka, friskpresset limesaft, gingerbeer.',
            'category_id' => 7,
            'type' => 'drinks',
            'price' => 85,
            'photo_path' => null,
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Strawberry Daquiri',
            'description' => 'Lys rom, jordbær, friskpresset lime, gomme sirup.',
            'category_id' => 7,
            'type' => 'drinks',
            'price' => 85,
            'photo_path' => null,
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Gin Hass',
            'description' => 'Gin, mangojuice, frisk lime og lemon.',
            'category_id' => 7,
            'type' => 'drinks',
            'price' => 85,
            'photo_path' => null,
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);

        DB::table('products')->insert([
            'name' => 'Raspberry Love',
            'description' => 'Vodka, cointreau, hindbær, frisk lime og honning.',
            'category_id' => 7,
            'type' => 'drinks',
            'price' => 85,
            'photo_path' => null,
            'created_at' => DateTime::dateTimeThisYear(),
            'updated_at' => DateTime::dateTimeThisYear(),
        ]);
    }
}
