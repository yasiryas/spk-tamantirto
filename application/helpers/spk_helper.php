<?php 
// Fungsi keanggotaan segitiga
function membership_triangle($x, $a, $b, $c) {
    if ($x <= $a || $x >= $c) {
        return 0;
    } elseif ($x >= $b) {
        return ($c - $x) / ($c - $b);
    } else {
        return ($x - $a) / ($b - $a);
    }
}

function fuzymamdani( $sdm,$kl,$psr ){
  // Aturan fuzzy
  $rules = [
    ['KT' => 'sangat_tinggi', 'KA' => 'sangat_tinggi', 'KI' => 'sangat_tinggi', 'PD' => 'sangat_tinggi'],
    ['KT' => 'tingggi', 'KA' => 'tinggi', 'KI' => 'tinggi', 'PD' => 'tinggi'],
    ['KT' => 'sedang', 'KA' => 'sedang', 'KI' => 'sedang', 'PD' => 'sedang'],
    ['KT' => 'rendah', 'KA' => 'rendah', 'KI' => 'rendah', 'PD' => 'rendah'],
    ['KT' => 'sangat_rendah', 'KA' => 'sangat_rendah', 'KI' => 'sangat_rendah', 'PD' => 'sangat_rendah'],
  ];

  // Fuzzifikasi
  // Kualitas tanah (KT)
  // Ketersediaan air (KA)
  // Ketersediaan infrastruktur (KI)
  $kt = $sdm ?? 0.8; // Contoh input
  $ka = $kl ?? 0.7;
  $ki = $psr ?? 0.6 ;

  // ... (hitung nilai keanggotaan untuk setiap input)
  // Hitung nilai keanggotaan untuk KT
  $kt_sangat_rendah = membership_triangle($kt, 0, 0.2, 0.4); // Hasilnya akan mendekati 0
  $kt_rendah = membership_triangle($kt, 0.2, 0.4, 0.6); // Hasilnya akan kecil
  $kt_sedang = membership_triangle($kt, 0.4, 0.6, 0.8); // Hasilnya akan cukup besar
  $kt_tinggi = membership_triangle($kt, 0.6, 0.8, 1); // Hasilnya akan besar
  $kt_sangat_tinggi = membership_triangle($kt, 0.8, 1, 1); // Hasilnya akan mendekati 1

    // Hitung nilai keanggotaan untuk KT
  $ka_sangat_rendah = membership_triangle($ka, 0, 0.1, 0.2); // Hasilnya akan mendekati 0
  $ka_rendah = membership_triangle($ka, 0.2, 0.3, 0.7); // Hasilnya akan kecil
  $ka_sedang = membership_triangle($ka, 0.8, 0.5, 0.4); // Hasilnya akan cukup besar
  $ka_tinggi = membership_triangle($ka, 0.1, 0.2, 0.8); // Hasilnya akan besar
  $ka_sangat_tinggi = membership_triangle($ka, 1, 0.9, 0.8); // Hasilnya akan mendekati 1

  $psr_sangat_rendah = membership_triangle($ki, 1, 0, 0.2); // Hasilnya akan mendekati 0
  $psr_rendah = membership_triangle($ki, 0.5, 0.4, 0.3); // Hasilnya akan kecil
  $psr_sedang = membership_triangle($ki, 0.4, 0.8, 0.6); // Hasilnya akan cukup besar
  $psr_tinggi = membership_triangle($ki, 0.2, 0.9, 0.8); // Hasilnya akan besar
  $psr_sangat_tinggi = membership_triangle($ki, 0.9, 1, 1); // Hasilnya akan mendekati 1

  $sdm_array = [
    'sangat_rendah' => $kt_sangat_rendah,
    'rendah' => $kt_rendah,
    'sedang' => $kt_sedang,
    'tinggi' => $kt_tinggi,
    'sangat_tinggi' => $kt_sangat_tinggi
  ];

  $kl_array = [
    'sangat_rendah' => $ka_sangat_rendah,
    'rendah' => $ka_rendah,
    'sedang' => $ka_sedang,
    'tinggi' => $ka_tinggi,
    'sangat_tinggi' => $ka_sangat_tinggi
  ];

  $psr_array = [
    'sangat_rendah' => $psr_sangat_rendah,
    'rendah' => $psr_rendah,
    'sedang' => $psr_sedang,
    'tinggi' => $psr_tinggi,
    'sangat_tinggi' => $psr_sangat_tinggi
  ];

  $output_fuzzy = array_map(function($a, $b) {
    return $a + $b;
  }, $sdm_array, $kl_array,$psr_array);


  // Defuzzifikasi (metode centroid)
  $domain = ['sangat_rendah', 'rendah', 'sedang', 'tinggi', 'sangat_tinggi'];
  $potensi_desa = defuzzify_centroid($output_fuzzy, $domain);

  return ucwords( str_replace('_',' ',$potensi_desa) );
}

// Defuzzifikasi (metode centroid)
function defuzzify_centroid($output_fuzzy, $domain) {
  // $output_fuzzy: array assosiatif output fuzzy
  // $domain: domain output (misal: array(0, 1, 2, 3, 4))

  $total_area = 0;
  $first_moment = 0;
  $x = 0;

  foreach ($output_fuzzy as $label => $membership) {
      $area = 0.5 * $membership * 1; // Lebar alas segitiga diasumsikan 1
      $first_moment += $area * ($x + 0.5 * $membership);
      $total_area += $area;
      $x++;
  }

  $centroid = $first_moment / $total_area;
  return $domain[floor($centroid)]; // Mapping centroid ke domain output
}


/** 
 * RUMUS FUZZY MAMDANI 
 * REVISION
 */

function CI(){ return $ci =& get_instance(); }

/**
 * STEP 1
 */
function getPedukuhanFuzzy(){

  $query_pedukuhan = CI()->db->where('indikator_ids !=','')->get('padukuhan')->result_array();

  $result =[];

  foreach( $query_pedukuhan as $key => $pedukuhan ){
    $query_indikator = CI()->db->select('id_indikator,nama_indikator,key_indikator')->where_in('id_indikator',explode(',',$pedukuhan['indikator_ids']))->get('indikator')->result_array();
    
    $data_indikator = [];
    foreach( $query_indikator as $indikator ){
      $arr_value_padukuhan = explode(',', $pedukuhan['indikator_values']);
      foreach(explode(',',$pedukuhan['indikator_ids']) as $i => $id_indikator_pedukuhan){
          if( $indikator['id_indikator'] == $id_indikator_pedukuhan ){
            $data_indikator = array_merge( $data_indikator,[
              $indikator['key_indikator'] => $arr_value_padukuhan[$i],
            ]);
          }
      }

    }


    $result = array_merge($result,[$pedukuhan['nama_padukuhan']=> $data_indikator]);
  }
  
  return $result;

}

/**
 * STEP 2
 */
function fuzzifikasi($nilai, $rendah, $sedang, $tinggi) {
      $membership = [];
      // Rendah
      if ($nilai <= $rendah[1]) {
          $membership['rendah'] = 1;
      } elseif ($nilai > $rendah[1] && $nilai < $sedang[0]) {
          $membership['rendah'] = ($sedang[0] - $nilai) / ($sedang[0] - $rendah[1]);
      } else {
          $membership['rendah'] = 0;
      }
  
      // Sedang
      if ($nilai > $sedang[0] && $nilai < $sedang[1]) {
          $membership['sedang'] = ($nilai - $sedang[0]) / ($sedang[1] - $sedang[0]);
      } elseif ($nilai >= $sedang[1] && $nilai <= $tinggi[0]) {
          $membership['sedang'] = 1;
      } elseif ($nilai > $tinggi[0] && $nilai < $tinggi[1]) {
          $membership['sedang'] = ($tinggi[1] - $nilai) / ($tinggi[1] - $tinggi[0]);
      } else {
          $membership['sedang'] = 0;
      }
  
      // Tinggi
      if ($nilai >= $tinggi[0]) {
          $membership['tinggi'] = 1;
      } elseif ($nilai > $sedang[1] && $nilai < $tinggi[0]) {
          $membership['tinggi'] = ($nilai - $sedang[1]) / ($tinggi[0] - $sedang[1]);
      } else {
          $membership['tinggi'] = 0;
      }
  
      return $membership;
}

/**
 * STEP 3
 */
function inferensi(array $calculatefuzzi) {
  $rules = [
    'sangat_tinggi' => min($calculatefuzzi['tinggi'], $calculatefuzzi['tinggi'], $calculatefuzzi['tinggi']),
    'tinggi' => min($calculatefuzzi['sedang'], $calculatefuzzi['tinggi'], $calculatefuzzi['sedang']),
    'sedang' => min($calculatefuzzi['rendah'], $calculatefuzzi['sedang'], $calculatefuzzi['tinggi']),
    'rendah' => min($calculatefuzzi['rendah'], $calculatefuzzi['rendah'], $calculatefuzzi['rendah'])
  ];

  return $rules;
}

/**
 * STEP 4
 */
// Defuzzifikasi menggunakan metode Centroid
function defuzzifikasi($inferensi) {
    // Definisi nilai crisp
    $crisp = getArrayCrip();
    
    $numerator = 0;
    $denominator = 0;

    foreach ($inferensi as $key => $value) {
        $numerator += $value * $crisp[$key];
        $denominator += $value;
    }

    return ($denominator == 0) ? 0 : $numerator / $denominator;
}

function prosesPerhitunganKeseluruhan(){
  // Proses untuk setiap kelurahan
  $data_potensi = [];
  foreach (getPedukuhanFuzzy() as $nama => $nilai) {
      $indikators=[];
      foreach( $nilai as $i => $item_nilai ){
        $query_indikator = CI()->db->where('key_indikator',$i)->get('indikator')->row_array();
          $rendah = explode('-',$query_indikator['rendah']);
          $sedang = explode('-',$query_indikator['sedang']);
          $tinggi = explode('-',$query_indikator['tinggi']);

          $indikators[] = $query_indikator['nama_indikator'];
          $fuzzy = fuzzifikasi($item_nilai, $rendah, $sedang, $tinggi);

          // Inferensi
          $hasil_inferensi = inferensi($fuzzy);

          // Defuzzifikasi
          $potensi = defuzzifikasi($hasil_inferensi);

        }
        $round_potensi = round($potensi,2);

        $data_potensi[]= [
          'pedukuhan'=>$nama,
          'potensi_fuzzy'=>$round_potensi,
          'potensi_text' => jenisPotensiPedukuhan( $round_potensi ),
          'indikator' => $indikators,
        ];
  }

  return $data_potensi;
}

function jenisPotensiPedukuhan(int $round_potensi){
  $query_crips = getArrayCrip();
  if( $round_potensi <= (int) $query_crips['rendah'] ){
    $text = 'Rendah';
  }else if( (int) $query_crips['rendah'] < $round_potensi && $round_potensi <= (int) $query_crips['sedang'] ){
    $text = 'Sedang';
  }else if( (int) $query_crips['sedang'] < $round_potensi && $round_potensi <= (int) $query_crips['tinggi'] ){
    $text = 'Tinggi';
  } else if( $query_crips['tinggi'] < $round_potensi && $round_potensi <= (int) $query_crips['sangat_tinggi'] ){
    $text = 'Sangat Tinggi';
  } 

  return $text;
}

function getArrayCrip(){
  $crisp = CI()->db->get('nilaicrips')->row_array();
    
  unset($crisp['id_nilaicrip']);

  return $crisp;
}