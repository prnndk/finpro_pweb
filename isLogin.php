<?php
//cek is user log in
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('location: ../login.php');
    exit;
}