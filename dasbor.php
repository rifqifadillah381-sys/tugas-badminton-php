<?php
// Pastikan koneksi.php sudah di-include
include "koneksi.php";

// Ambil username dari session
$username_session = $_SESSION['username'];

// Ambil data foto user dari tabel userr
$query_user = $conn->prepare("SELECT foto FROM userr WHERE username = ?");
$query_user->bind_param("s", $username_session);
$query_user->execute();
$data_user = $query_user->get_result()->fetch_assoc();

// Hitung jumlah data Article
$query_article = $conn->query("SELECT id FROM articel");
$jumlah_article = $query_article->num_rows;

// Hitung jumlah data Gallery (sesuai database userr/gallery)
$query_gallery = $conn->query("SELECT id FROM gallery");
$jumlah_gallery = $query_gallery->num_rows;
?>

<div class="container text-center mt-5">
    <h1 class="display-4 border-bottom pb-3 mb-4">dashboard</h1>
    
    <div class="welcome-section mb-5">
        <p class="lead mb-0">Selamat Datang,</p>
        <h2 class="text-danger fw-bold mb-3"><?= $username_session ?></h2>
        
        <div class="d-flex justify-content-center">
            <?php 
            $path_foto = (!empty($data_user['foto']) && file_exists("img/" . $data_user['foto'])) 
                         ? "img/" . $data_user['foto'] 
                         : "https://via.placeholder.com/200"; 
            ?>
            <div style="width: 200px; height: 200px; border-radius: 50%; overflow: hidden; border: 5px solid #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                <img src="<?= $path_foto ?>" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        </div>
    </div>

    <div class="row justify-content-center g-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 py-3">
                <div class="card-body d-flex justify-content-center align-items-center gap-3">
                    <span class="fs-5"><i class="bi bi-newspaper"></i> Article</span>
                    <span class="badge bg-danger rounded-circle p-2 fs-6" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                        <?= $jumlah_article ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 py-3">
                <div class="card-body d-flex justify-content-center align-items-center gap-3">
                    <span class="fs-5"><i class="bi bi-camera"></i> Gallery</span>
                    <span class="badge bg-danger rounded-circle p-2 fs-6" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                        <?= $jumlah_gallery ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

