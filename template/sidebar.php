<?php
require_once '../isLogin.php';
$roles = $_SESSION['isAdmin'];
?>
<nav class="navbar nav-primary header" id="header">
    <div class="container-fluid">
        <div class="header_toggle">
            <i class="bx bx-menu text-white" id="header-toggle"></i>
        </div>
        <img
                src="https://portal.its.ac.id/images/profile-default.jpg"
                alt="mdo"
                width="40"
                height="40"
                class="rounded-circle"
        />
    </div>
    </div>
</nav>
<?php if ($roles == 'admin') { ?>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo">
                    <i class="bx bx-layer nav_logo-icon"></i>
                    <span class="nav_logo-name">ACC BIMBEL</span>
                </a>
                <div class="nav_list">
                    <a href="../admin/dashboard.php" class="nav_link active">
                        <i class="bx bx-grid-alt nav_icon"></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
                    <a href="../admin/list_users.php" class="nav_link">
                        <i class="bx bx-user nav_icon"></i>
                        <span class="nav_name">Users</span>
                    </a>
                    <a href="../admin/kelas.php" class="nav_link">
                        <i class="bx bx-chalkboard nav_icon"></i>
                        <span class="nav_name">Class</span>
                    </a>
                    <a href="../admin/pembayaran.php" class="nav_link">
                        <i class="bx bx-money nav_icon"></i>
                        <span class="nav_name">Pembayaran</span>
                    </a>
                    <a href="../admin/absensi.php" class="nav_link">
                        <i class="bx bx-check-square nav_icon"></i>
                        <span class="nav_name">Presensi</span>
                    </a>
                    <a href="../admin/nilai.php" class="nav_link">
                        <i class="bx bx-bar-chart-alt-2 nav_icon"></i>
                        <span class="nav_name">Nilai</span>
                    </a>
                    <a href="../admin/daftar_guru.php" class="nav_link">
                        <i class="bx bx-group nav_icon"></i>
                        <span class="nav_name">Guru</span>
                    </a>
                    <a href="../admin/daftar_cabang.php" class="nav_link">
                        <i class="bx bx-building-house nav_icon"></i>
                        <span class="nav_name">Cabang</span>
                    </a>
                </div>
            </div>
            <a href="../logout.php" class="nav_link">
                <i class="bx bx-log-out nav_icon"></i>
                <span class="nav_name">Sign Out</span>
            </a>
        </nav>
    </div>
<?php } else {
    $request_location = $_SERVER['REQUEST_URI'];
    ?>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo">
                    <i class="bx bx-layer nav_logo-icon"></i>
                    <span class="nav_logo-name">ACC BIMBEL</span>
                </a>
                <div class="nav_list">
                    <a href="../siswa/dashboard.php"
                       class="nav_link <?php echo $request_location == '/siswa/dashboard.php' ? 'active' : ''; ?>">
                        <i class="bx bx-grid-alt nav_icon"></i>
                        <span class="nav_name">List Materi</span>
                    </a>
                    <a href="../siswa/daftar_materi.php"
                       class="nav_link <?php if ($_SERVER['REQUEST_URI'] == '/siswa/daftar_materi.php') echo 'active'; ?>">
                        <i class="bx bx-clipboard nav_icon"></i>
                        <span class="nav_name">List Materi</span>
                    </a>
                    <a href="../siswa/kelas.php"
                       class="nav_link <?php if ($_SERVER['REQUEST_URI'] == '/siswa/kelas.php') echo 'active'; ?>">
                        <i class="bx bx-chalkboard nav_icon"></i>
                        <span class="nav_name">Class</span>
                    </a>
                    <a href="../siswa/pembayaran.php"
                       class="nav_link <?php if ($_SERVER['REQUEST_URI'] == '/siswa/pembayaran.php') echo 'active'; ?>">
                        <i class="bx bx-money nav_icon"></i>
                        <span class="nav_name">Pembayaran</span>
                    </a>
                    <a href="../siswa/absensi.php" class="nav_link">
                        <i class="bx bx-check-square nav_icon"></i>
                        <span class="nav_name">Presensi</span>
                    </a>
                    <a href="../siswa/nilai.php" class="nav_link">
                        <i class="bx bx-bar-chart-alt-2 nav_icon"></i>
                        <span class="nav_name">Nilai</span>
                    </a>
                </div>
            </div>
            <a href="../logout.php" class="nav_link">
                <i class="bx bx-log-out nav_icon"></i>
                <span class="nav_name">Sign Out</span>
            </a>
        </nav>
    </div>
<?php } ?>
