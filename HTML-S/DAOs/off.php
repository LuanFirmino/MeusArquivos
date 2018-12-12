<?php
    session_start();
    $_SESSION['logM'] = false;
    $_SESSION['logP'] = false;
    header("Location: ../login.php");
?>