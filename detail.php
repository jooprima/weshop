<div id="kiri">

    <?php
        
        echo kategori($kategori_id);

    ?>

</div>

<div id="kanan">

    <?php
        $barang_id = $_GET['barang_id'];

        $query = mysqli_query($koneksi,"select * from barang where barang_id = '$barang_id' and status='on'");

        $row = mysqli_fetch_assoc($query);

        echo "<div id='detail-barang'>
                <h2>$row[nama_barang]</h2>
                <div id='frame-gambar'>
                    <img src='".BASE_URL."images/barang/$row[gambar]' />
                </div>
                <div id='frame-harga'>
                    <span>".rupiah($row['harga'])."</span>
                    <a href='".BASE_URL."tambah_keranjang.php?barang_id=$row[barang_id]'>+ add to cart</a>
                </div>
                <div id='keterangan'>
                    <b>Keterangan </b> $row[spesifikasi]
                </div>
            </div>";
    ?>

</div>