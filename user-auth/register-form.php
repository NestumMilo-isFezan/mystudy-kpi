<?php
include '../template/header1.php'
?>

<body>
    <div class="main-container">
        <div class="action-title">
            <h1>Register Form</h1>
        </div>

        <main class="main-content">
            <div class="register-container">
                <img src="../src/img/user_icon.png" alt="User" class="user-icon">
                
                <form action="register-action.php" method="post" class=login-form onsubmit="return validateYearInput(document.getElementById('yearInput').value)">
                    <div class="form-group">
                        <label for="intake"><b>Intake batch</b></label>
                        <input type="text" placeholder="Enter your intake batch (eg : 2021/2022)" name="intake" id="intakebatch"required>
                    </div>

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
                        <button type="submit" name="submit" class="submitbutton">Register</button>
                        <input type="button" name="cancel" class="cancelbutton" value="Cancel" onClick="window.location.href='../index.php';">
                    </div>

                </form>
            </div>
        </main>
        <script>
            function validateYearInput(inputString) {
                // Split the input string by '/'
                var years = inputString.split('/');
                
                // Check if there are exactly two items in the list
                if (years.length != 2) {
                    alert("Input should be in the format 'YYYY/YYYY'");
                    return;
                }
                
                // Check if both items are digits and have 4 characters
                for (var i = 0; i < years.length; i++) {
                    if (isNaN(years[i]) || years[i].length != 4) {
                        alert("Both years should be 4 digits");
                        return;
                    }
                }
                
                // Convert the items to integers
                var year1 = parseInt(years[0], 10);
                var year2 = parseInt(years[1], 10);
                
                // Check if the years are consecutive
                if (year2 - year1 != 1) {
                    alert("The years should be consecutive");
                    return;
                }
                
                // Check if the years are above 1999/2000
                if (year1 < 2000 || year2 < 2001) {
                    alert("Both years should be above 1999/2000");
                    return;
                }
                
                // If all checks pass, show a success message
                alert("Input is valid");
            }

            
        </script>

        <footer class="author-footer">
            <p>Copyright @2023 FCI - Hak milik Nurahfezan</p>
        </footer>
    </div>

</body>