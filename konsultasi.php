<style type="text/css">

    #visitor tr, td {
        font-style: 20px;
        padding: 5px;
    }
</style>

<?php
include_once 'functions.php';
if ($act)
    $db->query("TRUNCATE TABLE tb_konsultasi");

$success = false;
$row = $db->get_row("SELECT * FROM tb_konsultasi ORDER BY id_rule DESC LIMIT 1");
$visitor = $db->get_row("SELECT * FROM tb_visitor ORDER BY id_visitor DESC LIMIT 1");

if ($row) {
    $jawaban = $row->jawaban;
    $row = $db->get_row("SELECT * FROM tb_rule WHERE parent='$row->id_rule' AND child='$jawaban'");

    if ($row->jenis == 'tanya') {
        $kode_gejala = $row->kode;
        $id_rule = $row->id_rule;
    } else {
        $kode_kelompok = $row->kode;
        $success = true;
    }

    if ($success) {
        $row = $db->get_row("SELECT * FROM tb_kelompok WHERE kode_kelompok='$kode_kelompok'");
    } else {
        $row = $db->get_row("SELECT * FROM tb_gejala WHERE kode_gejala='$kode_gejala'");
    }
} else {
    $start = true;
    $row = $db->get_row("SELECT * FROM tb_rule ORDER BY parent, child LIMIT 1");
    $kode_gejala = $row->kode;
    $id_rule = $row->id_rule;
}
?>
<div class="page-header">
    <h1>Konsultasi</h1>
</div>

         
<?php if ($success) :
 ?>
    <div class="page-header">
    <strong>
    <table class="visitor">
        <tr>
            <td>Nama</td>
            <td> : </td>
            <td><?php echo $visitor->nama_visitor; ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td> : </td>
            <td><?php echo $visitor->jk_visitor; ?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td> : </td>
            <td><?php echo $visitor->bdate_visitor; ?></td>
        </tr>
        <tr>
            <td>Tanggal Visit</td>
            <td> : </td>
            <td><?php echo $visitor->tgl_visit; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td> : </td>
            <td><?php echo $visitor->alamat_visitor; ?></td>
        </tr>
        <tr>
            <td>Nomor Telepon</td>
            <td> : </td>
            <td><?php echo $visitor->telp_visitor; ?></td>
        </tr>
    </table>
</strong>

</div>
    <div class="panel panel-primary">
       
        <div class="panel-heading">
            <h3 class="panel-title">Hasil Konsultasi</h3>
        </div>
        <div class="panel-body text-center">
            <p>Adapun hasilnya adalah</p>
            <h2 class="text-primary"><?= $row->nama_kelompok ?></h2>
            <h3>Solusi</h3>
            <p><?= enter_to_br($row->solusi) ?></p>
            <form action="simpan.php" method="post">
                <input type="hidden" name="kode_gejala" value="<?= $row->kode_gejala ?>" />
                <p>&nbsp;</p>
                <p>
                    <button name="new" class="btn btn-primary" value="1"><span class="glyphicon glyphicon-refresh"></span> Konsultasi Lagi</button>
                    <button name="print" class="btn btn-secondary" onclick="window.print()"><span class="glyphicon glyphicon-print"></span> Cetak</button>
                    <a class="btn btn-success" href="?m=home"><span class="glyphicon glyphicon-ok-sign"></span> Selesai Konsultasi</a>

                </p>
            </form>
        </div>
    </div>
    <h3>Riwayat Pertanyaan</h3>
    <div class="list-group">
        <?php
        $rows = $db->get_results("SELECT * FROM tb_konsultasi k INNER JOIN tb_gejala g ON g.kode_gejala=k.kode");
        $no = 1;
        foreach ($rows as $row) : ?>
            <div class="list-group-item"><?= $no++ ?>. Apakah <?= strtolower($row->nama_gejala) ?>? <strong><?= $row->jawaban ?></strong></div>
        <?php endforeach ?>
    </div>
<?php else : ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Jawablah pertanyaan berikut ini</h3>
        </div>
        <div class="panel-body">
            <h3>[<?= $kode_gejala ?>] Apakah <?= strtolower($GEJALA[$kode_gejala]) ?>?</h3>
            <form action="simpan.php" method="post">
                <input type="hidden" name="id_rule" value="<?= $id_rule ?>" />
                <input type="hidden" name="kode" value="<?= $kode_gejala ?>" />
                <p>&nbsp;</p>
                <p>
                    <button name="yes" class="btn btn-primary" value="1">Ya</button>
                    <button name="no" class="btn btn-danger" value="1">Tidak</button>
                    <?php if (!$start) : ?>
                        <a onclick="return confirm('Anda yakin tidak melanjutkan konsultasi?')" href="?m=home" class="btn btn-info pull-right">Batal Konsultasi</a>
                    <?php endif ?>
                </p>
            </form>
        </div>
    </div>
<?php endif ?>