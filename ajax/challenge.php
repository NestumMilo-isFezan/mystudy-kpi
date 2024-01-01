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
            <th>Challenge</th>
            <th>Plan</th>
            <th>Remark</th>
            <th>Photo</th>
            <th>Modify</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $sql = "SELECT * FROM challenge WHERE userID=". $_SESSION["UID"].
            " AND (challenge LIKE '%$keyword%'
            OR plan LIKE '%$keyword%'
            OR remark LIKE '%$keyword%')";
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                $numrow=1;
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $numrow . "</td><td>". $row["sem"] . " " . $row["year"]. "</td><td>" . $row["challenge"] .
                        "</td><td>" . $row["plan"] . "</td><td>" . $row["remark"] . "</td><td>" .
                        "<a href=uploads/challenge/" . $row["img_path"] . ">" . $row["img_path"] . "</a></td>";

                    echo '<td> <a href="challenge/edit.php?id=' . $row["ch_id"] . '">Edit</a>&nbsp;|&nbsp;';
                    echo '<a href="challenge/delete.php?id=' . $row["ch_id"] . '" onClick="return confirm(\'Delete?\');">Delete</a> </td>';
                    echo "</tr>" . "\n\t\t";
                    $numrow++;
                }
            }
            else {
                echo '<tr><td colspan="7">No results.</td></tr>';
            } 
            
            mysqli_close($conn);
        ?>

    </tbody>
</table>