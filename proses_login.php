<?php

    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = mysqli_query($koneksi, "select * from user where email='$email' and password='$password' and status='on'");

    if(mysqli_num_rows($query) == 0){
        header("location:".BASE_URL."index.php?page=login&notif=true");
    }else{
        $row = mysqli_fetch_assoc($query);

        echo $row['nama'];
    }

?>