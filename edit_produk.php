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
<?php

  // memanggil file koneksi.php untuk membuat koneksi
include 'config.php';

  // mengecek apakah di url ada nilai GET id
  if (isset($_GET['id'])) {
    // ambil nilai id dari url dan disimpan dalam variabel $id
    $id = ($_GET["id"]);

    // menampilkan data dari database yang mempunyai id=$id
    $query = "SELECT * FROM produk WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    // jika data gagal diambil maka akan tampil error berikut
    if(!$result){
      die ("Query Error: ".mysqli_errno($conn).
         " - ".mysqli_error($conn));
    }
    // mengambil data dari database
    $data = mysqli_fetch_assoc($result);
      // apabila data tidak ada pada database maka akan dijalankan perintah ini
       if (!count($data)) {
          echo "<script>alert('Data tidak ditemukan pada database');window.location='index.php';</script>";
       }
  } else {
    // apabila tidak ada data GET id pada akan di redirect ke index.php
    echo "<script>alert('Masukkan data id.');window.location='index.php';</script>";
  }         
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
                <h1>Edit Produk <?php echo $data['nama_produk']; ?></h1>
            <center>
            <form method="POST" action="proses_edit.php" enctype="multipart/form-data" >
            <section class="base">
                <!-- menampung nilai id produk yang akan di edit -->
                <input name="id" value="<?php echo $data['id']; ?>"  hidden />
                <div>
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" value="<?php echo $data['nama_produk']; ?>" autofocus="" required="" />
                </div>
                <div>
                <label>Deskripsi</label>
                <input type="text" name="deskripsi" value="<?php echo $data['deskripsi']; ?>" />
                </div>
                <div>
                <label>Harga Beli</label>
                <input type="text" name="harga_beli" required=""value="<?php echo $data['harga_beli']; ?>" />
                </div>
                <div>
                <label>Harga Jual</label>
                <input type="text" name="harga_jual" required="" value="<?php echo $data['harga_jual']; ?>"/>
                </div>
                <div>
                <label>Gambar Produk</label>
                <img src="gambar/<?php echo $data['gambar_produk']; ?>" style="width: 120px;float: left;margin-bottom: 5px;">
                <input type="file" name="gambar_produk" />
                <i style="float: left;font-size: 11px;color: red">Abaikan jika tidak merubah gambar produk</i>
                </div>
                <div>
                <button type="submit">Simpan Perubahan</button>
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