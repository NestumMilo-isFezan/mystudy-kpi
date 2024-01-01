<?PHP
session_start();
include('../../config/config.php');

if(!isset($_SESSION["UID"])){
    header("location:../../index.php"); 
}
//this action called when Delete link is clicked
if(isset($_GET["id"]) && $_GET["id"] != ""){
    $id = $_GET["id"];
    $type = 'activity';
    $sql = "DELETE FROM $type WHERE a_id=" . $id . " AND userID=" . $_SESSION["UID"];
    
    if (mysqli_query($conn, $sql)) {
        $pagetitle = 'Success';
        include('../../template/header-kpi-info.php');
        echo '
        <img class="status-icon" src="../../src/img/success.png"/>
        <h1 class="status"><b>Successful</b></h1>
        <p class="description">Activity Record Successfully Removed.<br>';
        header("refresh:5;URL=../../managekpi.php");
     } else {
        $pagetitle = 'Failed';
        include('../../template/header-kpi-info.php');
        echo "Error deleting record: " . mysqli_error($conn) . "<br>";
        echo '<a href="my_challenge.php">Back</a>';
    }
}
mysqli_close($conn);

?>