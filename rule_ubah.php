<?php
    $row = $db->get_row("SELECT * FROM tb_rule WHERE id_rule='$_GET[ID]'"); 
?>
<div class="page-header">
    <h1>Ubah Rule</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post">
            <div class="form-group">
                <label><strong>Parent</strong> <span class="text-danger">*</span></label>                         
                <select class="form-control" name="parent">
                    <option value=""></option>
                    <?=get_rule_option(set_value('parent', $row->parent))?>
                </select>
            </div>
            <div class="row">
                <div class="col-md-6">                    
                    <div class="form-group">
                        <label>Tanya</label>
                        <select class="form-control" name="tanya">
                            <option value=""></option>
                            <?=get_gejala_option(set_value('tanya', $row->kode), true)?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">                    
                    <div class="form-group">
                        <label>kelompok</label>
                        <select class="form-control" name="kelompok">
                            <option value=""></option>
                            <?=get_kelompok_option(set_value('kelompok', $row->kode_kelompok))?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label><strong>Child </strong> <span class="text-danger">*</span></label>
                <select class="form-control" name="child">
                    <option value=""></option>
                    <?=get_child_option(set_value('child', $row->child))?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=rule"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>