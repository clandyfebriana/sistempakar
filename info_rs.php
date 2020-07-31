<div class="page-header">
	<h1>Data Rumah Sakit Rujukan untuk Covid-19</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="info_rs" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group">
                <a href="?m=info_rs&q=" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr class="nw">
                    <th>No</th>
                    <th>Provinsi</th>
                    <th>Nama Rumah Sakit</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                </tr>
            </thead>
            <?php
            $q = esc_field($_GET['q']);
            $rows = $db->get_results("SELECT * FROM tb_rumahsakit 
                WHERE kode_rs LIKE '%$q%' OR provinsi LIKE '%$q%' OR nama_rs LIKE '%$q%' OR alamat_rs LIKE '%$q%' OR telp_rs LIKE '%$q%'
                ORDER BY provinsi");
            $no=0;
            
            foreach($rows as $row):?>
            <tr>
                <td><?=++$no ?></td>
                <td><?=$row->provinsi?></td>
                <td><?=$row->nama_rs?></td>
                <td><?=$row->alamat_rs?></td>
                <td><?=$row->telp_rs?></td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>