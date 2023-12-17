<?php
$pagetitle = 'Profile';
include('config/config.php');
include 'template/header.php'
?>

<body>
    <div class="main-container">
        <?php
            // Primary Header
            include 'template/titlebar.php';
            
            // Check if the seesion is running,
            if (isset($_SESSION['UID'])){
                include 'template/logged_menu.php';

                // Retrieve data through session UID
                $sql = 'SELECT user.userID, user.matricNo, user.userEmail, userprofile.username, userprofile.program, userprofile.mentor, userprofile.motto
                FROM user INNER JOIN userprofile ON user.userID = userprofile.userID
                WHERE user.userID=' . $_SESSION['UID'] . ';';

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);

                    $matricNo = $row["matricNo"];
                    $userEmail = $row["userEmail"];
                    $username = $row["username"];
                    $program = $row["program"];
                    $mentor = $row["mentor"];
                    $motto = $row["motto"];
                }
            }
            // Else, head to the index.page
            else{
                header('refresh:0 ;URL=index.php');
            }
        ?>

        <?php 
            
        ?>
        <main class="main-content">
            <div class="profile-container">
                <div class="profile-section">
                    <?php
                    if (file_exists('uploads/profilepic/'. $matricNo . '.jpg')) {
                        echo'<img class="pfp-img" src="uploads/profilepic/'.$matricNo.'.jpg"/>';

                    }
                    else if (file_exists('uploads/profilepic/'. $matricNo . '.png')){
                        echo'<img class="pfp-img" src="uploads/profilepic/'.$matricNo.'.png"/>';
                        
                    }
                    else{
                        echo'<img class="pfp-img" style="border:0;" src="src/img/user_icon.png"/>';
                    
                    }
                    ?>
                    <div class="pfp-namewithmotto">
                        <?php 
                            if($username==""){
                                echo "<em><h1>No user name is set</h1></em>";
                            }
                            else echo "<h1>$username</h1>";
                        ?>
                        <?php 
                            if($motto==""){
                                echo "<em><p>No motto yet</p></em>";
                            }
                            else echo "<p>$motto</p>";
                        ?>
                    </div>
                </div>
               

                <div class="pfp-biodata">
                    <table width="100%" class="profile-table">
                        <tr>
                            <th colspan="2" align="center" class="profile-header">Biodata &nbsp; <a href="profile/edit-form.php"><i class='bx bxs-edit' ></i></a></td>
                        </tr>
                        <tr>
                            <th id="biodata">Matric No.</th>
                            <td id="matricno" class="profile-data" style="text-transform: uppercase;"><?= $matricNo?></td>
                        </tr>
                        <tr>
                            <th id="biodata">Email</th>
                            <td id="useremail" class="profile-data"><?= $userEmail?></td>
                        </tr>
                        <tr>
                            <th id="biodata">Program</th>
                            <td id="usercourse" class="profile-data"><?= $program?></td>
                        </tr>
                        <tr>
                            <th id="biodata">Mentor Name</th>
                            <td id="usermentor" class="profile-data"><?= $mentor?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </main>

        <footer class="author-footer">
            <p>Copyright @2023 FCI - Hak milik Nurahfezan</p>
        </footer>
    </div>

</body>

</html>