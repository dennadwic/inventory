<?php
    $page = $_GET['page'];
    $aksi = $_GET['aksi'];

    if($page == "supplier") {
        if($aksi == "") {
            include "page/supplier/data_supplier.php";
        }
    }

    if($page == "product") {
        if($aksi == "") {
            include "page/product/data_product.php";
        }
    }

    if($page == "barangmasuk") {
        if($aksi == "") {
            include "page/barangmasuk/data_barangmasuk.php";
        }
    }

    if($page == "barangkeluar") {
        if($aksi == "") {
            include "page/barangkeluar/data_barangkeluar.php";
        }
    }

    if($page == "") {
            include "home.php";
    }
?>