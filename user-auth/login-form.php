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
            <h1>Login Form</h1>
        </div>

        <main class="main-content">
            <div class="login-container">
                <img src="../src/img/user_icon.png" alt="User" class="user-icon">
                
                <form action="login-action.php" method="post" class=login-form>
                    <div class="form-group">
                        <label for="matricno"><b>Matric No</b></label>
                        <input type="text" placeholder="Enter matric no" name="matricNo" id="matricNo" required/>
                    </div>

                    <div class="form-group">
                        <label for="pass"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="userPwd" id="userPwd" required>
                    </div>

                    <div class="rememberme">
                        <input type="checkbox" checked="checked" name="remember">
                        <label>Remember me </label>
                    </div>
                    
                    <div class="submit-group">
                        <button type="submit" class="submitbutton">Login</button>
                    </div>

                    <div class="register-forgot">
                        <p><a onClick="showRegister()" style="cursor: pointer;">Register</a>
                         | <a style="cursor: pointer;">Forgot password?</a></p>
                    </div>
                </form>
            </div>
        </main>

        <footer class="author-footer">
            <p>Copyright @2023 FCI - Hak milik Nurahfezan</p>
        </footer>
    </div>

</body>