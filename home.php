<?php
session_start();
include_once 'index.php';
$studentCourse = $courseModel->courseList($_SESSION['user']['sid']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <style>
        table{
            width: 1000px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<a href="login.php">
    <button>&lt;Logout</button>
</a>
<table border="1">
    <tr>
        <th>CourseNumber</th>
        <th>CourseName</th>
        <th>Semester</th>
        <th>Year</th>
        <th>Grade</th>
        <th>Actions</th>
    </tr>
    <?php
    foreach ($studentCourse as $course) {
        ?>
        <tr>
            <td><?php echo $course['cnum'] ?></td>
            <td><?php echo $course['cname'] ?></td>
            <td><?php echo $course['semester'] ?></td>
            <td><?php echo $course['year'] ?></td>
            <td><?php echo $course['grade'] ?></td>
            <td>
                <a href="course.php?<?php echo 'actions='.$course['actions'].'&cid='.$course['cid']?>">
                    <?php
                        if ($course['actions']==='0')
                            echo "Show Course";
                        else
                            echo "Manage Course";
                    ?>
                </a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
</body>
</html>
