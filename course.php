<?php
$cid = $_GET['cid'];
$actions = $_GET['actions'];
session_start();
include_once 'index.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['type'] == 'setGrade')
        $courseModel->updateGrade($_POST['cid'], $_POST['sid'], $_POST['grade']);
    else if ($_POST['type'] == 'addAssignment') {
        $assignmentModel->addAssignment($_POST);
    }
}

$takeList = $courseModel->getTakeList($cid);
$assignmentList = $assignmentModel->assignmentList($cid);
$gradesList = $assignmentModel->gradesBySidAndCid($_SESSION['user']['sid'], $cid);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Course</title>
    <style>
        table {
            width: 1000px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<a href="home.php">
    <button>&lt;Cancel</button>
</a>
<a href="post.php?cid=<?php echo $cid?>&actions=<?php echo $actions?>">
    <button>Posts</button>
</a>
<?php
if ($actions) {
    ?>
    <form method="post">
        <table border="1">
            <input type="hidden" name="cid" value="<?php echo $cid ?>">
            <input type="hidden" name="type" value="addAssignment">
            <tr>
                <th>Assignment Name</th>
                <td><input type="text" name="aname"></td>
            </tr>
            <tr>
                <th>Due Date</th>
                <td><input type="datetime-local" name="due"></td>
            </tr>
            <tr>
                <th>Instruction</th>
                <td>
                    <input name="instruction" type="text">
                </td>
            </tr>
            <tr>
                <th>Point</th>
                <td><input type="text" name="point"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center">
                    <button type="submit">Add Assignment</button>
                </td>
            </tr>
        </table>
    </form>

    <table border="1">
        <tr>
            <th>StudentId</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Grade</th>
            <th>Actions</th>
        </tr>
        <?php
        foreach ($takeList as $take) {
            ?>
            <tr>
                <td><?php echo $take['sid'] ?></td>
                <td><?php echo $take['fname'] ?></td>
                <td><?php echo $take['lname'] ?></td>
                <td><?php echo $take['lettergrade'] ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="cid" value="<?php echo $cid ?>">
                        <input type="hidden" name="sid" value="<?php echo $take['sid'] ?>">
                        <input type="hidden" name="type" value="setGrade">
                        <input type="text" name="grade">
                        <button>Set Grade</button>
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <table border="1">
        <tr>
            <th>Assignment Name</th>
            <th>Due Date</th>
            <th>Instruction</th>
            <th>Points</th>
            <th>Actions</th>
        </tr>
        <?php
        foreach ($assignmentList as $assignment) {
            ?>
            <tr>
                <td><?php echo $assignment['aname'] ?></td>
                <td><?php echo $assignment['due'] ?></td>
                <td><?php echo $assignment['instruction'] ?></td>
                <td><?php echo $assignment['point'] ?></td>
                <td>
                    <a href="assignment.php?<?php echo 'cid='.$cid.'&aname='.$assignment['aname']?>">to assignment</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
<?php } ?>
<?php if ($actions == '0') { ?>
    <table border="1">
        <tr>
            <th>Assignment Name</th>
            <th>Points</th>
            <th>Instruction</th>
            <th>Grade</th>
        </tr>
        <?php
        foreach ($gradesList as $grade) {
            ?>
            <tr>
                <td><?php echo $grade['aname'] ?></td>
                <td><?php echo $grade['point'] ?></td>
                <td><?php echo $grade['instruction'] ?></td>
                <td><?php echo $grade['grade'] ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
<?php } ?>

</body>
</html>
