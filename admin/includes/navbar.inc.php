<!-- Navbar starts -->
<nav class="navbar">
        <div class="sidebar-toggle">
            <i class='bx bx-menu' id="toggle-icon"></i>
        </div>
        <div class="profile-section">
            <img src="../images/profile-pics/profile-pic-4.jpg" alt="Admin image" width="40" height="40">
            <div class="profile-info">
                <span>Hi,</span>
                <span class="name">
                    <?php 
                        session_start();
                        if(isset($_SESSION['username_admin'])){
                            echo $_SESSION['username_admin'];
                        } 
                    ?>
                </span>
            </div>
        </div>
    </nav>
<!-- Navbar end --->