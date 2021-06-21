<?php

namespace App\Model;

class Event {

    private $id;
    private $name;
    private $date;
    private $place;
    private $fb_url;
    private $order_nb;
    private $url;
    private $description;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of place
     */ 
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set the value of place
     *
     * @return  self
     */ 
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get the value of fb_url
     */ 
    public function getFb_url()
    {
        return $this->fb_url;
    }

    /**
     * Set the value of fb_url
     *
     * @return  self
     */ 
    public function setFb_url($fb_url)
    {
        $this->fb_url = $fb_url;

        return $this;
    }

    /**
     * Get the value of order_nb
     */ 
    public function getOrder_nb()
    {
        return $this->order_nb;
    }

    /**
     * Set the value of order_nb
     *
     * @return  self
     */ 
    public function setOrder_nb($order_nb)
    {
        $this->order_nb = $order_nb;

        return $this;
    }

    /**
     * Get the value of url
     */ 
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of url
     *
     * @return  self
     */ 
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}