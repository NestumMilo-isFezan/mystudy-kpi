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
        $id = $_POST['id'];
        $name = $_POST["cgpa"];
        $sem = $_POST["sem"];
        $year = $_POST["year"];
        $remark = $_POST["remark"];
        $type = 'cgpa';
        $userid = $_SESSION['UID'];

        $sql = "UPDATE $type SET sem='$sem', year='$year', cgpa='$name', remark='$remark' WHERE cgpa_id=$id";

        if (mysqli_query($conn, $sql)) {
            $pagetitle = 'Success';
            include('../../template/header-kpi-info.php');
            echo'
                <img class="status-icon" src="../../src/img/success.png"/>
                <h1 class="status"><b>CGPA Info Updated</b></h1>
                <p class="description">Moving into the Manage KPI page in 3 seconds.<br>
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
                    window.location.href = 'edit.php';}, 3000);
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