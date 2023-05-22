<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Manage Product</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Product</li>
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
                    $auto = mysqli_query($koneksi, "SELECT max(id_product) AS max_code FROM tb_product");
                    $row = mysqli_fetch_array($auto);
                    $code = $row['max_code'];
                    $urutan = (int) substr($code, 2,3);
                    $urutan++;
                    $huruf = "PR";
                    $id_product = $huruf.sprintf("%03s", $urutan);
                  ?>
                    <!-- Start Form Input User -->
                    <form method="post" name="proses" role="form">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>ID Product</label>
                            <input type="text" name="id_product" value="<?php echo $id_product?>" class="form-control"
                              readonly>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>Nama Product</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama Product" name="nama_product">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>Category</label>
                            <select class="form-control" name="id_category">
                            <option value="">--Pilih--</option>
                            <?php
                                $sql_jenis = mysqli_query($koneksi, "SELECT * FROM tb_category") or die (mysqli_error($koneksi));
                                while($data_jenis = mysqli_fetch_array($sql_jenis)) {
                                  echo '<option value="'.$data_jenis['id_category'].'">'.$data_jenis['nama_category'].'</option>';
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>Inventory Uom</label>
                            <select class="form-control" name="id_satuan">
                            <option value="">--Pilih--</option>
                              <?php
                                $sql_satuan = mysqli_query($koneksi, "SELECT * FROM tb_satuan") or die (mysqli_error($koneksi));
                                while($data_satuan = mysqli_fetch_array($sql_satuan)) {
                                  echo '<option value="'.$data_satuan['id_satuan'].'">'.$data_satuan['nama_satuan'].'</option>';
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>Stock</label>
                            <input type="text" class="form-control" placeholder="Masukkan Stock" name="stock" onkeypress="return hanyaAngka(event)">
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
                $id_product = $_POST['id_product'];
                $nama_product = $_POST['nama_product'];
                $id_category = $_POST['id_category'];
                $id_satuan = $_POST['id_satuan'];
                $stock = $_POST['stock'];

                $sql = $koneksi->query("INSERT INTO tb_product (id_product, nama_product, id_category, id_satuan, stock)VALUES('$id_product','$nama_product','$id_category','$id_satuan','$stock')");

                if($sql){
            ?>

            <script type="text/javascript">
              alert ("Data Berhasil Disimpan");
              window.location.href="?page=product";
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
                    <th>ID Product</th>
                    <th>Nama Product</th>
                    <th>Category</th>
                    <th>Inventory Uom</th>
                    <th>Stock</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no = 1;
                    $query = "SELECT * FROM tb_product
                      INNER JOIN tb_category ON tb_product.id_category = tb_category.id_category
                      INNER JOIN tb_satuan ON tb_product.id_satuan = tb_satuan.id_satuan";
                    $sql_product = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
                    while($row = mysqli_fetch_array($sql_product)) {
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $row['id_product'];?></td>
                    <td><?php echo $row['nama_product'];?></td>
                    <td><?php echo $row['nama_category'];?></td>
                    <td><?php echo $row['nama_satuan'];?></td>
                    <td><?php echo $row['stock'];?></td>
                    <td>
                      <a href="?page=product&aksi=edit&id_product=<?php echo $row['id_product']?>" class="btn btn-success btn-flat" ><i class="fas fa-edit"></i></a>
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