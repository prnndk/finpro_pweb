<?php

//cek is user adin
require_once 'isLogin.php';

if ($_SESSION['isAdmin'] !== true) {
    header('location: /siswa/dashboard.php');
    exit;
}

