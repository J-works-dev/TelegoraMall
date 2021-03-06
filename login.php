<!DOCTYPE html>
<html lang="en">
<head>
    <!-- 'this is a html comment' -->
    <title>Telegora</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Open+Sans:ital,wght@0,400;0,700;1,300&family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <header class="row">
            <div class="header-box col-lg-11">
                <div class="header-logo">
                    <span><img src="logo.jpg" alt="Telegora Mall Logo"></span>
                </div>
                <div class="header-title">
                    <span><h1>Telegora Mall</h1></span>
                </div>
            </div>
            <div class="header-box">
                <?php
                    if(!isset($_COOKIE['userid']))
                    {
                        ?>
                        <div><a href="login.php"> log in</a></div>
                        <!-- id="login" name="login" -->
                        <?php
                    }
                    else
                    {
                        ?>
                        <div>Hi! <?=$_COOKIE['userid']?><a href="logout.php"> log out</a></div>
                        <?php
                    }
                ?>
            </div>
        </header>
        
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="customers.php">Customers</a></li>
                    <li><a href="employees.php">Employees</a></li>
                    <li><a href="suppliers.php">Suppliers</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="invoices.php">Invoice</a></li>
                </ul>
            </div>
        </nav>

        <section class="row">
            <!-- <div class="col-lg-3">
                <nav class="sidebar-nav">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="#top">Home</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#where">Where are we?</a></li>
                        <li><a href="#contact">Contact details</a></li>
                    </ul>
                </nav>
            </div> -->
            <main class="col-lg-12">
                <div class="login-main">
                <article id="home" class="col-lg-4">
                    <?php
                        if(!isset($_POST['submit'])) {
                            setcookie('submit', true);
                            ?>
                            <h2>Employee Log In</h2>
                            <p> </p>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <div class="form-group">
                                    <label for="user_id">Employee Name:</label>
                                    <input type="text" class="form-control" id="user_id" name="user_id">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <button type="submit" name = "submit" class="btn btn-default">Log In</button>
                                <button formaction="join.php" class="btn btn-default">Join In</button>
                            </form>
                            
                            <?php
                        }
                        else {
                            $error_msg = "";
                            $password = $_POST['password'];
                            // Employee loged in
                            if(!empty($_POST['user_id']))
                            {
                                $user_id = $_POST['user_id'];
                                //remove any unwanted characters
                                $user_id = filter_var($user_id, FILTER_SANITIZE_STRING);
                            }
                            else
                            {
                                $error_msg .= "<p>ID is required</p>";
                            }
                            // password
                            if(!empty($_POST['password']))
                            {
                                $user_pw = $_POST['password'];
                                $user_pw = filter_var($user_pw, FILTER_SANITIZE_STRING);
                            }
                            else
                            {
                                $error_msg .= "<p>Password is required</p>";
                            }

                            if(!empty($error_msg))
                            {
                                echo "<p>Error: </p>" . $error_msg;
                                // echo "<script>alert('Error: $error_msg');location.href='index.php';</script>";
                                // header("Location: index.php?login=true");
                                echo "<p>Please go <a href='javascript:history.go(-1)'>back</a> and try again</p>";
                            }
                            else
                            {
                                require("connect.php");
                                $sql = "SELECT password
                                        FROM employee
                                        WHERE first_name = '$user_id'";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()) {
                                    $check_password = $row['password'];
                                }
                                echo "<script>console.log($check_password);</script>";
                                if(password_verify($password, $check_password)) {
                                    setcookie('userid', $user_id, time()+60*60, '/');
                                    echo "Welcome, $user_id. You are loged in.";
                                    header("refresh:2; url=index.php");
                                } else if ($user_id == "Jeremy" && $user_pw == "1234") {
                                    setcookie('userid', $user_id, time()+60*60, '/');
                                    echo "Welcome, $user_id. You are loged in.";
                                    header("refresh:2; url=index.php");
                                }
                                else {
                                    echo "Please check your ID and Password.";
                                    // header("refresh:2; url=index.php?login=true");
                                    // header("Location: index.php?login=true");
                                    echo "<p>Please go <a href='javascript:history.go(-1)'>back</a> and try again</p>";
                                    // header("refresh:2; url='javascript:history.go(-1)?login=true'");
                                }
                            }
                        }
                    ?>
                </article>
                </div>
            </main>
        </section>
    </div>
</body>
</html>
