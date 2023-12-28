<?PHP
include('../config/config.php');

// Generate template
include '../template/header2.php';

//variables
$action="";
$id="";
$sem = "";
$year = "";
$challenge =" ";
$remark = "";

//for upload
$target_dir = "../uploads/challenge/";
$target_file = "";
$uploadOk = 0;
$imageFileType = "";
$uploadfileName = "";

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //values for add or edit
    $sem = $_POST["sem"];
    $year = $_POST["year"];
    $challenge = trim($_POST["challenge"]);
    $plan = trim($_POST["plan"]);
    $remark = trim($_POST["remark"]);
    
    //uploaded file
    $filetmp = $_FILES["fileToUpload"];

    //file of the image/photo file
    $uploadfileName = $filetmp["name"];

    // Check if there is an image to be uploaded
    // If there is no image
    if(isset($_FILES["fileToUpload"]) &&  $_FILES["fileToUpload"]["name"] == ""){
        $sql = "INSERT INTO challenge (userID, sem, year, challenge, plan, remark, img_path)
            VALUES (" . $_SESSION["UID"] . ", " . $sem . ", '". $year . "', '" . $challenge . "','" . $plan . "', '" . $remark . "', '" . $uploadfileName . "')";
       
        $status = insertTo_DBTable($conn, $sql);

        if ($status) {
            echo '
            <img class="status-icon" src="../src/img/success.png"/>
            <h1 class="status"><b>Successful</b></h1>
            <p class="description">New Challenge Record Added Successfully.<br>';
            header("refresh:5;URL=../challenge.php");

        } else {  
            echo '
            <img class="status-icon" src="../src/img/user-error.png"/>
            <h1 class="status"><b>Error</b></h1>
            <p class="description">Something went wrong.</p>
            <p class="description">You will be redirected back to Add Form Page in 5 seconds.</p>';
            header("refresh:5;URL=add-form.php");
        }   
    }
    //IF there is image
    else if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {
        //Variable to determine for image upload is OK
        $uploadOk = 1;        
        $filetmp = $_FILES["fileToUpload"];

        //file of the image/photo file
        $uploadfileName = $filetmp["name"];
                 
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);        
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            echo '
            <img class="status-icon" src="../src/img/user-error.png"/>
            <h1 class="status"><b>Error</b></h1>
            <p class="description">This image file "' .$uploadfileName. '" is already existed.<br>Please Try Again</p>';

            // echo "ERROR: Sorry, image file $uploadfileName already exists.<br>";
            $uploadOk = 0;
        }

        // Check file size <= 488.28KB or 500000 bytes
        if ($_FILES["fileToUpload"]["size"] > 500000) {  
            echo '
            <img class="status-icon" src="../src/img/user-error.png"/>
            <h1 class="status"><b>Error</b></h1>
            <p class="description">This image file size is already too big.<br>Please Try Again</p>';

            $uploadOk = 0;
        }
        
        // Allow only these file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo '
            <img class="status-icon" src="../src/img/user-error.png"/>
            <h1 class="status"><b>Error</b></h1>
            <p class="description">This image file is not in the right format.<br>Please Try Again</p>';
            
            $uploadOk = 0;
        } 

        //If uploadOk, then try add to database first 
        //uploadOK=1 if there is image to be uploaded, filename not exists, file size is ok and format ok     
        if($uploadOk){
            $sql = "INSERT INTO challenge (userID, sem, year, challenge, plan, remark, img_path)
            VALUES (" . $_SESSION["UID"] . ", " . $sem . ", '". $year . "', '" . $challenge . "','" . $plan . "', '" . $remark . "', '" . $uploadfileName . "')";
            
            $status = insertTo_DBTable($conn, $sql);

            if ($status) {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    //Image file successfully uploaded 
                    //Tell successfull record
                    echo '
                    <img class="status-icon" src="../src/img/success.png"/>
                    <h1 class="status"><b>Successful</b></h1>
                    <p class="description">New Challenge Record Added Successfully.<br>';
                    header("refresh:5;URL=../challenge.php");
                } 
                else{
                    //There is an error while uploading image 
                    echo '
                    <img class="status-icon" src="../src/img/user-error.png"/>
                    <h1 class="status"><b>Error</b></h1>
                    <p class="description">Something went wrong.</p>
                    <p class="description">You will be redirected back to Add Form Page in 5 seconds.</p>';
                    header("refresh:5;URL=add-form.php");             
                }
            } 
            else { 
                echo '
                <img class="status-icon" src="../src/img/user-error.png"/>
                <h1 class="status"><b>Error</b></h1>
                <p class="description">Something went wrong.</p>
                <p class="description">You will be redirected back to Add Form Page in 5 seconds.</p>';
                header("refresh:5;URL=add-form.php"); 
            }
        }
        else{            
            echo '<p class="description">You will be redirected back to the Add Form Page in 5 seconds.</p>';
            header("refresh:5;URL=add-form.php");
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

?>