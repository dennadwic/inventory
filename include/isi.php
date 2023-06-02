<?php
    $page = $_GET['page'];
    $aksi = $_GET['aksi'];

    if($page == "vendor") {
        if($aksi == "") {
            include "page/vendor/data_vendor.php";
        }
        if($aksi == "edit") {
            include "page/vendor/edit.php";
        }
        if($aksi == "delete") {
            include "page/vendor/delete.php";
        }
    }

    if($page == "product") {
        if($aksi == "") {
            include "page/product/data_product.php";
        }
        if($aksi == "edit") {
            include "page/product/edit.php";
        }
        if($aksi == "delete") {
            include "page/product/delete.php";
        }
    }

    if($page == "barangmasuk") {
        if($aksi == "") {
            include "page/barangmasuk/data_barangmasuk.php";
        }
        if($aksi == "delete") {
            include "page/barangmasuk/delete.php";
        }
    }

    if($page == "barangkeluar") {
        if($aksi == "") {
            include "page/barangkeluar/data_barangkeluar.php";
        }
        if($aksi == "export") {
            include "page/barangkeluar/exportbrgklr.php";
        }
        if($aksi == "print") {
            include "page/barangkeluar/print.php";
        }
    }

    if($page == "") {
        include "home.php";
    }
?>