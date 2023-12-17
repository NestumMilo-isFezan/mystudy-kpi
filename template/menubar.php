<?php
//echo '<nav class="topnav" id="myTopnav">
//    <a href="index.php" class="active">Profile</a>
//    <a href="my_kpi.php" class="active">KPI Indicator</a> 
//    <a href="my_activities.php" class="active">List of Activities</a>
//    <a href="my_challenge.php" class="active">Challenge and Future Plan</a>
//    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
//    <i class="fa fa-bars"></i></a>
//</nav>';

/*echo '<nav class="topnav" id="myTopnav">
<a href="user-auth/register-form.php" class="active" style="background-color:#0e5fc9; float: right">Register</a>
<a href="user-auth/login-form.php" class="active" style="background-color:#2ac90e; float: right">Login</a>
<a href="javascript:void(0);" class="icon" onclick="myFunction()">
<i class="fa fa-bars"></i></a>
</nav>';*/

echo'
<nav>
    <ul class="sidebar">
        <li onclick="hideSidebar()"><a href="#"><i class="bx bx-x" ></i></a></li>
        <li><a href="user-auth/login-form.php">Login</a></li>
        <li><a href="user-auth/register-form.php">Register</a></li>
    </ul>
    <ul>
        <li class="hideOnMobile"><a href="index.php" id="title"><i class="bx bxs-book" ></i> | My Study KPI</a></li>
        <li class="hideOnMobile" id="login-button"><a href="user-auth/login-form.php">Login</a></li>
        <li class="hideOnMobile" id="reg-button"><a href="user-auth/register-form.php">Register</a></li>
        <li class="menu-button" onclick="showSidebar()"><a href="#"><i class="bx bx-menu" ></i></a></li>
    </ul>
</nav>
';
?>