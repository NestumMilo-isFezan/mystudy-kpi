<?php
session_start();
include('../../config/config.php');

$sql = "SELECT * FROM certification WHERE userID=" . $_SESSION['UID'];
$result = mysqli_query($conn, $sql);
?>

<div class="actual-content">
    <section class="table__header">
        <h1>My Certificate</h1>
        <button class="add-item-button" onclick="location.href = 'managekpi/certificate/add.php';"><i class='bx bx-plus'></i><b>&nbsp; Add Certificate</b></button>
    </section>

    <section class="table__search">
        <form action="" method="post" class="searchbar">
            <input type="text" placeholder="Search.." name="search" id="keyword">
            <button id="search-data"><i class='bx bx-search-alt-2' ></i><b>&nbsp;Search</b></button>
        </form>
    </section>
                
    <section class="table__body" id="container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Sem & Year</th>
                    <th>Certificate</th>
                    <th>Level</th>
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
                        echo "<td>$numrow</td>";
                        echo "<td>".$row['sem'] . " " . $row['year'] ."</td>";
                        echo '<td>' .$row["certification"].'</td>';
                        echo '<td style="text-transform: capitalize;">' .$row["level"].'</td>';
                        echo '<td>' .$row["remark"].'</td>';

                        echo '<td> <a href="managekpi/certificate/edit.php?id=' . $row["cert_id"] . '">Edit</a>&nbsp;|&nbsp;';
                                echo '<a href="managekpi/certificate/delete.php?id=' . $row["cert_id"] . '" onClick="return confirm(\'Delete?\');">Delete</a> </td>';
                    }
                }
                else{
                    echo "<td colspan='6'> No Result </td>";
                }
                ?>
            </tbody>
        </table>
    </section>
</div>