<div class="page-header">
    <h1>Tambah Rule</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php';?>
        <form method="post">
            <div class="form-group">
                <label>Id Rules <span class="text-danger">*</span></label>                         
                <input class="form-control" type="number" name="id_rule" value="<?=set_value('id_rule', $db->get_var("SELECT MAX(id_rule) FROM tb_rule") + 1)?>">
            </div>
            <div class="form-group">
                <label><strong>Parent</strong> <span class="text-danger">*</span></label>                         
                <select class="form-control" name="parent">
                    <option value="">Root</option>
                    <?=get_rule_option(set_value('parent'))?>
                </select>
            </div>
            <div class="row">
                <div class="col-md-6">                    
                    <div class="form-group">
                        <label>Tanya</label>
                        <select class="form-control" name="tanya">
                            <option value=""></option>
                            <?=get_gejala_option(set_value('tanya'), true)?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">                    
                    <div class="form-group">
                        <label>DIAGNOSA</label>
                        <select class="form-control" name="kelompok">
                            <option value=""></option>
                            <?=get_kelompok_option(set_value('kelompok'))?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label><strong>Child </strong> <span class="text-danger">*</span></label>
                <select class="form-control" name="child">
                    <option value=""></option>
                    <?=get_child_option(set_value('child'))?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=rule"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>