<?php
session_start();
include('../config/config.php');

$sql = "SELECT * FROM kpiaim WHERE userID=" . $_SESSION['UID'];
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_assoc($result);
    $kpi_id = $row['aim_id'];
    $aim_cgpa = $row['cgpa'];
    $a_fac = $row['a_fac'];
    $a_uni = $row['a_uni'];
    $a_nat = $row['a_nat'];
    $a_inter = $row['a_inter'];
    $c_fac = $row['c_fac'];
    $c_uni = $row['c_uni'];
    $c_nat = $row['c_nat'];
    $c_inter = $row['c_inter'];
    $cert_pro = $row['cert_pro'];
    $cert_tec = $row['cert_tec'];
}
?>

<div class="actual-content">
    <section class="table__header">
        <h1>My KPI</h1>
        <button class="add-item-button" onclick="location.href = 'managekpi/edit.php?id=<?= $kpi_id?>';"><i class='bx bx-plus'></i><b>&nbsp; Edit MyKPI Aim</b></button>
    </section>
                
    <section class="table__body" id="container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Indicator</th>
                    <th>Faculty KPI's Aim</th>
                    <th>My KPI's Aim</th>
                    <?php
                        $yearpart = explode('/',$_SESSION['intake']);
                        $year_part1 = intval($yearpart[0]);
                        $year_part2 = intval($yearpart[1]);

                        for ($i=0; $i<4; $i++){
                            $string_year = $year_part1+$i . '/' . $year_part2+$i;
                            $j = 1 + $i;
                                
                            echo"<th>Year $j Sem 1<br>$string_year</th>";
                            echo"<th>Year $j Sem 2<br>$string_year</th>";
                        }
                    ?>

                    <th>Remarks</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="kpi-indicate">1</td>
                    <td>CGPA</td>
                    <td>>= 3.00</td>
                    <td><?= $aim_cgpa?></td>
                    <?php
                        $yearpart = explode('/',$_SESSION['intake']);
                        $year_part1 = intval($yearpart[0]);
                        $year_part2 = intval($yearpart[1]);
                        $string_year = $year_part1 . '/' . $year_part2;
                        $counter = 0;
                        $year_count = 1;

                        $sql = "SELECT * FROM cgpa where userID=" .$_SESSION['UID'];
                        $result = mysqli_query($conn, $sql);

                        $num_rows = mysqli_num_rows($result);
                        for ($i=0;$i<$num_rows;$i++) {
                            $row = mysqli_fetch_assoc($result);      
                            echo"<td>" .$row['cgpa']. "</td>";
                            $counter++;
                            if($counter == 2){
                                $counter = 0;             
                                $string_year = $year_part1+$year_count . '/' . $year_part2+$year_count;
                                $year_count++;
                            }
                        }
                    ?>
                    <td>-</td>
                </tr>
                <tr>
                    <td rowspan="5" class="kpi-indicate">2</td>
                    <td colspan="12" style="text-align:center;">Student's Activity</td>
                </tr>
                <tr>
                    <td>Faculty</td>
                    <td>4</td>
                    <td><?= $a_fac?></td>
                    <?php
                        $yearpart = explode('/',$_SESSION['intake']);
                        $year_part1 = intval($yearpart[0]);
                        $year_part2 = intval($yearpart[1]);
                        $year_count = 1;

                        $sql = "SELECT * FROM activity_count where userID=" .$_SESSION['UID']. " AND level='Faculty' ORDER BY sem, year";
                        $result = mysqli_query($conn, $sql);
                        $activity_counts = mysqli_fetch_all($result, MYSQLI_ASSOC);

                        for ($i = 0; $i < 8; $i++) {
                            $string_year = $year_part1 + floor($i / 2) . '/' . $year_part2 + floor($i / 2);
                            $sem = $i % 2 + 1;
                    
                            $found = false;
                            foreach ($activity_counts as $row) {
                                if ($row['year'] == $string_year && $row['sem'] == $sem) {
                                    echo "<td>" . $row['counter'] . "</td>";
                                    $found = true;
                                    break;
                                }
                            }
                    
                            if (!$found) {
                                echo '<td>&nbsp;-&nbsp;</td>';
                            }
                        }

                    ?>
                    <td>-</td>
                </tr>
                <tr>
                    <td>University</td>
                    <td>4</td>
                    <td><?= $a_uni?></td>
                    <?php
                        $yearpart = explode('/',$_SESSION['intake']);
                        $year_part1 = intval($yearpart[0]);
                        $year_part2 = intval($yearpart[1]);
                        $year_count = 1;

                        $sql = "SELECT * FROM activity_count where userID=" .$_SESSION['UID']. " AND level='University' ORDER BY sem, year";
                        $result = mysqli_query($conn, $sql);
                        $activity_counts = mysqli_fetch_all($result, MYSQLI_ASSOC);

                        for ($i = 0; $i < 8; $i++) {
                            $string_year = $year_part1 + floor($i / 2) . '/' . $year_part2 + floor($i / 2);
                            $sem = $i % 2 + 1;
                    
                            $found = false;
                            foreach ($activity_counts as $row) {
                                if ($row['year'] == $string_year && $row['sem'] == $sem) {
                                    echo "<td>" . $row['counter'] . "</td>";
                                    $found = true;
                                    break;
                                }
                            }
                    
                            if (!$found) {
                                echo '<td>&nbsp;-&nbsp;</td>';
                            }
                        }

                    ?>
                    <td>-</td>
                </tr>
                <tr>
                    <td>National</td>
                    <td>1</td>
                    <td><?= $a_nat?></td>
                    <?php
                        $yearpart = explode('/',$_SESSION['intake']);
                        $year_part1 = intval($yearpart[0]);
                        $year_part2 = intval($yearpart[1]);
                        $year_count = 1;

                        $sql = "SELECT * FROM activity_count where userID=" .$_SESSION['UID']. " AND level='National' ORDER BY sem, year";
                        $result = mysqli_query($conn, $sql);
                        $activity_counts = mysqli_fetch_all($result, MYSQLI_ASSOC);

                        for ($i = 0; $i < 8; $i++) {
                            $string_year = $year_part1 + floor($i / 2) . '/' . $year_part2 + floor($i / 2);
                            $sem = $i % 2 + 1;
                    
                            $found = false;
                            foreach ($activity_counts as $row) {
                                if ($row['year'] == $string_year && $row['sem'] == $sem) {
                                    echo "<td>" . $row['counter'] . "</td>";
                                    $found = true;
                                    break;
                                }
                            }
                    
                            if (!$found) {
                                echo '<td>&nbsp;-&nbsp;</td>';
                            }
                        }

                    ?>
                    <td>-</td>

                </tr>
                <tr>
                    <td>International</td>
                    <td>1</td>
                    <td><?= $a_inter?></td>
                    <?php
                        $yearpart = explode('/',$_SESSION['intake']);
                        $year_part1 = intval($yearpart[0]);
                        $year_part2 = intval($yearpart[1]);
                        $year_count = 1;

                        $sql = "SELECT * FROM activity_count where userID=" .$_SESSION['UID']. " AND level='International' ORDER BY sem, year";
                        $result = mysqli_query($conn, $sql);
                        $activity_counts = mysqli_fetch_all($result, MYSQLI_ASSOC);

                        for ($i = 0; $i < 8; $i++) {
                            $string_year = $year_part1 + floor($i / 2) . '/' . $year_part2 + floor($i / 2);
                            $sem = $i % 2 + 1;
                    
                            $found = false;
                            foreach ($activity_counts as $row) {
                                if ($row['year'] == $string_year && $row['sem'] == $sem) {
                                    echo "<td>" . $row['counter'] . "</td>";
                                    $found = true;
                                    break;
                                }
                            }
                    
                            if (!$found) {
                                echo '<td>&nbsp;-&nbsp;</td>';
                            }
                        }

                    ?>
                    <td>-</td>

                </tr>
                <tr>
                    <td rowspan="5" class="kpi-indicate">3</td>
                    <td colspan="12" style="text-align:center;">Student's Competition</td>
                </tr>
                <tr>
                    <td>Faculty</td>
                    <td>2</td>
                    <td><?= $c_fac?></td>
                    <?php
                        $yearpart = explode('/',$_SESSION['intake']);
                        $year_part1 = intval($yearpart[0]);
                        $year_part2 = intval($yearpart[1]);
                        $year_count = 1;

                        $sql = "SELECT * FROM comp_count where userID=" .$_SESSION['UID']. " AND level='Faculty' ORDER BY sem, year";
                        $result = mysqli_query($conn, $sql);
                        $activity_counts = mysqli_fetch_all($result, MYSQLI_ASSOC);

                        for ($i = 0; $i < 8; $i++) {
                            $string_year = $year_part1 + floor($i / 2) . '/' . $year_part2 + floor($i / 2);
                            $sem = $i % 2 + 1;
                    
                            $found = false;
                            foreach ($activity_counts as $row) {
                                if ($row['year'] == $string_year && $row['sem'] == $sem) {
                                    echo "<td>" . $row['counter'] . "</td>";
                                    $found = true;
                                    break;
                                }
                            }
                    
                            if (!$found) {
                                echo '<td>&nbsp;-&nbsp;</td>';
                            }
                        }

                    ?>
                    <td>-</td>
                </tr>
                <tr>
                    <td>University</td>
                    <td>2</td>
                    <td><?= $c_uni?></td>
                    <?php
                        $yearpart = explode('/',$_SESSION['intake']);
                        $year_part1 = intval($yearpart[0]);
                        $year_part2 = intval($yearpart[1]);
                        $year_count = 1;

                        $sql = "SELECT * FROM comp_count where userID=" .$_SESSION['UID']. " AND level='University' ORDER BY sem, year";
                        $result = mysqli_query($conn, $sql);
                        $activity_counts = mysqli_fetch_all($result, MYSQLI_ASSOC);

                        for ($i = 0; $i < 8; $i++) {
                            $string_year = $year_part1 + floor($i / 2) . '/' . $year_part2 + floor($i / 2);
                            $sem = $i % 2 + 1;
                    
                            $found = false;
                            foreach ($activity_counts as $row) {
                                if ($row['year'] == $string_year && $row['sem'] == $sem) {
                                    echo "<td>" . $row['counter'] . "</td>";
                                    $found = true;
                                    break;
                                }
                            }
                    
                            if (!$found) {
                                echo '<td>&nbsp;-&nbsp;</td>';
                            }
                        }

                    ?>
                    <td>-</td>
                </tr>
                <tr>
                    <td>National</td>
                    <td>1</td>
                    <td><?= $c_nat?></td>
                    <?php
                        $yearpart = explode('/',$_SESSION['intake']);
                        $year_part1 = intval($yearpart[0]);
                        $year_part2 = intval($yearpart[1]);
                        $year_count = 1;

                        $sql = "SELECT * FROM comp_count where userID=" .$_SESSION['UID']. " AND level='National' ORDER BY sem, year";
                        $result = mysqli_query($conn, $sql);
                        $activity_counts = mysqli_fetch_all($result, MYSQLI_ASSOC);

                        for ($i = 0; $i < 8; $i++) {
                            $string_year = $year_part1 + floor($i / 2) . '/' . $year_part2 + floor($i / 2);
                            $sem = $i % 2 + 1;
                    
                            $found = false;
                            foreach ($activity_counts as $row) {
                                if ($row['year'] == $string_year && $row['sem'] == $sem) {
                                    echo "<td>" . $row['counter'] . "</td>";
                                    $found = true;
                                    break;
                                }
                            }
                    
                            if (!$found) {
                                echo '<td>&nbsp;-&nbsp;</td>';
                            }
                        }

                    ?>
                    <td>-</td>

                </tr>
                <tr>
                    <td>International</td>
                    <td>1</td>
                    <td><?= $c_inter?></td>
                    <?php
                        $yearpart = explode('/',$_SESSION['intake']);
                        $year_part1 = intval($yearpart[0]);
                        $year_part2 = intval($yearpart[1]);
                        $year_count = 1;

                        $sql = "SELECT * FROM comp_count where userID=" .$_SESSION['UID']. " AND level='International' ORDER BY sem, year";
                        $result = mysqli_query($conn, $sql);
                        $activity_counts = mysqli_fetch_all($result, MYSQLI_ASSOC);

                        for ($i = 0; $i < 8; $i++) {
                            $string_year = $year_part1 + floor($i / 2) . '/' . $year_part2 + floor($i / 2);
                            $sem = $i % 2 + 1;
                    
                            $found = false;
                            foreach ($activity_counts as $row) {
                                if ($row['year'] == $string_year && $row['sem'] == $sem) {
                                    echo "<td>" . $row['counter'] . "</td>";
                                    $found = true;
                                    break;
                                }
                            }
                    
                            if (!$found) {
                                echo '<td>&nbsp;-&nbsp;</td>';
                            }
                        }

                    ?>
                    <td>-</td>

                </tr>
                <tr>
                    <td rowspan="5" class="kpi-indicate">4</td>
                    <td colspan="12" style="text-align:center;">Certificate</td>
                </tr>
                <tr>
                    <td>Professional</td>
                    <td>>=1</td>
                    <td><?= $cert_pro?></td>
                    <?php
                        $yearpart = explode('/',$_SESSION['intake']);
                        $year_part1 = intval($yearpart[0]);
                        $year_part2 = intval($yearpart[1]);
                        $year_count = 1;

                        $sql = "SELECT * FROM cert_count where userID=" .$_SESSION['UID']. " AND level='Professional' ORDER BY sem, year";
                        $result = mysqli_query($conn, $sql);
                        $activity_counts = mysqli_fetch_all($result, MYSQLI_ASSOC);

                        for ($i = 0; $i < 8; $i++) {
                            $string_year = $year_part1 + floor($i / 2) . '/' . $year_part2 + floor($i / 2);
                            $sem = $i % 2 + 1;
                    
                            $found = false;
                            foreach ($activity_counts as $row) {
                                if ($row['year'] == $string_year && $row['sem'] == $sem) {
                                    echo "<td>" . $row['counter'] . "</td>";
                                    $found = true;
                                    break;
                                }
                            }
                    
                            if (!$found) {
                                echo '<td>&nbsp;-&nbsp;</td>';
                            }
                        }

                    ?>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Technical</td>
                    <td>>=1</td>
                    <td><?= $cert_tec?></td>
                    <?php
                        $yearpart = explode('/',$_SESSION['intake']);
                        $year_part1 = intval($yearpart[0]);
                        $year_part2 = intval($yearpart[1]);
                        $year_count = 1;

                        $sql = "SELECT * FROM cert_count where userID=" .$_SESSION['UID']. " AND level='Technical' ORDER BY sem, year";
                        $result = mysqli_query($conn, $sql);
                        $activity_counts = mysqli_fetch_all($result, MYSQLI_ASSOC);

                        for ($i = 0; $i < 8; $i++) {
                            $string_year = $year_part1 + floor($i / 2) . '/' . $year_part2 + floor($i / 2);
                            $sem = $i % 2 + 1;
                    
                            $found = false;
                            foreach ($activity_counts as $row) {
                                if ($row['year'] == $string_year && $row['sem'] == $sem) {
                                    echo "<td>" . $row['counter'] . "</td>";
                                    $found = true;
                                    break;
                                }
                            }
                    
                            if (!$found) {
                                echo '<td>&nbsp;-&nbsp;</td>';
                            }
                        }

                    ?>
                    <td>-</td>
                </tr>

            </tbody>
        </table>
    </section>
</div>