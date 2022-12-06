<?php
session_start();
include_once 'index.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student = $studentModel->login($_POST['sid'], $_POST['lid']);
    if($student){
        $_SESSION['user'] = $student;
        header("location:home.php");
    }else{
        $message = "Error loginID or studentId";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
<?php
    if (isset($message)){
        echo "<p style='color: red'>$message</p>";
    }
?>
<form action="login.php" method="post">
    <div>
        <label for="sid">StudentId</label>
        <input type="text" name="sid" id="sid" placeholder="Student Id">
    </div>
    <div>
        <label for="lid">Password</label>
        <input type="text" name="lid" id="lid" placeholder="Login Id">
    </div>
    <div>
        <button type="submit">Login</button>
    </div>
</form>
</body>
</html>
