<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 5px;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <h1>File List</h1>
    <ul>
        <?php
        // Array untuk menyimpan nama file yang tidak ingin ditampilkan
        $excluded_files = array("index.php", "handler.php", "koneksi.php", "auth.php", "app.yaml");
        
        // Mendapatkan daftar file dalam folder
        $files = glob("*");
        
        // Menampilkan setiap file yang tidak termasuk dalam daftar yang dikecualikan sebagai hyperlink
        foreach ($files as $file) {
            if (is_file($file) && !in_array($file, $excluded_files)) {
                echo "<li><a href='$file'>$file</a></li>";
            }
        }
        ?>
    </ul>
</body>
</html>
