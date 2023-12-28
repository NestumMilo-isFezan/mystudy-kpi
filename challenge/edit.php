<?php
include '../template/header1.php';
include('../config/config.php');

$id = "";
$sem = "";
$year = "";
$challenge =" ";
$plan = "";
$remark = "";
$img = "";

if(isset($_GET["id"]) && $_GET["id"] != ""){
    $sql = "SELECT * FROM challenge WHERE ch_id=". $_GET["id"];

    //echo $sql . "<br>";
    $result = mysqli_query($conn, $sql);
        
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row["ch_id"];
        $sem = $row["sem"];
        $year = $row["year"];
        $challenge = $row["challenge"];
        $plan = $row["plan"];
        $remark = $row["remark"];
        $img = $row["img_path"];
    }        
}

mysqli_close($conn);

?>

<body>
    <div class="main-container">
        <?php
            // Primary Header
            include '../template/titlebar.php';

        ?>
        <div class="action-title">
            <h1>Edit Challenge and Plan</h1>
            <p class="indicate"><em>Required field with mark</em></p>
        </div>

        <main class="main-content">
            <div class="challenge-container">
                <form action="edit-action.php" method="post" class=challenge-form enctype="multipart/form-data">
                    <div class="merge-formsection">
                        <input type="hidden" value="<?= $_GET['id']?>" name="cid">
                        <div class="formsection1">
                            <label for="sem"><p class="indicate"><b>Sem</b></p></label>

                            <select size="1" id="sem" name="sem" required>
                                <option value="" <?php echo ($sem == '') ? 'selected' : ''; ?>>&nbsp;</option>
                                <option <?php echo ($sem == 1) ? 'selected' : ''; ?>>1</option>;                           
                                <option <?php echo ($sem == 2) ? 'selected' : ''; ?>>2</option>;                        
                            </select>
                        </div>
                        <div class="formsection1">
                            <label for="year"><p class="indicate"><b>Year</b></p></label>
                            <input type="text" name="year" id="year" required value="<?= $year?>"/>
                        </div>
                    </div>

                    <div class="formsection">
                        <label for="challenge"><p class="indicate"><b>Challenge</b></p></label>
                        <textarea rows="4" name="challenge" required><?= $challenge?></textarea>
                    </div>
                    <div class="formsection">
                        <label for="plan"><p class="indicate"><b>Plan</b></p></label>
                        <textarea rows="4" name="plan" required><?= $plan?></textarea>
                    </div>
                    <div class="formsection">
                        <label for="remark"><p class="indicate"><b>Remark</b></p></label>
                        <textarea rows="4" name="remark" required><?= $remark?></textarea>
                    </div>
                    <div class="formsection">
                        <p><b>Upload Image (If you want)</b></p>
                        <input name="fileToUpload" id="fileToUpload" type="file" accept="image/png, image/jpeg"/>
                        <?php
                            $uploadpath = '../uploads/profilepic/';
                            $challengeimgpath = $uploadpath . $img;
                            if (file_exists($challengeimgpath)){
                                echo '<img id="filepreview" src="../src/img/add-file.png">';
                            }
                            else{
                                echo '<img id="filepreview" src="../uploads/challenge/'.$img.'" style="width: 600px; height:300px">';
                            }
                        ?>
                        <div class="edit-img">
                            <label for="fileToUpload" class="browse-button" id="browsebutton">Select Image</label>
                            <button name="deleteimg" class="delete-button" ><i class='bx bxs-trash'></i></button>
                        </div>
                    </div>

                    <div class="yesno-update">
                        <button type="submit" name="submitform" class="update-button"><i class='bx bxs-check-circle'></i></button>
                        <button name="cancelform" class="cancel-button"><i class='bx bxs-x-circle'></i></button>
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
                        previewImage.style.width = '600px';
                        previewImage.style.height = '300px';
                    });
                </script>
        </main>

        <footer class="author-footer">
            <p>Copyright @2023 FCI - Hak milik Nurahfezan</p>
        </footer>
    </div>

</body>