<?php
  $id_product = $_GET['id_product'];
  $sql = $koneksi->query("SELECT * FROM tb_product WHERE id_product='$id_product'");
  $row = $sql->fetch_assoc();

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Product</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Edit Product</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<div class="container-fluid">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Edit Product</h3>
        </div>
        <!-- /.card-header -->
        
        <!-- form start -->
        <form method="POST">
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Item Code</label>
                <input type="text" class="form-control" value="<?php echo $row['id_product'] ?>" name="id_product" readonly>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Name</label>
              <input type="text" class="form-control" value="<?php echo $row['nama_product'] ?>" name="nama_product">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Category</label>
              <select class="form-control" name="id_category">
                <option value="<?php echo $row['nama_category'] ?>" disabled>--Pilih--</option>
                <?php
                  $sql_category = mysqli_query($koneksi, "SELECT * FROM tb_category") or die (mysqli_error($koneksi));
                  while($data_category = mysqli_fetch_array($sql_category)) {
                    echo '<option value="'.$data_category['id_category'].'">'.$data_category['nama_category'].'</option>';
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Inventory Uom</label>
              <select class="form-control" name="id_satuan">
                <option value="<?php echo $row['nama_satuan'] ?>" disabled>--Pilih--</option>
                <?php
                  $sql_satuan = mysqli_query($koneksi, "SELECT * FROM tb_satuan") or die (mysqli_error($koneksi));
                  while($data_satuan = mysqli_fetch_array($sql_satuan)) {
                    echo '<option value="'.$data_satuan['id_satuan'].'">'.$data_satuan['nama_satuan'].'</option>';
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Stock</label>
              <input type="text" class="form-control" value="<?php echo $row['stock'] ?>" name="stock" disabled>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" name="update" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
      <!-- /.card -->
    </div>
  </div>
</div>

<?php
  if(isset($_POST['update'])) {
    $id_product   = $_POST['id_product'];
    $nama_product = $_POST['nama_product'];
    $id_category  = $_POST['id_category'];
    $id_satuan    = $_POST['id_satuan'];

    $sql = $koneksi->query("UPDATE tb_product SET nama_product='$nama_product', id_category='$id_category', id_satuan='$id_satuan' WHERE id_product='$id_product'");

    if($sql){
      ?>

        <script type="text/javascript">
          alert ("Data Berhasil Diubah");
          window.location.href="?page=product";
        </script>

      <?php
    }
  }
?>