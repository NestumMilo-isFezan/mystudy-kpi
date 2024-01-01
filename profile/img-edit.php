<?php
include('../config/config.php');

// Generate template
include '../template/header2.php';
        //for upload
        $target_dir = "../uploads/profilepic/";
        $target_file = "";
        $uploadOk = 0;
        $imageFileType = "";
        $uploadfileName = "";

        //check if logged-in
        if(!isset($_SESSION["UID"])){
            header("location:index.php"); 
        }

        //this block is called when button Submit is clicked
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // If there is no image
            if(isset($_FILES["selectimg"]) &&  $_FILES["selectimg"]["name"] == ""){
                echo '
                <img class="status-icon" src="../src/img/user-error.png"/>
                <h1 class="status"><b>Error</b></h1>
                <p class="description">Sorry, Please enter image first.</p>
                <p class="description">You will be redirected back to the Profile Edit Page in 3 seconds.</p>';
                echo "  <script>
                            setTimeout(function () {
                                window.location.href = 'edit-form.php';}, 3000);
                        </script>";
            }   
        
            //IF there is image
            else if (isset($_FILES["selectimg"]) && $_FILES["selectimg"]["error"] == UPLOAD_ERR_OK) {
                // Delete previous image before updating
                deletePreviousImage($conn);

                //Variable to determine for image upload is OK
                $uploadOk = 1;        
                $filetmp = $_FILES["selectimg"];

                //file of the image/photo file
                $uploadfileName = $filetmp["name"];
                        
                $target_file = $target_dir . basename($_FILES["selectimg"]["name"]);        
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                // Check if file already exists
                if (file_exists($target_file)) {
                    echo '
                    <img class="status-icon" src="../src/img/user-error.png"/>
                    <h1 class="status"><b>Error</b></h1>
                    <p class="description">Sorry, this file is existed..<br>Please uses another image.</p>
                    <p class="description">You will be redirected back to the Profile Edit Page in 3 seconds.</p>';
                    echo "  <script>
                                setTimeout(function () {
                                    window.location.href = 'edit-form.php';}, 3000);
                            </script>";
                    $uploadOK = 0;
                }

                // Check file size <= 488.28KB or 500000 bytes
                if ($_FILES["selectimg"]["size"] > 500000) {  
                    echo '
                    <img class="status-icon" src="../src/img/user-error.png"/>
                    <h1 class="status"><b>Error</b></h1>
                    <p class="description">Sorry, this files are too big..<br>Please uses valid image size.</p>
                    <p class="description">You will be redirected back to the Profile Edit Page in 3 seconds.</p>';
                    echo "  <script>
                                setTimeout(function () {
                                    window.location.href = 'edit-form.php';}, 3000);
                            </script>";
                    $uploadOK = 0;
                }
                
                // Allow only these file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
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

                //If uploadOk, then try add to database first 
                //uploadOK=1 if there is image to be uploaded, filename not exists, file size is ok and format ok     
                if($uploadOk){
                    $sql = "UPDATE userprofile SET img_path='$uploadfileName' where userID=" .$_SESSION['UID'];
                    
                    $status = insertTo_DBTable($conn, $sql);

                    if ($status) {
                        if (move_uploaded_file($_FILES["selectimg"]["tmp_name"], $target_file)) {
                            //Image file successfully uploaded 
                            //Tell successfull record
                            echo'
                                <img class="status-icon" src="../src/img/success.png"/>
                                <h1 class="status"><b>Profile Picture Updated</b></h1>
                                <p class="description">The file '. $uploadfileName . ' has been uploaded.<br>Moving into the profile page in 3 seconds.
                                ';
                        echo "  <script>
                            setTimeout(function () {
                            window.location.replace('../profile.php');}, 3000);
                            </script>";
                        } 
                        else{
                            //There is an error while uploading image 
                            echo '
                            <img class="status-icon" src="../src/img/user-error.png"/>
                            <h1 class="status"><b>Error</b></h1>
                            <p class="description">Sorry, something went wrong.</p>
                            <p class="description">You will be redirected back to the Profile Edit Page in 3 seconds.</p>';
                            echo "  <script>
                                        setTimeout(function () {
                                            window.location.href = 'edit-form.php';}, 3000);
                                    </script>";            
                        }
                    } 
                    else { 
                        echo '
                        <img class="status-icon" src="../src/img/user-error.png"/>
                        <h1 class="status"><b>Error</b></h1>
                        <p class="description">Sorry, something went wrong.</p>
                        <p class="description">You will be redirected back to the Profile Edit Page in 3 seconds.</p>';
                        echo "  <script>
                                    setTimeout(function () {
                                        window.location.href = 'edit-form.php';}, 3000);
                                </script>";            
                    }
                }
                else{                  
                    echo '
                    <img class="status-icon" src="../src/img/user-error.png"/>
                    <h1 class="status"><b>Error</b></h1>
                    <p class="description">Sorry, something went wrong.</p>
                    <p class="description">You will be redirected back to the Profile Edit Page in 3 seconds.</p>';
                    echo "  <script>
                                setTimeout(function () {
                                    window.location.href = 'edit-form.php';}, 3000);
                            </script>";            
                }
            }    
}

//close db connection
mysqli_close($conn);

//Function to insert data to database table
function insertTo_DBTable($conn, $sql){
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
        return false;
    }
}


function deletePreviousImage($conn) {
    $sql = "SELECT img_path FROM userprofile WHERE userID = ". $_SESSION["UID"];
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $previousImagePath = $row['img_path'];
        
        // Check if the previous image path exists and delete it
        if ($previousImagePath && file_exists("../uploads/profilepic/$previousImagePath")) {
            unlink("../uploads/profilepic/$previousImagePath");
        }
    }
}

?>