<?php
  session_start();
  if (!isset($_SESSION['id_user'])){
    header("Location: login.php");
  }

  include "include/koneksi.php";
  $sessioname   = $_SESSION['id_user'];
  $sql          = "SELECT * FROM tb_vendor";
  $data1        = mysqli_query($koneksi, $sql);
  $vendor       = mysqli_num_rows($data1);

  $sessioname   = $_SESSION['id_user'];
  $sql          = "SELECT * FROM tb_product";
  $data2        = mysqli_query($koneksi, $sql);
  $product      = mysqli_num_rows($data2);

  $sessioname   = $_SESSION['id_user'];
  $sql          = "SELECT * FROM tb_brgmasuk";
  $data3        = mysqli_query($koneksi, $sql);
  $barangmasuk  = mysqli_num_rows($data3);

  $sessioname   = $_SESSION['id_user'];
  $sql          = "SELECT * FROM tb_brgkeluar";
  $data4        = mysqli_query($koneksi, $sql);
  $barangkeluar = mysqli_num_rows($data4);
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info" style="padding-bottom: 30px;">
          <div class="inner">
            <h3><?php echo $vendor ?></h3>
            <p>Total Data Barang</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="index.php?page=vendor" class="small-box-footer" style="top: 30px;">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success" style="padding-bottom: 30px;">
          <div class="inner">
            <h3><?php echo $product ?></h3>
            <p>Data Supplier</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="index.php?page=product" class="small-box-footer" style="top: 30px;">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning" style="padding-bottom: 30px;">
          <div class="inner">
            <h3><?php echo $barangmasuk ?></h3>
            <p>Barang Masuk</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="index.php?page=barangmasuk" class="small-box-footer" style="top: 30px;">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger" style="padding-bottom: 30px;">
          <div class="inner">
            <h3><?php echo $barangkeluar ?></h3>
            <p>Barang Keluar</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="index.php?page=barangkeluar" class="small-box-footer" style="top: 30px;">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-4 col-6">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Stok Barang Minimun</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Barang</th>
                  <th>Stock</th>
                </tr>
              </thead>
              <tbody>
              <?php
                  $no = 1;
                  $query = "SELECT * FROM tb_product WHERE stock <=5";
                  $sql_product = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
                  while($row = mysqli_fetch_array($sql_product)) {
                ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['nama_product']; ?></td>
                    <td><?php echo $row['stock']; ?></td>
                  </tr>
                  <?php
                  }
                  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Transaksi Terakhir Data Barang Masuk Hari ini</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Barang</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no = 1;
                  $query = "SELECT * FROM tb_brgmasuk
                      INNER JOIN tb_vendor ON tb_brgmasuk.id_vendor = tb_vendor.id_vendor
                      INNER JOIN tb_product ON tb_brgmasuk.id_product = tb_product.id_product
                      WHERE tglmasuk = curdate()";
                  $sql_product = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
                  while ($row = mysqli_fetch_array($sql_product)) 
                  {
                   $id_product = $row['id_product']
                ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['tglmasuk']; ?></td>
                    <td><?php echo $row['nama_product']; ?></td>
                    <td><?php echo $row['jumlahbrgmsk']; ?></td>
                  </tr>
                  <?php
                  }
                  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Transaksi Terakhir Data Barang Keluar Hari ini</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Barang</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    $no = 1;
                    $query = "SELECT * FROM tb_brgkeluar
                      INNER JOIN tb_product ON tb_brgkeluar.id_product = tb_product.id_product
                      WHERE tglkeluar = curdate()";
                    $sql_product = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
                    while($row = mysqli_fetch_array($sql_product)) {
                ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $row['tglkeluar'];?></td>
                    <td><?php echo $row['nama_product'];?></td>
                    <td><?php echo $row['jumlahbrgklr'];?></td>
                  </tr>
                  <?php
                    }
                  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>