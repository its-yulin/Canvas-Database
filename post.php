<?php
session_start();
include_once 'index.php';
$sid = $_SESSION['user']['sid'];
$cid = $_GET['cid'];
$tags = $postModel->getTags($cid);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['type'] === 'addPost') {
        $params = [
            'cid' => $cid,
            'sid' => $sid,
            'ptitle' => $_POST['ptitle'],
            'tag' => $_POST['tag'],
            'text' => $_POST['text']
        ];
        $postModel->addPost($params);
    } else if ($_POST['type'] === 'addReply') {
        $params = [
            'cid' => $cid,
            'sid' => $sid,
            'pid' => $_POST['pid'],
            'reply' => $_POST['reply']
        ];
        $postModel->addReply($params);
    }
}

$postList = $postModel->postList($cid);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post</title>
    <style>
        table {
            width: 1000px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<a href="course.php?<?php echo "actions=" . $_GET['actions'] . "&cid=" . $_GET['cid'] ?>">
    <button>&lt;Cancel</button>
</a>
<form method="post">
    <table border="1">
        <input type="hidden" name="type" value="addPost">
        <tr>
            <th>Post Title</th>
            <td><input type="text" name="ptitle"></td>
        </tr>
        <tr>
            <th>Post Text</th>
            <td><textarea name="text"></textarea></td>
        </tr>
        <tr>
            <th>Post Tag</th>
            <td>
                <select name="tag">
                    <?php
                    echo sizeof($tags);
                    if (sizeof($tags) === 0) {
                        echo "<option>Default</option>";
                    }
                    foreach ($tags as $tag) {
                        $v = $tag['tag'];
                        echo "<option>$v</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center">
                <button>Add Post</button>
            </td>
        </tr>
    </table>
</form>
<table border="1" style="margin-top: 10px">
    <?php
    foreach ($postList as $item) {
        ?>
        <tr>
            <th>Post Title</th>
            <th>Post Text</th>
            <th>Post Date</th>
            <th>Post Tag</th>
        </tr>
        <tr>
            <td><?php echo $item['ptitle'] ?></td>
            <td><?php echo $item['text'] ?></td>
            <td><?php echo $item['pdate'] ?></td>
            <td><?php echo $item['tag'] ?></td>
        </tr>
        <tr>
            <td colspan="4">
                <form method="post">
                    <input type="hidden" name="type" value="addReply">
                    <input type="hidden" name="pid" value="<?php echo $item['pid'] ?>">
                    <h3>Replys:
                        <input name="reply" type="text">
                        <button>Reply</button>
                    </h3>
                </form>
                <?php
                foreach ($item['reply'] as $reply) {
                    ?>
                    <div>
                        <p>SID: <?php echo $reply['sid'] ?></p>
                        <p>Reply Time: <?php echo $reply['rtime'] ?></p>
                        <p>Reply Text:<?php echo $reply['reply'] ?></p>
                        <hr>
                    </div>
                    <?php
                }
                ?>


            </td>
        </tr>
        <?php
    }
    ?>
</table>
</body>
</html>
