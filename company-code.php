<?php
include "db_conn.php";

$title = $_POST['title'];
$email = $_POST['email'];
$tags = $_POST['tags'];
$type = $_POST['type'];
$experience = $_POST['experience'];
$minimum_salary = $_POST['minimum_salary'];
$maximum_salary = $_POST['maximum_salary'];
$region = $_POST['region'];
$location = $_POST['location'];
$upload_file = $_POST['upload_file'];

if (empty($title)) {
    header("Location: company-post-jobs.php?error=title is required");
    exit();
} elseif (empty($email)) {
    header("Location: company-post-jobs.php?error=email is required");
    exit();
} elseif (empty($tags)) {
    header("Location: company-post-jobs.php?error=tags is required");
    exit();
} elseif (empty($experience)) {
    header("Location: company-post-jobs.php?error=experience is required");
    exit();
} elseif (empty($experience)) {
    header("Location: company-post-jobs.php?error=experience is required");
    exit();
} elseif (empty($maximum_salary)) {
    header("Location: company-post-jobs.php?error=maximum salary is required");
    exit();
} elseif (empty($maximum_salary)) {
    header("Location: company-post-jobs.php?error=maximum salary is required");
    exit();
} elseif (empty($region)) {
    header("Location: company-post-jobs.php?error=region is required");
    exit();
} elseif (empty($location)) {
    header("Location: company-post-jobs.php?error=location is required");
    exit();

}
$sql = "INSERT INTO jobs (title,email,tags,experience,minimum_salary,maximum_salary,region,location,upload_file) VALUES ('$title','$email','$tags','$experience','$minimum_salary','$maximum_salary','$region','$location','$upload_file');";

$result = mysqli_query($conn, $sql);
if ($result) {
    if (isset($_FILES['upload_file'])) {
        $errors = array();
        $file_name = $_FILES['upload_file']['name'];
        $file_size = $_FILES['upload_file']['size'];
        $file_tmp = $_FILES['upload_file']['tmp_name'];
        $file_type = $_FILES['upload_file']['type'];
        $file_ext = strtolower(end(explode('.', $_FILES['upload_file']['name'])));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be excately 2 MB';
        }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "images/" . $file_name);
            echo "Success";
        } else {
            print_r($errors);
        }

        $to = "mehedihasansagor.cse@gmail.com";
        $subject = "This is subject";

        $message = "<b>This is HTML message.</b>";
        $message .= "<h1>This is headline.</h1>";

        $header = "From:mehedihasansagor.cse@gmail.com \r\n";
        $retval = mail($to, $subject, $message, $header);

        if ($retval == true) {
            echo "Message sent successfully...";
        } else {
            echo "Message could not be sent...";
        }
    }

}
header("Location: company-post-jobs.php?success=Successfully submit");
exit();