<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'amount' => '/Amount.php',
                'burger' => '/Burger.php',
                'burgerbuilder' => '/BurgerBuilder.php',
                'burgerrendererinterface' => '/BurgerRendererInterface.php',
                'burgertextrenderer' => '/BurgerTextRenderer.php',
                'burgerviewmodel' => '/BurgerViewModel.php',
                'burgerxmlrenderer' => '/BurgerXmlRenderer.php',
                'cheese' => '/Cheese.php',
                'cheeseburgerrecipe' => '/CheeseburgerRecipe.php',
                'currency' => '/Currency.php',
                'hamburgerrecipe' => '/HamburgerRecipe.php',
                'ingredient' => '/Ingredient.php',
                'ingredientfactory' => '/IngredientFactory.php',
                'ingredientnamecollection' => '/IngredientNameCollection.php',
                'ingredientrepository' => '/IngredientRepository.php',
                'lowerbread' => '/LowerBread.php',
                'patty' => '/Patty.php',
                'price' => '/Price.php',
                'priceformatter' => '/PriceFormatter.php',
                'pricetextrepresentationbuilder' => '/PriceTextRepresentationBuilder.php',
                'recipe' => '/Recipe.php',
                'salad' => '/Salad.php',
                'sauce' => '/Sauce.php',
                'tomato' => '/Tomato.php',
                'upperbread' => '/UpperBread.php',
                'xslrenderer' => '/XslRenderer.php'
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    }
);
// @codeCoverageIgnoreEnd
