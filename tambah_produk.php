<?php
session_start();
ob_start();
include 'config.php';

if (empty($_SESSION['nama'])) {
?>
<p>kalian harus login untuk mengakses halaman ini</p>
<meta http-equiv="refresh" content="1; url=login.php" />
<?php
} else {
    define('INDEX', true)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=devicewidth, initial-scale=1.0" />
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="style.css" />
    <style></style>
</head>

<body>
    <div class="grid-container">
        <div class="grid-navbar">
            <div class="navbarheader">Sembako Online</div>
            <div class="logout"><a href="logout.php">Logout</a></div>
        </div>
        <div class="grid-sidebar">
            <div class="profilepic">
                <img src="gambar/profil.png" alt="" class="imground" />
                <p><?php echo $_SESSION['nama']; ?></p>
            </div>
            <div class="navigation">
                <ul>
                    <li><a href="?hal=dashboard">Dashboard</a></li>
                    <li><a href="?hal=dataMhs">Data Produk</a></li>
                    <li><a href="tambah_produk.php">Tambah Produk</a></li> 
                </ul>
            </div>
        </div>
        <div class="grid-head">
            <h2>SELAMAT DATANG DI SISTEM SEMBAKO ONLINE</h2>
            <p>Memudahkan Pendataan Produk Toko Anda</p>
        </div>
        <div class="grid-content">
          <center>
            <h1>Tambah Produk</h1>
          <center>
          <form method="POST" action="proses_tambah.php" enctype="multipart/form-data" >
            <section class="base">
              <div>
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" autofocus="" required="" />
              </div>
              <div>
                <label>Deskripsi</label>
                <input type="text" name="deskripsi" />
              </div>
              <div>
                <label>Harga Beli</label>
                <input type="text" name="harga_beli" required="" />
              </div>
              <div>
                <label>Harga Jual</label>
                <input type="text" name="harga_jual" required="" />
              </div>
              <div>
                <label>Gambar Produk</label>
                <input type="file" name="gambar_produk" required="" />
              </div>
              <div>
                <button type="submit">Simpan Produk</button>
              </div>
            </section>
          </form>
        </div>
    </div>
</body>
</html>
<?php
}
?> 