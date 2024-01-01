<?php
$pagetitle = 'Home';
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
                include 'template/menubar.php';

                
            }
            
        /*    
        <nav>
            <ul class="sidebar">
                <li onclick="hideSidebar()"><a href="#"><i class='bx bx-x' ></i></a></li>
                <li><a href="#">Login</a></li>
                <li><a href="#">Register</a></li>
            </ul>
            <ul>
                <li class="hideOnMobile"><a href="#" id="title"><i class='bx bxs-book' ></i> | My Study KPI</a></li>
                <li class="hideOnMobile" id="login-button"><a href="#">Login</a></li>
                <li class="hideOnMobile" id="reg-button"><a href="#">Register</a></li>
                <li class="menu-button" onclick="showSidebar()"><a href="#"><i class='bx bx-menu' ></i></a></li>
            </ul>
        </nav>
            */
        ?>

        <main class="main-content">
            <h1>Announcement</h1>
        </main>

        <footer class="author-footer">
            <p>Copyright @2023 FCI - Hak milik Nurahfezan</p>
        </footer>
    </div>

</body>