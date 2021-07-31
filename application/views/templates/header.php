<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">

    <!-- <title><?//= $data["judulHalaman"]; ?></title> -->
    <title><?= $judulHalaman; ?></title>    <!-- semua key yang disimpan diarray ketika dikirim ke view otomatis menjadi variable -->
  </head>
  <body>

  <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
        <a class="navbar-brand" href="<?= base_url(); ?>">CI App</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                  <!-- base url juga merupakan bagian dari modul yang perlu diaktifkan jika mau digunakan -->
                <a class="nav-link" href="<?= base_url(); ?>">Home <span class="sr-only">(current)</span></a>
                <a class="nav-link" href="<?= base_url(); ?>mahasiswa">Mahasiswa</a>
                <a class="nav-link" href="#">About</a>
                </div>
            </div>
        </div>
    </nav>
  <!-- akhir navbar -->