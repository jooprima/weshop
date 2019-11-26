<?php
    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    admin_only("kategori",$level);

    $button = isset($_POST['button']) ? $_POST['button'] : $_GET['button'] ;
    $kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : "";
    
    $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : "";
    $status = isset($_POST['status']) ? $_POST['status'] : "";

    if ($button == "Add") {
        mysqli_query($koneksi,"insert into kategori (kategori,status) values ('$kategori','$status')");
    }elseif ($button == "Update") {
        mysqli_query($koneksi,"update kategori set kategori='$kategori',
                                                    status='$status' where kategori_id='$kategori_id'");
    }elseif ($button == "Delete") {
        mysqli_query($koneksi,"delete from kategori where kategori_id='$kategori_id'");
    }

    

    header("location:".BASE_URL."index.php?page=my_profile&module=kategori&action=list");
?>
