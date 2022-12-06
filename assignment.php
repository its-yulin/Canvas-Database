<?php
session_start();
include_once 'index.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $assignmentModel->updateGrade($_POST);
}
$gradesList = $assignmentModel->gradesByCidAndAName($_GET['aname'], $_GET['cid']);
//echo json_encode($gradesList);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Assignment</title>
    <style>
        table {
            width: 1000px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<a href="course.php?<?php echo "actions=1&cid=" . $_GET['cid'] ?>">
    <button>&lt;Cancel</button>
</a>
<table border="1">
    <tr>
        <th>Sid</th>
        <th>FirstName</th>
        <th>LastName</th>
        <th>Assignment Name</th>
        <th>Grade</th>
        <th>Actions</th>
    </tr>
    <?php
    foreach ($gradesList as $grade) {
        ?>
        <tr>
            <td><?php echo $grade['sid'] ?></td>
            <td><?php echo $grade['fname'] ?></td>
            <td><?php echo $grade['lname'] ?></td>
            <td><?php echo $grade['aname'] ?></td>
            <td><?php echo $grade['grade'] ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="sid" value="<?php echo $grade['sid'] ?>">
                    <input type="hidden" name="aname" value="<?php echo $grade['aname'] ?>">
                    <input type="hidden" name="cid" value="<?php echo $grade['cid'] ?>">
                    <input type="text" name="grade">
                    <button>Set Grade</button>
                </form>
            </td>
        </tr>
        <?php
    }
    ?>

</table>

</body>
</html>
