<?php

namespace model;

use mysqli_result;
use mysqli;

class Model
{
    protected $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }


    protected function toList(mysqli_result $mysqlResult)
    {
        $result = array();

        while ($houses = $mysqlResult->fetch_assoc()) {
            $result[] = $houses;
        }

        return $result;
    }

    protected function getOne(mysqli_result $mysqlResult)
    {
        if ($mysqlResult->num_rows > 0) {
            return $mysqlResult->fetch_assoc();
        } else {
            return null;
        }
    }

}
