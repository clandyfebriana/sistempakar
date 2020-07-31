<?php
    $row = $db->get_row("SELECT * FROM tb_rumahsakit WHERE kode_rs='$_GET[ID]'"); 
?>
<div class="page-header">
    <h1>Ubah Data Rumah Sakit</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post" action="?m=rumahsakit_ubah&ID=<?=$row->kode_rs?>">
            <div class="form-group">
                <input class="form-control" type="hidden" name="kode" readonly="readonly" value="<?=$row->kode_rs?>"/>
            </div>
            <div class="form-group">
                <label><strong>Provinsi </strong> <span class="text-danger">*</span></label>
                <select class="form-control" name="provinsi">
                    <option value=""></option>
                    <?=get_provinsi_option(set_value('child', $row->provinsi))?>
                </select>
            </div>
            <div class="form-group">
                <label>Nama Rumah Sakit <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_rs" value="<?=$row->nama_rs?>"/>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" name="alamat" rows="8"><?=$row->alamat_rs?></textarea>
            </div>
            <div class="form-group">
                <label>No. Telp</label>
                <input class="form-control" type="text" name="telp" value="<?=$row->telp_rs?>"/>
            </div>
            <div class="page-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=rumahsakit"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>