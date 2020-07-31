<?php
error_reporting(~E_NOTICE );
session_start();

include'config.php';
include'includes/db.php';
$db = new DB($config['server'], $config['username'], $config['password'], $config['database_name']);
include'includes/general.php';
    
$mod = $_GET['m'];
$act = $_GET['act'];  

$rows = $db->get_results("SELECT * FROM tb_gejala ORDER BY kode_gejala");
$GEJALA = array();
foreach($rows as $row) {
    $GEJALA[$row->kode_gejala] = $row->nama_gejala; 
}

$rows = $db->get_results("SELECT * FROM tb_kelompok ORDER BY kode_kelompok");
$kelompok = array();
foreach($rows as $row) {
    $kelompok[$row->kode_kelompok] = $row->nama_kelompok; 
}


function get_kelompok_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_kelompok, nama_kelompok FROM tb_kelompok ORDER BY kode_kelompok");
    foreach($rows as $row){
        if($row->kode_kelompok==$selected)
            $a.="<option value='$row->kode_kelompok' selected>[$row->kode_kelompok] $row->nama_kelompok</option>";
        else
            $a.="<option value='$row->kode_kelompok'>[$row->kode_kelompok] $row->nama_kelompok</option>";
    }
    return $a;
}

function get_gejala_option($selected = '', $ask = false){
    global $db;
    $rows = $db->get_results("SELECT kode_gejala, nama_gejala FROM tb_gejala ORDER BY kode_gejala");
        
    foreach($rows as $row){
        $select = ($row->kode_gejala==$selected) ? 'selected' : '';
        $text = ($ask) ? '['. $row->kode_gejala . '] Apakah '. strtolower($row->nama_gejala) . '?' : '['. $row->kode_gejala . '] ' .$row->nama_gejala;
            
        $a.="<option value='$row->kode_gejala' $select>$text</option>";
    }
    return $a;
}

function get_rule_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT * FROM tb_rule ORDER BY id_rule");
        
    foreach($rows as $row){
        $select = $row->id_rule==$selected ? 'selected' : '';
        $text = 'Rule ' . $row->id_rule  . ': '. $row->jenis .' ['. $row->kode . ']';
            
        $a.="<option value='$row->id_rule' $select>$text</option>";
    }
    return $a;
}

function get_child_option($selected = ''){
    $arr = array(
        'ya' => 'Ya',
        'tidak' => 'Tidak',
    );
    
    foreach($arr as $key => $val){
        $select = $key==$selected ? 'selected' : '';        
        $a.="<option value='$key' $select>$val</option>";
    }
    return $a;
}

function get_provinsi_option($selected = ''){
    $arr = array(
        'Aceh' => 'Aceh',
        'Sumatra Utara' => 'Sumatra Utara',
        'Sumatra Barat' => 'Sumatra Barat',
        'Riau' => 'Riau',
        'Sumatra Selatan' => 'Sumatra Selatan',
        'Kepulauan Riau' => 'Kepulauan Riau',
        'Jambi' => 'Jambi',
        'Bengkulu' => 'Bengkulu',
        'Kepulauan Bangka Belitung' => 'Kepulauan Bangka Belitung',
        'Lampung' => 'Lampung',
        'Banten' => 'Banten',
        'DKI Jakarta' => 'DKI Jakarta',
        'Jawa Barat' => 'Jawa Barat',
        'Jawa Tengah' => 'Jawa Tengah',
        'DI Yogyakarta' => 'DI Yogyakarta',
        'Jawa Timur' => 'Jawa Timur',
        'Bali' => 'Bali',
        'Nusa Tenggara Barat' => 'Nusa Tenggara Barat',
        'Nusa Tenggara Timur' => 'Nusa Tenggara Timur',
        'Kalimantan Barat' => 'Kalimantan Barat',
        'Kalimantan Selatan' => 'Kalimantan Selatan',
        'Kalimantan Tengah' => 'Kalimantan Tengah',
        'Kalimantan Utara' => 'Kalimantan Utara',
        'Kalimantan Timur' => 'Kalimantan Timur',
        'Gorontalo' => 'Gorontalo',
        'Sulawesi Utara' => 'Sulawesi Utara',
        'Sulawesi Barat' => 'Sulawesi Barat',
        'Sulawesi Selatan' => 'Sulawesi Selatan',
        'Sulawesi Tengah' => 'Sulawesi Tengah',
        'Sulawesi Tenggara' => 'Sulawesi Tenggara',
        'Maluku' => 'Maluku',
        'Maluku Utara' => 'Maluku Utara',
        'Papua Barat' => 'Papua Barat',
        'Papua' => 'Papua'
    );
    
    foreach($arr as $key => $val){
        $select = $key==$selected ? 'selected' : '';        
        $a.="<option value='$key' $select>$val</option>";
    }
    return $a;
}

function enter_to_br($str)
{
    return str_ireplace("\r\n", "<br />", $str);
}

function get_words($str, $limit = 20)
{
    $str = explode(' ', strip_tags($str), $limit + 1);
    //echo count($str);
    if (count($str) <= $limit) {
        return implode(' ', $str);
    } else {
        array_pop($str);
        return implode(' ', $str) . '...';
    }
}