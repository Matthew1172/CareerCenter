<?php
class User 
{
    var $user_id;
    var $user_first;
    var $user_last;
    var $user_email;
    var $user_phone;
    var $user_uid;
    var $user_type;
    var $user_a3;
    var $user_a2;
    var $user_a1;
    var $user_q3;
    var $user_q2;
    var $user_q1;
    
    public function __construct($user_id,$user_first,$user_last,$user_email,$user_phone,$user_uid,$user_type,$user_a3,$user_a2,$user_a1,$user_q3,$user_q2,$user_q1) {
        $this->user_id = $user_id;
        $this->user_first = $user_first;
        $this->user_last = $user_last;
        $this->user_email = $user_email;
        $this->user_phone = $user_phone;
        $this->user_uid = $user_uid;
        $this->user_type = $user_type;
        $this->user_a3 = $user_a3;
        $this->user_a2 = $user_a2;
        $this->user_a1 = $user_a1;
        $this->user_q3 = $user_q3;
        $this->user_q2 = $user_q2;
        $this->user_q1 = $user_q1;
    }
    
    public function getID()
    {
        return $this->user_id;
    }
    public function getFirst()
    {
        return $this->user_first;
    }
    public function getLast()
    {
        return $this->user_last;
    }
    public function getEmail()
    {
        return $this->user_email;
    }
    public function getPhone()
    {
        return $this->user_phone;
    }
    public function getUID()
    {
        return $this->user_uid;
    }
    public function getType()
    {
        return $this->user_type;
    }
    public function getA3()
    {
        return $this->user_a3;
    }
    public function getA2()
    {
        return $this->user_a2;
    }
    public function getA1()
    {
        return $this->user_a1;
    }
    public function getQ3()
    {
        return $this->user_q3;
    }
    public function getQ2()
    {
        return $this->user_q2;
    }
    public function getQ1()
    {
        return $this->user_q1;
    }
    
    public function setID($x)
    {
        $this->user_id = $x;
    }
    public function setFirst($x)
    {
        $this->user_first = $x;
    }
    public function setLast($x)
    {
        $this->user_last = $x;
    }
    public function setEmail($x)
    {
        $this->user_email = $x;
    }
    public function setPhone($x)
    {
        $this->user_phone = $x;
    }
    public function setUID($x)
    {
        $this->user_uid = $x;
    }
    public function setType($x)
    {
        $this->user_type = $x;
    }
    public function setA3($x)
    {
        $this->user_a3 = $x;
    }
    public function setA2($x)
    {
        $this->user_a2 = $x;
    }
    public function setA1($x)
    {
        $this->user_a1 = $x;
    }
    public function setQ3($x)
    {
        $this->user_q3 = $x;
    }
    public function setQ2($x)
    {
        $this->user_q2 = $x;
    }
    public function setQ1($x)
    {
        $this->user_q1 = $x;
    }
}
