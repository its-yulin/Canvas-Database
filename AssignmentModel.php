<?php


namespace model;


class AssignmentModel extends Model
{
    function assignmentList($cid)
    {
        $sql = "SELECT * FROM assignment WHERE cid = '$cid';";
        return $this->toList($this->conn->query($sql));
    }

    function gradesBySidAndCid($sid, $cid)
    {
        $sql = "SELECT * FROM grade LEFT JOIN assignment ON assignment.`aname`=grade.`aname` AND assignment.`cid`=grade.`cid` WHERE grade.cid = '$cid' AND grade.sid = '$sid'";
        return $this->toList($this->conn->query($sql));
    }

    function gradesByCidAndAName($aname,$cid){
        $sql = "SELECT * FROM grade LEFT JOIN student ON student.`sid`=grade.`sid` WHERE grade.cid = '$cid' AND grade.aname = '$aname'";
        return $this->toList($this->conn->query($sql));
    }

    function addAssignment($params)
    {
        $cid = $params['cid'];
        $aname = $params['aname'];
        $due = $params['due'];
        $instruction = $params['instruction'];
        $point = $params['point'];
        $sql = "insert into assignment values ('$cid','$aname','$due','$instruction','$point')";
        return $this->conn->query($sql);
    }

    function updateGrade($params){
        $cid = $params['cid'];
        $aname = $params['aname'];
        $grade = $params['grade'];
        $sid = $params['sid'];
        $sql = "update grade set grade='$grade' where sid='$sid' and cid='$cid' and aname='$aname'";
        return $this->conn->query($sql);
    }
}
