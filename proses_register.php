<?php

    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $level = "customer";
    $status = "on";
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $alamat = $_POST['alamat'];
    $password = md5($_POST['password']);
    $re_password = $_POST['re_password'];
    
    unset($_POST['password']);
    unset($_POST['re_password']);

    $dataForm = http_build_query($_POST);

    if(empty($nama_lengkap) || empty($email) || empty($phone) || empty($alamat) || empty($password)) {
        header("location: ".BASE_URL."index.php?page=register&notif=require&$dataForm");
    }else{
        mysqli_query($koneksi, "insert into user (level,nama,email,alamat,phone,password,status)
                                values ('$level','$nama_lengkap','$email','$alamat','$phone','$password','$status')");
    }

    

?>