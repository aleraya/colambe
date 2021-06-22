<?php

namespace App\Model;

class Event {

    private $id;
    private $name;
    private $date;
    private $place;
    private $fb_url;
    private $order_nb;    
    private $picture;

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
     * Get the value of date
     */ 
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of place
     */ 
    public function getPlace(): ?string
    {
        return $this->place;
    }

    /**
     * Set the value of place
     *
     * @return  self
     */ 
    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get the value of fb_url
     */ 
    public function getFbUrl(): ?string
    {
        return $this->fb_url;
    }

    /**
     * Set the value of fb_url
     *
     * @return  self
     */ 
    public function setFbUrl(string $fb_url): self
    {
        $this->fb_url = $fb_url;

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

    /**
     * Get the value of picture
     */ 
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @return  self
     */ 
    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getThumb() {
        return EVENT_HOST.$this->picture;
    }
}