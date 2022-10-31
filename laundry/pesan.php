<?php 
    include "header.php";
?>
<br>
<ul>
    <br>
<h3 align="center"><strong>List Paket</strong></h3>
<br>
<br>
<div class="row">
    <?php 
    include "koneksi.php";
    $qry_paket=mysqli_query($conn,"select * from paket");
    while($dt_paket=mysqli_fetch_array($qry_paket)){
        ?>
        
        <br>
        <div class="col-md-3">
            <div class="card" >
              <div class="card-body">
                <form method="post" action="proses_tambah_keranjang.php">
                    <h5 class="card-title"><?=$dt_paket['jenis_paket']?></h5> 
                    <br>
                    <tr>
                    <td>Jumlah Pesan</td><td><input type="number" name="jumlah_pesan" value="1" min = "1"></td>
                    </tr>
                    <br>
                    <br>
                    <br>
                    <h6 class="card-text">Rp.<?=substr($dt_paket['harga'], 0,500)?></h6>
                    <br>
                    
                        <input type="hidden" name="id" value="<?=$dt_paket['id']?>"> 
                        <input class = "btn btn-primary" type = "submit" value = "Pilih">
                </form>
              </div>
            </div>
        </div>
        <?php
    }
    ?>
</div> 

<h2>Daftar Pesanan di Keranjang</h2>
<table class="table table-hover striped">
    <form action="id=<?=$dt_paket['id']?>" method="post">
    <thead>
        <tr>
        
            <th>Nama Paket</th>
            <th>Jumlah</th>
            <th>harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total=0;
        if(@$_SESSION['cart']){
        foreach ($_SESSION['cart'] as $index => $value){
            $subtotal =$value['qty'] * $value ['harga'];
            $total += $subtotal;
            
            ?>
            <tr>
                
                <td><?=$value['nama_paket']?></td>
                <td><?=$value['qty']?></td>
                <td><?=$value['harga']?></td>
                <td><a href="hapus_cart.php?id=<?=$index?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-danger"><strong>X</strong></a></td>
            </tr>
 
        <?php 
        
        } 
        }
        ?>
        <tr>
            <td colspan="2">Total</td>
            <td><strong><?=$total?></strong></td>
        </tr>
    </tbody>
</table>
</form>

<form action="checkout.php" method="post">
<legend class="col-form-label col-sm-2 pt-0"> Nama Member : </legend>
            <select name="id_member" class="form-control">
                <?php
                //get data member untuk dropdown
                $get_member = mysqli_query($conn, "SELECT * FROM member");
                while($dt=mysqli_fetch_array($get_member)){
                    echo "<option value='".$dt['id_member']."'>".$dt['nama_member']."</option>";
                }
                ?>
            </select>
<input type='submit'  class="btn btn-primary" value='Check Out'>
            </form>
<?php 
    include "footer.php";
?>
  