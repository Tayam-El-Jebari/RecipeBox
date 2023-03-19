<?php
require __DIR__ . '/foodCategory.php';

class MealProduct
{

    private int $productId;
    private FoodCategory $FoodCategory;
    private float $price;
    private string $imageAddress;
    private string $productName;
    private int $kcal;
    private string $allergens;
    private $ingredients;
    private $ingredientsWeight;




    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $id 
     * @return self
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * @return FoodCategory
     */
    public function getFoodCategory(): FoodCategory
    {
        return $this->FoodCategory;
    }

    /**
     * @param int $FoodCategoryId
     * @return self
     */
    public function setFoodCategory($FoodCategory)
    {
        $this->FoodCategory = $FoodCategory;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return self
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }
    /**
	 * @return string
	 */
	public function getImageAddress(): string {
		return $this->imageAddress;
	}
	
	/**
	 * @param string $imageAddress 
	 * @return self
	 */
	public function setImageAddress(string $imageAddress): self {
		$this->imageAddress = $imageAddress;
		return $this;
	}
    /**
	 * @return string
	 */
	public function getProductName(): string {
		return $this->productName;
	}
	
	/**
	 * @param string $productName 
	 * @return self
	 */
	public function setProductName(string $productName): self {
		$this->productName = $productName;
		return $this;
	}

    /**
     * @return int
     */
    public function getKcal(): int
    {
        return $this->kcal;
    }

    /**
     * @param int $kcal 
     * @return self
     */
    public function setKcal(int $kcal): self
    {
        $this->kcal = $kcal;
        return $this;
    }
	    /**
	 * @return string
	 */
	public function getAllergens(): string {
		return $this->allergens;
	}
	/**
	 * @param string $allergens 
	 * @return self
	 */
	public function setAllergens(string $allergens): self {
		$this->allergens = $allergens;
		return $this;
	}
    /**
	 * @return string[]
	 */
	public function getIngredients() {
		return $this->ingredients;
	}
	/**
	 * @param string $ingredients 
	 * @return self
	 */
	public function setIngredients(string $ingredients): self {
		$this->ingredients = explode(",", $ingredients);;
		return $this;
	}
    /**
	 * @return string[]
	 */
    public function getIngredientsWeight() {
		return $this->ingredientsWeight;
	}
	/**
	 * @param string $ingredients 
	 * @return self
	 */
	public function setIngredientsWeight(string $ingredientsWeight): self {
		$this->ingredientsWeight = explode(",", $ingredientsWeight);
		return $this;
	}

}