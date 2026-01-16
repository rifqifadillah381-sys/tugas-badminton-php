<?php
include 'koneksi.php';
include "upload_foto.php";

/* ==========================================================
   LOGIKA PROSES (SIMPAN, UPDATE, HAPUS)
   Ditaruh di paling atas agar tidak mengganggu tampilan
   ========================================================== */
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $tanggal = date("Y-m-d H:i:s");
    $username = $_SESSION['username'];
    $nama_gambar = $_FILES['gambar']['name'];
    $gambar = '';

    if ($nama_gambar != '') {
        $cek_upload = upload_foto($_FILES['gambar']);
        if ($cek_upload['status']) {
            $gambar = $cek_upload['message'];
        } else {
            echo "<script>alert('".$cek_upload['message']."');location='admin.php?page=gallery';</script>";
            exit;
        }
    }

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // UPDATE
        $id = $_POST['id'];
        if ($nama_gambar == '') {
            $gambar = $_POST['gambar_lama'];
        } else {
            if (!empty($_POST['gambar_lama']) && file_exists('img/'.$_POST['gambar_lama'])) {
                unlink('img/'.$_POST['gambar_lama']);
            }
        }
        $stmt = $conn->prepare("UPDATE gallery SET judul=?, gambar=?, tanggal=?, username=? WHERE id=?");
        $stmt->bind_param("ssssi", $judul, $gambar, $tanggal, $username, $id);
    } else {
        // INSERT
        $stmt = $conn->prepare("INSERT INTO gallery (judul, gambar, tanggal, username) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $judul, $gambar, $tanggal, $username);
    }
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Data berhasil disimpan');location='admin.php?page=gallery';</script>";
}

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];
    if (!empty($gambar) && file_exists('img/'.$gambar)) { unlink('img/'.$gambar); }
    $stmt = $conn->prepare("DELETE FROM gallery WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Data berhasil dihapus');location='admin.php?page=gallery';</script>";
}
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg"></i> Tambah Gallery
        </button>
        <div class="input-group w-50">
            <input type="text" id="search" class="form-control" placeholder="Cari Gallery...">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
        </div>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle bg-white">
            <thead class="table-dark">
                <tr>
                    <th width="5%">No</th>
                    <th width="35%">Judul / Deskripsi</th>
                    <th width="35%">Gambar</th>
                    <th width="15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="result">
                <?php
                $sql = "SELECT * FROM gallery ORDER BY tanggal DESC";
                $res = $conn->query($sql);
                $no = 1;
                if ($res->num_rows > 0):
                    while ($row = $res->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td>
                        <div class="fw-bold"><?= htmlspecialchars($row['judul']); ?></div>
                        <small class="text-muted">pada: <?= $row['tanggal']; ?><br>oleh: <?= $row['username']; ?></small>
                    </td>
                    <td>
                        <?php if (!empty($row['gambar']) && file_exists('img/'.$row['gambar'])): ?>
                            <img src="img/<?= $row['gambar']; ?>" class="img-thumbnail" style="max-width: 150px;">
                        <?php else: ?>
                            <span class="badge bg-light text-dark">No Image</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-success rounded-circle" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id'] ?>"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-sm btn-danger rounded-circle" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row['id'] ?>"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>

                <div class="modal fade" id="modalEdit<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Gallery</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="gambar_lama" value="<?= $row['gambar'] ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Judul</label>
                                        <input type="text" name="judul" class="form-control" value="<?= $row['judul'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Ganti Gambar (Opsional)</label>
                                        <input type="file" name="gambar" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" name="simpan" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalHapus<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content text-center p-3">
                            <div class="modal-body">
                                <i class="bi bi-exclamation-triangle text-danger display-4"></i>
                                <p class="mt-3">Yakin hapus <b><?= $row['judul'] ?></b>?</p>
                                <form method="post">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="gambar" value="<?= $row['gambar'] ?>">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php endwhile; else: ?>
                <tr><td colspan="4" class="text-center p-4 text-muted">Belum ada data gallery.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Gallery Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan judul..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih Gambar</label>
                        <input type="file" name="gambar" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan Gallery</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $("#search").on("keyup", function() {
        let keyword = $(this).val();
        $.ajax({
            url: "gallery_search.php",
            type: "POST",
            data: { keyword: keyword },
            success: function(data) { $("#result").html(data); }
        });
    });
</script> tolong benerin kl ada yang salah
