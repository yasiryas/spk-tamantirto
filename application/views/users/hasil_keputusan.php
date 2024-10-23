         <div class="container-fluid">

              <!-- Page Heading -->
              <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
              <div class="row">
                   <div class="col-lg-12">
                        <div class="card shadow mb-4">
                             <div class="card-header py-3">
                                  <div class="row align-middle d-flex">
                                       <h6 class="m-2 col-auto font-weight-bold text-primary">Hasil Perhitungan</h6>
                                  </div>
                             </div>
                             <div class="card-body">
                                  <div class="table-responsive">
                                       <table class="#" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                 <tr>
                                                      <td></td>
                                                 </tr>
                                            </thead>
                                            <tbody">
                                                 <tr>
                                                      <td>
                                                           <div class="card mb-3">
                                                                <div class="card-body">
                                                                     <h5 class="card-title">Special title treatment</h5>
                                                                     <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                                     <a href="#" class="btn btn-primary">Go somewhere</a>
                                                                </div>
                                                           </div>
                                                      </td>
                                                 </tr>
                                                 <tr>
                                                      <td>
                                                           <div class="card mb-3">
                                                                <div class="card-body">
                                                                     <h5 class="card-title">Card title</h5>
                                                                     <p class="card-text">This is another card with title and supporting text below. This card has some additional content to make it slightly taller overall.</p>
                                                                     <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                                                </div>
                                                           </div>
                                                      </td>
                                                 </tr>
                                                 <tr>
                                                      <td>
                                                           <div class="card mb-3">
                                                                <div class="card-body">
                                                                     <h5 class="card-title">Card title</h5>
                                                                     <p class="card-text">This is another card with title and supporting text below. This card has some additional content to make it slightly taller overall.</p>
                                                                     <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                                                </div>
                                                           </div>
                                                      </td>
                                                 </tr>
                                                 </tbody>
                                  </div>
                             </div>
                        </div>

                        <!-- Modal Hapus Padukuha -->
                        <div class="modal fade" id="modalHapusPadukuhan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                             <div class="modal-dialog">
                                  <div class="modal-content">
                                       <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Padukuhan</h5>
                                            <button type="button" class="close  closeHapusPadukuhan" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                            </button>
                                       </div>
                                       <form action="<?= base_url('manajemen_data/hapus_padukuhan'); ?>" method="POST">
                                            <div class="modal-body">
                                                 Apakah kamu yakin mau menghapus padukuhan ini?
                                                 <input name="idPadukuhan" id="idPadukuhan" type="hidden" value="id">
                                            </div>
                                            <div class="modal-footer">
                                                 <button type="submit" class="btn btn-danger">Delete</button>
                                                 <button type="button" class="btn btn-secondary closeHapusPadukuhan" data-dismiss="modal">Close</button>
                                            </div>
                                       </form>
                                  </div>
                             </div>
                        </div>

                        <!-- Modal Ubah Padukuhan-->
                        <div id="modalUbahPadukuhan" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                             <div class="modal-dialog">
                                  <div class="modal-content">
                                       <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Padukuhan</h5>
                                            <button type="button" class="close closeUbahPadukuhan" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                            </button>
                                       </div>
                                       <form action="<?= base_url('manajemen_data/update_padukuhan'); ?>" method="POST">
                                            <div class="modal-body">
                                                 <input name="idUpdatePadukuhan" id="idUpdatePadukuhan" type="hidden" value="">
                                                 <div class="form-group">
                                                      <label for="ubahNamaPadukuhan">Nama Padukuhan</label>
                                                      <input type="text" class="form-control" id="ubahNamaPadukuhan" name="ubahNamaPadukuhan" value="<?= set_value('ubahNamaPadukuhan'); ?>">
                                                      <?= $this->session->flashdata('message-update-padukuhan'); ?>
                                                      <div id="errorNamaPadukuhan" class="invalid-feedback ml-1"></div>
                                                 </div>
                                            </div>
                                            <div class="modal-footer">
                                                 <button type="button" class="btn btn-secondary closeUbahPadukuhan" data-dismiss="modal">Close</button>
                                                 <button type="submit" class="btn btn-primary" id="btnUpdatePadukuhan">Update</button>
                                            </div>
                                       </form>
                                  </div>
                             </div>
                        </div>
                        <!-- /.container-fluid -->