<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/mealProduct.php';
require_once __DIR__ . '/../models/ingredient.php';


class ProductRepository extends Repository
{

    function getMostRecentFour()
    {
        try {
            $stmt = $this->connection->query("SELECT m.id, fc.foodCategoryName, fc.foodCategoryID, m.price, m.image, m.name, m.kcal, m.allergens, GROUP_CONCAT(ingredients.ingredient) as ingredients, GROUP_CONCAT(ingredients.ingredientWeight) as ingredientsWeight
            FROM meals as m
            INNER JOIN foodCategories as fc
			ON m.mainIngredientId = fc.foodCategoryID
            INNER JOIN ingredients 
            ON m.id = ingredients.meal_id 
            GROUP BY m.id 
            ORDER BY m.id DESC LIMIT 4;");

            $products = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $product = new MealProduct();
                $product->setProductId($row['id']);
                $product->setFoodCategory(new FoodCategory($row['foodCategoryID'], $row['foodCategoryName']));
                $product->setPrice($row['price']);
                $product->setImageAddress($row['image']);
                $product->setProductName($row['name']);
                $product->setKcal($row['kcal']);
                $product->setAllergens(explode(",",$row['allergens']));
                $product->setIngredients($this->createIngredientsArray($row['ingredients'], $row['ingredientsWeight']));
                $products[] = $product;
            }
            return $products;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getAll()
    {
        try {
            $stmt = $this->connection->query("SELECT m.id, fc.foodCategoryName, fc.foodCategoryID, m.price, m.image, m.name, m.kcal, m.allergens, GROUP_CONCAT(ingredients.ingredient) as ingredients, GROUP_CONCAT(ingredients.ingredientWeight) as ingredientsWeight
            FROM meals as m
            INNER JOIN foodCategories as fc
			ON m.mainIngredientId = fc.foodCategoryID
            INNER JOIN ingredients 
            ON m.id = ingredients.meal_id 
            GROUP BY m.id 
            ORDER BY m.id;");
            $products = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $product = new MealProduct();
                $product->setProductId($row['id']);
                $product->setFoodCategory(
                    new FoodCategory($row['foodCategoryID'], $row['foodCategoryName'])
                );
                $product->setPrice($row['price']);
                $product->setImageAddress($row['image']);
                $product->setProductName($row['name']);
                $product->setKcal($row['kcal']);
                $product->setAllergens(explode(",",$row['allergens']));
                $product->setIngredients($this->createIngredientsArray($row['ingredients'], $row['ingredientsWeight']));
                $products[] = $product;
            }
            return $products;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getOne($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT m.id, fc.foodCategoryName, fc.foodCategoryID, m.price, m.image, m.name, m.kcal, m.allergens, GROUP_CONCAT(ingredients.ingredient) as ingredients, GROUP_CONCAT(ingredients.ingredientWeight) as ingredientsWeight
            FROM meals as m
            INNER JOIN foodCategories as fc
			ON m.mainIngredientId = fc.foodCategoryID
            INNER JOIN ingredients 
            ON m.id = ingredients.meal_id 
            WHERE m.id = ?
            GROUP BY m.id 
            ORDER BY m.id");
            $stmt->execute([$id]);

            $product = new MealProduct();

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $product->setProductId($row['id']);
                $product->setFoodCategory(
                    new FoodCategory($row['foodCategoryID'], $row['foodCategoryName'])
                );
                $product->setPrice($row['price']);
                $product->setImageAddress($row['image']);
                $product->setProductName($row['name']);
                $product->setKcal($row['kcal']);
                $product->setAllergens(explode(",",$row['allergens']));
                $product->setIngredients($this->createIngredientsArray($row['ingredients'], $row['ingredientsWeight']));
            } 

            return $product;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getAllCategories()
    {
        try {
            $stmt = $this->connection->query("SELECT foodCategoryID, foodCategoryName, bannerImage
            FROM foodCategories;");

            $foodCategories = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $foodCategory = new FoodCategory($row['foodCategoryID'], $row['foodCategoryName']);
                $foodCategory->setBannerImage($row['bannerImage']);
                $foodCategories[] = $foodCategory;
            }

            return $foodCategories;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    private function createIngredientsArray($ingredients, $ingredientsWeight){
        //filled with strings
        $ingredientsStringArray = explode(",",$ingredients);
        $ingredientsStringWeightArray = explode(",",$ingredientsWeight);

        //filled with ingredient objects
        $ingredientArray = array();

        for($i=0;$i<count($ingredientsStringArray);$i++){
            $ingredient = new Ingredient();
            $ingredient->setIngredient($ingredientsStringArray[$i]);
            $ingredient->setIngredientWeight( $ingredientsStringWeightArray[$i]);
            array_push($ingredientArray, $ingredient);
        }
        return $ingredientArray;
    }
}
