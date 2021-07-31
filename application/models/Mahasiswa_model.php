<?php

use GuzzleHttp\Client;  // pakai namespace biar nulis GuzzleHttp\Client jadi Client saja, nulis ini harus diluar class / diatas class

class Mahasiswa_model extends CI_model {
    // controllers wajib extends CI_Controller
    // models wajib extends CI_model

    // supaya tidak instansiasi class guzzle berkali2
    private $_client;   // dikasih _ supaya tau kalau ini property private
    public function __construct()
    {
        $this->_client = new Client([
            "base_uri" => "http://localhost/oto/10RestApi/8AutentikasiRestServer/api/",
            "auth" => ["kijangcitys", "54321"]
        ]); // cara penggunaan ini semua ada di dokumentasi guzzle
    }

    public function getAllMahasiswa()
    {
        // baca cara mengolah database menggunakan ci di dokumentasi query builder class

        // select mahasiswa
        // $query = $this->db->get("mahasiswa");

        // generating query result (fetch)
        // return $query->result_array();

        // atau bisa disingkat jadi
        // return $this->db->get("mahasiswa")->result_array();

        // $client = new Client(); // bisa dimasukkan parameter

        $response = $this->_client->request("GET", "mahasiswa", [   // jadi sedikit lebih simple jika pakai __construct
            "query" => [
                "kijang-key" => "eka321"
            ]
        
        ]); // parameter request = request method, url, array[jika kirim lewat params = query, jika lewat body beda lagi]

        $result = $response->getBody()->getContents(); // ambil jsonnya pakai method getBody()->getContents()
        $result = utf8_encode($result);
        return json_decode($result, true)["data"];  // masuk ke array data
        
    }

    public function tambahDataMahasiswa()
    {
        $data = [
            // "nama" => $dataMahasiswa["nama"],
            // "nim" => $dataMahasiswa["nim"],
            // "email" => $dataMahasiswa["email"],
            // "jurusan" => $dataMahasiswa["jurusan"]

            // di ci bisa pakai cara ini, bisa dengan mudah menghindari sql injection, (htmlspecialchars) dengan memberi parameter tambahan di method post("nama", true);
            "nrp" => $this->input->post("nrp", true),
            "nama" => $this->input->post("nama", true),
            "email" => $this->input->post("email", true),
            "jurusan" => $this->input->post("jurusan", true),
            "kijang-key" => "eka321"
        ];
    
        // $this->db->insert('mahasiswa', $data);
        
        $response = $this->_client->request("POST", "mahasiswa", [
            "form_params" => $data
        ]);
    }

    public function hapusDataMahasiswa($idMahasiswaPar)
    {
        // $this->db->delete('mahasiswa', ['id' => $idMahasiswaPar]);

        // $this->db->where('id', $idMahasiswaPar);
        // $this->db->delete('mahasiswa');

        $response = $this->_client->request("DELETE", "mahasiswa", [
            "form_params" => [
                "kijang-key" => "eka321",
                "id" => $idMahasiswaPar
            ]
        ]); // delete tidak lewat params jadi tidak bisa pakai "query", jika kirim lewat body pakai "form_params"

    }

    public function getMahasiswaById($idMahasiswaPar)
    {
        // $this->db->where("id", 1);
        // $this->db->or_where("nama", "Uyup");
        // return $this->db->get("mahasiswa")->result_array();

        // return $this->db->get_where("mahasiswa", ["id" => $idMahasiswaPar])->result_array(); // result_array() sebenarnya bisa untuk ngambil 1 data, tapi lebih baik digunakan untuk mengambil banyak data

        // return $this->db->get_where("mahasiswa", ["id" => $idMahasiswaPar])->row_array();   // jika data return hanya 1 lebih baik gunakan row_array(), jika row(); saja bentuknya object, tambahi row_array(); jika ingin bentuk array

        // $client = new Client();
        $response = $this->_client->request("GET", "mahasiswa", [
            
            "query" => [
                "kijang-key" => "eka321",
                "id" => "$idMahasiswaPar"
            ]
        ]);

        $result = $response->getBody()->getContents();
        $result = utf8_encode($result);
        return json_decode($result, true)["data"][0];
    }

    public function ubahDataMahasiswa($dataMahasiswa)
    {
        $data = [
            // "nama" => $dataMahasiswa["nama"],
            // "nim" => $dataMahasiswa["nim"],
            // "email" => $dataMahasiswa["email"],
            // "jurusan" => $dataMahasiswa["jurusan"]

            // pakai ini lebih aman, dari sql injection
            "nrp" => $this->input->post("nrp", true),
            "nama" => $this->input->post("nama", true),
            "email" => $this->input->post("email", true),
            "jurusan" => $this->input->post("jurusan", true)

        ];
        
        // $this->db->where('id', $dataMahasiswa["id"]);

        // $this->db->where("id", $this->input->post("id"));
        // $this->db->update('mahasiswa', $data);  // ingat jangan pakai repalce, karena data akan dihapus dan buat yang baru

        $response = $this->_client->request("PUT", "mahasiswa", [
            "form_params" => [
                "kijang-key" => "eka321",
                "nrp" => $data["nrp"],
                "nama" => $data["nama"],
                "email" => $data["email"],
                "jurusan" => $data["jurusan"],
                "id" => $this->input->post("id")

            ]
        ]);

    }

    public function cariDataMahasiswa()
    {
        $keyword = $this->input->post("keyword", true);
        // sebenarnya true itu berfungsi kalau datanya diinsert ke database, tapi gpp tulis saja
        $this->db->like('nama', $keyword);
        $this->db->or_like('nim', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('jurusan', $keyword);

        return $this->db->get("mahasiswa")->result_array();
    }

}

?>