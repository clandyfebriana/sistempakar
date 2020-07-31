<div class="page-header">
	<h1>Rule & Decision Tree</h1>
</div>
<div class="row">
	<div class="col-md-5">
		<?php
		$rows = $db->get_results("SELECT * FROM tb_rule ORDER BY parent, child DESC");
		$fc = new FC($rows);
		?>
	</div>
	<div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                <form class="form-inline">
                    <input type="hidden" name="m" value="rule" />
                    <div class="form-group">
                        <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-primary" href="?m=rule_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped small">
                    <thead>
                        <tr class="nw">
                            <th>ID</th>
                            <th>Parent</th>
                            <th>Child</th>
                            <th>Jenis</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php

                    $q = esc_field($_GET['q']);
                    $rows = $db->get_results("SELECT * FROM tb_rule ORDER BY id_rule");
                    $no=0;
                    
                    foreach($rows as $row):?>
                    <tr>
                        <td><?=$row->id_rule?></td>
                        <td><?=$row->parent?></td>
                        <td><?=ucfirst($row->child)?></td>
                        <td><?=ucfirst($row->jenis)?></td>
                        <td><?=$row->kode?></td>
                        <td>                        
                            <?php if($row->jenis=='tanya'):?>
                            Apakah <?=strtolower($GEJALA[$row->kode])?>?
                            <?php else:?>  
                            <?=$kelompok[$row->kode]?>  
                            <?php endif?>                                                  
                        </td>
                        <td class="nw">
                            <a class="btn btn-xs btn-warning" href="?m=rule_ubah&ID=<?=$row->id_rule?>"><span class="glyphicon glyphicon-edit"></span></a>
                            <a class="btn btn-xs btn-danger" href="aksi.php?act=rule_hapus&ID=<?=$row->id_rule?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<?php

	Class FC{
		public $tree;
		public $rule;

		function __construct($rows){
			foreach($rows as $row){
				$this->rule[] = $row;
			}
			$this->build_tree();
			$this->display();
		}

		function display(){
			echo '<ul class="fc_tree">';
			$this->_display($this->tree, 'R1 : Root', 'fc_tree');
			echo '</ul>';
		}

		function _display($tree, $caption, $class=""){
			if(!$tree){
				return;
			}
			$class = $tree['jenis']== 'tanya' ? 'btn-primary' : 'btn-success';

			echo "<li><b class='btn btn-xs $class'>$caption: $tree[value]</b>";

			echo "<ul>";

			foreach ($tree['child'] as $key => $val) {
				$this->_display($val, 'R' .$val['id'] .': '. $key);
			}
			echo "</ul>";
			echo "</li>";
			
		}

		function build_tree(){
			$first = current((array)$this->rule);

			$this->tree = array(
				'jenis' => 'tanya',
				'value' => $first->kode,
				'child' => $this->_build_tree($first)
			);
		}

		function _build_tree($row){
			$arr = array();

			$branches = array();
			foreach ((array)$this->rule as $key => $val) {
				if ($val->parent==$row->id_rule) {
					$x['id'] = $val->id_rule;
					$x['jenis'] = $val->jenis;
					$x['value'] = $val->kode;
					$x['child'] = $this->_build_tree($val);
					$arr[$val->child] = $x;
				}
			}
			return $arr;
		}
	}
?>
<style type="text/css">
.fc_tree{
    margin-left: 0;
    padding: 0;
}
.fc_tree ul{
    margin-left:0px;
    padding-left: 25px;
}
.fc_tree li{list-style-type:none;margin:3px;position:relative}
.fc_tree li::before {
    content: "";
    position: absolute;
    top: -3px;
    left: -20px;
    border-left: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    border-radius: 0 0 0 0;
    width: 20px;
    height: 15px;
}
.fc_tree li::after {
    position: absolute;
    content: "";
    top: 11px;
    left: -20px;
    border-left: 1px solid #ccc;
    border-top: 1px solid #ccc;
    border-radius: 0 0 0 0;
    width: 20px;
    height: 100%;
}
.fc_tree li:last-child::after{display:none}
.fc_tree li:last-child:before{border-radius:0 0 0 3px}
ul.fc_tree>li:first-child::before{display:none}
.fc_tree b{
min-width: 50px;
}
</style>