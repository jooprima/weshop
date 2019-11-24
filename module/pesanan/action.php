<?php

    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    session_start();

    $pesanan_id = $_GET['pesanan_id'];
    $button = $_POST['button'];
    
    if ($button == "konfirmasi") {
        $user_id = $_SESSION["user_id"];
        $nomor_rekening = $_POST['nomor_rekening'];
        $nama_account = $_POST['nama_account'];
        $tanggal_transfer = $_POST['tanggal_transfer'];

        $queryPembayaran = mysqli_query($koneksi,"insert into konfirmasi_pembayaran (pesanan_id,nomor_rekening,nama_account,tanggal_transfer)
                                                                values ('$pesanan_id','$nomor_rekening','$nama_account','$tanggal_transfer')");

        if ($queryPembayaran) {
            mysqli_query($koneksi,"update pesanan set status='1' where pesanan_id='$pesanan_id'");
        }

    }elseif ($button == "Edit Status") {
        $status = $_POST["status"];

        mysqli_query($koneksi,"update pesanan set status='$status' where pesanan_id='$pesanan_id'");

        if ($status == "2") {
            $query = mysqli_query($koneksi,"select * from pesanan_detail where pesanan_id='$pesanan_id'");
            while ($row=mysqli_fetch_assoc($query)) {
                $barang_id = $row["barang_id"];
                $quantity = $row["quantity"];

                mysqli_query($koneksi,"update barang set stok=stok-$quantity where barang_id='$barang_id'");
            }
        }
    }
    header("location:".BASE_URL."index.php?page=my_profile&module=pesanan&action=list");

?>