<?php
include_once "_class/Koneksi.php";

$q = isset($_POST['q']) ? strval($_POST['q']) : '';
$getData = isset($_POST['getData']) ? $_POST['getData'] : '';
$getID = isset($_POST['getID']) ? strval($_POST['getID']) : '';


$koneksi_db = Koneksi::connect();

switch($getData) {

    case "m_pegawai" :{
         $rs = mysqli_query($koneksi_db,"select * from tb_pegawai where id like '%$q%' or nama_lengkap like '%$q%'");
         $items = array();
            while($row = mysqli_fetch_object($rs)){

               if ($row->id == $getID) {
                  $row->selected = true;
               }

               array_push($items, $row);
            }
         $result = $items;
                           
   }break;

    case "m_jabatan" :{
         $rs = mysqli_query($koneksi_db,"select * from tb_jabatan where id like '%$q%' or nama_jabatan like '%$q%'");
         $items = array();
            while($row = mysqli_fetch_object($rs)){

               if ($row->id == $getID) {
                  $row->selected = true;
               }

               array_push($items, $row);
            }
         $result = $items;
                           
   }break;

    case "m_struktural" :{
         $rs = mysqli_query($koneksi_db,"select * from tb_struktural where id like '%$q%' or unit_kerja like '%$q%'");
         $items = array();
            while($row = mysqli_fetch_object($rs)){

               if ($row->id == $getID) {
                  $row->selected = true;
               }

               array_push($items, $row);
            }
         $result = $items;
                           
   }break;

}






echo json_encode ($result);


?>