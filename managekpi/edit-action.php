<?php
session_start();
include('../config/config.php');

//check if logged-in
if(!isset($_SESSION["UID"])){
    header("location:../index.php"); 
}

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        $id = $_POST["id"];
        $aim_cgpa = $_POST['cgpaaim'];
        $a_fac = $_POST['afac'];
        $a_uni = $_POST['auni'];
        $a_nat = $_POST['anat'];
        $a_inter = $_POST['ainter'];
        $c_fac = $_POST['cfac'];
        $c_uni = $_POST['cuni'];
        $c_nat = $_POST['cnat'];
        $c_inter = $_POST['cinter'];
        $certpro = $_POST['certpro'];
        $certtec = $_POST['certtec'];

        $sql = "UPDATE kpiaim SET aim_id=$id, a_fac=$a_fac, a_uni=$a_uni, a_nat=$a_nat, a_inter=$a_inter, c_fac=$c_fac, c_uni=$c_uni, c_nat=$c_nat, c_inter=$c_inter, cert_pro=$certpro, cert_tec=$certtec, cgpa=$aim_cgpa WHERE aim_id=$id AND userID=" .$_SESSION['UID'];

        if (mysqli_query($conn, $sql)) {
            $pagetitle = 'Success';
            include('../template/header3.php');
            echo'
                <img class="status-icon" src="../src/img/success.png"/>
                <h1 class="status"><b>Your KPI Aim Info Updated</b></h1>
                <p class="description">Moving into the Manage KPI page in 3 seconds.<br>
            ';
            echo"<script>
                    setTimeout(function () {
                    window.location.href = '../managekpi.php';}, 3000);
                </script>";
        }
        else {
            $pagetitle = 'Failed';
            include('../template/header3.php');
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
                    window.location.href = '../managekpi.php';}, 0);
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