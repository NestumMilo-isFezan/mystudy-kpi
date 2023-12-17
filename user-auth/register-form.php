<?php
include '../template/header1.php'
?>

<body>
    <div class="main-container">
        <?php
            // Primary Header
            include '../template/titlebar.php';

        ?>
        <div class="action-title">
            <h1>Register Form</h1>
        </div>

        <main class="main-content">
            <div class="register-container">
                <img src="../src/img/user_icon.png" alt="User" class="user-icon">
                
                <form action="register-action.php" method="post" class=login-form>
                    <div class="form-group">
                        <label for="matricno"><b>Matric No</b></label>
                        <input type="text" placeholder="Enter matric no" name="matricNo" id="matricNo" required/>
                    </div>

                    <div class="form-group">
                        <label for="email"><b>Email</b></label>
                        <input type="email" placeholder="Enter email" name="userEmail" id="userEmail" required/>
                    </div>

                    <div class="form-group">
                        <label for="pass"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="userPwd" id="userPwd" required maxlength="8">
                    </div>

                    <div class="form-group">
                        <label for="pass"><b>Confirm Password</b></label>
                        <input type="password" placeholder="Re-enter Password" name="confirmPwd" id="confirmPwd" required>
                    </div>
                    
                    <div class="submit-group">
                        <button type="submit" class="submitbutton">Register</button>
                        <button type="reset" class="cancelbutton">Cancel</button>
                    </div>

                </form>
            </div>
        </main>

        <footer class="author-footer">
            <p>Copyright @2023 FCI - Hak milik Nurahfezan</p>
        </footer>
    </div>

</body>