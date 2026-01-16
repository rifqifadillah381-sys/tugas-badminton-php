<?php
// Memulai session agar sistem tahu siapa yang login
session_start();

// Set variable username dan password dummy (sesuai permintaan Anda)
$username_dummy = "admin";
$password_dummy = "123456";

$error_php = "";

$username_dummy = "april";
$password_dummy = "april";

$error_php = "";

// Cek apakah form sudah dikirim (method POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userInput = $_POST['user'];
    $passInput = $_POST['pass'];

    // Validasi apakah input sama dengan data dummy
    if ($userInput === $username_dummy && $passInput === $password_dummy) {
        // Simpan status login di session
        $_SESSION['username'] = $userInput;
        $_SESSION['status'] = "login"; // Tambahkan status login sesuai admin.php Anda sebelumnya
        
        // Alihkan ke halaman admin
        header("location:admin.php"); 
        exit; // Sangat penting agar kode di bawahnya tidak terbaca
    } else {
        // Jika salah, simpan pesan error untuk ditampilkan
        $error_php = "Username atau Password Salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | My Daily Journal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link rel="icon" href="img/logo.png" />
    <style>
        body { background-color: #f8d7da; }
        .card { border-radius: 20px; border: none; }
    </style>
</head>
<body>
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-5">
                <div class="card shadow p-4">
                    <div class="text-center mb-3">
                        <i class="bi bi-person-circle h1 display-4 text-danger"></i>
                        <h3 class="fw-bold mt-2">Login Admin</h3>
                        <p welcome to my daily Journal</p>
                        <hr />
                    </div>

                    <form action="" method="post" id="loginForm">
                        <div class="mb-3">
                            <input
                                type="text"
                                name="user"
                                id="user"
                                class="form-control py-2 rounded-4"
                                placeholder="Username"
                                autocomplete="off"
                            />
                        </div>

                        <div class="mb-3">
                            <input
                                type="password"
                                name="pass"
                                id="pass"
                                class="form-control py-2 rounded-4"
                                placeholder="Password"
                            />
                        </div>

                        <div class="text-center my-3 d-grid">
                            <button type="submit" class="btn btn-danger rounded-4 py-2 fw-bold shadow-sm">Login Sekarang</button>
                        </div>

                        <div id="errorMsg" class="text-danger text-center small fw-bold">
                            <?php echo $error_php; ?>
                        </div>
                    </form>
                </div>
                <div class="text-center mt-3">
                    <a href="index.php" class="text-decoration-none text-danger small"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.getElementById("loginForm").addEventListener("submit", function(event) {
        const user = document.getElementById("user").value.trim();
        const pass = document.getElementById("pass").value.trim();
        const errorMsg = document.getElementById("errorMsg");

        errorMsg.textContent = "";

        if (user === "") {
            errorMsg.textContent = "Username tidak boleh kosong!";
            event.preventDefault();
            return;
        }

        if (pass === "") {
            errorMsg.textContent = "Password tidak boleh kosong!";
            event.preventDefault();
            return;
        }
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>