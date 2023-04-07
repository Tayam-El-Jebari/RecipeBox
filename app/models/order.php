<?php
require_once __DIR__ . '/mealProduct.php';



class Order implements JsonSerializable
{
    private MealProduct $product;
    private int $quantity;
    private DateTime $paidDateTime;
    private string $status;
    public function __construct($mealProduct, $quantity, $paidDateTime = null, $status = '') {
        // make default value for dateTime
        if ($paidDateTime === null) {
            $paidDateTime = new DateTime();
        }
        $this->product = $mealProduct;
        $this->quantity = $quantity;
        $this->paidDateTime = $paidDateTime;
        $this->status = $status;
    }


    /**
     * Get the value of quantity
     */ 
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */ 
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return [
            'product' => $this->getProduct(),
            'quantity' => $this->getQuantity(),
            'status' => $this->getStatus(),
            'paid on' => $this->getPaidDateTime(),
        ];
    }

    /**
     * Get the value of paidDateTime
     */ 
    public function getPaidDateTime()
    {
        return $this->paidDateTime;
    }

    /**
     * Set the value of paidDateTime
     *
     * @return  self
     */ 
    public function setPaidDateTime($paidDateTime)
    {
        $this->paidDateTime = $paidDateTime;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of product
     */ 
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set the value of product
     *
     * @return  self
     */ 
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }
}