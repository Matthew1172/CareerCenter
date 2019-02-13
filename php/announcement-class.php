<?php
class Announcement
{
  var $id;
  var $title;
  var $description;
  var $dateStamp;
  public function __construct($id, $title, $description, $dateStamp)
  {
    $this->id = $id;
    $this->title = $title;
    $this->description = $description;
    $this->dateStamp = $dateStamp;
  }
  public function getID()
  {
    return $this->id;
  }
  public function getTitle()
  {
    return $this->title;
  }
  public function getDesc()
  {
    return $this->description;
  }
  public function getDate()
  {
    return $this->dateStamp;
  }
}
?>
