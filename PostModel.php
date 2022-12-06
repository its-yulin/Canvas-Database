<?php


namespace model;


class PostModel extends Model
{

    public function addPost($params){
        $pid = uniqid();
        $cid = $params['cid'];
        $sid = $params['sid'];
        $tag = $params['tag'];
        date_default_timezone_set("Asia/Shanghai");
        $pdate = date('Y-m-d H:i:s');
        $ptitle = $params['ptitle'];
        $text = $params['text'];
        $sql = "insert into post values ('$pid','$cid','$sid','$ptitle','$pdate','$text')";
        $this->conn->query($sql);
        $sql = "insert into tag values ('$pid','$cid','$tag')";
        return $this->conn->query($sql);
    }

    public function getTags($cid){
        $sql = "SELECT tag FROM tag WHERE cid = '$cid' GROUP BY tag;";
        return $this->toList($this->conn->query($sql));
    }

    public function postList($cid){
        $sql = "select * from post where cid = '$cid'";
        $toList = $this->toList($this->conn->query($sql));
        $result = [];
        foreach ($toList as $item){
            $pid = $item['pid'];
            $item['reply']=$this->toList($this->conn->query("select * from reply where pid = '$pid'"));
            $one = $this->getOne($this->conn->query("select tag from tag where pid = '$pid'"));
            $item['tag']= $one?$one['tag']:"default";
            $result[] = $item;
        }
        return $result;
    }

    public function addReply($params){
        $cid = $params['cid'];
        $pid = $params['pid'];
        $rid = uniqid();
        $sid = $params['sid'];
        date_default_timezone_set("Asia/Shanghai");
        $time = date('Y-m-d H:i:s');
        $reply = $params['reply'];
        $sql = "insert into reply values ('$cid','$pid','$rid','$sid','$time','$reply')";
        return $this->conn->query($sql);
    }

}
