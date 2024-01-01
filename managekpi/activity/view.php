<?php
session_start();
include('../../config/config.php');

$sql = "SELECT * FROM activity WHERE userID=" . $_SESSION['UID'];
$result = mysqli_query($conn, $sql);
?>

<div class="actual-content">
    <section class="table__header">
        <h1>My Activity</h1>
        <button class="add-item-button" onclick="location.href = 'managekpi/activity/add.php';"><i class='bx bx-plus'></i><b>&nbsp; Add Activity</b></button>
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
                    <th>Activity</th>
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
                        echo '<td>' .$row["activity"].'</td>';
                        echo '<td style="text-transform: capitalize;">' .$row["level"].'</td>';
                        echo '<td>' .$row["remark"].'</td>';

                        echo '<td> <a href="managekpi/activity/edit.php?id=' . $row["a_id"] . '">Edit</a>&nbsp;|&nbsp;';
                        echo '<a href="managekpi/activity/delete.php?id=' . $row["a_id"] . '" onClick="return confirm(\'Delete?\');">Delete</a> </td>';
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