<?php
$pagetitle = 'Challenges and Plans';
include('config/config.php');
include 'template/header.php'
?>

<body>
    <div class="main-container">
        <?php
            // Menubar or Navbar
            if (isset($_SESSION['UID'])){
                include 'template/logged_menu.php';
            }
            else{
                header('refresh:0 ;URL=index.php');
            }
        ?>

        <main class="main-content">
            <div class="data-content">
            <section class="table__header">
                <h1>List of Challenges and Plans</h1>
                <button class="add-item-button" onclick="location.href = 'challenge/add-form.php';"><i class='bx bx-plus'></i><b>&nbsp; Add Challenges</b></button>
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
                            <th>Challenge</th>
                            <th>Plan</th>
                            <th>Remark</th>
                            <th>Photo</th>
                            <th>Modify</th>
                        </tr>
                    </thead>

                    <?php

                    ?>

                    <tbody>
                    <?php
                        $sql = "SELECT * FROM challenge WHERE userID=". $_SESSION["UID"];
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
            </section>
            <script src="script/challenge-search-script.js"></script>
            </div>
        </main>

        <footer class="author-footer">
            <p>Copyright @2023 FCI - Hak milik Nurahfezan</p>
        </footer>
    </div>

</body>