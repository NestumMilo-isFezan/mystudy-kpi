<?php
session_start();
include('../../config/config.php');

$sql = "SELECT * FROM cgpa WHERE userID=" . $_SESSION['UID'] . " ORDER BY year, sem";
$result = mysqli_query($conn, $sql);
?>

<div class="actual-content">
    <section class="table__header">
        <h1>My CGPA</h1>
    </section>
   
    <section class="table__body" id="container">
        <table>
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Sem</th>
                    <th>CGPA</th>
                    <th>Remark</th>
                    <th>Modify</th>
                    
                </tr>
            </thead>
               
            <tbody>
                <?php 
                    $numrow=1;
                    if (mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td>".$row['year']."</td>";
                            echo "<td>".$row['sem']."</td>";
                            echo "<td>".$row['cgpa']."</td>";
                            echo '<td>' .$row['remark'].'</td>';

                            echo '<td> <a href="managekpi/cgpa/edit.php?id=' . $row["cgpa_id"] . '">Edit</a>&nbsp;|&nbsp;';
                            echo '<a href="managekpi/cgpa/delete.php?id=' . $row["cgpa_id"] . '" onClick="return confirm(\'Delete?\');">Delete</a> </td>';
                        }
                    }
                ?>
                
            </tbody>
        </table>
    </section>
</div>