<div id="kiri">
    
    <?php
    
        echo kategori($kategori_id);
    
    ?>

</div>

<div id="kanan">

    <div id="slides">

        <?php

            $queryBanner = mysqli_query($koneksi,"select * from banner where status='on' order by banner_id desc limit 3");

            while ($rowBanner=mysqli_fetch_assoc($queryBanner)) {
                echo "<a href='".BASE_URL."$rowBanner[link]'><img src='".BASE_URL."images/slide/$rowBanner[gambar]' ></a>";
            }
        ?>

    </div>

    <div id="frame-barang">
        <ul>

            <?php

                if ($kategori_id) {
                    $kategori_id = "and barang.kategori_id='$kategori_id'";
                }

                $query = mysqli_query($koneksi,"select barang.*,kategori.kategori from barang join kategori on barang.kategori_id=kategori.kategori_id where barang.status='on' $kategori_id order by rand() desc limit 9");

                $no=1;
                while ($row=mysqli_fetch_assoc($query)) {

                    $kategori = strtolower($row["kategori"]);
                    $barang = strtolower($row["nama_barang"]);
                    $barang = str_replace(" ","-",$barang);

                    $style=false;
                    if ($no == 3) {
                        $style="style='margin-right:0px'";
                        $no=0;
                    }
                    
                    echo "<li $style>
                        <p class='price'>".rupiah($row['harga'])."</p>
                        <a href='".BASE_URL."$row[barang_id]/$kategori/$barang.html'>
                            <img src='".BASE_URL."images/barang/$row[gambar]' />
                        </a>
                        <div class='keterangan-gambar'>
                            <p><a href='".BASE_URL."$row[barang_id]/$kategori/$barang'</a></p>
                            <span>Stok : $row[stok]</span>
                        </div>
                        <div class='button-add-cart'>
                            <a href='".BASE_URL."tambah_keranjang.php?barang_id=$row[barang_id]'>+ Add to Cart</a>
                        </div>
                    </li>";

                    $no++;
                }
            ?>

        </ul>
    </div>

</div>