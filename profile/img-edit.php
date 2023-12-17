<?php
$target_dir = "../uploads/profilepic/";
$target_file = "";
$uploadOK = 0;
$imageFiletype = "";
$uploadfileName = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submitimg"])) {
        
    include'../template/header2.php';
        if(isset($_FILES['selectimg']) && $_FILES['selectimg']['error'] == UPLOAD_ERR_OK) {    
            $filetmp = $_FILES["selectimg"];
            $uploadname = $_SESSION['matricNo'];
            $uploadOK = 1;
            ini_set('upload_max_filesize', '4M');
            ini_set('post_max_size', '4M');
        
            //Get file extension
            $imageFiletype = strtolower(pathinfo($filetmp["name"], PATHINFO_EXTENSION));
        
            //Allow certain file formats
            if($imageFiletype != "jpg" && $imageFiletype != "png" && $imageFiletype != "jpeg") {
                echo '
                <img class="status-icon" src="../src/img/user-error.png"/>
                <h1 class="status"><b>Error</b></h1>
                <p class="description">Sorry, only JPG, JPEG, and PNG files are allowed..<br>Please uses valid image format.</p>
                <p class="description">You will be redirected back to the Profile Edit Page in 3 seconds.</p>';
                echo "  <script>
                            setTimeout(function () {
                                window.location.href = 'edit-form.php';}, 3000);
                        </script>";
                $uploadOK = 0;
            }
        
            //Rename file
            $target_file = $target_dir . $uploadname . '.' . $imageFiletype;
        
            //Delete old file with the same name
            if (file_exists($target_file)) {
                deleteFile($target_file);
            }
        }

        if ($uploadOK == 1) {
            if (move_uploaded_file($filetmp["tmp_name"], $target_file)) {
                echo'
                <img class="status-icon" src="../src/img/success.png"/>
                <h1 class="status"><b>Profile Picture Updated</b></h1>
                <p class="description">The file '. htmlspecialchars(basename($filetmp["name"])) . ' has been uploaded.<br>Moving into the profile page in 3 seconds.
                ';
                echo "  <script>
                            setTimeout(function () {
                            window.location.replace('../profile.php');}, 3000);
                        </script>";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } 
    else if(isset($_POST["cancelit"])) {
        echo " <script>
                    setTimeout(function () {
                    window.location.href = 'edit-form.php';}, 0);
                </script>";
    }
}



function deleteFile($filename) {
    $info = pathinfo($filename);
    $dirname = $info['dirname'];
    $basename = $info['filename'];

    $files = glob($dirname . DIRECTORY_SEPARATOR . $basename . '.*');

    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
}
?>