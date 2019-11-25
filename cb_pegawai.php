<?php

$q = isset($_POST['q']) ? strval($_POST['q']) : '';
$id = isset($_POST['id']) ? strval($_POST['id']) : '';
include_once "api/_class/Koneksi.php";
$koneksi_db = Koneksi::connect();

$rs = mysqli_query($koneksi_db,"select * from tb_pegawai where id like '%$q%' or nama_lengkap like '%$q%'");

$items = array();
	while($row = mysqli_fetch_object($rs)){

		if ($row->id == $id) {
			$row->selected = true;
		}

		array_push($items, $row);
	}
$result = $items;
echo json_encode ($result);


?>