<?php
$pagetitle = 'Challenges and Plans';
include('config/config.php');
include 'template/header.php'
?>

<body>
    <div class="main-container">
        <?php
            // Primary Header
            include 'template/titlebar.php';

            // Menubar or Navbar
            if (isset($_SESSION['UID'])){
                include 'template/logged_menu.php';
            }
            else{
                include 'template/menubar.php';
            }
        ?>

        <main class="main-content">
            <div class="challenge-content">
            <section class="table__header">
                <h1>List of Challenges and Plans</h1>
            </section>
                
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th>id</th>
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
                        <tr>
                            <td>1</td>
                            <td>1-2021/2022</td>
                            <td>Mengantuk</td>
                            <td>Tidur</td>
                            <td>Taknak</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>1-2021/2022</td>
                            <td>Mengantuk</td>
                            <td>Tidur</td>
                            <td>Taknak</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
            </section>
            </div>
        </main>

        <footer class="author-footer">
            <p>Copyright @2023 FCI - Hak milik Nurahfezan</p>
        </footer>
    </div>

</body>