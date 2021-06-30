<?php

namespace App\Model;

class Price {

    private $id;
    private $name;
    private $text;
    private $price;
    private $pricesection_id;
    private $pricetype_id;
    
    private $pricetype;
    private $pricesection;
    private $nbNameId;



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
     * Get the value of text
     */ 
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */ 
    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of pricetype_id
     */ 
    public function getPricetypeId(): ?int
    {
        return $this->pricetype_id;
    }

    /**
     * Set the value of pricetype_id
     *
     * @return  self
     */ 
    public function setPricetypeId(?int $pricetype_id): self
    {
        $this->pricetype_id = $pricetype_id;

        return $this;
    }

    /**
     * Get the value of pricesection_id
     */ 
    public function getPricesectionId(): ?int
    {
        return $this->pricesection_id;
    }

    /**
     * Set the value of pricesection_id
     *
     * @return  self
     */ 
    public function setPricesectionId(int $pricesection_id): self
    {
        $this->pricesection_id = $pricesection_id;

        return $this;
    }

    /**
     * Get the value of pricetype
     */ 
    public function getPricetype(): ?string
    {
        return $this->pricetype;
    }

    /**
     * Set the value of pricetype
     *
     * @return  self
     */ 
    public function setPricetype(string $pricetype): self
    {
        $this->pricetype = $pricetype;

        return $this;
    }

    /**
     * Get the value of pricesection
     */ 
    public function getPricesection(): ?string
    {
        return $this->pricesection;
    }

    /**
     * Set the value of pricesection
     *
     * @return  self
     */ 
    public function setPricesection(string $pricesection): self
    {
        $this->pricesection = $pricesection;

        return $this;
    }

    /**
     * Get the value of nbNameId
     */ 
    public function getNbNameId(): ?int
    {
        return $this->nbNameId;
    }

    /**
     * Set the value of nbNameId
     *
     * @return  self
     */ 
    public function setNbNameId(int $nbNameId): self
    {
        $this->nbNameId = $nbNameId;

        return $this;
    }
}

