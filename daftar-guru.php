<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'finpro_pweb';

// Create connection
$connect = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connect->connect_error) {
    exit('Connection failed: '.$connect->connect_error);
}

// Query untuk mendapatkan data pengajar
$query = "SELECT * FROM pengajar";
$result = $connect->query($query);

// Memeriksa apakah query berhasil dieksekusi
if ($result === false) {
    echo 'Error: '.$connect->error;
} else {
    // Mendapatkan hasil query sebagai array asosiatif
    while ($row = $result->fetch_assoc()) {
        // Lakukan sesuatu dengan data pengajar, contohnya:
        echo 'ID: ' . $row['id'] . '<br>';
        echo 'Nama: ' . $row['nama'] . '<br>';
        echo 'Cabang ID: ' . $row['cabang_id'] . '<br>';
        echo '<br>';
    }
}

// Menutup koneksi
$connect->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta nama="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Bimbel ACC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    <link rel="stylesheet" href="../public/style.css" />

    <style>
        .wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        main {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            /* Menambahkan margin: 0 auto untuk membuat container berada di tengah */
            text-align: center;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
        }

        .pengajar-section {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            gap: 17px;
            flex-shrink: 0;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
            width: 100%;
            padding: 20px;
        }

        .pengajar-section h2,
        .pengajar-section .pengajar-info {
            font-weight: bold;
        }

        .pengajar-section h2 {
            width: 128px;
            flex-shrink: 0;
            color: #333;
            font-size: 40px;
            margin-bottom: 1rem;
            margin-top: 20px;
        }

        .pengajar-section .pengajar-info {
            text-align: left;
            width: 100%;
        }

        .pengajar-section .pengajar-info img {
            width: 100px;
            /* Set the width of the pengajar image */
            border-radius: 50%;
            margin-right: 10px;
        }

        .pengajar-section .pengajar-info p {
            color: #000;
            font-family: Poppins;
            font-size: 18px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
            margin: 10px 0;
        }
    </style>
</head>

<body id="body-pd">

    <?php include 'sidebar.php'; ?>

    <nav class="navbar nav-primary header" id="header">
        <div class="container-fluid">
            <div class="header_toggle">
                <i class="bx bx-menu text-white" id="header-toggle"></i>
            </div>
            <div class="d-flex">
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="40" height="40" class="rounded-circle" />
                    </a>
                    <ul class="dropdown-menu text-small">
                        <li class="dropdown-header">Admin Menu</li>
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo">
                    <i class="bx bx-layer nav_logo-icon"></i>
                    <span class="nav_logo-nama">ACC BIMBEL</span>
                </a>
                <div class="nav_list">
                    <a href="#" class="nav_link active">
                        <i class="bx bx-grid-alt nav_icon"></i>
                        <span class="nav_nama">Dashboard</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class="bx bx-user nav_icon"></i>
                        <span class="nav_nama">Users</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class="bx bx-message-square-detail nav_icon"></i>
                        <span class="nav_nama">Messages</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class="bx bx-bookmark nav_icon"></i>
                        <span class="nav_nama">Bookmark</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class="bx bx-folder nav_icon"></i>
                        <span class="nav_nama">Files</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class="bx bx-bar-chart-alt-2 nav_icon"></i>
                        <span class="nav_nama">Stats</span>
                    </a>
                </div>
            </div>
            <a href="#" class="nav_link">
                <i class="bx bx-log-out nav_icon"></i>
                <span class="nav_nama">SignOut</span>
            </a>
        </nav>
    </div>

    <body id="body-pd">

        <?php include 'sidebar.php'; ?>

        <nav class="navbar nav-primary header" id="header">
            <!-- Navbar content remains unchanged -->
        </nav>

        <div class="l-navbar" id="nav-bar">
            <!-- Sidebar content remains unchanged -->
        </div>

        <!-- Main content -->
        <main class="height">
    <div class="wrapper">
        <h2>Our pengajars</h2>
        <main>
            <section class="pengajar-section">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Cabang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Loop through the pengajars array
                        foreach ($pengajars as $pengajar) {
                            echo '<tr>';
                            echo '<td>' . $pengajar['id'] . '</td>';
                            echo '<td>' . $pengajar['nama'] . '</td>';
                            echo '<td>' . $pengajar['cabang_id'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </main>

        <footer>
            <div class="footer">
                <p>
                    Made with <i class="bx bxs-heart"></i> by
                    <a href="/">Actual Cendekia Course</a>
                </p>
            </div>
        </footer>

        <script src="../public/index.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </body>

</html>