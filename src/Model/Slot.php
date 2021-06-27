<?php

namespace App\Model;

use DateTime;

class Slot {

    private $id;
    private $day;
    private $start_time;
    private $end_time;


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
     * Get the value of day
     */ 
    public function getDay(): ?int
    {
        return $this->day;
    }

    /**
     * Set the value of day
     *
     * @return  self
     */ 
    public function setDay(int $day): self
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get the value of start_time
     */ 
    public function getStartTime(): ?DateTime
    {
        return new DateTime($this->start_time);
    }

    /**
     * Set the value of start_time
     *
     * @return  self
     */ 
    public function setStartTime(string $start_time): self
    {
        $this->start_time = $start_time;

        return $this;
    }

    /**
     * Get the value of end_time
     */ 
    public function getEndTime(): ?DateTime
    {
        return new DateTime($this->end_time);
    }

    /**
     * Set the value of end_time
     *
     * @return  self
     */ 
    public function setEndTime(string $end_time): self
    {
        $this->end_time = $end_time;

        return $this;
    }
    
}