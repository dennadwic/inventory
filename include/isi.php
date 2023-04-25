<?php
    $page = $_GET['page'];
    $aksi = $_GET['aksi'];

    if($page == "supplier") {
        if($aksi == "") {
            include "page/supplier/data_supplier.php";
        }
    }

    if($page == "barang") {
        if($aksi == "") {
            include "page/barang/data_barang.php";
        }
    }

    if($page == "") {
            include "home.php";
    }
?>