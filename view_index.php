<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Layout - jQuery EasyUI</title>
    <link rel="stylesheet" type="text/css" href="themes/default/easyui.css">
     <link rel="stylesheet" type="text/css" href="themes/icon.css">
     <script type="text/javascript" src="js/jquery.min.js"></script>
     <script type="text/javascript" src="js/jquery.easyui.min.js"></script>
    <script>
        function addTab(title, url){
            if ($('#tt').tabs('exists', title)){
                $('#tt').tabs('select', title);
            } else {
                var content = '<iframe frameborder="0"  src="'+url+'" style="width:100%;height:100%;"></iframe>';
                $('#tt').tabs('add',{
                    title:title,
                    content:content,
                    closable:true
                });
            }
        }
    </script>
    <style type="text/css">
        <!--
      
        .style1 {font-size: large}
        -->
    </style>
</head>

<body class="easyui-layout">
    <div data-options="region:'north',border:false" style="height:70px;padding:10px">
     
    	<div style="float: left;">
    		<h3 class="style1">JUDUL SISTEM APLIKASI</h3>
    	</div>
         <div style="padding:15px;float: right;">
	        <a href="#" class="easyui-linkbutton" data-options="plain:true">HOME</a>
	        <a href="#" class="easyui-splitbutton" data-options="menu:'#mm2',iconCls:'icon-tip'">ABOUT ME</a>
	        <a href="#" class="easyui-splitbutton" data-options="menu:'#mm1',iconCls:'icon-help'">PETUNJUK</a>	        
	        <a href="#" class="easyui-menubutton" data-options="menu:'#mm3',iconCls:'icon-man'">ACTION</a>
	    </div>
	    <div id="mm1" style="width:150px;">
	        <div data-options="iconCls:'icon-undo'">Undo</div>
	        <div data-options="iconCls:'icon-redo'">Redo</div>
	        <div class="menu-sep"></div>
	        <div>Cut</div>
	        <div>Copy</div>
	        <div>Paste</div>
	        <div class="menu-sep"></div>
	        <div>
	            <span>Toolbar</span>
	            <div>
	                <div>Address</div>
	                <div>Link</div>
	                <div>Navigation Toolbar</div>
	                <div>Bookmark Toolbar</div>
	                <div class="menu-sep"></div>
	                <div>New Toolbar...</div>
	            </div>
	        </div>
	        <div data-options="iconCls:'icon-remove'">Delete</div>
	        <div>Select All</div>
	    </div>
	    <div id="mm2" style="width:100px;">
	        <div data-options="iconCls:'icon-ok'">Ok</div>
	        <div data-options="iconCls:'icon-cancel'">Cancel</div>
	    </div>
	    <div id="mm3" style="width:150px;">
	        <div>Help</div>
	        <div>Update</div>
	        <div>
	            <span>About</span>
	            <div class="menu-content" style="padding:10px;text-align:left">
	                <img src="http://www.jeasyui.com/images/logo1.png" style="width:150px;height:50px">
	                <p style="font-size:14px;color:#444">Try jQuery EasyUI to build your modern, interactive, javascript applications.</p>
	            </div>
	        </div>
	    </div>




    </div>
    <div data-options="region:'west',split:true,title:'MENU'" style="width:180px;padding:10px;">
        <div class="easyui-panel" title="MASTER" collapsible="true"  style="width:150px;height:auto;padding:5px;">
        	
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-shapes',plain:true" onClick="addTab('Data User','view_user.php')">User</a><br />
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-shapes',plain:true" onClick="addTab('Data Jabatan','view_jabatan.php')">Jabatan</a><br />
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-shapes',plain:true" onClick="addTab('Data Struktural','view_struktural.php')">Struktural</a><br />
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-shapes',plain:true" onClick="addTab('Data Pegawai','view_pegawai.php')">Pegawai</a><br />
           
            
        </div>
        </br>
         <div class="easyui-panel" title="LIST" collapsible="true" collapsed="true"  style="width:150px;height:auto;padding:5px;">
        	<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-shapes',plain:true" onClick="addTab('Data Jabatan Struktural Pegawai','view_pegawai_action.php')">Jabatan Pegawai</a><br />
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-shapes',plain:true" onClick="addTab('Data Work','view_work.php')">Work</a><br />
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-shapes',plain:true" onClick="addTab('Data Petugas','frmPetugas.php')">Domain</a><br />
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-shapes',plain:true" onClick="addTab('Data Petugas','frmPetugas.php')">Job</a><br />
            
           
            
        </div>
        </br>
        <div class="easyui-panel" title="GRAFIK" collapsible="true" collapsed="true" style="width:150px;height:auto;padding:5px;">
        	
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-shapes',plain:true" onClick="addTab('Data Work','view_work.php.php')">Work</a><br />
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-shapes',plain:true" onClick="addTab('Data Petugas','frmPetugas.php')">Domain</a><br />
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-shapes',plain:true" onClick="addTab('Data Petugas','frmPetugas.php')">Job</a><br />
           
        </div>
        </br>
        <div class="easyui-panel" title="REPORT" collapsible="true"  collapsed="true" style="width:150px;height:auto;padding:5px;">
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-man',plain:true" onClick="addTab('Laporan Penjualan','laporan/penjualan/pilih_lap.php')">Tahunan</a><br />
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-man',plain:true" onClick="addTab('Laporan Pembelian','laporan/barang_masuk/pilih_lap.php')">Triwulan</a>
        </div>
        <br>

         <div class="easyui-panel" title="SETTING" collapsible="true"  collapsed="true" style="width:150px;height:auto;padding:5px;">
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-man',plain:true" onClick="addTab('Laporan Penjualan','laporan/penjualan/pilih_lap.php')">Tahunan</a><br />
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-man',plain:true" onClick="addTab('Laporan Pembelian','laporan/barang_masuk/pilih_lap.php')">Triwulan</a>
        </div>
    </div>
    <div style="height:50px;padding:20px;" data-options="region:'south',border:false" align="center"><strong>&copy; IT Support 2016</strong></div>
    <div data-options="region:'center'" id="tt" class="easyui-tabs">
    	
        <div title="Selamat Datang" style="padding-top:10px; text-align:center; background-repeat:no-repeat; background:img/hapus.png; background-color:#FFF;">
              <div class="frametabel">
				 
            </div>
        </div>
    </div>
</body>
</html>
