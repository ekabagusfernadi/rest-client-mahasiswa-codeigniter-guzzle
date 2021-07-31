<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">

        <!-- form bisa pakai template ci juga, karena ci juga menyediakan form -->
        <!-- dokumentasi ci bisa dilihat secara offline di base_url()/user_guide -->
        <!-- form helper = echo form_open('email/send'); ini sama seperti nulis tag form -->

        

        <div class="form-group">

            <div class="card">
                <div class="card-header">
                    Form Ubah Data Mahasiswa
                </div>
                <div class="card-body">

                    <!-- <?php// if( validation_errors() == true ) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?//= validation_errors(); ?>
                        </div>
                    <?php// endif; ?> -->
                    <!-- menampilkan pesan eror validasi ci -->

                    <form action="" method="post">

                        <input type="hidden" name="id" value="<?= $mahasiswa["id"]; ?>">

                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $mahasiswa["nama"]; ?>">
                        <small id="emailHelp" class="form-text text-danger"><?= form_error("nama"); ?></small>
                        <!-- required itu html yang menjalankan jadi tidak semua browser support, kita bisa pakai modul ci yaitu form validation supaya ci saja yang menjalankan requirednya, type email juga bisa dicek -->

                        <label for="nrp">Nrp</label>
                        <input type="text" class="form-control" id="nrp" name="nrp" value="<?= $mahasiswa["nrp"]; ?>">
                        <small id="emailHelp" class="form-text text-danger"><?= form_error("nrp"); ?></small>

                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?= $mahasiswa["email"]; ?>">
                        <small id="emailHelp" class="form-text text-danger"><?= form_error("email"); ?></small>

                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <select class="form-control" id="jurusan" name="jurusan" value="<?= $mahasiswa["jurusan"]; ?>">
                                <?php foreach( $jurusan as $jur ) : ?>
                                    <?php if( $mahasiswa["jurusan"] == $jur ) : ?>
                                        <option value="<?= $jur; ?>" selected><?= $jur; ?></option>

                                    <?php else : ?>

                                        <option value="<?= $jur; ?>"><?= $jur; ?></option>
                                    
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                
                            </select>
                        </div>
                        <button type="submit" name="ubah" class="btn btn-primary float-right">Ubah Data</button>
                    </form>
                </div>
            </div>

            
        </div>

        

        </div>
    </div>
</div>