<?php

class Mahasiswa extends CI_Controller {

    // public function __construct()
    // {
    //    parent::__construct();   // tapi sebelum diload wajib tulis kode ini, untuk menjalankan __construct() dari class CI_Controller(sudah aturan CI)

    //     // secara default kita cuma bisa menggunakan fitur mvc di CI, untk menggunakan fitur yang lain seperti database, security, form, dll wajib dipangil dulu modulnya(jadi tidak langsung aktif, harus diaktifkan manual)
    //     $this->load->database();    // ini manggil modul database, hanya untuk method ini saja ya., jika akan ada banyak method yg perlu database dalam 1 class controller, maka load database bisa ditarik ke dlm constructor

    //     // tapi misal banyak controller yang perlu database, dari pada buat __construct banyak, ada cara agar class database diload ketika aplikasi dijaalankan dari awal, mau dipakai ataupun tidak.
    //     // caranya bukan config/autoload/$autoload["library"] = array("database"); -> tulis database diarraynya

    // jika sudah atur databasenya di config/database seperti biasa

    // }

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Mahasiswa_model");
        // jika perlu dibanyak method load di __construct saja
        // $this->load->helper("url"); // ini untuk mengktifkan base_url(), tapi base url tidak cocok jika diaktifkan dicontroller, aktifkan di autoload $autoload["helper"] = array("url");

        // modul form_validation merupakan bagian dari library
        $this->load->library("form_validation");
    }

    public function index()
    {
        // $this->load->database(); // jika hanya 1 method yang perlu load database, lngsung paggil saja dimethod tanpa __construct
        // $this->load->model("Mahasiswa_model");  // model juga perlu diload dulu

        $data["judulHalaman"] = "List Mahasiswa";

        $data["mahasiswa"] = $this->Mahasiswa_model->getAllMahasiswa();

        if( $this->input->post("keyword") ) {   // seperti isset($_POST["keyword"])
            $data["mahasiswa"] = $this->Mahasiswa_model->cariDataMahasiswa();
        }

        $this->load->view("templates/header", $data);
        $this->load->view("mahasiswa/index", $data);
        $this->load->view("templates/footer");
    }

    public function tambah()
    {
        $data["judulHalaman"] = "Tambah Mahasiswa";

        $this->form_validation->set_rules("nama", "Nama", "required");  // parameter ada 3, name, nama alias dari name yang nantinya akan dimunculkan jika name tersebut error, yang terakhir yaitu rulesnya
        $this->form_validation->set_rules("nrp", "Nrp", "required|numeric");
        $this->form_validation->set_rules("email", "Email", "required|valid_email"); // jika ada lebih dari satu rules, maka sambung dengan karakter pipe (|)

        // semua pesan error bisa dilihat didlm library language di folder system/language/english/form_validation_lang.php
        // tapi kalau mau mengubah jngan diubah di situ, copy dulu filenya, lalu pastekan di aplication/language/english, lalu tinggal diedit sesuai keinginan 

        if( $this->form_validation->run() == FALSE ) {  // jalankan kode jika form validationnya tidak sukses atau mengembalikan nilai false
            $this->load->view("templates/header", $data);
            $this->load->view("mahasiswa/tambah");
            $this->load->view("templates/footer");
        } else {
            // ambil datanya dan jalankan model
            $this->Mahasiswa_model->tambahDataMahasiswa($_POST);

            // jangan lupa pakai flashdata
            // ada di modul session, biasanya diload di autoload libraries
            // set session->flashdata() dicontroller lalu panggil di view index
            $this->session->set_flashdata("flash", "ditambahkan");   // parameter ada 2 yaitu nama session dan isinya apa

            redirect("mahasiswa");  // redirect punya ci, pindah ke controller mahasiswa/index

            
        }

        
    }

    public function hapus($idMahasiswaUrl)
    {
        // echo $idMahasiswaUrl;
        $this->Mahasiswa_model->hapusDataMahasiswa($idMahasiswaUrl);

        $this->session->set_flashdata("flash", "dihapus");

        redirect("mahasiswa");
    }

    public function detail($idMahasiswaUrl)
    {
        $data["judulHalaman"] = "Detail Mahasiswa";

        $data["mahasiswa"] = $this->Mahasiswa_model->getMahasiswaById($idMahasiswaUrl);

        $this->load->view("templates/header", $data);
        $this->load->view("mahasiswa/detail", $data);
        $this->load->view("templates/footer");
    }

    public function ubah($idMahasiswaUrl)
    {
        $data["judulHalaman"] = "Ubah Mahasiswa";

        $data["mahasiswa"] = $this->Mahasiswa_model->getMahasiswaById($idMahasiswaUrl);

        // ini misal diambil dari database
        $data["jurusan"] = ["Sistem Informasi", "Teknik Industri", "Teknik Pangan", "Teknik Mesin", "Teknik Planologi", "Teknik Lingkungan"];

        $this->form_validation->set_rules("nama", "Nama", "required");  
        $this->form_validation->set_rules("nrp", "Nrp", "required|numeric");
        $this->form_validation->set_rules("email", "Email", "required|valid_email"); 

        if( $this->form_validation->run() == FALSE ) {  
            $this->load->view("templates/header", $data);
            $this->load->view("mahasiswa/ubah", $data);
            $this->load->view("templates/footer");
        } else {
            
            $this->Mahasiswa_model->ubahDataMahasiswa($_POST);

            $this->session->set_flashdata("flash", "diubah");   

            redirect("mahasiswa");  

            
        }

        
    }
}

?>