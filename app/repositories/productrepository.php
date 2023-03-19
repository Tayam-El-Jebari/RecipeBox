<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/mealProduct.php';

class ProductRepository extends Repository {

    function getMostRecentFour() {
        try {
            $stmt = $this->connection->query("SELECT m.id, fc.foodCategoryName, m.price, m.image, m.name, m.kcal, m.allergens, GROUP_CONCAT(ingredients.ingredient) as ingredients, GROUP_CONCAT(ingredients.ingredientWeight) as ingredientsWeight
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
                $product->setFoodCategory(new FoodCategory($row['foodCategoryName']));
                $product->setPrice($row['price']);
                $product->setImageAddress($row['image']);
                $product->setProductName($row['name']);
                $product->setKcal($row['kcal']);
                $product->setAllergens($row['allergens']);
                $product->setIngredients($row['ingredients']);
                $product->setIngredients($row['ingredientsWeight']);
                $products[] = $product;
            }
            
            return $products;

        } catch (PDOException $e)
        {
            echo $e;
        }
    }
    function getAll() {
        try {
            $stmt = $this->connection->query("SELECT m.id, fc.foodCategoryName, m.price, m.image, m.name, m.kcal, m.allergens, GROUP_CONCAT(ingredients.ingredient) as ingredients, GROUP_CONCAT(ingredients.ingredientWeight) as ingredientsWeight
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
                    new FoodCategory($row['foodCategoryName']));
                $product->setPrice($row['price']);
                $product->setImageAddress($row['image']);
                $product->setProductName($row['name']);
                $product->setKcal($row['kcal']);
                $product->setAllergens($row['allergens']);
                $product->setIngredients($row['ingredients']);
                $product->setIngredients($row['ingredientsWeight']);
                $products[] = $product;
            }
            
            return $products;

        } catch (PDOException $e)
        {
            echo $e;
        }
    }
    function getAllCategories() {
        try {
            $stmt = $this->connection->query("SELECT foodCategoryID, foodCategoryName, bannerImage
            FROM foodCategories;");

            $foodCategories = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $foodCategory = new FoodCategory($row['foodCategoryName']);
                $foodCategory->setBannerImage($row['bannerImage']);
                $foodCategory->setFoodCategoryID($row['foodCategoryID']);
                $foodCategories[] = $foodCategory;
            }
            
            return $foodCategories;

        } catch (PDOException $e)
        {
            echo $e;
        }
    }
}