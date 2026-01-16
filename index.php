<?php
session_start(); 
include "koneksi.php";
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UKM Bulutangkis NSU</title>
    <link rel="icon" href="https://via.placeholder.com/32" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    
    <style>
        body {
            background-color: #fff;
        }
     
        #hero {
            background-color: #f8d7da;
            color: #02060d;
        }
       
        #aboutme .accordion-button:not(.collapsed) {
            background-color: #f8d7da; 
            color: #000000; 
        }
        #aboutme .accordion-button {
            background-color: #f8f9fa;
        }
        #aboutme .accordion-button:focus {
            box-shadow: none;
            border-color: #f5c6cb;
        }
        
        #schedule i {
            color: #06f335; 
        }
      
        footer {
            background-color: #f8f9fa;
        }
        footer i {
            color: #212529; 
        }

        /* --- THEME SWITCHER CSS START --- */
        .dark-mode {
            background-color: #212529 !important; /* Warna background gelap */
            color: #f8f9fa !important; /* Warna teks terang */
        }

        .dark-mode .navbar {
            background-color: #343a40 !important;
        }
        
        /* Mengganti warna background hero, gallery, about me saat dark mode */
        .dark-mode #hero,
        .dark-mode #gallery,
        .dark-mode #aboutme {
            background-color: #495057 !important;
            color: #f8f9fa !important;
        }

        .dark-mode .card {
            background-color: #495057 !important;
            color: #f8f9fa !important;
        }

        .dark-mode .text-body-secondary, 
        .dark-mode .card-text {
            color: #ced4da !important; 
        }

        .dark-mode .accordion-button {
            background-color: #5d666d !important;
            color: #f8f9fa !important;
        }
        
        .dark-mode .accordion-button:not(.collapsed) {
            background-color: #495057 !important; 
        }

        .dark-mode footer {
            background-color: #343a40 !important;
        }
        .dark-mode footer i {
            color: #f8f9fa !important;
        }
        /* --- THEME SWITCHER CSS END --- */
    </style>
</head>
<body>
 
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">UKM Bulutangkis NSU</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark mt-3">
    <li class="nav-item">
        <a class="nav-link" href="#home">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#article">Article</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#gallery">Gallery</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#schedule">Schedule</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#aboutme">About Me</a>
    </li>

    <?php if (isset($_SESSION['username'])): ?>
        <li class="nav-item">
            <a class="nav-link fw-bold text-danger" href="admin.php">Admin: <?= $_SESSION['username'] ?></a>
        </li>
    <?php else: ?>
        <li class="nav-item">
            <a class="nav-link fw-bold" href="login.php">Login</a>
        </li>
    <?php endif; ?>

    </ul>
                </ul>
            </div>
            <div class="d-flex ms-3">
                <button id="dark-mode-btn" class="btn btn-dark btn-sm me-2" title="Dark Mode">
                    <i class="bi bi-moon-fill"></i>
                </button>
                <button id="light-mode-btn" class="btn btn-warning btn-sm" title="Light Mode">
                    <i class="bi bi-sun-fill"></i>
                </button>
            </div>
        </div>
    </nav>

   <section id="hero" class="text-center p-5 bg-danger-subtle text-sm-start">
    <div class="container">
        <div class="d-sm-flex flex-sm-row-reverse align-items-center">
                        <img src="https://img.freepik.com/premium-vector/badminton-racket-shuttlecock-lies-badminton-court-view-from-sport-poster-vector_274258-920.jpg?w=360" class="img-fluid" width="300" alt="Banner Badminton">
            <div>
                <h1 class="fw-bold display-4">UKM Bulutangkis NSU: Pusat Informasi, Jadwal, dan Prestasi Klub.</h1>
                <h4 class="fw-bold display-6">Satu raket, satu semangat. Gabung dan raih podium tertinggi bersama kami.</h4>
                <p class="mt-3">
                    <span id="tanggal"></span> | <span id="jam"></span>
                </p>
            </div>
        </div>
    </div>
    </section>

    <!--------------article begin------------------------->

<section id="article" class="text-center p-5">
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">article</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center"></div>

        <!------------------- col begin-------------->
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
             <img src="https://png.pngtree.com/thumb_back/fh260/background/20240529/pngtree-badminton-ball-near-the-badminton-court-line-image_15734410.jpg"  class="card-img-top" alt="pelatihan NSU">

                    <div class="card-body">
                        <h5 class="card-title fw-bold">Pengenalan Klub Badminton NSU</h5>
                        <p class="card-text text-start">Klub Badminton NSU dibentuk untuk mewadahi minat dan bakat mahasiswa dalam olahraga bulu tangkis. Klub ini terbuka untuk anggota tunggal dan ganda, dengan fokus pada pembinaan atlet berprestasi.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-body-secondary">Last updated 21 hour ago</small>
                    </div>
                </div>
            </div>

            <!-----------cole end------------>
            <?php
          
        ?>

        </div>
    </div>
</section>

<!--------------------article end----------------------------->
                  
    <section id="gallery" class="text-center p-5 bg-danger-subtle">
    <div class="container">
        <h2 class="fw-bold display-4 pb-4">Gallery</h2>
        <div id="carouselExample" class="carousel slide mx-auto shadow-lg" style="max-width: 500px;">
            <div class="carousel-inner rounded">
                <div class="carousel-item active">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSpzCwwiobqyt8NDak9RNPicft95F0KubnTuA&amp;" 
                         class="d-block w-100" 
                         style="height: 350px; object-fit: cover;" 
                         alt="Pemain Bulutangkis Bertanding">
                </div>
                <div class="carousel-item">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQz0n0mHZxdFA11aqzM0_XgOMjdoFkVHxzZbA&amp;s" 
                         class="d-block w-100" 
                         style="max-width:640px; object-fit: cover;" 
                         alt="Bulutangkis Latihan Fisik">
                </div>
                <div class="carousel-item">
                    <img src="https://www.jasapembuatanlapangan.id/wp-content/uploads/2019/08/lampu-lapangan-badminton-outdoor-min.jpg" 
                         class="d-block w-100" 
                         style="height: 350px; object-fit: cover;" 
                         alt="Lapangan Bulutangkis">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="mt-3">
            <a href="#"><i class="bi bi-instagram h4 p-2 text-dark"></i></a>
        </div>
    </div>
</section>
            </div>
            <div class="mt-3">
                 <a href="#"><i class="bi bi-instagram h4 p-2 text-dark"></i></a>
            </div>
        </div>
    </section>
    <section id="schedule" class="text-center p-5">
        <div class="container">
            <h2 class="fw-bold display-4 pb-4">Schedule Harian</h2>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4">
                <div class="col">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-person-walking fs-1"></i>
                        <h5 class="mt-3 fw-bold">Latihan Fisik</h5>
                        <p class="small">Lari pagi atau skipping untuk meningkatkan stamina.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-trophy fs-1"></i>
                        <h5 class="mt-3 fw-bold">Teknik Dasar</h5>
                        <p class="small">Melatih teknik dasar olahraga (servis, pukulan, passing).</p>
                    </div>
                </div>
                <div class="col">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-tv fs-1"></i>
                        <h5 class="mt-3 fw-bold">Analisis Video</h5>
                        <p class="small">Menonton dan menganalisis pertandingan profesional.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-moon-stars fs-1"></i>
                        <h5 class="mt-3 fw-bold">Istirahat</h5>
                        <p class="small">Menjaga kualitas tidur untuk pemulihan otot.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-clipboard-check fs-1"></i>
                        <h5 class="mt-3 fw-bold">Evaluasi</h5>
                        <p class="small">Mengevaluasi performa latihan harian dengan pelatih.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-cup-straw fs-1"></i>
                        <h5 class="mt-3 fw-bold">Nutrisi</h5>
                        <p class="small">Mempersiapkan asupan makanan berprotein tinggi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="aboutme" class="text-center p-5 bg-danger-subtle">
        <div class="container" style="max-width: 800px;">
            <h2 class="fw-bold display-4 pb-4">About me</h2>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Universitas Dian Nuswantoro Semarang (2024-Now)
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body text-start">
                            <strong>Riwayat Pendidikan Tinggi.</strong> Berfokus pada pengembangan web dan aplikasi untuk menunjang media informasi olahraga, khususnya dalam bidang manajemen data atlet dan jadwal kompetisi.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            SMA Negeri 1 Semarang (2021-2024)
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body text-start">
                            <strong>Riwayat Pendidikan Menengah Atas.</strong> Aktif dalam klub bulu tangkis sekolah dan kompetisi antar-sekolah, menjabat sebagai Wakil Ketua klub selama dua tahun.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            SMP Negeri 2 Semarang (2018-2021)
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body text-start">
                            <strong>Riwayat Pendidikan Menengah Pertama.</strong> Awal mula tertarik dengan dunia bulu tangkis dan berpartisipasi dalam berbagai kejuaraan olahraga lokal.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="text-center p-4">
        <div>
            <a href="#"><i class="bi bi-instagram h2 p-2 text-dark"></i></a>
            <a href="#"><i class="bi bi-twitter h2 p-2 text-dark"></i></a>
            <a href="#"><i class="bi bi-whatsapp h2 p-2 text-dark"></i></a>
        </div>
        <div class="mt-2">
            <p>Rifqi Fadilah Lyslie &copy; 2024</p>
        </div>
    </footer>
    <button id="backToTop" class="btn btn-danger rounded-circle position-fixed bottom-0 end-0 m-3 d-none" style="z-index: 1000;">
        <i class="bi bi-arrow-up" title="Back to Top"></i>
    </button>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script type="text/javascript">
        function formatAngka(angka) {
            return angka < 10 ? '0' + angka : angka;
        }

        
        function tampilWaktu() {
            const waktu = new Date();
            const tanggal = formatAngka(waktu.getDate());
            const bulan = formatAngka(waktu.getMonth() + 1); 
            const tahun = waktu.getFullYear();
            const jam = formatAngka(waktu.getHours());
            const menit = formatAngka(waktu.getMinutes());
            const detik = formatAngka(waktu.getSeconds());

            const tanggal_full = tanggal + "/" + bulan + "/" + tahun;
            const jam_full = jam + ":" + menit + ":" + detik;

            const tanggalElement = document.getElementById("tanggal");
            const jamElement = document.getElementById("jam");

            if (tanggalElement && jamElement) {
                tanggalElement.innerHTML = tanggal_full;
                jamElement.innerHTML = jam_full;
            }
        }
    
        setInterval(tampilWaktu, 1000);
    </script>
    
    <script type="text/javascript"> 
       
        const backToTop = document.getElementById("backToTop");
        window.addEventListener("scroll", function () {
            if (window.scrollY > 300) {
                backToTop.classList.remove("d-none");
                backToTop.classList.add("d-block");
            } else {
                backToTop.classList.remove("d-block");
                backToTop.classList.add("d-none");
            }
        });
        backToTop.addEventListener("click", function () {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
        
        // --- THEME SWITCHER JAVASCRIPT START ---
        const body = document.body;
        const darkModeBtn = document.getElementById('dark-mode-btn');
        const lightModeBtn = document.getElementById('light-mode-btn');

        // 1. Fungsi untuk mengaktifkan Dark Mode
        darkModeBtn.addEventListener('click', () => {
            body.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark');
        });

        // 2. Fungsi untuk mengaktifkan Light Mode
        lightModeBtn.addEventListener('click', () => {
            body.classList.remove('dark-mode');
            localStorage.setItem('theme', 'light');
        });

        // 3. Memuat preferensi tema saat halaman dimuat
        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                body.classList.add('dark-mode');
            }
        });
        // --- THEME SWITCHER JAVASCRIPT END ---
    </script>
</body>
</html>







