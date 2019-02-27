<?php
class Job
{
    var $job_id;
    var $job_employer_id;
    var $job_title;
    var $job_desc;
    var $job_pos;
    var $job_loc;
    var $job_med;
    var $job_it;
    var $job_health;
    var $job_bus;
    var $job_food;
    var $job_hosp;
    var $job_cul;
    var $job_date;

    public function __construct($job_id, $job_employer_id, $job_title, $job_desc, $job_loc, $job_med, $job_it, $job_health, $job_bus, $job_food, $job_hosp, $job_cul, $job_date)
    {
        $this->job_id = $job_id;
        $this->job_employer_id = $job_employer_id;
        $this->job_title = $job_title;
        $this->job_desc = $job_desc;
        $this->job_loc = $job_loc;
        $this->job_med = $job_med;
        $this->job_it = $job_it;
        $this->job_health = $job_health;
        $this->job_bus = $job_bus;
        $this->job_food = $job_food;
        $this->job_hosp = $job_hosp;
        $this->job_cul = $job_cul;
        $this->job_date = $job_date;
    }

    public function getID()
    {
        return $this->job_id;
    }
    public function getEmployerID()
    {
        return $this->job_employer_id;
    }
    public function getTitle()
    {
        return $this->job_title;
    }
    public function getDesc()
    {
        return $this->job_desc;
    }
    public function getLoc()
    {
        return $this->job_loc;
    }
    public function getMed()
    {
        return $this->job_med;
    }
    public function getIT()
    {
        return $this->job_it;
    }
    public function getHealth()
    {
        return $this->job_health;
    }
    public function getBus()
    {
        return $this->job_bus;
    }
    public function getFood()
    {
        return $this->job_food;
    }
    public function getHosp()
    {
        return $this->job_hosp;
    }
    public function getCul()
    {
        return $this->job_cul;
    }
    public function getDate()
    {
        return $this->job_date;
    }
    public function setID($x)
    {
        $this->job_id = $x;
    }
    public function setEmployerID($x)
    {
        $this->job_employer_id = $x;
    }
    public function setTitle($x)
    {
        $this->job_title = $x;
    }
    public function setDesc($x)
    {
        $this->job_desc = $x;
    }
    public function setLoc($x)
    {
        $this->job_loc = $x;
    }
    public function setMed($x)
    {
        $this->job_med = $x;
    }
    public function setIT($x)
    {
        $this->job_it = $x;
    }
    public function setHealth($x)
    {
        $this->job_health = $x;
    }
    public function setBus($x)
    {
        $this->job_bus = $x;
    }
    public function setFood($x)
    {
        $this->job_food = $x;
    }
    public function setHosp($x)
    {
        $this->job_hosp = $x;
    }
    public function setCul($x)
    {
        $this->job_cul = $x;
    }
    public function setDate($x)
    {
        $this->job_date = $x;
    }
}
