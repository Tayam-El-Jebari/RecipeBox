<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/mealProduct.php';
require_once __DIR__ . '/../models/ingredient.php';


class ProductRepository extends Repository
{

    function getMostRecentFour()
    {
        try {
            $stmt = $this->connection->query("SELECT m.id, fc.foodCategoryName, fc.foodCategoryID, m.price, m.image, m.name, m.kcal, m.allergens,
            GROUP_CONCAT(ingredients.ingredient) as ingredients, GROUP_CONCAT(ingredients.ingredientWeight) as ingredientsWeight
            FROM meals as m
            INNER JOIN foodCategories as fc
			ON m.mainIngredientId = fc.foodCategoryID
            INNER JOIN ingredients 
            ON m.id = ingredients.meal_id 
            GROUP BY m.id 
            ORDER BY m.id DESC LIMIT 4;");

            $products = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              
                $products[] = $this->createProduct($row);
            }
            return $products;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    private function createProduct($row){
        $product = new MealProduct();
        $product->setProductId($row['id']);
        $product->setFoodCategory(new FoodCategory($row['foodCategoryID'], $row['foodCategoryName']));
        $product->setPrice($row['price']);
        $product->setImageAddress($row['image']);
        $product->setProductName($row['name']);
        $product->setKcal($row['kcal']);
        $product->setAllergens(explode(",", $row['allergens']));
        $product->setIngredients($this->createIngredientsArray($row['ingredients'], $row['ingredientsWeight']));
        return $product;
    }
    function getAll()
    {
        try {
            $stmt = $this->connection->query("SELECT m.id, fc.foodCategoryName, fc.foodCategoryID, m.price, m.image, m.name, m.kcal, m.allergens, 
            GROUP_CONCAT(ingredients.ingredient) as ingredients, GROUP_CONCAT(ingredients.ingredientWeight) as ingredientsWeight
            FROM meals as m
            INNER JOIN foodCategories as fc
			ON m.mainIngredientId = fc.foodCategoryID
            INNER JOIN ingredients 
            ON m.id = ingredients.meal_id 
            GROUP BY m.id 
            ORDER BY m.id;");
            $products = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $products[] = $this->createProduct($row);
            }
            return $products;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getOneProduct($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT m.id, fc.foodCategoryName, fc.foodCategoryID, m.price, m.image, m.name, m.kcal, m.allergens, 
            GROUP_CONCAT(ingredients.ingredient) as ingredients, GROUP_CONCAT(ingredients.ingredientWeight) as ingredientsWeight
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
                $product =  $this->createProduct($row);
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
    private function createIngredientsArray($ingredients, $ingredientsWeight)
    {
        //filled with strings
        $ingredientsStringArray = explode(",", $ingredients);
        $ingredientsStringWeightArray = explode(",", $ingredientsWeight);

        //filled with ingredient objects
        $ingredientArray = array();

        for ($i = 0; $i < count($ingredientsStringArray); $i++) {
            $ingredient = new Ingredient();
            $ingredient->setIngredient($ingredientsStringArray[$i]);
            $ingredient->setIngredientWeight($ingredientsStringWeightArray[$i]);
            array_push($ingredientArray, $ingredient);
        }
        return $ingredientArray;
    }

    public function storeUserCartItem($userId, $item)
    {
        try {
            //NOTE: userCarts table has a TRIGGER that automatically fills the payDate on insert or update. The payDate is never retrieved UNLESS the isPaid = 1;
            $stmt = $this->connection->prepare("INSERT INTO userCarts (userId, mealId, quantity, isPaid, `statusID`) VALUES (?, ?, ?, 0, 1)");
            $stmt->execute([$userId, $item->getProduct()->getProductId(), $item->getQuantity()]);
        } catch (PDOException $e) {
            throw new ErrorException("Something went wrong with storing cart item: " . $e->getMessage());
        }
    }
    public function processPaymentCartItem($userId, $item)
    {
        try {
            //NOTE: userCarts table has a TRIGGER that automatically fills the payDate on insert or update. The payDate is never retrieved UNLESS the isPaid = 1;
            $stmt = $this->connection->prepare("INSERT INTO userCarts (userId, mealId, quantity, isPaid, `statusID`) VALUES (?, ?, ?, 1, 1)");
            $stmt->execute([$userId, $item->getProduct()->getProductId(), $item->getQuantity()]);
        } catch (PDOException $e) {
            throw new ErrorException("Something went wrong with storing cart item: " . $e->getMessage());
        }
    }
    public function checkIfCartItemExists($userId, $item)
    {
        try {
            $stmt = $this->connection->prepare("SELECT cartId FROM userCarts WHERE userId = ? AND mealId = ? AND isPaid = 0");
            $stmt->execute([$userId, $item->getProduct()->getProductId()]);
            return !empty($stmt->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            throw new ErrorException("Something went wrong with checking cart item! Please try again later.");
        }
    }
    public function updateUserCartItem($userId, $item)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE userCarts SET isPaid = 1, quantity = quantity + ? WHERE userId = ? AND mealId = ?");
            $stmt->execute([$item->getQuantity(), $userId, $item->getProduct()->getProductId()]);
        } catch (PDOException $e) {
            throw new ErrorException("Something went wrong with updating cart item! Please try again later.");
        }
    }
    public function getMostRecentPaidOrders($userId)
    {
        try {
            $stmt = $this->connection->prepare("SELECT userCarts.mealId, meals.price, userCarts.quantity, userCarts.payDate, meals.name, meals.image, StatusOrders.status
                    FROM userCarts
                    JOIN meals ON userCarts.mealId = meals.id
                    JOIN StatusOrders ON userCarts.statusID = StatusOrders.statusID
                    WHERE userCarts.isPaid = 1 AND userCarts.userId = ? 
                    ORDER BY userCarts.payDate DESC LIMIT 10;");

            $stmt->execute([$userId]);

            $orders = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $product = new MealProduct();
                $product->setPrice($row['price']);
                $product->setProductName($row['name']);
                $product->setImageAddress($row['image']);
                $order = new Order($product, $row['quantity']);
                $order->setPaidDateTime(new DateTime($row['payDate']));
                $order->setStatus($row["status"]);
                $orders[] = $order;
            }
            return $orders;
        } catch (PDOException $e) {
            throw new ErrorException("Something went wrong with retrieving orders! Please try again later.");
        }
    }
    public function getPaidOrders($userId)
    {
        try {
            $stmt = $this->connection->prepare("SELECT m.id, fc.foodCategoryName, fc.foodCategoryID, m.price, m.image, m.name, m.kcal, m.allergens, 
            GROUP_CONCAT(ingredients.ingredient) as ingredients, GROUP_CONCAT(ingredients.ingredientWeight) as ingredientsWeight, userCarts.mealId, 
            userCarts.quantity, userCarts.payDate, StatusOrders.status 
            FROM meals as m 
            INNER JOIN foodCategories as fc ON m.mainIngredientId = fc.foodCategoryID 
            INNER JOIN ingredients ON m.id = ingredients.meal_id 
            INNER JOIN userCarts ON userCarts.mealId = m.id 
            INNER JOIN StatusOrders ON userCarts.statusID = StatusOrders.statusID 
            WHERE userCarts.isPaid = 1 AND userCarts.userId = ? 
            GROUP BY m.id ORDER BY userCarts.payDate DESC;
            ");

            $stmt->execute([$userId]);

            $orders = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $order = new Order($this->createProduct($row), $row['quantity']);
                $order->setPaidDateTime(new DateTime($row['payDate']));
                $order->setStatus($row["status"]);
                $orders[] = $order;
            }
            return $orders;
        } catch (PDOException $e) {
            throw new ErrorException("Something went wrong with retrieving orders! Please try again later.");
        }
    }
}
