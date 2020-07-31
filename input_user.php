
<div class="page-header">
    <h1>Identitas Pengunjung</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post">
            <div class="form-group">
                <label>Nama Lengkap (Sesuai KTP)<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_visitor" value="<?=$_POST['nama_visitor']?>"/>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <br>
                <input class="custom-control-input" type="radio" name="jk_visitor" value="Lk"/> Laki-laki 
                &nbsp 
                <input class="custom-control-input" type="radio" name="jk_visitor" value="Pr"/> Perempuan
            </div>
            <div class="form-group">
                <label>Tanggal Lahir (Sesuai KTP)</label>
                <input class="form-control" type="date" name="bdate_visitor">
            </div>
            <div class="form-group">
                <label>Alamat Lengkap (Sesuai KTP)</label>
                <textarea class="form-control" name="alamat_visitor" rows="8"><?=$_POST['detail_visitor']?></textarea>
            </div>
            <div class="form-group">
                <label>Nomor Telepon<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="telp_visitor" value="<?=$_POST['telp_visit']?>"/>
            </div
            <div class="form-group">
                <button class=" submit btn btn-primary" name="submit"><span class="glyphicon glyphicon-save"></span> Lanjut Konsultasi</button>
                <a class="btn btn-danger" href="?m=diagnosa"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>