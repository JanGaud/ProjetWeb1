<?php

namespace App\Models;

class TimbreModel
{
    private $userId;
    private $prixInit;
    private $titre;
    private $description;
    private $quality;
    private $debut;
    private $fin;
    private $image;
    private $bids = [];

    /**
     * Get the value of prixInit
     */ 
    public function getPrixInit()
    {
        return $this->prixInit;
    }

    /**
     * Set the value of prixInit
     *
     * @return  self
     */ 
    public function setPrixInit($prixInit)
    {
        $this->prixInit = $prixInit;

        return $this;
    }

    /**
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

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

    /**
     * Get the value of debut
     */ 
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set the value of debut
     *
     * @return  self
     */ 
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get the value of fin
     */ 
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set the value of fin
     *
     * @return  self
     */ 
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of bids
     */ 
    public function getBids()
    {
        return $this->bids;
    }

    /**
     * Set the value of bids
     *
     * @return  self
     */ 
    public function setBids($bids)
    {
        $this->bids = $bids;

        return $this;
    }

    /**
     * Get the value of quality
     */ 
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * Set the value of quality
     *
     * @return  self
     */ 
    public function setQuality($quality)
    {
        $this->quality = $quality;

        return $this;
    }

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }
}