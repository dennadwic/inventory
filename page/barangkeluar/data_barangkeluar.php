<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Data Barang Keluar</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Barang Keluar</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <button class="btn btn-primary btn-round mr-auto" data-toggle="modal" data-target="#addRowModal">
              <i class="fa fa-plus"></i>
              Add Data
            </button>
          </div>

          <div class="card-body">
            <!-- Modal Insert -->
            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header no-bd">
                    <h5 class="modal-title">
                      <span class="fw-mediumbold">
                        Masukkan
                      </span>
                      <span class="fw-light">
                        Data
                      </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                  <?php
                  #error_reporting(0);
                  include "koneksi.php";
                    $auto = mysqli_query($koneksi, "SELECT max(id_brgkeluar) AS max_code FROM tb_brgkeluar");
                    $row = mysqli_fetch_array($auto);
                    $code = $row['max_code'];
                    $urutan = (int) substr($code, 6,3);
                    $urutan++;
                    $huruf = "T-BK-";
                    $id_brgkeluar = $huruf.sprintf("%03s", $urutan);                    
                  ?>
                    <!-- Start Form Input User -->
                    <form method="post" name="proses" role="form">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>No Transaksi</label>
                            <input type="text" name="id_brgkeluar" value="<?php echo $id_brgkeluar?>" class="form-control"
                              readonly>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>Tanggal Keluar</label>
                            <input type="date" class="form-control" name="tglkeluar">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>Nama Penerima</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama Penerima" name="nama_penerima">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>Nama Barang</label>
                            <select class="form-control" name="id_product">
                            <option value="">--Pilih--</option>
                            <?php
                                $sql_product = mysqli_query($koneksi, "SELECT * FROM tb_product") or die (mysqli_error($koneksi));
                                while($data_product = mysqli_fetch_array($sql_product)) {
                                  echo '<option value="'.$data_product['id_product'].'">'.$data_product['nama_product'].'</option>';
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>Jumlah Barang Masuk</label>
                            <input type="text" class="form-control" placeholder="Masukkan Jumlah Barang Keluar" name="jumlahbrgklr">
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer no-bd">
                        <input type="submit" class="btn btn-primary" value="Simpan" name="simpan">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <?php
              if(isset($_POST['simpan'])) {
                $id_brgkeluar  = $_POST['id_brgkeluar'];
                $tglkeluar     = $_POST['tglkeluar'];
                $nama_penerima = $_POST['nama_penerima'];
                $id_product    = $_POST['id_product'];
                $jumlahbrgklr  = $_POST['jumlahbrgklr'];

                $cekstock = mysqli_query($koneksi, "select * from tb_product where id_product='$id_product'");
                $ambildata = mysqli_fetch_array($cekstock);

                $stocksekarang = $ambildata['stock'];
                $kurangstock = $stocksekarang-$jumlahbrgklr;

                $sql = $koneksi->query("INSERT INTO tb_brgkeluar (id_brgkeluar, tglkeluar, nama_penerima, id_product, jumlahbrgklr)VALUES('$id_brgkeluar','$tglkeluar','$nama_penerima','$id_product','$jumlahbrgklr')");
                $updatestockkeluar = mysqli_query($koneksi, "update tb_product set stock='$kurangstock' where id_product='$id_product'");

                if($sql){
            ?>

            <script type="text/javascript">
              alert ("Data Berhasil Disimpan");
              window.location.href="?page=barangkeluar";
            </script>
            
            <?php
                }
              }
            ?>

            <div class="table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Transaksi</th>
                    <th>Tanggal Keluar</th>
                    <th>Nama Penerima</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang Keluar</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    $query = "SELECT * FROM tb_brgkeluar
                      INNER JOIN tb_product ON tb_brgkeluar.id_product = tb_product.id_product";
                    $sql_product = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
                    while($row = mysqli_fetch_array($sql_product)) {
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $row['id_brgkeluar'];?></td>
                    <td><?php echo $row['tglkeluar'];?></td>
                    <td><?php echo $row['nama_penerima'];?></td>
                    <td><?php echo $row['nama_product'];?></td>
                    <td><?php echo $row['jumlahbrgklr'];?></td>
                    <td>
                      <a onclick="return confirm('Apakah Anda Yakin Menghapus Data Ini ?')" href="?page=product&aksi=delete&id_product=<?php echo $row['id_product']?>" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></a>
                    </td>
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
  </div>
</section>