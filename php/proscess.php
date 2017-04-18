<?php
session_start();

$servername = "vgtradeshow.db.5308118.hostedresource.com";
$username = "vgtradeshow";
$password = "P2ssw#rd";
$dbname = "vgtradeshow";
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
        
        echo '<!DOCTYPE html>
        <html>
            <head>  
                <meta charset = "utf-8" />
                <meta name = "viewport" content = "width=device-width,initial-scale=1.0,minimum-scale=1.0"/>
                <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
                <title>Results</title>
            </head>
            
            <body style="display:flex;flex-flow:row wrap;justify-content:center;align-items:center">
                <div style="margin:0 auto;font-size:3rem;font-family:orbitron;">The email you entered is already in use. Please enter a different email.
                    <br/>
                    <a style = "display: block; color: #ffffff; font-family: orbitron;font-size:1.25rem; margin:1rem auto; text-decoration: none; height: 40px; width: 130px; line-height: 40px;background-color: #1a1a1a; text-align: center;" href = "http://kuzmaclass.org/sandbox/VendicantGamesStoryboard1.10PM/contact.php">Back</a>
                </div>
            </body>
        
        </html>
        ';

    } else {
        $sql = "INSERT INTO $tname (fname, lname, email) VALUES ('$fname', '$lname', '$email')";
        if(!$conn->query($sql)) {
            $_SESSION["submission_results"] = false;
            echo "<script>window.location.href = '../index.php'</script>";
            
            echo '<!DOCTYPE html>
            <html>
                <head>  
                    <meta charset = "utf-8" />
                    <meta name = "viewport" content = "width=device-width,initial-scale=1.0,minimum-scale=1.0"/>
                    <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
                    <title>Results</title>
                </head>

                <body style="display:flex;flex-flow:row wrap;justify-content:center;align-items:center">
                    <div style="margin:0 auto;font-size:3rem;font-family:orbitron;">An error occured. Please try again later.
                        <br/>
                        <a style = "display: block; color: #ffffff; font-family: orbitron;font-size:1.25rem; margin:1rem auto; text-decoration: none; height: 40px; width: 130px; line-height: 40px;background-color: #1a1a1a; text-align: center;" href = "http://kuzmaclass.org/sandbox/VendicantGamesStoryboard1.10PM/contact.php">Back</a>
                    </div>
                </body>

            </html>
            ';
            
            $subject = "Error Report - Trade Show";
            $message = "An error occured while proscessing user input. Please verify the integrity of all scripts";
            @mail($admin, $subject, $message, $headers);
            
        } else {
            $_SESSION["submission_results"] = true;
            
            $subject = "Vendicant Games Trade Show";
            $message = "Thanks for signing up! We'll send you a reminder several days before the event starts";

            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if(@mail($email, $subject,$message,$headers)) {

                    echo "<script>window.location.href = '../index.php'</script>";

                    echo '<!DOCTYPE html>
                    <html>
                        <head>  
                            <meta charset = "utf-8" />
                            <meta name = "viewport" content = "width=device-width,initial-scale=1.0,minimum-scale=1.0"/>
                            <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
                            <title>Results</title>
                        </head>

                        <body style="display:flex;flex-flow:row wrap;justify-content:center;align-items:center">
                            <div style="margin:0 auto;font-size:3rem;font-family:orbitron;">Your response was sucessfully recorded.
                                <br/>
                                <a style = "display: block; color: #ffffff; font-family: orbitron;font-size:1.25rem; margin:1rem auto; text-decoration: none; height: 40px; width: 130px; line-height: 40px;background-color: #1a1a1a; text-align: center;" href = "http://kuzmaclass.org/sandbox/VendicantGamesStoryboard1.10PM/contact.php">Back</a>
                            </div>
                        </body>

                    </html>
                    ';
            }
        
            } else {
                $_SESSION["email_error"] = true;
                echo "<script>window.location.href = '../index.php'</script>";
            }

        }
    }

} else if( $fname == null || $lname == null || $email == null) {
    $_SESSION["form_incomplete"] = true;
    echo "<script>window.location.href = '../index.php'</script>";
    
    echo '<!DOCTYPE html>
        <html>
            <head>  
                <meta charset = "utf-8" />
                <meta name = "viewport" content = "width=device-width,initial-scale=1.0,minimum-scale=1.0"/>
                <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
                <title>Results</title>
            </head>
            
            <body style="display:flex;flex-flow:row wrap;justify-content:center;align-items:center">
                <div style="margin:0 auto;font-size:3rem;font-family:orbitron;">Please verify that all fields were completed correctly.
                    <br/>
                    <a style = "display: block; color: #ffffff; font-family: orbitron;font-size:1.25rem; margin:1rem auto; text-decoration: none; height: 40px; width: 130px; line-height: 40px;background-color: #1a1a1a; text-align: center;" href = "http://kuzmaclass.org/sandbox/VendicantGamesStoryboard1.10PM/contact.php">Back</a>
                </div>
            </body>
        
        </html>
        ';
}

$conn -> close();

?>