         <div class="container-fluid">

              <!-- Page Heading -->
              <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
              <div class="row">
                   <div class="col-lg-12">
                        <?= $this->session->flashdata('message'); ?>
                        <div class="card shadow mb-4" id="form-tambah-indikator">
                             <div class="card-header py-3">
                                  <div class="row align-middle d-flex">
                                       <h6 class="m-2 col-auto font-weight-bold text-primary" id="titleFormActionindikator">Tambah indikator</h6>
                                  </div>
                             </div>
                             <div class="card-body">
                                  <form action="<?= base_url('manajemen_data/tambah_indikator'); ?>" method="post">
                                       <!-- <div class="form-row align-items-top"> -->
                                       <div class="form-group">
                                            <div class="col-auto mb-2">
                                                 <label for="nama_indikator">Nama indikator</label>
                                                 <input type="text" class="form-control" id="nama_indikator" name="nama_indikator" value="<?= set_value('nama_indikator'); ?>">
                                                 <?= form_error('nama_indikator', '<small class="text-danger pl-1">', '</small>'); ?>
                                            </div>
                                       </div>
                                       <div class="form-group">
                                             <div class="col-auto mb-2">
                                                  <label for="nama_indikator">Key Indikator</label>
                                                  <input type="text" value="<?= set_value('key_indikator'); ?>" maxlength="8" class="form-control" name="key_indikator" placeholder="Isi dengan Kode misal : (SDM) inisial dari Sumber Daya Manusia">
                                                  <?= form_error('key_indikator', '<small class="text-danger pl-1">', '</small>'); ?>
                                             </div>
                                       </div>
                                       <!-- Range Nilai -->
                                       <div class="form-group">
                                             <div class="col-auto mb-2">
                                                  <label for="rendah">Rendah</label>
                                                  <input type="text" value="<?= set_value('rendah'); ?>" maxlength="8" class="form-control" name="rendah" placeholder="Range nilai rendah Ex: 0-30">
                                                  <?= form_error('rendah', '<small class="text-danger pl-1">', '</small>'); ?>
                                             </div>
                                       </div>
                                       <div class="form-group">
                                             <div class="col-auto mb-2">
                                                  <label>Sedang</label>
                                                  <input type="text" value="<?= set_value('sedang'); ?>" maxlength="8" class="form-control" name="sedang" placeholder="Range nilai sedang Ex: 0-30">
                                                  <?= form_error('sedang', '<small class="text-danger pl-1">', '</small>'); ?>
                                             </div>
                                       </div>
                                       <div class="form-group">
                                             <div class="col-auto mb-2">
                                                  <label>Tinggi</label>
                                                  <input type="text" value="<?= set_value('tinggi'); ?>" maxlength="8" class="form-control" name="tinggi" placeholder="Range nilai tinggi Ex: 0-30">
                                                  <?= form_error('tinggi', '<small class="text-danger pl-1">', '</small>'); ?>
                                             </div>
                                       </div>
                                        <!-- End Range Nilai -->

                                       <div class="modal-footer mt-3">
                                            <button class="col-auto ml-auto btn btn-primary btn-sm" id="btnAddindikator" type="submit"><i class="fas fa-save"></i>&nbsp Save</button>
                                       </div>
                                  </form>
                             </div>
                        </div>
                        <div class="card shadow mb-4" id="form-ubah-indikator" style="display: none">
                             <div class="card-header py-3">
                                  <div class="row align-middle d-flex">
                                       <h6 class="m-2 col-auto font-weight-bold text-primary" id="titleFormActionindikator">Ubah indikator</h6>
                                  </div>
                             </div>
                             <div class="card-body">
                                  <form action="<?= base_url('manajemen_data/update_indikator'); ?>" method="post">
                                       <!-- <div class="form-row align-items-top"> -->
                                       <div class="form-group">
                                            <div class="col-auto mb-2">
                                                 <label for="nama_indikator">Nama indikator</label>
                                                 <input type="hidden" class="form-control" id="idUpdateindikator" name="id_indikator" value="<?= set_value('id_indikator'); ?>">
                                                 <input type="text" class="form-control" id="namaUpdateindikator" name="ubah_nama_indikator" value="<?= set_value('ubah_nama_indikator'); ?>">
                                                 <?= form_error('ubah_nama_indikator', '<small class="text-danger pl-1" id="errorUbahindikator" value="1">', '</small>'); ?>
                                            </div>
                                       </div>
                                       <div class="form-group">
                                             <div class="col-auto mb-2">
                                                  <label for="nama_indikator">Key Indikator</label>
                                                  <input value="<?= set_value('ubah_key_indikator'); ?>" type="text" maxlength="8" class="form-control" name="ubah_key_indikator" placeholder="Isi dengan Kode misal : (SDM) inisial dari Sumber Daya Manusia">
                                                  <?= form_error('ubah_key_indikator', '<small class="text-danger pl-1">', '</small>'); ?>
                                             </div>
                                       </div>

                                       <!-- Range Nilai -->
                                       <div class="form-group">
                                             <div class="col-auto mb-2">
                                                  <label for="rendah">Rendah</label>
                                                  <input type="text" value="<?= set_value('ubah_rendah'); ?>" maxlength="8" class="form-control" name="ubah_rendah" placeholder="Range nilai rendah Ex: 0-30">
                                                  <?= form_error('ubah_rendah', '<small class="text-danger pl-1">', '</small>'); ?>
                                             </div>
                                       </div>
                                       <div class="form-group">
                                             <div class="col-auto mb-2">
                                                  <label>Sedang</label>
                                                  <input type="text" value="<?= set_value('ubah_sedang'); ?>" maxlength="8" class="form-control" name="ubah_sedang" placeholder="Range nilai sedang Ex: 0-30">
                                                  <?= form_error('ubah_sedang', '<small class="text-danger pl-1">', '</small>'); ?>
                                             </div>
                                       </div>
                                       <div class="form-group">
                                             <div class="col-auto mb-2">
                                                  <label>Tinggi</label>
                                                  <input type="text" value="<?= set_value('ubah_tinggi'); ?>" maxlength="8" class="form-control" name="ubah_tinggi" placeholder="Range nilai tinggi Ex: 0-30">
                                                  <?= form_error('ubah_tinggi', '<small class="text-danger pl-1">', '</small>'); ?>
                                             </div>
                                       </div>
                                        <!-- End Range Nilai -->

                                       <div class="modal-footer mt-3">
                                            <div class="nav justify-content-end">
                                                 <a class="col-auto ml-auto btn btn-danger btn-sm closeUbahindikator" id="btnCloseUpdateindikator"><i class="fas fa-times"></i>&nbsp Close</a>
                                                 <button class="col-auto ml-2 btn btn-primary btn-sm" id="btnUpdateindikator" type="submit"><i class="fas fa-save"></i>&nbsp Save</button>
                                            </div>
                                       </div>
                                  </form>
                             </div>
                        </div>
                        <div class="card shadow mb-4">
                             <div class="card-header py-3">
                                  <div class="row align-middle d-flex">
                                       <h6 class="m-2 col-auto font-weight-bold text-primary">Data indikator</h6>
                                  </div>
                             </div>
                             <div class="card-body">
                                  <div class="table-responsive">
                                       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                 <tr>
                                                      <td>No</td>
                                                      <td>Nama indikator</td>
                                                      <td>Key Indikator</td>
                                                      <td>Rendah</td>
                                                      <td>Sedang</td>
                                                      <td>Tinggi</td>
                                                      <td>Aksi</td>
                                                 </tr>
                                            </thead>
                                            <tbody>
                                                 <?php $i = 1; ?>
                                                 <?php foreach ($data_indikator as $dk) : 
                                                       $items_range = [
                                                            'rendah' => $dk['rendah'] ?? '',
                                                            'sedang' => $dk['sedang'] ?? '',
                                                            'tinggi' => $dk['tinggi'] ?? '',
                                                       ];
                                                  ?>
                                                      <tr>
                                                           <td><?= $i++ ?></td>
                                                           <td><?= $dk['nama_indikator']; ?></td>
                                                           <td><?= $dk['key_indikator']; ?></td>
                                                           <td><?= $dk['rendah'] ?? ''; ?></td>
                                                           <td><?= $dk['sedang'] ?? ''; ?></td>
                                                           <td><?= $dk['tinggi'] ?? ''; ?></td>
                                                           <td>
                                                                <a href="#" class="btn btn-warning btn-sm mb-1 btnUbahindikator" id="btnUbahindikator" data-range='<?= json_encode($items_range); ?>' data-toggle="modal" data-key-indikator="<?= $dk['key_indikator']; ?>" data-id-indikator="<?= $dk['id_indikator']; ?>" data-nama-indikator="<?= $dk['nama_indikator']; ?>"><i class="fas fa-edit"> </i>&nbsp Ubah</a>
                                                                <a href="#" class="btn btn-danger btn-sm mb-1 btnHapusindikator" id="btnHapusindikator" data-toggle="modal" data-target="#modalHapusindikator" data-id-indikator="<?= $dk['id_indikator']; ?>" data-name="<?= $dk['nama_indikator']; ?>"> <i class="fas fa-trash"></i>&nbsp Hapus</a>
                                                           </td>
                                                      </tr>
                                                 <?php endforeach; ?>
                                            </tbody>
                                  </div>
                             </div>
                        </div>

                        <!-- Modal Hapus Padukuha -->
                        <div class="modal fade" id="modalHapusindikator" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                             <div class="modal-dialog">
                                  <div class="modal-content">
                                       <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus indikator</h5>
                                            <button type="button" class="close  closeHapusindikator" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                            </button>
                                       </div>
                                       <form action="<?= base_url('manajemen_data/hapus_indikator'); ?>" method="POST">
                                            <div class="modal-body">
                                                 Apakah kamu yakin mau menghapus indikator ini?
                                                 <input name="idindikator" id="idindikator" type="hidden" value="id">
                                            </div>
                                            <div class="modal-footer">
                                                 <button type="submit" class="btn btn-danger">Delete</button>
                                                 <button type="button" class="btn btn-secondary closeHapusindikator" data-dismiss="modal">Close</button>
                                            </div>
                                       </form>
                                  </div>
                             </div>
                        </div>

                        <!-- Modal Ubah indikator-->
                        <div id="modalUbahindikator" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                             <div class="modal-dialog">
                                  <div class="modal-content">
                                       <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data indikator</h5>
                                            <button type="button" class="close closeUbahindikator" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                            </button>
                                       </div>
                                       <form action="<?= base_url('manajemen_data/update_indikator'); ?>" method="POST">
                                            <div class="modal-body">
                                                 <input name="idUpdateindikator" id="idUpdateindikator" type="hidden" value="">
                                                 <div class="form-group">
                                                      <label for="ubahNamaindikator">Nama indikator</label>
                                                      <input type="text" class="form-control" id="ubahNamaindikator" name="ubahNamaindikator" value="<?= set_value('ubahNamaindikator'); ?>">
                                                      <?= $this->session->flashdata('message-update-indikator'); ?>
                                                      <div id="errorNamaindikator" class="invalid-feedback ml-1"></div>
                                                 </div>
                                            </div>
                                            <div class="modal-footer">
                                                 <button type="button" class="btn btn-secondary closeUbahindikator" data-dismiss="modal">Close</button>
                                                 <button type="submit" class="btn btn-primary" id="btnUpdateindikator">Update</button>
                                            </div>
                                       </form>
                                  </div>
                             </div>
                        </div>
                        <!-- /.container-fluid -->