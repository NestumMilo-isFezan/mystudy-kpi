<?php
include '../template/header1.php';

include('../config/config.php');
?>

<body>
    <div class="main-container">
        <?php
            // Primary Header
            include '../template/titlebar1.php';
            
            // Check if the seesion is running,
            if (isset($_SESSION['UID'])){
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
                header('refresh:0 ;URL=../index.php');
            }
        ?>
        <div class="action-title">
            <h1>Profile Edit Form</h1>
        </div>

        <main class="main-content">
            <div class="profile-edit-container">
                
                <!--Section PIC-->
                <div class="pic-container">
                    <button id="editimg" class="edit-img">Edit Image</button>
                    <form method="post" action="img-edit.php" enctype="multipart/form-data" class="pic-section">
                        <input name="selectimg" id="selectimg" type="file" accept="image/png, image/jpeg"/>
                            <?php 
                                $uploadpath = '../uploads/profilepic/';
                                $userpfpath = $uploadpath . $matricNo . '.png';
                                $userpfpath1 = $uploadpath . $matricNo . '.jpg';
                                if (file_exists($userpfpath)) {
                                    echo '<img id="imgpreview" src="'. $userpfpath .'">';
                                }
                                else if (file_exists($userpfpath1)) {
                                    echo '<img id="imgpreview" src="'. $userpfpath1 .'">';
                                }
                                else {
                                    echo '<img id="imgpreview" src="../src/img/user_icon.png">';
                                }
                            ?>    
                
                        <div class="updateimg-form">
                            <label for="selectimg" class="browse-button" id="browsebutton">Select Image</label>
                            <div class="confirmation" id="confirmation">
                                <button type="submit" name="submitimg" class="update-button"><i class='bx bxs-check-circle'></i></button>
                                <button name="cancelit" class="cancel-button" id="cancelprompt"><i class='bx bxs-x-circle'></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <script type="text/javascript">
                    var imageInput = document.getElementById("selectimg");
                    var previewImage =document.getElementById("imgpreview");

                    imageInput.addEventListener("change", function(event){
                        if(event.target.files.length == 0){
                            return;
                        }

                        var tempUrl = URL.createObjectURL(event.target.files[0]);
                        previewImage.setAttribute("src", tempUrl);
                    });

                    document.getElementById("editimg").addEventListener('click', function(){
                        this.style.display = 'none';
                        document.getElementById("browsebutton").style.display = 'inline';
                        document.getElementById("confirmation").style.display = 'grid';
                    });

                    document.getElementById("cancelprompt").addEventListener('click', function(){
                        document.getElementById("editimg").style.display = 'flex';
                        document.getElementById("browsebutton").style.display = 'none';
                        document.getElementById("confirmation").style.display = 'none';
                    });
                </script>

                <!--Section Biodata Form-->
                <div class="form-section">
                    <form action="edit-action.php" method="post" class=profile-form>
                        <div class="merge-formsection">
                            <div class="formsection1">
                                <label for="matricno"><b>Matric No</b></label>
                                <input type="text" value=<?= $matricNo ?> name="matricNo" id="matricNo" style="text-transform: uppercase;" readonly/>
                            </div>
                            <div class="formsection1">
                                <label for="program"><b>Course Programme</b></label>

                                <select size="1" name="program">
                                    <option value="" <?php echo ($program == '') ? 'selected' : ''; ?> disabled >Select Program</option>   
                                    <option <?php echo ($program == 'Software Engineering') ? 'selected' : ''; ?>>Software Engineering</option>
                                    <option <?php echo ($program == 'Network Engineering') ? 'selected' : ''; ?>>Network Engineering</option>
                                    <option <?php echo ($program == 'Data Science') ? 'selected' : ''; ?>>Data Science</option>
                                </select>
                            </div>

                        </div>
                        <div class="formsection">
                            <label for="username"><b>Name</b></label>
                            <input type="text" name="username" value="<?=$username?>">
                        </div>
                        
                        <div class="formsection">
                            <label for="userEmail"><b>E-mail</b></label>
                            <input type="email" name="userEmail" value="<?=$userEmail?>" readonly>
                        </div>

                        <div class="formsection">
                            <label for="mentor"><b>Mentor Name</b></label>
                            <input type="text" name="mentor" value="<?=$mentor?>">
                        </div>

                        <div class="formsection">
                            <label for="motto"><b>Your Study Motto</b></label>
                            <textarea rows="2" name="motto"><?=$motto?></textarea>
                        </div>
                        <div class="yesno-update">
                            <button type="submit" name="submitimg" class="update-button"><i class='bx bxs-check-circle'></i></button>
                            <button name="cancelform" class="cancel-button" onclick=""><i class='bx bxs-x-circle'></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <footer class="author-footer">
            <p>Copyright @2023 FCI - Hak milik Nurahfezan</p>
        </footer>
    </div>
</body>
</html>