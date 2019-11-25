<?php
include_once "_class/Koneksi.php";
{ // DEBUG
  //$_POST['getData'] = "pegawai";
  //die(json_encode($_POST));
}
{
   // paging
   $page = intval( isset($_POST['page']) ? $_POST['page'] : 1 );
   $nRows= intval( isset($_POST['rows']) ? $_POST['rows'] : 20 );
   $offset = ($page - 1) * $nRows;
   $LIMIT  = "LIMIT $nRows OFFSET $offset";
   // ceking order by
   $sort = isset($_POST['sort']) ? $_POST['sort'] : '';
   $order = isset($_POST['order']) ? $_POST['order'] : 'DESC';
   //$ORDER_BY = empty($sort) ? '' : "ORDER BY $sort $order";
   // cek value post getdata
   $getData = isset($_POST['getData']) ? $_POST['getData'] : '';
   // get seraching value
   $getID = isset($_POST['getID']) ? $_POST['getID'] : '';
   $cari = isset($_POST['cari']) ? $_POST['cari'] : '';
   $multiQuery = [];
   $emptyMssg = "";
   $typeRows="datagrid";
   $ROWS  = [
      'rows' => []
   ];
}
// switch getData
{
   switch($getData) {
      case "pegawai" :{
         $emptyMssg = "Data barang tidak tersedia";
         $WHERE    = empty($cari) ? "WHERE 1" : "WHERE `nip_lama`='$cari' OR `nip_baru`='$cari' OR `nama_lengkap` LIKE '$cari%'";
         $ORDER_BY =  "ORDER BY ".( empty($sort) ? 'id' : $sort )." $order";
         $multiQuery[] = "SELECT COUNT(0) as total FROM tb_pegawai $WHERE";
         $multiQuery[] = "SELECT * FROM tb_pegawai $WHERE $ORDER_BY $LIMIT";
      }break;

     
      case "pegawai_action" :{
         $emptyMssg = "Data barang tidak tersedia";
         $WHERE    = empty($cari) ? "WHERE 1" : "WHERE `nip_lama`='$cari' OR `nip_baru`='$cari' OR `nama_lengkap` LIKE '$cari%'";
         $ORDER_BY =  "ORDER BY ".( empty($sort) ? 'id' : $sort )." $order";
         $multiQuery[] = "SELECT COUNT(0) as total FROM index_view $WHERE";
         $multiQuery[] = "SELECT * FROM index_view $WHERE $ORDER_BY $LIMIT";
      }break;

       case "jabatan" :{
         $emptyMssg = "Data barang tidak tersedia";
         $WHERE    = empty($cari) ? "WHERE 1" : "WHERE `kode_jabatan`='$cari' OR `nama_jabatan`='$cari' ";
         $ORDER_BY =  "ORDER BY ".( empty($sort) ? 'id' : $sort )." $order";
         $multiQuery[] = "SELECT COUNT(0) as total FROM tb_jabatan $WHERE";
         $multiQuery[] = "SELECT * FROM tb_jabatan $WHERE $ORDER_BY $LIMIT";
      }break;

      case "struktural" :{
         $emptyMssg = "Data barang tidak tersedia";
         $WHERE    = empty($cari) ? "WHERE 1" : "WHERE `kode`='$cari' OR `unit_kerja`='$cari' ";
         $ORDER_BY =  "ORDER BY ".( empty($sort) ? 'id' : $sort )." $order";
         $multiQuery[] = "SELECT COUNT(0) as total FROM tb_struktural $WHERE";
         $multiQuery[] = "SELECT * FROM tb_struktural $WHERE $ORDER_BY $LIMIT";
      }break;


      case "work" :{
         $emptyMssg = "Data barang tidak tersedia";
         $WHERE    = empty($cari) ? "WHERE 1" : "WHERE `nama`='$cari' OR `sumber`='$cari' ";
         $ORDER_BY =  "ORDER BY ".( empty($sort) ? 'id' : $sort )." $order";
         $multiQuery[] = "SELECT COUNT(0) as total FROM works $WHERE";
         $multiQuery[] = "SELECT * FROM works $WHERE $ORDER_BY $LIMIT";
      }break;

      

      case "barang" :{
         $emptyMssg = "Data barang tidak tersedia";
         $WHERE    = empty($cari) ? "WHERE 1" : "WHERE `code`='$cari' OR `name` LIKE '$cari%'";
         $ORDER_BY =  "ORDER BY ".( empty($sort) ? 'code' : $sort )." $order";
         $multiQuery[] = "SELECT COUNT(0) as total FROM m_barang $WHERE";
         $multiQuery[] = "SELECT mb.* ,ms.satuan_name
                           FROM m_barang mb 
                           left join m_satuan ms on ms.satuan_code = mb.satuan_code
                           $WHERE $ORDER_BY $LIMIT";
      }break;


      case "m_satuan" :{
         $typeRows="combobox";
         $multiQuery[] = "SELECT * from m_satuan ";
                           
      }break;
      
      default: break;
   }
}
// cek query is not empty
if(!count($multiQuery)) die(json_encode(['isMessage' => "You cannot access file"]));
{
   $koneksi_db = Koneksi::connect();
   if(mysqli_multi_query($koneksi_db, join(";", $multiQuery) )){
      do{
         if ($result = mysqli_store_result($koneksi_db)){
            while($rows = mysqli_fetch_assoc($result)){
               if(isset($rows['total'])) {
                        if ($typeRows =='combobox') {
                       
                           if ($rows['id'] == 1 ) {
                                 $rows['selected'] = true;
                           }

                        }

                      $ROWS = array_merge($ROWS, $rows);

               }else{
                  $ROWS['rows'][] = $rows;
               }
            }
         }
      }while( mysqli_more_results($koneksi_db) && mysqli_next_result($koneksi_db) );
   }

   // jika error query
   if(mysqli_error($koneksi_db)) $ROW['isMessage'] = "Error Query: ".mysqli_error($koneksi_db);
   
}

Koneksi::close();
echo json_encode( $typeRows =='combobox' ? $ROWS['rows'] : array_merge($ROWS, ['emptyMssg' => $emptyMssg]) );