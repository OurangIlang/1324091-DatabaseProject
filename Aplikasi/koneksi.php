<?php
 
 $servername = getenv('DB_HOST') ?: "localhost";
 $database = getenv('DB_NAME') ?: "dbinvoice1";
 $username = getenv('DB_USER') ?: "root";
 $password = getenv('DB_PASSWORD') ?: "";
 
 // untuk tulisan bercetak tebal silakan sesuaikan dengan detail database Anda
 // membuat koneksi
 $conn = mysqli_connect($servername, $username, $password, $database);
 // mengecek koneksi

?>