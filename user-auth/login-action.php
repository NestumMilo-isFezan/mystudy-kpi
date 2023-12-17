<?php
// Masuk server
include("../config/config.php");
?>

<?php
// Generate template
include '../template/header2.php';

// Login values from Login Page
$userMatric = $_POST['matricNo'];
$userPwd = $_POST['userPwd'];

$sql = "SELECT * FROM user WHERE matricNo='$userMatric' LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1){
    // Check Password Hash
    $row = mysqli_fetch_array($result);
    if (password_verify($_POST['userPwd'], $row["userPwd"])){
        // Bind UserID from user table into session
        $_SESSION['UID'] = $row['userID'];
        $_SESSION['matricNo'] = $row['matricNo'];
        $_SESSION['loggedin_time'] = time();
        echo'
        <img class="status-icon" src="../src/img/success.png"/>
        <h1 class="status"><b>Login Success</b></h1>
        <p class="description">Moving into the system in 3 seconds.<br>';
        header("refresh:3;URL=../index.php");
    }
    else{
        echo '
        <img class="status-icon" src="../src/img/user-error.png"/>
        <h1 class="status"><b>Error</b></h1>
        <p class="description">This Matric-No' . $row['matricNo'] . 'is not existed.<br>Please register a new users or enter a correct Matric-No</p>
        <p class="description">You will be redirected back to the Login Page in 5 seconds.</p>';
        header("refresh:5;URL=login-form.php");
    }
}

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