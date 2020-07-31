<div class="page-header">
    <h1>Tambah Data Rumah Sakit</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post">
            <div class="form-group">
                <label><strong>Provinsi </strong> <span class="text-danger">*</span></label>
                <select class="form-control" name="provinsi">
                    <option value="">---PILIH PROVINSI---</option>
                    <?=get_provinsi_option(set_value('provinsi'))?>
                </select>
            </div>
            <div class="form-group">
                <label>Nama Rumah Sakit <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_rs" value="<?=$_POST['nama_rs']?>"/>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" name="alamat" rows="8"><?=$_POST['alamat']?></textarea>
            </div>
            <div class="form-group">
                <label>No. Telp</label>
                <input type="text" class="form-control" name="telp" value="<?=$_POST['telp']?>"/>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=rumahsakit"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>