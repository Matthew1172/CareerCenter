<?php
class Announcement
{
    private $title;
    private $description;
    private $id;
    private $dateStamp;

    function __construct($id, $title, $description, $dateStamp)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->dateStamp = $dateStamp;
    }

    function getId()
    {
        return $this->id;
    }

    function getTitle()
    {
        return $this->title;
    }

    function getDescription()
    {
        return $this->description;
    }

    function getDateStamp()
    {
        return $this->dateStamp;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setTitle($title)
    {
        $this->title = $title;
    }

    function setDescription($description)
    {
        $this->description = $description;
    }

    function setDateStamp($dateStamp)
    {
        $this->dateStamp = $dateStamp;
    }
}
?>
