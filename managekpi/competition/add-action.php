<?php
session_start();
include('../../config/config.php');

//check if logged-in
if(!isset($_SESSION["UID"])){
    header("location:../../index.php"); 
}

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        $name = $_POST["competition"];
        $sem = $_POST["sem"];
        $year = $_POST["year"];
        $level = $_POST["level"];
        $remark = $_POST["remark"];
        $type = 'competition';
        $userid = $_SESSION['UID'];

        $sql = 'INSERT INTO '.$type.'('.$type.', sem, year, level, remark, type, userID)
                values("'.$name.'", '.$sem.', "'.$year.'", "'.$level.'", "'.$remark.'", "'.$type.'", '.$userid.')';

        if (mysqli_query($conn, $sql)) {
            $pagetitle = 'Success';
            include('../../template/header-kpi-info.php');
            echo'
                <img class="status-icon" src="../../src/img/success.png"/>
                <h1 class="status"><b>Competition Record Added</b></h1>
                <p class="description">Moving into the profile page in 3 seconds.<br>
            ';
            echo"<script>
                    setTimeout(function () {
                    window.location.href = '../../managekpi.php';}, 3000);
                </script>";
        }
        else {
            $pagetitle = 'Failed';
            include('../../template/header-kpi-info.php');
            echo '
                <img class="status-icon" src="../../src/img/db-error.png"/>
                <h1 class="status"><b>Error</b></h1><p class="description"> SQL error ['
                . $sql . ']<br> Code [' . mysqli_error($conn) . ']</p>';
            echo "<script>
                    setTimeout(function () {
                    window.location.href = 'add.php';}, 3000);
                </script>";
        }
    }
    else if(isset($_POST["cancelform"])) {
        echo " <script>
                    setTimeout(function () {
                    window.location.href = '../../managekpi.php';}, 0);
                </script>";
    }
}
?>

</div>
</main>
<footer class="author-footer">
    <p>Copyright @2023 FCI - Hak milik Nurahfezan</p>
</footer>
</div>
</body>
</html>