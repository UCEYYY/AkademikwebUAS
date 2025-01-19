<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Tambahkan gaya untuk navbar agar terlihat lebih modern */
        .navbar {
            background: linear-gradient(135deg, #4caf50, #2196f3);
            color: #fff;
        }

        .navbar-brand, .nav-link {
            color: #fff !important;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .navbar-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }

        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="/index.php"> ->Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../mahasiswa/index.php">Mahasiswa</a></li>
                    <li class="nav-item"><a class="nav-link" href="../dosen/index.php">Dosen</a></li>
                    <li class="nav-item"><a class="nav-link" href="../matakuliah/index.php">Mata Kuliah</a></li>
                    <li class="nav-item"><a class="nav-link" href="../perkuliahan/index.php">Perkuliahan</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1>Selamat Datang di Aplikasi Akademik</h1>
        <p>Gunakan navigasi di atas untuk menjelajahi aplikasi.</p>
    </div>
</body>
</html>
