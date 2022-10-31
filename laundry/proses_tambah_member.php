
<?php
if($_POST){
    $nama_member=$_POST['nama_member'];
    $alamat=$_POST['alamat'];
    $jenis_kelamin=$_POST['jenis_kelamin'];
    $tlp=$_POST['tlp'];
    //$id_kelas=$_POST['id_kelas'];
    if(empty($nama_member)){
        echo "<script>alert('nama member tidak boleh kosong');location.href='tambah_member.php';</script>";
 
    } elseif(empty($alamat)){
        echo "<script>alert('alamat tidak boleh kosong');location.href='tambah_member.php';</script>";
    } elseif(empty($jenis_kelamin)){
        echo "<script>alert('jenis kelamin tidak boleh kosong');location.href='tambah_member.php';</script>";
    } elseif(empty($tlp)){
        echo "<script>alert('telepon tidak boleh kosong');location.href='tambah_member.php';</script>";
    }else {
        include "koneksi.php"; 
        $insert=mysqli_query($conn,"insert into member (id_member, nama_member, alamat, jenis_kelamin, tlp) value ('".$id_member."','".$nama_member."','".$alamat."','".$jenis_kelamin."','".$tlp."')") or die(mysqli_error($conn)); 
        if($insert){ 
            echo "<script>alert('Sukses menambahkan member');location.href='tambah_member.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan member');location.href='tambah_member.php';</script>";
        }
    }
}
?> 