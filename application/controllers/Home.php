<?php

// cara ganti halaman home yang diload dahulu ada di config/routes/ default_controller

class Home extends CI_Controller {
    public function index($nama = "default", $umur = 0) // data dari url
    {
        $data["judulHalaman"] = "Home";
        $data["nama"] = $nama;
        $data["umur"] = $umur;

        $this->load->view("templates/header", $data);
        $this->load->view("home/index", $data);   // load bisa untuk macam2 bisa view, model, helper, library, dll
        $this->load->view("templates/footer");
    }
}

?>