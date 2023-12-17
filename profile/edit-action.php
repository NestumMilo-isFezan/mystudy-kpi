<?PHP
include'../template/header2.php';
include('../config/config.php');
//check if logged-in
if(!isset($_SESSION["UID"])){
    header("location:../index.php"); 
}

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submitimg"])) {
        $username = $_POST["username"];
        $program = $_POST["program"];
        $mentor = $_POST["mentor"];
        $motto = $_POST["motto"];

        $sql = 'UPDATE userprofile
                SET username="' .$username. '", program="' .$program. '", mentor="' . $mentor . '", motto="' . $motto .
                '" WHERE userID=' .$_SESSION['UID'] . ';';
    
        echo $sql . "<br>";

        if (mysqli_query($conn, $sql)) {
            echo'
                <img class="status-icon" src="../src/img/success.png"/>
                <h1 class="status"><b>Profile Info Updated</b></h1>
                <p class="description">Moving into the profile page in 3 seconds.<br>
            ';
            echo"<script>
                    setTimeout(function () {
                    window.location.href = '../profile.php';}, 3000);
                </script>";
        }
        else {
            echo '
                <img class="status-icon" src="../src/img/db-error.png"/>
                <h1 class="status"><b>Error</b></h1><p class="description"> SQL error ['
                . $sql . ']<br> Code [' . mysqli_error($conn) . ']</p>';
            echo "<script>
                    setTimeout(function () {
                    window.location.href = 'edit-form.php';}, 3000);
                </script>";
        }
    }
    else if(isset($_POST["cancelform"])) {
        echo " <script>
                    setTimeout(function () {
                    window.location.href = '../profile.php';}, 0);
                </script>";
    }
}
//close db connection
mysqli_close($conn);
?>
