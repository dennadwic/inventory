<?php
    $id_vendor = $_GET['id_vendor'];
    $sql=$koneksi->query("DELETE FROM tb_vendor WHERE id_vendor='$id_vendor'");

    if ($sql) {
        ?>
        <script type="text/javascript">
        alert ("Data Berhasil Dihapus");
        window.location.href="?page=vendor";
      </script>
      <?php
    }
?>