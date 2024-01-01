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
   <a href="profile.php"';
if ($ActivePage == 'profile.php'){
    echo 'class="active"';
}
echo '>Profile</a>
    <a href="my_kpi.php"';
if ($ActivePage == 'my_kpi.php'){
    echo 'class="active"';
}
echo '>KPI Indicator</a>
    <a href="my_activities.php"';
if ($ActivePage == 'my_activities.php'){
    echo 'class="active"';
}
echo '>List of Activities</a>
    <a href="my_challenge.php"';
if ($ActivePage == 'my_challenge.php'){
    echo 'class="active"';
}
echo '>Challenge and Future Plan</a>
    <a href="user-auth/logout-action.php" class="logout-nav">Logout</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i></a>
    </nav>';
*/

echo'
<nav>
    <ul class="sidebar">
        <li onclick="hideSidebar()"><a href="#"><i class="bx bx-x" ></i></a></li>';
        echo'<li'; if ($pagetitle == 'Profile'){ echo' id="active-page"><a href="profile.php">Profile</a></li>';} else {echo'><a href="profile.php">Profile</a></li>';}
        echo'<li'; if ($pagetitle == 'Manage KPI'){ echo' id="active-page"><a href="managekpi.php">Manage KPI</a></li>';} else {echo'><a href="managekpi.php">Manage KPI</a></li>';}
        echo'<li'; if ($pagetitle == 'List of Activities'){ echo' id="active-page"><a href="activity.php">Activity</a></li>';} else {echo'><a href="activity.php">Activity</a></li>';}
        echo'<li'; if ($pagetitle == 'Challenges and Plans'){ echo' id="active-page"><a href="challenge.php">Challenge</a></li>';} else {echo'><a href="challenge.php">Challenge</a></li>';}
        echo'<li><a href="user-auth/logout-action.php">Logout</a></li>
    </ul>
    <ul>
        <li class="hideOnMobile"><a href="index.php" id="title"><i class="bx bxs-book" ></i> | My Study KPI</a></li>';
        echo'<li class="hideOnMobile"'; if ($pagetitle == 'Profile'){ echo'id="active-page"><a href="profile.php">Profile</a></li>';} else{echo '><a href="profile.php">Profile</a></li>';}
        echo'<li class="hideOnMobile"'; if ($pagetitle == 'Manage KPI'){ echo'id="active-page"><a href="managekpi.php">Manage</a></li>';} else{echo '><a href="managekpi.php">Manage</a></li>';}
        echo'<li class="hideOnMobile"'; if ($pagetitle == 'List of Activities'){ echo'id="active-page"><a href="activity.php">Activity</a></li>';} else{echo '><a href="activity.php">Activity</a></li>';}
        echo'<li class="hideOnMobile"'; if ($pagetitle == 'Challenges and Plans'){ echo'id="active-page"><a href="challenge.php">Challenge</a></li>';} else{echo '><a href="challenge.php">Challenge</a></li>';}
        echo'<li class="hideOnMobile" id="logout-button"><a href="user-auth/logout-action.php"><i class="bx bxs-log-out"></i>&nbsp;Logout</a></li>
        <li class="menu-button" onclick="showSidebar()"><a href="#"><i class="bx bx-menu" ></i></a></li>
    </ul>
</nav>

';

?>