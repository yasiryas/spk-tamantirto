<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h5>Rules</h5>
                    <table class="table table-bordered">
                        <thead>
                            <th>Indikator</th>
                            <th>Keterangan</th>
                        </thead>
                        <tbody>
                            <?php foreach($data_indikator as $row): ?>
                            <tr>
                                <td><?= $row['nama_indikator']; ?></td>
                                <td>Sangat Tinggi,Tinggi,Sedang,Rendah,Sangat Rendah</td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Fuzzifikasi</h5>
                            <div class="form">
                                <form id="frm-fuzzy" >
                                    <div class="form-group">
                                        <label>Sumber Daya Manusia (SDM)</label>
                                        <input type="number" value="0.8" class="form-control" id="sdm" name="sdm" step="any" min="0" max="1" required>
                                    </div>
                                    <div class="form-group">
                                        <lagit bel>Potensi Kelembagaan (KL)</label>
                                        <input type="number" value="0.7" class="form-control" id="kl" name="kl" step="any" min="0" max="1" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Sarana dan Prasarana (PSR)</label>
                                        <input type="number" value="0.6" class="form-control" id="psr" name="psr" step="any" min="0" max="1" required>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary">Hitung</button>
                                    </div>
                                </form>
                                <div class="catatan">
                                    <small><em>Catatan : untuk pengisian penulisan angka hanya bisa di input di range 0-1 (misal 0.1,0.2,1..dst)</em></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Hasil Perhitungan</h5>
                            <div class="hasil-fuzy"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {        
        $('#frm-fuzzy').on('submit', function(e) {
            e.preventDefault();
            let root = $(this);
            let sdm = root.find('#sdm').val();
            let kl = root.find('#kl').val();
            let psr = root.find('#psr').val();
            let data = {sdm,kl,psr};

            $.ajax({
                url: '<?= base_url('manajemen_data/hitungfuzzy')?>',
                type: 'POST',
                data:data,
                dataType: 'json',
                // contentType: 'application/json',
                beforeSend: function() {
                    root.find('button').hide();
                    $('.hasil-fuzy').html('<div class="spinner-border text-primary" role="status"></div>');
                },
                success: function(res) {       
                    root.find('button').show();

                    let html = `<p> Berdasarkan Perhitungan yang Di peroleh dengan Metode Fuzy Mamdani yang mengacu pada 3 Indikator Maka di didapatkan Hasil Sebagi Berikut :</p>`;
                        html +=`<table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>Desa Tamantirto meliliki Potensi : <strong>${res.hsl}</strong> </td>
                                </tr>
                            </thead>
                        </table>`;
                    
                    $('.hasil-fuzy').html(html);
                    
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        $('#frm-fuzzy').trigger('submit');

    });
</script>