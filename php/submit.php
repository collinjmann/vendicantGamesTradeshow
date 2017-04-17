<!DOCTYPE html>

<html>
    <head>
        <title>Tradeshow Signup</title>
        <link rel="stylesheet" type="text/css" href="../css/php.css" />
    </head>
    
    <body>
        <h1>
            <?php
                function safeReturn($val)
                {
                    $val = htmlspecialchars($val);
                    $val = trim($val);
                    $val = str_replace(";", "", $val);
                    $val = str_replace(" ", "", $val);
                    return $val;
                }
                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $info = array(safeReturn($_POST["email"]), strtolower(safeReturn($_POST["f_name"])), strtolower(safeReturn($_POST["m_name"])), strtolower(safeReturn($_POST["l_name"])));

                    if (filter_var($info[0], FILTER_VALIDATE_EMAIL) && preg_match("/^[- '\p{L}]+$/u", $info[1]) && preg_match("/^[- '\p{L}]+$/u", $info[2]) && preg_match("/^[- '\p{L}]+$/u", $info[3]) && strlen($info[1]) >= 1 && strlen($info[2]) == 1 && strlen($info[3]) >= 1)
                    {
                        $con = new mysqli("localhost", "root", "");
                        if ($con->connect_error)
                        {
                            echo "There was an error in the sending prosses. Please try again later.";
                        }
                        else
                        {
                            $sql = "create database if not exists vgames;";
                            if ($con->query($sql) === true)
                            {
                                $sql = "create table if not exists people (id int(6) unsigned auto_increment primary key, email varchar(255), f_name varchar(255), m_name varchar(1), l_name varchar(255));";

                                $con = new mysqli("localhost", "root", "", "vgames");
                                if ($con->connect_error)
                                {
                                    echo "Error loading database.";
                                }
                                else
                                {
                                    if ($con->query($sql) === true)
                                    {
                                        $there = false;
                                        $sql = "select email from `people`;";
                                        $r = $con->query($sql);
                                        if ($r->num_rows > 0)
                                        {
                                            while ($row = $r->fetch_assoc())
                                            {
                                                if ($row["email"] == $info[0])
                                                {
                                                    $there = true;
                                                }
                                            }
                                        }               
                                        if ($there == false)
                                        {
                                            $sql = "insert into `people` (email, f_name, m_name, l_name) values(\"$info[0]\", \"$info[1]\", \"$info[2]\", \"$info[3]\")";
                                            if ($con->query($sql) === true)
                                            {
                                                echo "Your infomation has been submited.";
                                            }
                                            else
                                            {
                                                echo "Sorry, there was an error submiting your information. Please try again later.";
                                            }
                                        }
                                        else
                                        {
                                            echo "You have already signed up.";
                                        }
                                    }
                                    else
                                    {
                                        echo "Error loading table.";
                                    }
                                }
                            }
                            else
                            {
                                echo "Error loading database.";
                            }
                        }
                        $con->close();
                    }
                    else
                    {
                        echo "Make sure all fields were filled in correctly, message not sent.";
                    }
                }
                else
                {
                    echo "You have not submited any information.";
                }
            ?>
        </h1>
        <a href="../index.html">Back to Main Page</a>
    </body>
</html>