<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Akademik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        header {
            background-color:rgb(28, 118, 207);
            color: white;
            padding: 20px 10px;
            text-align: center;
        }
        header h1 {
            margin: 0;
        }
        main {
            padding: 20px;
            text-align: center;
        }
        main h2 {
            color:rgb(18, 106, 194); 
        }
        main p {
            font-size: 1.1em;
            margin-bottom: 20px;
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 30%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
        }
        th {
            background-color:rgb(27, 109, 192); 
            color: white;
        }
        td a {
            display: block;
            text-decoration: none;
            color:rgb(15, 95, 174);
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        td a:hover {
            background-color:rgb(45, 113, 214); 
            color: white;
        }
        footer {
            background-color:rgb(26, 109, 193); 
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Dashboard Akademik</h1>
    </header>

    <main>
        <h2>Selamat Datang di Dashboard Akademik</h2>
        <p>Pilih menu di bawah untuk mengelola data akademik:</p>

        <table>
            <tr>
                <th>Menu</th>
            </tr>
            <tr>
                <td><a href="mahasiswa.php">Data Mahasiswa</a></td>
            </tr>
            <tr>
                <td><a href="dosen.php">Data Dosen</a></td>
            </tr>
            <tr>
                <td><a href="matakuliah.php">Data Mata Kuliah</a></td>
            </tr>
            <tr>
                <td><a href="perkuliahan.php">Data Perkuliahan</a></td>
            </tr>
        </table>
    </main>

    <footer>
        &copy; 2025 Sistem Akademik. All Rights Reserved.
    </footer>
</body>
</html>
