<?php
// Memastikan session aktif jika file ini diakses langsung
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "koneksi.php";

// Pastikan user sudah login
if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit;
}

$username_session = $_SESSION['username'];

/* =========================================
   1. AMBIL DATA USER DARI TABEL 'userr'
========================================= */
$stmt = $conn->prepare("SELECT * FROM userr WHERE username = ?");
$stmt->bind_param("s", $username_session);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();

/* =========================================
   2. PROSES UPDATE SAAT TOMBOL DIKLIK
========================================= */
if (isset($_POST['simpan'])) {
    $password_baru = $_POST['password'];
    $foto_lama = $data['foto'];
    $nama_foto = $_FILES['foto']['name'];
    
    $password_final = $data['password']; // Default password lama
    $foto_final = $data['foto'];         // Default foto lama

    // Logika Ganti Password (MD5 sesuai sistem login kamu)
    if (!empty($password_baru)) {
        $password_final = md5($password_baru);
    }

    // Logika Ganti Foto
    if (!empty($nama_foto)) {
        $target_dir = "img/";
        // Buat folder img jika belum ada
        if (!is_dir($target_dir)) { mkdir($target_dir); }

        $ext = pathinfo($nama_foto, PATHINFO_EXTENSION);
        $nama_file_baru = $username_session . "_" . time() . "." . $ext;
        $target_file = $target_dir . $nama_file_baru;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            // Hapus foto lama dari folder jika ada
            if ($foto_lama && file_exists($target_dir . $foto_lama)) {
                unlink($target_dir . $foto_lama);
            }
            $foto_final = $nama_file_baru;
        }
    }

    // Update ke database tabel 'userr'
    $stmt_upd = $conn->prepare("UPDATE userr SET password = ?, foto = ? WHERE username = ?");
    $stmt_upd->bind_param("sss", $password_final, $foto_final, $username_session);
    
    if ($stmt_upd->execute()) {
        echo "<script>alert('Profil berhasil diperbarui!'); window.location='admin.php?page=profile';</script>";
    }
    $stmt_upd->close();
}
?>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Manajemen Profile</h4>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label fw-bold">Username</label>
                    <input type="text" class="form-control bg-light" value="<?= $data['username'] ?>" readonly>
                    <small class="text-muted">Username tidak dapat diubah.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Ganti Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Isi hanya jika ingin mengganti password">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Ganti Foto Profil</label>
                    <input type="file" name="foto" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold d-block">Foto Profil Saat Ini</label>
                    <?php 
                        $path_foto = (!empty($data['foto']) && file_exists("img/" . $data['foto'])) 
                                     ? "img/" . $data['foto'] 
                                     : "https://via.placeholder.com/150"; 
                    ?>
                    <img src="<?= $path_foto ?>" width="150" class="img-thumbnail shadow-sm">
                </div>

                <hr>
                <button type="submit" name="simpan" class="btn btn-success">
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>