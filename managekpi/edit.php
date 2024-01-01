<?php
session_start();
$pagetitle = 'Edit MyKPI Aim';
include '../template/header4.php';
include('../config/config.php');
if(!isset($_SESSION["UID"])){
    header("location:../index.php"); 
}
if(isset($_GET["id"]) && $_GET["id"] != ""){
    //Change this.... 
    $type = 'kpiaim';

    $edit_id = $_GET['id'];
    $sql = "SELECT * FROM $type WHERE aim_id=$edit_id AND userID=" .$_SESSION['UID'];

    $result = mysqli_query($conn, $sql);
        
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row["aim_id"];
        $aim_cgpa = $row['cgpa'];
        $a_fac = $row['a_fac'];
        $a_uni = $row['a_uni'];
        $a_nat = $row['a_nat'];
        $a_inter = $row['a_inter'];
        $c_fac = $row['c_fac'];
        $c_uni = $row['c_uni'];
        $c_nat = $row['c_nat'];
        $c_inter = $row['c_inter'];
        $certpro = $row['cert_pro'];
        $certtec = $row['cert_tec'];
    }        
}
?>
<body>
    <div class="main-container">
        <div class="action-title">
            <h1>Edit MyKPI Aim</h1>
            <p class="indicate"><em>Required field with mark</em></p>
        </div>

        <main class="main-content">
            <div class="form-container" >
                <form action="edit-action.php" method="post" class='kpi-form' enctype="multipart/form-data">
                
                    <div class="formsection-1">
                        <label for="cgpaaim"><h2><b>CGPA Aim</b></h2></label>
                        <input type="text" name="cgpaaim" required value='<?= $aim_cgpa?>'>
                    </div>

                    <div class="formsection-1">
                        <label><h2><b>Activity's Aim</b></h2></label>
                    </div>
                    <div class="merge-formsection-1">
                        <input type="hidden" value="<?= $id?>" name="id">
                        <div class="formsection2">
                            <label for="afac"><p><b>Faculty</b></p></label>
                            <input type="number" name="afac" required value='<?= $a_fac?>'>
                        </div>
                        <div class="formsection2">
                            <label for="auni"><p><b>University</b></p></label>
                            <input type="number" name="auni" required value='<?= $a_uni?>'>
                        </div>
                        <div class="formsection2">
                            <label for="anat"><p><b>National</b></p></label>
                            <input type="number" name="anat" required value='<?= $a_nat?>'>
                        </div>
                        <div class="formsection2">
                            <label for="ainter"><p><b>International</b></p></label>
                            <input type="number" name="ainter" required value='<?= $a_inter?>'>
                        </div>
                    </div>

                    <div class="formsection-1">
                        <label><h2><b>Competition's Aim</b></h2></label>
                    </div>
                    <div class="merge-formsection-1">
                        <div class="formsection2">
                            <label for="cfac"><p><b>Faculty</b></p></label>
                            <input type="number" name="cfac" required value='<?= $c_fac?>'>
                        </div>
                        <div class="formsection2">
                            <label for="cuni"><p><b>University</b></p></label>
                            <input type="number" name="cuni" required value='<?= $c_uni?>'>
                        </div>
                        <div class="formsection2">
                            <label for="cnat"><p><b>National</b></p></label>
                            <input type="number" name="cnat" required value='<?= $c_nat?>'>
                        </div>
                        <div class="formsection2">
                            <label for="cinter"><p><b>International</b></p></label>
                            <input type="number" name="cinter" required value='<?= $c_inter?>'>
                        </div>
                    </div>

                    <div class="formsection-1">
                        <label><h2><b>Certificate's Aim</b></h2></label>
                    </div>
                    <div class="merge-formsection-2">
                        <div class="formsection2">
                            <label for="certpro"><p><b>Professional</b></p></label>
                            <input type="number" name="certpro" required value='<?= $certpro?>'>
                        </div>
                        <div class="formsection2">
                            <label for="certtec"><p><b>Technical</b></p></label>
                            <input type="number" name="certtec" required value='<?= $certtec?>'>
                        </div>
                    </div>

                    <div class="yesno-update-1">
                        <button type="submit" name="submit" class="update-button"><i class='bx bxs-check-circle'></i></button>
                        <button name="cancelform" class="cancel-button" onClick="window.location.href='../index.php';"><i class='bx bxs-x-circle'></i></button>
                    </div>
                </form>
            </div>
        </main>
        <footer class="author-footer">
            <p>Copyright @2023 FCI - Hak milik Nurahfezan</p>
        </footer>
    </div>

</body>