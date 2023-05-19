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
                    <!-- Start Form Input User -->
                    <form method="post" name="proses" role="form">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>No Transaksi</label>
                            <input type="text" name="id_vendor" value="<?php echo $id_vendor?>" class="form-control"
                              readonly>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>Tanggal Keluar</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama Vendor"
                              name="nama_vendor">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>Supplier</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nomor Telepon"
                              name="telepon_vendor" onkeypress="return hanyaAngka(event)">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control" placeholder="Masukkan Contact Person"
                              name="cperson_vendor">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>Jumlah Barang Keluar</label>
                            <input type="text" class="form-control" placeholder="Masukkan Email" name="email_vendor">
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

            <div class="table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Transaksi</th>
                    <th>Tanggal Keluar</th>
                    <th>Supplier</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang Keluar</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>T-BK-001</td>
                    <td>19 Mei 2023</td>
                    <td>Refresh Komputer</td>
                    <td>Mouse</td>
                    <td>5</td>
                    <td>
                      <a href="?page=vendor&aksi=edit&id_vendor=<?php echo $row['id_vendor']?>" class="btn btn-success btn-flat" ><i class="fas fa-edit"></i></a>
                      <a onclick="return confirm('Apakah Anda Yakin Menghapus Data Ini ?')" href="?page=vendor&aksi=delete&id_vendor=<?php echo $row['id_vendor']?>" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>T-BK-002</td>
                    <td>19 Mei 2023</td>
                    <td>Refresh Komputer</td>
                    <td>Keyboard</td>
                    <td>10</td>
                    <td>
                      <a href="?page=vendor&aksi=edit&id_vendor=<?php echo $row['id_vendor']?>" class="btn btn-success btn-flat" ><i class="fas fa-edit"></i></a>
                      <a onclick="return confirm('Apakah Anda Yakin Menghapus Data Ini ?')" href="?page=vendor&aksi=delete&id_vendor=<?php echo $row['id_vendor']?>" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>