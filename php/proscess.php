<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tradeshow_rvsp";
$tname = "responses";
$admin = "noah.pikaart.wgd@gmail.com";

$noreply = "noreply@kuzmaclass.org";
$headers = "From: " . $noreply;
$headers .= "MIME-Version: 1.0";
$headers .= "Content-type:text/html; charset = UTF-8"; 

$fname = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST["fname"]);
$lname = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST["lname"]);
$email = preg_replace('/[^A-Za-z0-9.@\-]/', '', $_POST["email"]);

$conn = new mysqli($servername, $username, $password, $dbname);

if($fname != null && $lname != null && $email != null)
{
    $sql = "SELECT * FROM responses WHERE email = '$email'";
    $result = $conn->query($sql);
    if(mysqli_num_rows($result) > 0) {
        $_SESSION['email_taken'] = true;
        echo "<script>window.location.href = '../index.php'</script>";

    } else {
        $sql = "INSERT INTO $tname (fname, lname, email) VALUES ('$fname', '$lname', '$email')";
        if(!$conn->query($sql)) {
            $_SESSION["submission_results"] = false;
            echo "<script>window.location.href = '../index.php'</script>";
            $subject = "Error Report - Trade Show";
            $message = "An error occured while proscessing user input. Please verify the integrity of all scripts";
            @mail($admin, $subject, $message, $headers);
        }

        $subject = "Vendicant Games Trade Show";
        $message = "Thanks for signing up! We'll send you a reminder several days before the event starts";

        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if(@mail($email, $subject,$message,$headers)) {
                $_SESSION["submission_results"] = true;
                echo "<script>window.location.href = '../index.php'</script>";
            } else {
                $_SESSION["email_error"] = true;
                echo "<script>window.location.href = '../index.php'</script>";
            }

        }
    }

} else if( $fname == null || $lname == null || $email == null) {
    $_SESSION["form_incomplete"] = true;
    echo "<script>window.location.href = '../index.php'</script>";
}


?>