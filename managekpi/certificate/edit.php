<?php
$pagetitle = 'Edit Activity';
include '../../template/header-kpi.php';
include('../../config/config.php');
if(!isset($_SESSION["UID"])){
    header("location:../index.php"); 
}
if(isset($_GET["id"]) && $_GET["id"] != ""){
    //Change this.... 
    $type = 'certificate';

    $edit_id = $_GET['id'];
    $sql = "SELECT * FROM certification WHERE cert_id=$edit_id AND userID=" .$_SESSION['UID'];

    $result = mysqli_query($conn, $sql);
        
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row["cert_id"];
        $sem = $row["sem"];
        $year = $row["year"];
        $level = $row['level'];
        $remark = $row["remark"];

        // Change this too....
        $name = $row["certification"];
    }        
}
?>
<body>
    <div class="main-container">
        <div class="action-title">
            <h1>Edit Certificate</h1>
            <p class="indicate"><em>Required field with mark</em></p>
        </div>

        <main class="main-content">
            <div class="form-container">
                <form action="edit-action.php" method="post" class=kpi-form enctype="multipart/form-data">
                    <div class="merge-formsection">
                        <input type="hidden" value="<?= $id?>" name="id">
                        <div class="formsection1">
                            <label for="sem"><p class="indicate"><b>Sem</b></p></label>

                            <select size="1" id="sem" name="sem">
                                <option value="" <?php echo ($sem == '') ? 'selected' : ''; ?>>&nbsp;</option>
                                <option <?php echo ($sem == 1) ? 'selected' : ''; ?>>1</option>;                           
                                <option <?php echo ($sem == 2) ? 'selected' : ''; ?>>2</option>;                        
                            </select>
                        </div>
                        <div class="formsection1">
                            <label for="year"><p class="indicate"><b>Year</b></p></label>
                            <!--input type="text" name="year" id="year" required/-->
                            <select id="year" name="year" required>
                                <option value="">&nbsp;</option>
                                <?php
                                    $yearpart = explode('/',$_SESSION['intake']);
                                    $year_part1 = intval($yearpart[0]);
                                    $year_part2 = intval($yearpart[1]);

                                    for ($i=0; $i<4; $i++){
                                        $string_year = $year_part1+$i . '/' . $year_part2+$i; 
                                ?>
                                    <option <?php echo($year == $string_year) ? 'selected' : '';?>> <?= $string_year?></option>
                                <?php    
                                    }
                                ?>                     
                            </select>
                        </div>
                    </div>

                    <div class="formsection">
                        <label for="level"><p class="indicate"><b>Level</b></p></label>
                        <select size="1" id="level" name="level" style="width:100%;" required>
                            <option value="">&nbsp;</option>
                            <option <?php echo($level == 'Professional') ? 'selected' : '';?>>Professional</option>;
                            <option <?php echo($level == 'Technical') ? 'selected' : '';?>>Technical</option>;
                        </select>
                    </div>

                    <div class="formsection">
                        <label for="certificate"><p class="indicate"><b>Certificate Name</b></p></label>
                        <input type="text" name="certificate" required value='<?= $name?>'></textarea>
                    </div>

                    <div class="formsection">
                        <label for="remark"><p><b>Remark</b></p></label>
                        <textarea rows="4" name="remark"><?= $remark?></textarea>
                    </div>

                    <div class="yesno-update">
                        <button type="submit" name="submit" class="update-button"><i class='bx bxs-check-circle'></i></button>
                        <button name="cancelform" class="cancel-button" onClick="window.location.href='../../managekpi.php';"><i class='bx bxs-x-circle'></i></button>
                    </div>
                </form>
            </div>
        </main>
        <footer class="author-footer">
            <p>Copyright @2023 FCI - Hak milik Nurahfezan</p>
        </footer>
    </div>

</body>