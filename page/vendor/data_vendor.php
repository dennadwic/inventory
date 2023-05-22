<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Manage Vendor</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Vendor</li>
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
                      $auto = mysqli_query($koneksi, "SELECT max(id_vendor) AS max_code FROM tb_vendor");
                      $row = mysqli_fetch_array($auto);
                      $code = $row['max_code'];
                      $urutan = (int) substr($code, 2, 3);
                      $urutan++;
                      $huruf = "V";
                      $id_vendor = $huruf.sprintf("%03s", $urutan);
                    ?>
                    <!-- Start Form Input User -->
                    <form method="post" name="proses" role="form">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>ID Vendor</label>
                            <input type="text" name="id_vendor" value="<?php echo $id_vendor?>" class="form-control"
                              readonly>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>Nama Vendor</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama Vendor"
                              name="nama_vendor">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>Telepon</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nomor Telepon"
                              name="telepon_vendor" onkeypress="return hanyaAngka(event)">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>Contact Person</label>
                            <input type="text" class="form-control" placeholder="Masukkan Contact Person"
                              name="cperson_vendor">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>Email</label>
                            <input type="text" class="form-control" placeholder="Masukkan Email" name="email_vendor">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" rows="3" placeholder="Masukkan Alamat Vendor"
                              name="alamat_vendor"></textarea>
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
                $id_vendor = $_POST['id_vendor'];
                $nama_vendor = $_POST['nama_vendor'];
                $telepon_vendor = $_POST['telepon_vendor'];
                $cperson_vendor = $_POST['cperson_vendor'];
                $email_vendor = $_POST['email_vendor'];
                $alamat_vendor = $_POST['alamat_vendor'];

                $sql = $koneksi->query("INSERT INTO tb_vendor (id_vendor, nama_vendor,  telepon_vendor, cperson_vendor, email_vendor, alamat_vendor)VALUES('$id_vendor','$nama_vendor','$telepon_vendor','$cperson_vendor','$email_vendor','$alamat_vendor')");

                if($sql){
            ?>

            <script type="text/javascript">
              alert ("Data Berhasil Disimpan");
              window.location.href="?page=vendor";
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
                    <th>ID Vendor</th>
                    <th>Nama Vendor</th>
                    <th>Telepon</th>
                    <th>Contact Person</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no = 1;
                    $query = "SELECT * FROM tb_vendor";
                    $sql_user = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
                    while($row = mysqli_fetch_array($sql_user)) {
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $row['id_vendor'];?></td>
                    <td><?php echo $row['nama_vendor'];?></td>
                    <td><?php echo $row['telepon_vendor'];?></td>
                    <td><?php echo $row['cperson_vendor'];?></td>
                    <td><?php echo $row['email_vendor'];?></td>
                    <td><?php echo $row['alamat_vendor'];?></td>
                    <td>
                      <a href="?page=vendor&aksi=edit&id_vendor=<?php echo $row['id_vendor']?>" class="btn btn-success btn-flat" ><i class="fas fa-edit"></i></a>
                      <a onclick="return confirm('Apakah Anda Yakin Menghapus Data Ini ?')" href="?page=vendor&aksi=delete&id_vendor=<?php echo $row['id_vendor']?>" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></a>
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