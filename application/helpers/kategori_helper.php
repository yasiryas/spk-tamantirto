<?php

function kategori_icon(?string $nama, ?string $ikon = null): string
{
     $peta = [
          'Persawahan' => 'fas fa-tractor',
          'Perladangan' => 'fas fa-mountain',
          'Peternakan' => 'fas fa-drumstick-bite',
          'Perkebunan' => 'fas fa-leaf',
          'Pertambangan' => 'fas fa-oil-can',
          'Kerajinan' => 'fas fa-hammer',
          'Industri Sedang/Besar' => 'fas fa-industry',
          'Perikanan' => 'fas fa-fish',
          'Jasa/Perdagangan' => 'fas fa-shopping-cart',
     ];

     if ($ikon !== null && trim($ikon) !== '') {
          $bersih = trim(preg_replace('/[^a-z0-9 \-]/i', '', $ikon));

          return strpos($bersih, 'fa-') === false ? 'fas ' . $bersih : $bersih;
     }

     return $peta[$nama] ?? 'fas fa-seedling';
}

function kategori_pilihan_ikon(): array
{
     return [
          'fas fa-tractor' => 'Pertanian',
          'fas fa-mountain' => 'Perladangan',
          'fas fa-drumstick-bite' => 'Peternakan',
          'fas fa-leaf' => 'Perkebunan',
          'fas fa-oil-can' => 'Pertambangan',
          'fas fa-hammer' => 'Kerajinan',
          'fas fa-industry' => 'Industri',
          'fas fa-fish' => 'Perikanan',
          'fas fa-shopping-cart' => 'Jasa/Perdagangan',
          'fas fa-binoculars' => 'Pariwisata',
     ];
}
