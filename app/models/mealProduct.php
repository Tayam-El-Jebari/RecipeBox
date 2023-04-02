<?php
require __DIR__ . '/foodCategory.php';
require __DIR__ . '/ingredient.php';


class MealProduct
{

    private int $productId;
    private FoodCategory $FoodCategory;
    private float $price;
    private string $imageAddress;
    private string $productName;
    private int $kcal;
    private string $allergens;
    private array $ingredients;




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
    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    public function setIngredients(array $ingredients): void
    {
        $this->ingredients = $ingredients;
    }
}