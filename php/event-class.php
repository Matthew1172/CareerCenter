<?php
class Event
{
        var $event_id;
        var $event_title;
        var $event_desc;
        var $event_loc;
        var $event_dateStamp;
        var $event_start;
        var $event_end;
        var $event_isMed;
        var $event_isIT;
        var $event_isHealth;
        var $event_isBus;
        var $event_isFood;
        var $event_isHosp;
        var $event_isCul;
        
    public function __construct($event_id, $event_title, $event_desc, $event_loc, $event_dateStamp, $event_start, $event_end, $event_isMed, $event_isIT, $event_isHealth, $event_isBus, $event_isFood, $event_isHosp, $event_isCul) {
        $this->event_id = $event_id;
        $this->event_title = $event_title;
        $this->event_desc = $event_desc;
        $this->event_loc = $event_loc;
        $this->event_dateStamp = $event_dateStamp;
        $this->event_start = $event_start;
        $this->event_end = $event_end;
        $this->event_isMed = $event_isMed;
        $this->event_isIT = $event_isIT;
        $this->event_isHealth = $event_isHealth;
        $this->event_isBus = $event_isBus;
        $this->event_isFood = $event_isFood;
        $this->event_isHosp = $event_isHosp;
        $this->event_isCul = $event_isCul;
    }
    
    public function getID()
    {
        return $this->event_id;
    }
    
    public function setID($event_newID)
    {
        $this->event_id = $event_newID;
    }
    
    public function getTitle()
    {
        return $this->event_title;
    }
    
    public function setTitle($event_newTitle)
    {
        $this->event_title = $event_newTitle;
    }
    
    public function getDesc()
    {
        return $this->event_desc;
    }
    
    public function setDesc($event_newDesc)
    {
        $this->event_desc = $event_newDesc;
    }
    
    public function getLoc()
    {
        return $this->event_loc;
    }
    
    public function setLoc($event_newLoc)
    {
        $this->event_loc = $event_newLoc;
    }
    
    public function getDateStamp()
    {
        return $this->event_dateStamp;
    }
    
    public function setDateStamp($event_newDateStamp)
    {
        $this->event_dateStamp = $event_newDateStamp;
    }
    
    public function getStart()
    {
        return $this->event_start;
    }
    
    public function setStart($event_newStart)
    {
        $this->event_start = $event_newStart;
    }
        
    public function getEnd()
    {
        return $this->event_end;
    }
    
    public function setEnd($event_newEnd)
    {
        $this->event_end = $event_newEnd;
    }
    
    public function getMed()
    {
        return $this->event_isMed;
    }
    
    public function setMed($event_newMed)
    {
        $this->event_isMed = $event_newMed;
    }
    
    public function getIT()
    {
        return $this->event_isIT;
    }
    
    public function setIT($event_newIT)
    {
        $this->event_isIT = $event_newIT;
    }
    
    public function getHealth()
    {
        return $this->event_isHealth;
    }
    
    public function setHealth($event_newHealth)
    {
        $this->event_isHealth = $event_newHealth;
    }
    
    public function getBus()
    {
        return $this->event_isBus;
    }
    
    public function setBus($event_newBus)
    {
        $this->event_isBus = $event_newBus;
    }

    public function getFood()
    {
        return $this->event_isFood;
    }
    
    public function setFood($event_newFood)
    {
        $this->event_isFood = $event_newFood;
    } 
    
    public function getHosp()
    {
        return $this->event_isHosp;
    }
    
    public function setHosp($event_newHosp)
    {
        $this->event_isHosp = $event_newHosp;
    } 
    
    public function getCul()
    {
        return $this->event_isCul;
    }
    
    public function setCul($event_newCul)
    {
        $this->event_isCul = $event_newCul;
    } 
}
