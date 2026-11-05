<?php

$halaman = $_GET['pages'] ?? 'dashboard';

switch ($halaman) {

    case 'dashboard':
        include 'pages/dashboard.php';
        break;

    case 'produk':
        include 'pages/produk.php';
        break;

    case 'tambah':
        include 'pages/tambah_produk.php';
        break;

    case 'edit':
        include 'pages/edit_produk.php';
        break;

    default:
        include 'pages/dashboard.php';
        break;
}
?>