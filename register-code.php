<?php
include "db_conn.php";

if (isset($_POST['name']) && isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
    if (empty($uname)) {
        header("Location: register.php?error=User Name is required");
        exit();
    } else if (empty($pass)) {
        header("Location: register.php?error= Password is required");
        exit();
    } else if (empty($uname)) {
        header("Location: register.php?error=Full Name is required");
        exit();
    } else {
        $sql = "INSERT INTO users (user_name, password, name,email,role) VALUES ('$uname', '$pass', '$name','$email','$role');";

        $result = mysqli_query($conn, $sql);
        header("Location: index.php?success=thank you for register");
        exit();
    }

} else {
    header("Location: register.php");
    exit();
}