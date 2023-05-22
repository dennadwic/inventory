<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Data Barang Masuk</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Barang Masuk</li>
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
                  error_reporting(0);
                  include "koneksi.php";
                    $auto = mysqli_query($koneksi, "SELECT max(id_brgmasuk) AS max_code FROM tb_brgmasuk");
                    $row = mysqli_fetch_array($auto);
                    $code = $row['max_code'];
                    $urutan = (int) substr($code, 6,3);
                    $urutan++;
                    $huruf = "T-BM-";
                    $id_brgmasuk = $huruf.sprintf("%03s", $urutan);                    
                  ?>
                    <!-- Start Form Input User -->
                    <form method="post" name="proses" role="form">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>No Transaksi</label>
                            <input type="text" name="id_brgmasuk" value="<?php echo $id_brgmasuk?>" class="form-control"
                              readonly>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>Tanggal Masuk</label>
                            <input type="date" class="form-control" name="tglmasuk">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>Supplier</label>
                            <select class="form-control" name="id_vendor">
                            <option value="">--Pilih--</option>
                            <?php
                                $sql_product = mysqli_query($koneksi, "SELECT * FROM tb_vendor") or die (mysqli_error($koneksi));
                                while($data_product = mysqli_fetch_array($sql_product)) {
                                  echo '<option value="'.$data_product['id_vendor'].'">'.$data_product['nama_vendor'].'</option>';
                                }
                              ?>
                            </select>
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
                            <input type="text" class="form-control" placeholder="Masukkan Jumlah Barang Masuk" name="jumlahbrgmsk">
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
                $id_brgmasuk  = $_POST['id_brgmasuk'];
                $tglmasuk     = $_POST['tglmasuk'];
                $id_vendor    = $_POST['id_vendor'];
                $id_product   = $_POST['id_product'];
                $jumlahbrgmsk = $_POST['jumlahbrgmsk'];

                $cekstock = mysqli_query($koneksi, "select * from tb_product where id_product='$id_product'");
                $ambildata = mysqli_fetch_array($cekstock);

                $stocksekarang = $ambildata['stock'];
                $tambahstock = $stocksekarang+$jumlahbrgmsk;

                $sql = $koneksi->query("INSERT INTO tb_brgmasuk (id_brgmasuk, tglmasuk, id_vendor, id_product, jumlahbrgmsk)VALUES('$id_brgmasuk','$tglmasuk','$id_vendor','$id_product','$jumlahbrgmsk')");
                $updatestockmasuk = mysqli_query($koneksi, "update tb_product set stock='$tambahstock' where id_product='$id_product'");

                if($sql){
            ?>

            <script type="text/javascript">
              alert ("Data Berhasil Disimpan");
              window.location.href="?page=barangmasuk";
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
                    <th>Tanggal Masuk</th>
                    <th>Supplier</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang Masuk</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    $query = "SELECT * FROM tb_brgmasuk
                      INNER JOIN tb_vendor ON tb_brgmasuk.id_vendor = tb_vendor.id_vendor
                      INNER JOIN tb_product ON tb_brgmasuk.id_product = tb_product.id_product";
                    $sql_product = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
                    while($row = mysqli_fetch_array($sql_product)) {
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $row['id_brgmasuk'];?></td>
                    <td><?php echo $row['tglmasuk'];?></td>
                    <td><?php echo $row['nama_vendor'];?></td>
                    <td><?php echo $row['nama_product'];?></td>
                    <td><?php echo $row['jumlahbrgmsk'];?></td>
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