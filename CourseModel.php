<?php


namespace model;


class CourseModel extends Model
{
    public function courseList($sid)
    {
        $sql = "SELECT
                c.*,
                take.`lettergrade` AS grade,
                IF(ISNULL(i.`iindex`) AND ISNULL(t.`tindex`),FALSE,TRUE) AS actions
                FROM 
                course AS c
                LEFT JOIN
                student AS s
                ON
                s.`sid`='$sid'
                LEFT JOIN 
                instructor AS i
                ON 
                i.`cid`=c.`cid` AND i.`sid`=s.`sid`
                LEFT JOIN
                ta AS t
                ON 
                t.`cid`=c.`cid` AND t.`sid`=s.`sid`
                LEFT JOIN
                take
                ON take.`cid`=c.`cid` AND take.`sid`=s.`sid`";
        return $this->toList($this->conn->query($sql));
    }

    public function getTakeList($cid)
    {
        $sql = "SELECT student.*,take.`lettergrade` FROM take LEFT JOIN student ON student.`sid`=take.`sid` WHERE cid = '$cid'";
        return $this->toList($this->conn->query($sql));
    }

    public function updateGrade($cid, $sid, $grade)
    {
        $sql = "UPDATE take SET lettergrade = '$grade' WHERE cid= '$cid' AND sid = '$sid'";
        return $this->conn->query($sql);
    }
}
