<?php
include "header.php";
?>
<h2> Histori laundry</h2>
<table class ="table table-hover table-striped">
    <thead>
        <th>NO</th>
        <th>Tanggal Beli</th>
        <th>Jenis Paket</th>
        <th>Total</th>

        <!-- Status Bayar = blm lunas >> batas waktu || Status Bayar = lunas >> tanggal bayar -->
                        <!--
                        <?php
        include "koneksi.php";
        $qry_histori = mysqli_query($conn, "select * from transaksi order by id_transaksi desc");
        $dt_histori= mysqli_fetch_array($qry_histori);
        if($dt_histori['status_bayar'] == 'belum_lunas'){
            ?>
        <th>Batas Waktu</th>
            <?php
        } elseif ($dt_histori['status_bayar'] == 'lunas'){
            ?>
            <th>Tanggal Bayar</th>
            <?php
        }
        ?> -->
        <th>Status Bayar</th>
        <th>Status Paket</th>
        <th>Aksi</th>
    </tr>
        
    </thead>
    <tbody>
        <?php
        include "koneksi.php";
        $qry_histori=mysqli_query($conn,"select * from transaksi order by id_transaksi desc");
        $no=0;
        while($dt_histori=mysqli_fetch_array($qry_histori)){
            $no++;
            $total = 0;
            $paket_dibeli="<ol>";
            $qry_paket=mysqli_query($conn,"select * from detail_transaksi join paket on paket.id=detail_transaksi.id_paket where id_transaksi ='" .$dt_histori['id_transaksi']."'");
            while($dt_paket=mysqli_fetch_array($qry_paket)){ 
                $paket_dibeli.="<li>".$dt_paket['jenis_paket']."</li>";
                $total += $dt_paket['harga']*$dt_paket['qty'];
            }
            $paket_dibeli.="</ol>";
          ?>
          <tr>
            <td><?=$no?></td>
            <td><?=$dt_histori['tgl_transaksi']?></td>
            <td><?=$paket_dibeli?></td>
            <td><?=$total?></td>
            
            <!-- Status Bayar = blm lunas >> batas waktu || Status Bayar = lunas >> tanggal bayar -->
                        <!-- 

                        <?php
            if($dt_histori['status_bayar']=='belum_lunas'){
                ?>
                <td><?=$dt_histori['batas_waktu']?></td>
                <?php
            } elseif ($dt_histori['status_bayar'] == 'lunas'){
                ?>
                <td><?=$dt_histori['tgl_bayar']?></td>
                <?php
            }
            ?>-->
            <td><?=$dt_histori['status_bayar']?></td>
            <td><?=$dt_histori['status_order']?></td>
            <td>
                <?php
                if($dt_histori['status_bayar'] == "belum_lunas"){
                    ?>
                    <a href="ubah_status.php?id_transaksi=<?=$dt_histori['id_transaksi']?> "><button class="btn btn-primary">Lunas</button></a> |
                    <?php
                } else {
                    ?>
                    <a href="#"><button class="btn btn-primary" class = "done" >✔</button></a> |
                    <?php
                }
                ?>
                <?php
                if ($dt_histori['status_order'] == "baru"){
                    ?>
                    <a href="ubah_status_paket.php?id_transaksi=<?=$dt_histori['id_transaksi']?>&status_order=diproses" ><button class="btn btn-primary">Diproses</button></a>
                    <?php
                } elseif 
                    ($dt_histori['status_order'] == "diproses"){
                        ?>
                        <a href="ubah_status_paket.php?id_transaksi=<?=$dt_histori['id_transaksi']?>&status_order=selesai" ><button class="btn btn-primary">Selesai</button></a>
                    <?php
                } elseif
                    ($dt_histori['status_order'] == "selesai"){
                        ?>
                        <a href="ubah_status_paket.php?id_transaksi=<?=$dt_histori['id_transaksi']?>&status_order=diambil"><button class="btn btn-primary">Diambil</button></a>
                    <?php
                } elseif
                    ($dt_histori['status_order'] == "diambil"){
                        ?>
                        <a href="#"><button class="btn btn-primary"class = "done" >✔</button></a> 
                        <?php
                    }
                    ?>
            </td>
           </tr>
                </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<ul>
<a href="hapus_histori.php" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-secondary"> Hapus Histori</a>
    </body>
</html>
          </tr>
          <?php
        
        
        ?>
    </tbody>
</table>
<?php
include "footer.php";
?> 