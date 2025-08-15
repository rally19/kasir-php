<?php 
include 'config.php';
include 'fungsi.php';

session_start(); 

$action = isset($_GET['action']) ? $_GET['action'] : 'list-penjualan';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="src/css/uikit.css" />
    <link rel="stylesheet" type="text/css" href="src/css/uikit-mod.css">
    <link rel="stylesheet" type="text/css" href="src/css/style.css">
    <script src="src\js\jquery.js"></script>
    <link href="src\css\select2.min.css" rel="stylesheet" />
    <script src="src\js\select2.min.js"></script>
    <title>Kasir</title>
</head>
<body>
    <div class="uk-grid-collapse" uk-grid>
        <div class="uk-width-1-6 uk-background-secondary uk-light uk-padding-small uk-visible@m" style="height: 100vh; position: sticky; top: 0;">
            <h3 class="uk-text-center">Kasir</h3>
            <ul class="uk-nav-default" uk-nav="multiple: true">
                <li class="uk-parent">
                <a href="#">Pelanggan<span uk-nav-parent-icon></span></a>
            <ul class="uk-nav-sub">
                <li><a href="index.php?action=list-pelanggan">List Pelanggan</a></li>
                <li><a href="index.php?action=create-pelanggan">Create Pelanggan</a></li>
            </ul>
                </li>
                <li class="uk-parent">
            <a href="#">Produk<span uk-nav-parent-icon></span></a>
            <ul class="uk-nav-sub">
                <li><a href="index.php?action=list-produk">List Produk</a></li>
                <li><a href="index.php?action=create-produk">Create Produk</a></li>
            </ul>
            </li>
            <li class="uk-parent">
            <a href="#">Penjualan<span uk-nav-parent-icon></span></a>
            <ul class="uk-nav-sub">
                <li><a href="index.php?action=list-penjualan">List Penjualan</a></li>
                <li><a href="index.php?action=create-penjualan">Create Penjualan</a></li>
            </ul>
            </li>
            </ul>
        </div>
        <div class="uk-width-expand">
            <div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky">
            <nav class="uk-navbar-container" uk-navbar>
                <div class="uk-navbar-left uk-flex uk-flex-1 uk-margin-left">
                    <form class="uk-search uk-search-default" style="flex-grow: 1;">
                        <span uk-search-icon></span>
                        <input class="uk-search-input uk-width-1-1" type="search" placeholder="Search...">
                    </form>
                </div>
                <div class="uk-navbar-right uk-margin-left uk-margin-right">
                <a class="uk-navbar-toggle" href="#" uk-icon="user"></a>
                <div uk-dropdown="pos: bottom-right; delay-hide: 400; animation: uk-animation-slide-top-small; animate-out: true; offset: -1">
                </div>
                    <a class="uk-hidden@m uk-icon-link" href="#" uk-icon="icon: menu" uk-toggle="target: #offcanvas-sidebar"></a>
                </div>
            </nav>
            </div>
            <div id="offcanvas-sidebar" uk-offcanvas="overlay: true">
                <div class="uk-offcanvas-bar">
                    <h3>Dashboard</h3>
                    <ul class="uk-nav uk-nav-default">
                        <ul class="uk-nav-default" uk-nav="multiple: true">
                            <li class="uk-parent">
                            <a href="#">Pelanggan<span uk-nav-parent-icon></span></a>
                        <ul class="uk-nav-sub">
                            <li><a href="index.php?action=list-pelanggan">List Pelanggan</a></li>
                            <li><a href="index.php?action=create-pelanggan">Create Pelanggan</a></li>
                        </ul>
                            </li>
                            <li class="uk-parent">
                        <a href="#">Produk<span uk-nav-parent-icon></span></a>
                        <ul class="uk-nav-sub">
                            <li><a href="index.php?action=list-produk">List Produk</a></li>
                            <li><a href="index.php?action=create-produk">Create Produk</a></li>
                        </ul>
                        </li>
                        <li class="uk-parent">
                        <a href="#">Penjualan<span uk-nav-parent-icon></span></a>
                        <ul class="uk-nav-sub">
                            <li><a href="index.php?action=list-penjualan">List Penjualan</a></li>
                            <li><a href="index.php?action=create-penjualan">Create Penjualan</a></li>
                        </ul>
                        </li>
                        </ul>
                    </ul>
                </div>
            </div>
            <?php
            switch ($action) {
                case 'list-pelanggan':
                    include 'pelanggan/list.php';
                    break;
                case 'view-pelanggan':
                    include 'pelanggan/view.php';
                    break;
                case 'edit-pelanggan':
                    include 'pelanggan/edit.php';
                    break;
                case 'delete-pelanggan':
                    include 'pelanggan/delete.php';
                    break;
                case 'create-pelanggan':
                    include 'pelanggan/create.php';
                    break;
                case 'list-produk':
                    include 'produk/list.php';
                    break;
                case 'view-produk':
                    include 'produk/view.php';
                    break;
                case 'edit-produk':
                    include 'produk/edit.php';
                    break;
                case 'delete-produk':
                    include 'produk/delete.php';
                    break;
                case 'create-produk':
                    include 'produk/create.php';
                    break;
                case 'delete-penjualan':
                    include 'penjualan/delete.php';
                    break;
                case 'create-penjualan':
                    include 'penjualan/create.php';
                    break;
                case 'delete-penjualan-detail':
                    include 'penjualan/detail_delete.php';
                    break;
                case 'view-penjualan':
                    include 'penjualan/view.php';
                    break;
                case 'list-penjualan':
                    include 'penjualan/list.php';
                    break;
                case 'edit-penjualan':
                    include 'penjualan/edit.php';
                    break;
                default:
                    include 'penjualan/list.php';
                    break;
            }
            ?>
        </div>
    </div>
    <script src="src/js/fungsis.js"></script>
    <script src="src/js/uikit.js"></script>
    <script src="src/js/uikit-icons.js"></script>
</body>
</html>
