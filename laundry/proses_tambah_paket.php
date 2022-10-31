<?php
if($_POST){
    $jenis_paket=$_POST['jenis'];
    $harga=$_POST['harga'];
    if(empty($jenis_paket)){
        echo "<script>alert('jenis paket tidak boleh kosong');location.href='tambah_paket.php';</script>";
    } elseif(empty($harga)){
        echo "<script>alert('harga tidak boleh kosong');location.href='tambah_paket.php';</script>";
    }else {
        include "koneksi.php";
        $insert=mysqli_query($conn,"insert into paket (jenis_paket, harga) value ('".$jenis_paket."','".$harga."')") or die(mysqli_error($conn));
        if($insert){
            echo "<script>alert('Sukses menambahkan paket');location.href='tambah_paket.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan paket');location.href='tambah_paket.php';</script>";
        }
    }
} 
?>  