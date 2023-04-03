<?php 

class Ingredient implements JsonSerializable
{
private string $ingredient;
private int $ingredientWeight;


/**
 * Get the value of ingredient
 */ 
public function getIngredient()
{
return $this->ingredient;
}

/**
 * Set the value of ingredient
 *
 * @return  self
 */ 
public function setIngredient($ingredient)
{
$this->ingredient = $ingredient;

return $this;
}

/**
 * Get the value of ingredientsWeight
 */ 
public function getIngredientWeight()
{
return $this->ingredientWeight;
}

/**
 * Set the value of ingredientsWeight
 *
 * @return  self
 */ 
public function setIngredientWeight($ingredientsWeight)
{
$this->ingredientWeight = $ingredientsWeight;

return $this;
}
#[\ReturnTypeWillChange]
public function jsonSerialize()
{
    return [
        'ingredient' => $this->getIngredient(),
        'ingredientWeight' => $this->getIngredientWeight(),
    ];
}
}