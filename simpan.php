<?php
require_once'functions.php';
if($_POST){
    if($_POST['yes'])
        $db->query("INSERT INTO tb_konsultasi (id_rule, kode, jawaban) VALUES ('$_POST[id_rule]', '$_POST[kode]', 'Ya')");
    elseif($_POST['no'])
        $db->query("INSERT INTO tb_konsultasi (id_rule, kode, jawaban) VALUES ('$_POST[id_rule]', '$_POST[kode]', 'Tidak')");
    elseif($_POST['new'])
        $db->query("TRUNCATE TABLE tb_konsultasi");
        
    header("location:index.php?m=konsultasi");
}
?>