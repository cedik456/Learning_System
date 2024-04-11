<?php
    session_start();
    // Destroy session
    if(session_destroy()) {
        // Redirecting To Home Page
        // header("Location: index.php");
        echo '<script>alert("Goodbye! Peace \s/")</script>';
        echo "<script>window.location.href ='index.php'</script>";

    }
?>