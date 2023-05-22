<?php
    $id_product = $_GET['id_product'];
    $sql=$koneksi->query("DELETE from tb_product WHERE id_product='$id_product'");

    if ($sql) {
        ?>
        <script type="text/javascript">
        alert ("Data Berhasil Dihapus");
        window.location.href="?page=product";
      </script>
      <?php
    }
?>