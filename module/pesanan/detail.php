<?php

    $pesanan_id = $_GET["pesanan_id"];

    $query = mysqli_query($koneksi,"select pesanan.pesanan_id,pesanan.nama_penerima,pesanan.nomor_telepon,pesanan.alamat,pesanan.tanggal_pemesanan,user.nama,kota.kota,kota.tarif 
                                        from pesanan join user on pesanan.user_id=user.user_id join kota on kota.kota_id=pesanan.kota_id where pesanan.pesanan_id='$pesanan_id'");

    $row=mysqli_fetch_assoc($query);

    $tanggal_pemesanan = $row['tanggal_pemesanan'];
    $nama_penerima = $row['nama_penerima'];
    $nomor_telepon = $row['nomor_telepon'];
    $alamat = $row['alamat'];
    $tarif = $row['tarif'];
    $nama = $row['nama'];
    $kota = $row['kota'];

?>

<div id="frame-faktur">
    <h3><center>Detail Pesanan</center></h3>

    <hr/>

    <table>
        <tr>
            <td>Nomor Faktur</td>
            <td>:</td>
            <td><?php echo $pesanan_id ?></td>
        </tr>
        <tr>
            <td>Nama Pemesan</td>
            <td>:</td>
            <td><?php echo $nama ?></td>
        </tr>
        <tr>
            <td>Nama Penerima</td>
            <td>:</td>
            <td><?php echo $nama_penerima ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?php echo $alamat ?></td>
        </tr>
        <tr>
            <td>Nomor Telepon</td>
            <td>:</td>
            <td><?php echo $nomor_telepon ?></td>
        </tr>
        <tr>
            <td>Tanggal Pemesanan</td>
            <td>:</td>
            <td><?php echo $tanggal_pemesanan ?></td>
        </tr>
    </table>
</div>

    <table class="table-list">
        <tr class="baris-title">
            <th class="no">No</th>
            <th class="kiri">Nama Barang</th>
            <th class="tengah">Qty</th>
            <th class="kanan">Harga Satuan</th>
            <th class="kanan">Total</th>
        </tr>

        <?php
            $queryDetail = mysqli_query($koneksi,"select pesanan_detail.*,barang.nama_barang 
                                                    from pesanan_detail join barang on pesanan_detail.barang_id=barang.barang_id where pesanan_detail.pesanan_id='$pesanan_id'");

            $no = 1;
            $subtotal = 0;
            while ($rowDetail=mysqli_fetch_assoc($queryDetail)) {

                $total = $rowDetail["harga"] * $rowDetail["quantity"];
                $subtotal = $subtotal + $total;
                
                echo "<tr>
                        <td class='no'>$no</td>
                        <td class='kiri'>$rowDetail[nama_barang]</td>
                        <td class='tengah'>$rowDetail[quantity]</td>
                        <td class='kanan'>".rupiah($rowDetail["harga"])."</td>
                        <td class='kanan'>".rupiah($total)."</td>
                    </tr>";

                    $no++;
            }
            $subtotal = $subtotal + $tarif;
        ?>

        <tr>
            <td class="kanan" colspan="4">Biaya pengiriman</td>
            <td class="kanan"><b><?php echo rupiah($tarif); ?></b></td>
        </tr>

        <tr>
            <td class="kanan" colspan="4">Sub Total</td>
            <td class="kanan"><b><?php echo rupiah($subtotal); ?></b></td>
        </tr>
    </table>

    <div id="frame-keterangan-pembayaran">
        <p>
            Silahkan Lakukan Pembayaran ke Bank ABC <br>
            Nomor Rekening : 0000-9999-8888 (a/n jooprima). <br>
            Setelah melakukan pembayaran silahkan lakukan konfirmasi pembayaran
            <a href="<?php echo BASE_URL."index.php?page=my_profile&module=pesanan&action=konfirmasi_pembayaran&pesanan_id=$pesanan_id"?>">Disini</a>.
        </p>
    </div>