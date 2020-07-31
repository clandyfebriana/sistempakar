<div class="page-header">
    <h1>Kelompok</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
           <input type="hidden" name="m" value="kelompok" />
           <div class="form-group">
               <input class="form-control" type="text" placeholder="Cari..." name="q" value="<?= $_GET['q'] ?>" />
           </div> 
           <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=kelompok_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr class="nw">
                    <th>No.</th>
                    <th>Kode Kelompok</th>
                    <th>Nama Kelompok</th>
                    <th>Detail</th>
                    <th>Solusi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
                $q  = esc_field($_GET['q']);
                $rows = $db->get_results("SELECT * FROM tb_kelompok WHERE kode_kelompok LIKE '%$q%' OR nama_kelompok LIKE '%$q%' OR detail LIKE '%$q%' ORDER BY kode_kelompok");
                $no = 0;
                foreach ($rows as $row) : ?>
            <tr>
                <td><?=++$no ?></td>
                <td><?=$row->kode_kelompok?></td>
                <td><?=$row->nama_kelompok?></td>
                <td><?=get_words($row->detail, 10)?></td>
                <td><?=get_words($row->solusi, 10)?></td>
                <td class="nw">
                    <a class="btn btn-xs btn-warning" href="?m=kelompok_ubah&ID=<?=$row->kode_kelompok?>"><span class="glyphicon glyphicon-edit"></span></a>
                    <a class="btn btn-xs btn-danger" href="aksi.php?act=kelompok_hapus&ID=<?=$row->kode_kelompok?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>