<?php
namespace model;

class StudentModel extends Model
{
    public function login($sid,$lid){
        return $this->getOne($this->conn->query("select * from student where sid='$sid' and lid='$lid'"));
    }
}
