<?php

if(!isset($_COOKIE['userid']))
{
    if(!isset($_POST['submit'])) {
        ?>
        <p> </p>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="user_id">Employee Name:</label>
                <input type="text" class="form-control" id="user_id" name="user_id">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" name = "submit" class="btn btn-default">Log In</button>
        </form>
        <?php
    }
    else {
        $error_msg = "";
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
            echo "<script>alert('Error: $error_msg');location.href='index.php';</script>";
            header("refresh:2; url='javascript:history.go(-1)?login=true'");
            // echo "<p>Please go <a href='javascript:history.go(-2)'>back</a> and try again</p>";
        }
        else
        {
            if($user_id == "Employee" && $user_pw == "1234") {
                setcookie('userid', $user_id, time()+60*60, '/');
                echo "Hi, $user_id. You are loged in.";
                header("refresh:2; url=index.php");
            }
            else {
                echo "<script>alert('Please check your ID and Password.');location.href='index.php';</script>";
                // header("refresh:2; url=index.php?login=true");
                header("refresh:2; url='javascript:history.go(-1)?login=true'");
            }
        }
    }
    
}
else
{
    ?>
    <div><?=$_COOKIE['userid']?> is logged in.</div>
    <?php
}

?>
