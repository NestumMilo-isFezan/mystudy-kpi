<?php
include'../template/header2.php';
if(isset($_SESSION['UID'])){
    unset($_SESSION['UID']);
    unset($_SESSION['matricNo']);
    unset($_SESSION['loggedin_time']);
    unset($_SESSION['$intake']);
    unset($_SESSION['username']);

    echo'
    <img class="status-icon" src="../src/img/success.png"/>
    <h1 class="status"><b>Logout Success</b></h1>
    <p class="description">Moving into the default page in 3 seconds.<br>';
    header("refresh:3;URL=../index.php");
}