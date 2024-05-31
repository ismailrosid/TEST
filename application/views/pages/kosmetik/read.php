<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Kosmetik</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <?php if (!empty($this->session->flashdata('success'))) { ?>
            <div class="alert alert-success" role="alert">
              <?= $this->session->flashdata('success');  ?>
            </div>
          <?php } ?>
          <div class="row mb-4">
            <div class="col-12">
              <a href="<?= site_url("kosmetik/create") ?>" class="btn btn-primary btn-sm">Tambah Kosmetik</a>
            </div>
          </div>
          <table id="example" class="display" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Merek</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Gambar</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($kosmetik as $key) { ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $key->merek_kosmetik; ?></td>
                  <td>Rp.<?= number_format($key->harga); ?></td>
                  <td><?= $key->stok; ?></td>
                  <td><img class="img-fluid" src="<?= base_url() ?>upload/<?= $key->gambar; ?>" alt=""></td>
                  <td>
                    <a href="<?= base_url() ?>kosmetik/update/<?= $key->id_kosmetik; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?= base_url() ?>kosmetik/delete/<?= $key->id_kosmetik; ?>" class="btn btn-danger btn-sm">Hapus</a>
                  </td>
                </tr>
              <?php
                $no++;
              } ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    </div>
  </div>
</div>