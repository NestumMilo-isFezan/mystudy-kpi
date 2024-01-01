<?php
$pagetitle = 'List of Activities';
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
                <h1>List of Involvements</h1>
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
                            <th>Involvement<br>(Activity/Competition/Certificate)</th>
                            <th>Category</th>
                            <th>Level</th>
                            <th>Remark</th>
                        </tr>
                    </thead>

                    <?php

                    ?>

                    <tbody>
                    <?php
                        // Activity
                        $sql = "SELECT * FROM involvements WHERE userID=". $_SESSION["UID"];
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
                                else if($row['type']=="certification"){
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
            </section>
            <script src="script/involvement-search-script.js"></script>
            </div>
        </main>

        <footer class="author-footer">
            <p>Copyright @2023 FCI - Hak milik Nurahfezan</p>
        </footer>
    </div>

</body>