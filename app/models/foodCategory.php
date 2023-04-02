<?php
class FoodCategory
{
    private int $foodCategoryID;
    private string $foodCategoryName;
    private string $bannerImage;
    public function __construct ($foodCategoryID, $foodCategoryName) {
        $this->foodCategoryID = $foodCategoryID;
        $this->foodCategoryName = $foodCategoryName;
    }
    /**
     * Get the value of foodCategoryID
     */ 
    public function getFoodCategoryID()
    {
        return $this->foodCategoryID;
    }

    /**
     * Set the value of foodCategoryID
     *
     * @return  self
     */ 
    public function setFoodCategoryID($foodCategoryID)
    {
        $this->foodCategoryID = $foodCategoryID;

        return $this;
    }

    /**
     * Get the value of foodCategoryName
     */ 
    public function getFoodCategoryName()
    {
        return $this->foodCategoryName;
    }

    /**
     * Set the value of foodCategoryName
     *
     * @return  self
     */ 
    public function setFoodCategoryName($foodCategoryName)
    {
        $this->foodCategoryName = $foodCategoryName;

        return $this;
    }

    /**
     * Get the value of bannerImage
     */ 
    public function getBannerImage()
    {
        return $this->bannerImage;
    }

    /**
     * Set the value of bannerImage
     *
     * @return  self
     */ 
    public function setBannerImage($bannerImage)
    {
        $this->bannerImage = $bannerImage;

        return $this;
    }
}