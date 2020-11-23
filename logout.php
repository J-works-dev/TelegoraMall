<?php
    setcookie('userid', '', time()-10, '/');
    echo "<script>alert('Logged Out');location.href='index.php';</script>";
    // header("Location: index.php");
?>