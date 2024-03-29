<?php
include '../template/header1.php';
include('../config/config.php');
if(!isset($_SESSION["UID"])){
    header("location:../index.php"); 
}
?>

<body>
    <div class="main-container">
        <div class="action-title">
            <h1>Add Challenge and Plan</h1>
            <p class="indicate"><em>Required field with mark</em></p>
        </div>

        <main class="main-content">
            <div class="challenge-container">
                <form action="add-action.php" method="post" class=challenge-form enctype="multipart/form-data">
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
                        <label for="challenge"><p class="indicate"><b>Challenge</b></p></label>
                        <textarea rows="4" name="challenge" required></textarea>
                    </div>
                    <div class="formsection">
                        <label for="plan"><p class="indicate"><b>Plan</b></p></label>
                        <textarea rows="4" name="plan" required></textarea>
                    </div>
                    <div class="formsection">
                        <label for="remark"><p class="indicate"><b>Remark</b></p></label>
                        <textarea rows="4" name="remark" required></textarea>
                    </div>
                    <div class="formsection">
                        <p><b>Upload Image (If you want)</b></p>
                        <input name="fileToUpload" id="fileToUpload" type="file" accept="image/png, image/jpeg"/>
                        <img id="filepreview" src="../src/img/add-file.png">
                        <label for="fileToUpload" class="browse-button" id="browsebutton">Select Image</label>
                    </div>

                    <div class="yesno-update">
                        <button type="submit" name="submit" class="update-button"><i class='bx bxs-check-circle'></i></button>
                        <button name="cancelform" class="cancel-button" onClick="window.location.href='../challenge.php';"><i class='bx bxs-x-circle'></i></button>
                    </div>
                </form>
            </div>
            <script type="text/javascript">
                    var imageInput = document.getElementById("fileToUpload");
                    var previewImage = document.getElementById("filepreview");

                    imageInput.addEventListener("change", function(event){
                        if(event.target.files.length == 0){
                            return;
                        }

                        var tempUrl = URL.createObjectURL(event.target.files[0]);
                        previewImage.setAttribute("src", tempUrl);
                    });
                </script>
        </main>

        <footer class="author-footer">
            <p>Copyright @2023 FCI - Hak milik Nurahfezan</p>
        </footer>
    </div>

</body>