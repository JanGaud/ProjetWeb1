<?php

namespace App\Models;

class Bid
{
    private $bidId;
    private UserModel $auteur;
    private EnchereModel $enchere;
    private $time;
    private $bid;


    /**
     * Get the value of bidId
     */ 
    public function getBidId()
    {
        return $this->bidId;
    }

    /**
     * Set the value of bidId
     *
     * @return  self
     */ 
    public function setBidId($bidId)
    {
        $this->bidId = $bidId;

        return $this;
    }

    /**
     * Get the value of time
     */ 
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set the value of time
     *
     * @return  self
     */ 
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get the value of bid
     */ 
    public function getBid()
    {
        return $this->bid;
    }

    /**
     * Set the value of bid
     *
     * @return  self
     */ 
    public function setBid($bid)
    {
        $this->bid = $bid;

        return $this;
    }

    /**
     * Get the value of enchere
     */ 
    public function getEnchere()
    {
        return $this->enchere;
    }

    /**
     * Set the value of enchere
     *
     * @return  self
     */ 
    public function setEnchere($enchere)
    {
        $this->enchere = $enchere;

        return $this;
    }

    /**
     * Get the value of auteur
     */ 
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set the value of auteur
     *
     * @return  self
     */ 
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }
}