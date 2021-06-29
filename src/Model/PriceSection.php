<?php

namespace App\Model;

class PriceSection {

    private $id;
    private $name;
    private $order_nb;


    /**
     * Get the value of id
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of order_nb
     */ 
    public function getOrderNb(): ?int
    {
        return $this->order_nb;
    }

    /**
     * Set the value of order_nb
     *
     * @return  self
     */ 
    public function setOrderNb(int $order_nb): self
    {
        $this->order_nb = $order_nb;

        return $this;
    }
}

