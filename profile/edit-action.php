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
        $intake = $_POST["intake"];

        $sql = 'UPDATE userprofile
                SET username="' .$username. '", program="' .$program. '", mentor="' . $mentor . '", motto="' . $motto . '", intake_batch="' .$intake .
                '" WHERE userID=' .$_SESSION['UID'] . ';';
    

        if (mysqli_query($conn, $sql)) {
            $_SESSION['intake'] = $intake;
            $yearpart = explode('/',$intake);
            $year_part1 = intval($yearpart[0]);
            $year_part2 = intval($yearpart[1]);
            $string_year = $year_part1 . '/' . $year_part2;
            $counter = 0;
            $year_count = 1;

            $sql = "SELECT cgpa_id from cgpa where userID=" .$_SESSION['UID'];
            $result = mysqli_query($conn, $sql);

            
            $num_rows = mysqli_num_rows($result);
                for ($i=0;$i<$num_rows;$i++) {
                    $row = mysqli_fetch_assoc($result);      
                    $sql = 'UPDATE cgpa SET year ="' .$string_year. '" WHERE cgpa_id='.$row['cgpa_id'];
                    mysqli_query($conn, $sql);
                    $counter++;
                    if($counter == 2){
                        $counter = 0;             
                        $string_year = $year_part1+$year_count . '/' . $year_part2+$year_count;
                        $year_count++;
                    }
                }

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
