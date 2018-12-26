<?php

class Event
{

    private $title;
       private $desc;
       private $location;
       private $dateStamp;
       private $startTime;
       private $endTime;
       private $type;
       private $id;

       function __construct($id, $title, $desc, $location, $dateStamp, $startTime, $endTime, $type)
       {
           $this->title = $title;
           $this->desc = $desc;
           $this->location = $location;
           $this->dateStamp = $dateStamp;
           $this->startTime = $startTime;
           $this->endTime = $endTime;
           $this->type = $type;
           $this->id = $id;
       }

       function printRecord()
       {
           echo($this->getTitle() . $this->getDesc() . $this->getLocation() . $this->getDateStamp() . $this->getStartTime() . $this->getEndTime() . $this->getType() . $this->getId());
       }

       function getTitle()
       {
           return $this->title;
       }

       function getDesc()
       {
           return $this->desc;
       }
       function getLocation()
       {
           return $this->location;
       }
       function getDateStamp()
       {
           return $this->dateStamp;
       }
       function getStartTime()
       {
           return $this->startTime;
       }
       function getEndTime()
       {
           return $this->endTime;
       }
       function getType()
       {
           return $this->type;
       }
       function getId()
       {
           return $this->id;
       }

       function setTitle($title)
       {
           $this->title = $title;
       }

       function setDesc($desc)
       {
           $this->desc = $desc;
       }
       function setLocation($location)
       {
           $this->location = $location;
       }
       function setDateStamp($dateStamp)
       {
           $this->dateStamp = $dateStamp;
       }
       function setStartTime($startTime)
       {
           $this->startTime = $startTime;
       }
       function setEndTime($endTime)
       {
           $this->endTime = $endTime;
       }
       function setType($type)
       {
           $this->type = $type;
       }
       function setId($id)
       {
           $this->id = $id;
       }


}

?>
