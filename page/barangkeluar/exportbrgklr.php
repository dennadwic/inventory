<section class="content mt-6">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="callout callout-info" style="border-top-width: 0px;border-top-style: solid;margin-top: 20px;">
          <h5>Transaksi Bahan : Masuk / Kembali</h5>
        </div>

        <div class="invoice p-3 mb-3">
          <div class="col-12 table-rensponsive">   
            <table class="table table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Nama Barang</th>
                  <th>Jenis</th>
                  <th>Merk</th>
                  <th>Ukuran</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  include "koneksi.php";
                  $no = 1;
                  $query = "SELECT * FROM tb_brgkeluar
                    INNER JOIN tb_product ON tb_brgkeluar.id_product = tb_product.id_product";
                  $sql_product = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
                    while($row = mysqli_fetch_array($sql_product)) {
                ?>

                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php $tanggals=$row['tglkeluar']; echo date("d-M-Y", strtotime($tanggals)) ?></td>
                  <td><?php echo $row['id_brgkeluar'] ?></td>
                  <td><?php echo $row['tglkeluar'] ?></td>
                  <td><?php echo $row['nama_penerima'] ?></td>
                  <td><?php echo $row['nama_product'] ?></td>
                  <td><?php echo $row['jumlahbrgklr'] ?></td>
                </tr>
                <?php 
                  }
                ?>
              </tbody>
            </table>

            <div class="row no-print">
                <div class="col-12">
                  <a href="?page=barangkeluar&aksi=print&print" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>