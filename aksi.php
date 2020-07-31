<?php
require_once 'functions.php';

/* Menu Login */
if ($mod == 'login'){
	$user = esc_field($_POST['user']);
	$pass = esc_field($_POST['pass']);

	$row = $db->get_row("SELECT * FROM tb_admin WHERE user='$user' AND password='$pass'");
	if ($row) {
		$_SESSION['login'] = $row->user;
		redirect_js("index.php");
	} else {
		print_msg("Kombinasi usernama dan password salah! Coba lagi.");
	}
} elseif ($act == 'logout') {
	unset($_SESSION['login']);
	header("location:index.php");
} elseif ($mod == 'password_ubah') {
	$pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $pass3 = $_POST['pass3'];

     $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$_SESSION[login]' AND password='$pass1'");

    if ($pass1 == '' || $pass2 == '' || $pass3 == '')
        print_msg('Field bertanda * harus diisi.');
    elseif (!$row)
        print_msg('Password lama salah.');
    elseif ($pass2 != $pass3)
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    else {
        $db->query("UPDATE tb_admin SET password='$pass2' WHERE user='$_SESSION[login]'");
        print_msg('Password berhasil diubah.', 'success');
    }
}


/*input pengunjung */
elseif ($mod == 'input_user') {
    $nama_visitor   = $_POST['nama_visitor'];
    $jk_visitor     = $_POST['jk_visitor'];
    $bdate_visitor  = $_POST['bdate_visitor'];
    $alamat_visitor = $_POST['alamat_visitor'];
    $telp_visitor = $_POST['telp_visitor'];

    if ($nama_visitor == '' || $jk_visitor =='' || $bdate_visitor == '' || $alamat_visitor == '' || $telp_visitor == ''){
        print_msg("Form pengunjung tidak boleh ada yang kosong!");
    } else {
        $db->query("INSERT INTO tb_visitor (nama_visitor, jk_visitor, bdate_visitor, alamat_visitor, telp_visitor) VALUES ('$nama_visitor', '$jk_visitor', '$bdate_visitor', '$alamat_visitor', '$telp_visitor')");
        redirect_js("index.php?m=konsultasi&act=new");
    }
}


/* Menu Kelompok */
elseif ($mod == 'kelompok_tambah') {
	$kode 	= $_POST['kode'];
	$nama 	= $_POST['nama'];
	$detail = $_POST['detail'];
	$solusi = $_POST['solusi'];

	if ($kode == '' || $nama == '' || $detail == '' || $solusi == ''){
		print_msg("Form tidak boleh ada yang kosong!");
	} elseif ($db->get_results("SELECT * FROM tb_kelompok WHERE kode_kelompok='$kode'")) {
		print_msg("Kode sudah ada!!!");
	} else {
		$db->query("INSERT INTO tb_kelompok (kode_kelompok, nama_kelompok, detail, solusi) VALUES ('$kode', '$nama', '$detail', '$solusi')");
		redirect_js("index.php?m=kelompok");
	}
} elseif ($mod == 'kelompok_ubah') {
	$nama 	= $_POST['nama'];
	$detail = $_POST['detail'];
	$solusi = $_POST['solusi'];

	if ($nama == '' || $detail == '' || $solusi == '') {
		print_msg("Form tidak boleh kosong!!");
	} else {
		$db->query("UPDATE tb_kelompok SET nama_kelompok='$nama', detail='$detail', solusi='$solusi' 
            WHERE kode_kelompok='$_GET[ID]'");
        redirect_js("index.php?m=kelompok");
    }
} else if ($act == 'kelompok_hapus') {
    $db->query("DELETE FROM tb_kelompok WHERE kode_kelompok='$_GET[ID]'");
    header("location:index.php?m=kelompok");
}

/* Menu Gejala */
elseif ($mod == 'gejala_tambah') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];

    if ($kode == '' || $nama == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($db->get_results("SELECT * FROM tb_gejala WHERE kode_gejala='$kode'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_gejala (kode_gejala, nama_gejala) VALUES ('$kode', '$nama')");
        redirect_js("index.php?m=gejala");
    }
} else if ($mod == 'gejala_ubah') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];

    if ($kode == '' || $nama == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_gejala SET nama_gejala='$nama' WHERE kode_gejala='$_GET[ID]'");
        redirect_js("index.php?m=gejala");
    }
} else if ($act == 'gejala_hapus') {
    $db->query("DELETE FROM tb_gejala WHERE kode_gejala='$_GET[ID]'");
    $db->query("DELETE FROM tb_pengetahuan WHERE kode_gejala='$_GET[ID]'");
    header("location:index.php?m=gejala");
}

/* Menu RS */
elseif($mod == 'rumahsakit_tambah'){
    $kode = $_POST['kode'];
    $provinsi = $_POST['provinsi'];
    $nama_rs = $_POST['nama_rs'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];

    if ($nama_rs == '' || $provinsi == '' || $alamat == '' || $telp == '')
        print_msg("Form tidak boleh kosong!");
    else {
    $db->query("INSERT INTO tb_rumahsakit (provinsi, nama_rs, alamat_rs, telp_rs) 
            VALUES ('$provinsi', '$nama_rs', '$alamat', '$telp')");
        redirect_js("index.php?m=rumahsakit");
    }
} else if ($mod == 'rumahsakit_ubah') {
    $kode = $_POST['kode'];
    $provinsi = $_POST['provinsi'];
    $nama_rs = $_POST['nama_rs'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];

    if ($nama_rs == '' || $provinsi == '' || $alamat == '' || $telp == '')
        print_msg("Form tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_rumahsakit SET provinsi='$provinsi', nama_rs='$nama_rs', alamat_rs='$alamat', telp_rs='$telp' WHERE kode_rs='$_GET[ID]'");
        redirect_js("index.php?m=rumahsakit");
    }
} else if ($act == 'hapus_rumahsakit') {
    $db->query("DELETE FROM tb_rumahsakit WHERE kode_rs='$_GET[ID]'");
    header("location:index.php?m=rumahsakit");
}

/* Menu Rule */
else if ($mod == 'rule_tambah') {
    $id_rule = $_POST['id_rule'];
    $parent = $_POST['parent'];
    $tanya = $_POST['tanya'];
    $kelompok = $_POST['kelompok'];
    $child = $_POST['child'];

    $ada = $db->get_row("SELECT * FROM tb_rule WHERE parent='$parent' AND child='$child' AND id_rule<>'$_GET[ID]'");

    if ($id_rule == '' || ($tanya == '' && $kelompok == '') || $child == '')
        print_msg("Pilih <strong>Parent</strong>, salah satu <strong>Tanya/Hasil</strong>, dan <strong>Child</strong>!");
    elseif ($db->get_row("SELECT * FROM tb_rule WHERE id_rule='$id_rule'"))
        print_msg("Id rule sudah terdaftar!");
    elseif ($ada)
        print_msg("Kombinasi parent dan child sudah ada!");
    else {
        $kode = $tanya ?: $kelompok;
        $jenis = $tanya ? 'tanya' : 'kelompok';

        $db->query("INSERT INTO tb_rule (id_rule, kode, jenis, parent, child) 
            VALUES ('$id_rule', '$kode', '$jenis', '$parent', '$child')");

        redirect_js("index.php?m=rule");
    }
} else if ($mod == 'rule_ubah') {
    $parent = $_POST['parent'];
    $tanya = $_POST['tanya'];
    $kelompok = $_POST['kelompok'];
    $child = $_POST['child'];

    $ada = $db->get_row("SELECT * FROM tb_rule WHERE parent='$parent' AND child='$child' AND id_rule<>'$_GET[ID]'");

    if ($parent == '' || ($tanya == '' && $kelompok == '') || $child == '')
        print_msg("Pilih <strong>Parent</strong>, salah satu <strong>Tanya/kelompok</strong>, dan <strong>Child</strong>!");
    elseif ($ada)
        print_msg("Kombinasi parent dan child sudah ada!");
    else {
        $kode = $tanya ?: $kelompok;
        $jenis = $tanya ? 'tanya' : 'kelompok';

        $db->query("UPDATE tb_rule SET parent='$parent', kode='$kode', jenis='$jenis', child='$child' WHERE id_rule='$_GET[ID]'");
        redirect_js("index.php?m=rule");
    }
} else if ($act == 'rule_hapus') {
    $db->query("DELETE FROM tb_rule WHERE id_rule='$_GET[ID]'");
    header("location:index.php?m=rule");
}


?>

