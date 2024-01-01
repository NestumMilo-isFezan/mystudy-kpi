<?php
$pagetitle = 'Add Certificate';
include '../../template/header-kpi.php';
include('../../config/config.php');
if(!isset($_SESSION["UID"])){
    header("location:../index.php"); 
}
?>
<body>
    <div class="main-container">
        <div class="action-title">
            <h1>Add Certificate</h1>
            <p class="indicate"><em>Required field with mark</em></p>
        </div>

        <main class="main-content">
            <div class="form-container">
                <form action="add-action.php" method="post" class=kpi-form enctype="multipart/form-data">
                    <div class="merge-formsection">
                        <div class="formsection1">
                            <label for="sem"><p class="indicate"><b>Sem</b></p></label>

                            <select size="1" id="sem" name="sem" required>
                                <option value="">&nbsp;</option>
                                <option value="1">1</option>;                           
                                <option value="2">2</option>;                        
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
                                        
                                        echo'<option value="'.$string_year.'">'.$string_year.'</option>;  ';
                                    }
                                ?>                      
                            </select>
                        </div>
                    </div>

                    <div class="formsection">
                        <label for="level"><p class="indicate"><b>Level</b></p></label>
                        <select size="1" id="level" name="level" style="width:100%;" required>
                            <option value="">&nbsp;</option>
                            <option value="Professional">Professional</option>;
                            <option value="Technical">Technical</option>;
                        </select>
                    </div>

                    <div class="formsection">
                        <label for="certificate"><p class="indicate"><b>Certificate Name</b></p></label>
                        <input type="text" name="certificate" required></textarea>
                    </div>

                    <div class="formsection">
                        <label for="remark"><b>Remark</b></p></label>
                        <textarea rows="4" name="remark"></textarea>
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