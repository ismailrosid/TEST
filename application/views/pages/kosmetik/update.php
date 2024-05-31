<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Default box -->
            <form enctype="multipart/form-data" action="<?= site_url("kosmetik/updateSave") ?>" method="post">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Update Kosmetik</h3>
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
                        <?php if (!empty(validation_errors())) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?= validation_errors(); ?>
                            </div>
                        <?php } ?>
                        <div class="mb-2">
                            <label for="merek" class="form-label">Merek Kosmetik</label>
                            <input value="<?= $kosmetik->merek_kosmetik; ?>" name="merek" type="text" class="form-control form-control-sm" id="merek" placeholder="Masukan Merek">
                        </div>
                        <div class="mb-2">
                            <label for="harga" class="form-label">Harga</label>
                            <input value="<?= $kosmetik->harga; ?>" name="harga" type="number" class="form-control form-control-sm" id="harga" placeholder="Masukan Harga">
                        </div>
                        <div class="mb-2">
                            <label for="stok" class="form-label">Stok</label>
                            <input value="<?= $kosmetik->stok; ?>" name="stok" type="number" class="form-control form-control-sm" id="stok" placeholder="Masukan Harga">
                        </div>
                        <div>
                            <label for="stok" class="form-label">Gambar</label>
                        </div>
                        <div class="input-group mb-2 input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input name="gambar" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">Pilih file</label>
                            </div>
                        </div>
                        <input name="id" type="hidden" value="<?= $kosmetik->id_kosmetik; ?>">
                        <input name="gambar" type="hidden" value="<?= $kosmetik->gambar; ?>">
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-warning btn-sm">Batal</button>
                            <button style="margin-left: 5px;" class="btn btn-success btn-sm">Simpan</button>
                        </div>
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->
            </form>

        </div>
    </div>
</div>