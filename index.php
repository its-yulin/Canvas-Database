<?php
namespace model;

$user = 'cs377';
$pass = 'ma9BcF@Y';
$host = 'localhost';
$dbName = 'canvas';
$port = 3306;
$conn = mysqli_connect($host, $user, $pass, $dbName, $port);

include_once 'Model.php';
include_once 'StudentModel.php';
include_once 'CourseModel.php';
include_once 'AssignmentModel.php';
include_once 'PostModel.php';

$studentModel = new StudentModel($conn);
$courseModel = new CourseModel($conn);
$assignmentModel = new AssignmentModel($conn);
$postModel = new PostModel($conn);
