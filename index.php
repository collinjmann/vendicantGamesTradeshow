<?php
session_start();    
include 'php/config.php';
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Vendicant Games Trade Show</title>
        <link rel="stylesheet" type="text/css" href="css/main.css" />
        <link rel="stylesheet" type="text/css" media="screen and (max-width: 1050px)" href="css/mobal.css" />
        <meta charset="utf-8" />
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    </head>
    
    <body>
        <?php
            if(isset($_SESSION["submission_results"])) {
                if($_SESSION["submission_results"] == false && $_SESSION["submission_results"] != null) {
                    echo "<script>alert('An error occured. Please try again later.');</script>";
                    $_SESSION["submission_results"] = null;
                } else if($_SESSION["submission_results"] == true) {
                    echo "<script>alert('Your submission was sucessfully recorded');</script>";
                    $_SESSION["submission_results"] = null;
                }
            }
            
            
            if(isset($_SESSION['email_taken'])) {
                if($_SESSION['email_taken'] == true) {
                    echo "<script>alert('The email you entered is already in use. Please enter a different email.');</script>";
                    $_SESSION["email_taken"] = null;
                }
            }
        
        if(isset($_SESSION["form_incomplete"])) {
            if($_SESSION["form_incomplete"] == true) {
                 echo "<script>alert('Not all fields were filled out. Please fill out missing fields before submitting');</script>";
                $_SESSION["form_incomplete"] = null;
            }
        }
            
        
        ?>
        
        <header>
            <div><span>Vendicant Games</span> Trade Show</div>
        </header>
        
        <div id="button">
            <div></div>
            <div></div>
            <div></div>
        </div>
        
        <main>
            <section>
                <h2>Sign Up!</h2>
                <form method="post" action="php/proscess.php">
                    <fieldset>
                        <legend>User Information</legend>
                        <div>
                            <span>Your Email: </span>
                            <input type="text" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" />
                        </div>
                        <div>
                            <span>First Name: </span>
                            <input type="text" name="fname" required />
                        </div>
                        <div>
                            <span>Last Name: </span>
                            <input type="text" name="lname" required />
                        </div>
                    </fieldset>
                    <input type="submit" />
                    <input type="reset" />
                </form>
            </section>
            
            <section>
                <article>
                    <h2>Lorum Ipsum</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </article>
            </section>
        </main>
        
        <footer>
            <span>&copy; Vendicant Games, all rights reserved | Email Webmaster: <a href="mailto:noah.pikaart.wgd@gmail.com">noah.pikaart.wgd@gmail.com</a></span>
        </footer>
    </body>
</html>