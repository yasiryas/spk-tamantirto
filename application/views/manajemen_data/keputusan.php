<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pedukuhan</th>
                                        <th>Indikator Perhitungan</th>
                                        <th>Potensi</th>
                                        <th>Hasil Perhitungan Fuzzy</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1;
                                    foreach( $perhitungan_fuzzy as $fuzzy ): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $fuzzy['pedukuhan']; ?></td>
                                        <td>
                                            <ul>
                                                <?php foreach($fuzzy['indikator'] as $row_indikator) : ?>
                                                    <li><?= $row_indikator; ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </td>
                                        <td><?= $fuzzy['potensi_text']; ?></td>
                                        <td><?= $fuzzy['potensi_fuzzy']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
