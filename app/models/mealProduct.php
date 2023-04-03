<?php
require_once __DIR__ . '/foodCategory.php';
require_once __DIR__ . '/ingredient.php';


class MealProduct implements JsonSerializable
{

    private int $productId;
    private FoodCategory $FoodCategory;
    private float $price;
    private string $imageAddress;
    private string $productName;
    private int $kcal;
    private array $allergens;
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
	public function getAllergens(): array {
		return $this->allergens;
	}
	public function setAllergens(array $allergens): void {
		$this->allergens = $allergens;
	}
    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    public function setIngredients(array $ingredients): void
    {
        $this->ingredients = $ingredients;
    }
    //return type will change because of return values differ in type 
    // 000webhost doesn't have php 8.1, which is why : mixed isn't used
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return [
            'productId' => $this->getProductId(),
            'foodCategory' => $this->getFoodCategory(),
            'price' => $this->getPrice(),
            'imageAddress' => $this->getImageAddress(),
            'productName' => $this->getProductName(),
            'kcal' => $this->getKcal(),
            'allergens' => $this->getAllergens(),
            'ingredients' => $this->getIngredients(),
        ];
    }
}