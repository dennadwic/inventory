<?php
  $id_vendor = $_GET['id_vendor'];
  $sql = $koneksi->query("SELECT * FROM tb_vendor WHERE id_vendor='$id_vendor'");
  $row = $sql->fetch_assoc();

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>DataTables</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Add Departement</li>
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
          <h3 class="card-title">Tambah Data Departement</h3>
        </div>
        <!-- /.card-header -->
        
        <!-- form start -->
        <form method="POST">
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">ID Vendor</label>
                <input type="text" class="form-control" value="<?php echo $row['id_vendor'] ?>" name="id_vendor" readonly>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Nama Vendor</label>
              <input type="text" class="form-control" value="<?php echo $row['nama_vendor'] ?>" name="nama_vendor">
            </div>
            <div class="form-group">
              <div class="form-group form-group-default">
                <label>Telepon</label>
                <input type="text" class="form-control" value="<?php echo $row['telepon_vendor'] ?>" name="telepon_vendor">
              </div>
            </div>
            <div class="form-group">
              <div class="form-group form-group-default">
                <label>Contact Person</label>
                <input type="text" class="form-control" value="<?php echo $row['cperson_vendor'] ?>" name="cperson_vendor">
              </div>
            </div>
            <div class="form-group">
              <div class="form-group form-group-default">
                <label>Email</label>
                <input type="text" class="form-control" value="<?php echo $row['email_vendor'] ?>" name="email_vendor">
              </div>
            </div>
            <div class="form-group">
              <div class="form-group">
               <label>Alamat</label>
                <textarea class="form-control" rows="3" name="alamat_vendor"><?php echo $row['alamat_vendor'] ?></textarea>
              </div>
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
    $id_vendor = $_POST['id_vendor'];
    $nama_vendor = $_POST['nama_vendor'];
    $telepon_vendor = $_POST['telepon_vendor'];
    $cperson_vendor = $_POST['cperson_vendor'];
    $email_vendor = $_POST['email_vendor'];
    $alamat_vendor = $_POST['alamat_vendor'];
    

    $sql = $koneksi->query("UPDATE tb_vendor SET nama_vendor='$nama_vendor', telepon_vendor='$telepon_vendor', cperson_vendor='$cperson_vendor', email_vendor='$email_vendor', alamat_vendor='$alamat_vendor' WHERE id_vendor='$id_vendor'");

    if($sql){
      ?>

        <script type="text/javascript">
          alert ("Data Berhasil Diubah");
          window.location.href="?page=vendor";
        </script>

      <?php
    }
  }
?>