<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<div class="row">
     <div class="col-lg-12">
          <?= $this->session->flashdata('message'); ?>
          <div class="card shadow mb-4" id="form-nilaicrip">
               <div class="card-header py-3">
                    <div class="row align-middle d-flex">
                         <h6 class="m-2 col-auto font-weight-bold text-primary" id="titleFormActionkategori">From Nilai CRIP</h6>
                    </div>
               </div>
               <div class="card-body">
                    <form method="POST" action="<?= base_url('manajemen_data/formNilaiCrip'); ?>">
                         <div class="row">
                              <?php 
                               if( !empty($data_nilaicrip) ) echo '<input type="hidden" name="id_nilaicrip" value="'.$data_nilaicrip['id_nilaicrip'].'">';
                          
                               foreach( $array_form as $key => $row_form ): 
                                    $val = $data_nilaicrip[$key] ?? ''; ?> 
                              
                              <div class="col-md-3">
                                   <div class="form-group">
                                        <div class="col-auto mb-2">
                                             <label for="<?= $row_form; ?>"><?= $row_form; ?></label>
                                             <input autocomplete="off" type="number" min="0" max="100" class="form-control"  name="<?= $key; ?>" value="<?= $val; ?>">
                                             <?= form_error($key, '<small class="text-danger pl-1">', '</small>'); ?>
                                        </div>
                                   </div>
                               </div>

                               <?php endforeach; ?>

                         </div> <!-- End Row -->

                         <div class="modal-footer mt-3">
                              <button class="col-auto ml-auto btn btn-primary btn-sm"  type="submit"><i class="fas fa-save"></i>&nbsp Save</button>
                         </div>
                    </form>
               </div>
          </div>

          <!-- /.container-fluid -->