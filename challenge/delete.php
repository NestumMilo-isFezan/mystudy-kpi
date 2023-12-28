<?PHP
include('../config/config.php');

// Generate template
include '../template/header2.php';

//this action called when Delete link is clicked
if(isset($_GET["id"]) && $_GET["id"] != ""){
    $id = $_GET["id"];
    deletePreviousImage($conn, $id);
    $sql = "DELETE FROM challenge WHERE ch_id=" . $id . " AND userID=" . $_SESSION["UID"];
    
    if (mysqli_query($conn, $sql)) {
        echo '
        <img class="status-icon" src="../src/img/success.png"/>
        <h1 class="status"><b>Successful</b></h1>
        <p class="description">Challenge Record Successfully Removed.<br>';
        header("refresh:5;URL=../challenge.php");
     } else {
        echo "Error deleting record: " . mysqli_error($conn) . "<br>";
        echo '<a href="my_challenge.php">Back</a>';
    }
}
mysqli_close($conn);


function deletePreviousImage($conn, $id) {
    $sql = "SELECT img_path FROM challenge WHERE ch_id = $id AND userID = ". $_SESSION["UID"];
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $previousImagePath = $row['img_path'];
        
        // Check if the previous image path exists and delete it
        if ($previousImagePath && file_exists("../uploads/challenge/$previousImagePath")) {
            unlink("../uploads/challenge/$previousImagePath");
        }
    }
}

?>
