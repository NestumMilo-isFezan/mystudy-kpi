<?php
// Masuk server
include("../config/config.php");
?>

<?php
// Generate template
include '../template/header2.php';
/*
STEP 1: Form data handling using mysqli_real_escape_string
function to escape special characters for use in an SQL query
*/

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['submit'])){
        // Data
        $userMatric = mysqli_real_escape_string($conn, $_POST['matricNo']);
        $userEmail = mysqli_real_escape_string($conn, $_POST['userEmail']);
        $userPwd = mysqli_real_escape_string($conn, $_POST['userPwd']);
        $confirmPwd = mysqli_real_escape_string($conn, $_POST['confirmPwd']);
        $intake = $_POST['intake'];
    
        // Validate Password
        if($userPwd !== $confirmPwd){
            die("Both password and confirm password do not match. Please try again.");
        }
    
        //STEP 2: Check if email is existed...
        $sql = "SELECT * FROM user WHERE userEmail='$userEmail' or matricNo='$userMatric' LIMIT 1";
        $result = mysqli_query($conn, $sql);
    
        if(mysqli_num_rows($result) ==1){
            echo '
            <img class="status-icon" src="../src/img/user-error.png"/>
            <h1 class="status"><b>Error</b></h1>
            <p class="description">This E-mail and Matric-No is already existed.<br>Please register a new users</p>
            <p class="description">You will be redirected back to the Register Page in 5 seconds.</p>';
            header("refresh:5;URL=register-form.php");
        }
        else{
            // If no, then just insert the data with hash password data.
            $pwdHash = trim(password_hash($_POST['userPwd'], PASSWORD_DEFAULT));
            $sql = "INSERT INTO user(matricNo, userEmail, userPwd) VALUES ('$userMatric', '$userEmail', '$pwdHash')";
            $insertOK=0;
    
            if(mysqli_query($conn, $sql)){
                echo '
                <img class="status-icon" src="../src/img/success.png"/>
                <h1 class="status"><b>Successful</b></h1>
                <p class="description">New User Record Created Successfully.<br>';
                $insertOK = 1;
            }
            else{
                echo '
                <img class="status-icon" src="../src/img/db-error.png"/>
                <h1 class="status"><b>Error</b></h1><p class="description"> SQL error ['
                . $sql . ']<br> Code [' . mysqli_error($conn) . ']</p>
                header("refresh:5;URL=register-form.php");
                ';
            }
    
            if($insertOK==1){
                $lastInsertedId = mysqli_insert_id($conn);
                $sql = "INSERT INTO userprofile (userID, username, program, mentor, motto, intake_batch, img_path) VALUES ('$lastInsertedId', '', '', '', '', '$intake', '')";
                
                if(mysqli_query($conn, $sql)){
                    $yearpart = explode('/',$intake);
                    $year_part1 = intval($yearpart[0]);
                    $year_part2 = intval($yearpart[1]);

                    for ($i=0; $i<4; $i++){
                        $string_year = $year_part1+$i . '/' . $year_part2+$i;
                        $j = 1 + $i;
                            
                        $sql = "INSERT INTO cgpa (userID, cgpa, remark, sem, year) VALUES('$lastInsertedId', '', '', '1', '$string_year'), ('$lastInsertedId', '', '', '2', '$string_year')";
                        mysqli_query($conn, $sql);
                    }
                    $sql = "INSERT INTO kpiaim(userID, a_fac, a_uni, a_nat, a_inter, c_fac, c_uni, c_nat, c_inter, cert_pro, cert_tec, cgpa)
                            VALUES ('$lastInsertedId', '', '', '', '', '', '', '', '' , '', '', 0.00)";
                    mysqli_query($conn, $sql);
                    
                    echo 'User Profile Record Created Successfully.</p>
                    <p class="description">Welcome to the system, <b>' . $userMatric . '</b></p>
                    <p class="description">You will be redirected to Login Page in 5 seconds.';
                    header("refresh:5;URL=login-form.php");
                }
                else{
                    echo '
                    <img class="status-icon" src="../src/img/db-error.png"/>
                    <h1 class="status"><b>Error</b></h1><p class="description"> SQL error ['
                    . $sql . ']<br> Code [' . mysqli_error($conn) . ']</p>';
                    header("refresh:5;URL=register-form.php");
                    
                }
            }
        }
    }
    else if(empty($_POST['cancel'])){
        header("refresh:0;URL=..index.php");
        exit();
    }
    
}

// Close SQL
mysqli_close($conn);

?>
</div>
</main>
<footer class="author-footer">
    <p>Copyright @2023 FCI - Hak milik Nurahfezan</p>
</footer>
</div>
</body>
</html>
