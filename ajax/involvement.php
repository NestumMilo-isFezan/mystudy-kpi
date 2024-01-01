<?php 
session_start();
include('../config/config.php');
$keyword = $_GET["keyword"]
?>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Sem & Year</th>
            <th>Involvement<br>(Activity/Competition/Certificate)</th>
            <th>Category</th>
            <th>Level</th>
            <th>Remark</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $sql = "SELECT * FROM involvements WHERE userID=". $_SESSION["UID"].
            " AND (involvement LIKE '%$keyword%'
            OR level LIKE '%$keyword%'
            OR remark LIKE '%$keyword%'
            OR type LIKE '%$keyword%')";
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                $numrow=1;
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $numrow . "</td><td>". $row["sem"] . " " . $row["year"]. "</td><td>" . $row["involvement"] .
                    "</td><td>";
                    if($row['type']=="activity"){
                        echo'<p class="mark activity">Activity</p>';
                    }
                    else if($row['type']=="competition"){
                        echo'<p class="mark competition">Competition</p>';
                    }
                    else if($row['type']=="certificate"){
                        echo'<p class="mark certificate">Certificate</p>';
                    }

                    echo "</td><td>";
                    if($row['level']=="faculty"){
                        echo'<p class="mark faculty">Faculty</p>';
                    }
                    else if($row['level']=="university"){
                        echo'<p class="mark university">University</p>';
                    }
                    else if($row['level']=="state"){
                        echo'<p class="mark state">State</p>';
                    }
                    else if($row['level']=="national"){
                        echo'<p class="mark national">National</p>';
                    }
                    else if($row['level']=="international"){
                        echo'<p class="mark international">International</p>';
                    }
                    echo "</td><td>" . $row["remark"] . "</td>";

                    $numrow++;
                }
            }
            else {
                echo '<tr><td colspan="6">No results.</td></tr>';
            } 
            
            mysqli_close($conn);
        ?>

    </tbody>
</table>