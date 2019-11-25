<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Basic jQuery EasyUI</title>
    <link rel="stylesheet" type="text/css" href="themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="themes/icon.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.easyui.min.js"></script>
</head>

<body>
    <table class="easyui-datagrid" id="dg"  pagination="true" rownumbers="true" fitColumns="true" fit="true" singleSelect="true" toolbar="#toolbar">
        <thead>
            <tr>
                <th data-options="field:'nip_lama',sortable:true, width: 30">Nip Lama</th>
                <th 
                data-options="field:'nip_baru',sortable:true, width:30,
                  editor:{
                    type:'validatebox',
                    options:{
                        required:true
                    }
                 }

                ">Nip Baru</th>
                 <th 
                data-options="field:'nama_lengkap',sortable:true, width:100,
                  editor:{
                    type:'validatebox',
                    options:{
                        required:true
                    }
                 }

                ">Nama Lengkap</th>
                 <th 
                data-options="field:'nama_jabatan',sortable:true, width:100,
                  editor:{
                    type:'validatebox',
                    options:{
                        required:true
                    }
                 }

                ">Jabatan</th>
                <th 
                data-options="field:'unit_kerja',sortable:true, width:100,
                  editor:{
                    type:'validatebox',
                    options:{
                        required:true
                    }
                 }

                ">Unit Kerja</th>
                
            </tr>
        </thead>
    </table>
    <!-- TOOLBAR -->
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton btn-toggle" iconCls="icon-add" plain="true" onclick="AddAction()" >Add Action</a>
       
        <div style="float: right;margin-right: 20px;">
            <span>Search:</span>
            <input id="searchid" style="line-height:26px;border:1px solid #ccc">
            <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-search" onclick="doSearch()">Search</a>
        </div>
    
    </div>
    <!-- END TOOLBAR -->
    <div id="dlg" class="easyui-dialog" style="width:600px;height:300px;padding:10px;"
        title="Register"  data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <h2>Account Information</h2>
        <form id="ff" method="post" >
            <table>
                <tr>
                    <td>Nama Lengkap:</td>
                    <td>
                      <input id="pg" class="easyui-combobox" name="nama_lengkap" style="width:400px;">
                                   
                    </td>
                </tr>
                <tr>
                    <td>Jabatan:</td>
                    <td>
                      <input id="jb" class="easyui-combobox" name="nama_jabatan" style="width:300px;">
                                   
                    </td>
                </tr>

                <tr>
                    <td>Unit Kerja:</td>
                    <td>
                      <input id="uk" class="easyui-combobox" name="unit_kerja" style="width:400px;">
                                   
                    </td>
                </tr>
                
            </table>

        </form>
    </div>
    <div id="dlg-buttons" style="padding: 10px;">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
    </div>

    <script>
        var editIndex = undefined;
        $(function () { // jQuery onReady
            $('#dg').datagrid({
                url: "api/get_all_index.php",
                queryParams: { getData: 'pegawai_action' },
                pagination:true,
                pageSize: 20,
                pageList: [20, 25, 50, 100],
                emptyMsg: '<h1>DATA TIDAK TERSEDIA</h1>',
                //event
                onBeforeLoad: function(){
                    //$('.btn-toggle').linkbutton('disable')
                },
                onLoadSuccess: function(data){
                    if(!data.total){
                        $.messager.show({
                            title: 'Information',
                            msg: data.emptyMssg || "Data tidak tersedia.",
                            showType: 'slide'
                        });
                    }
                },
                onLoadError : function(){
                    $.messager.alert('Error', 'Error Load Data', 'error');
                }
                //onClickCell: onClickCell,
                //onEndEdit: onEndEdit
              
            })
        })
       
        function doSearch(val){
            var $dg = $('#dg'),
            prevQueryParams = $dg.datagrid('options')['queryParams'],
            newQueryParams = $.extend(prevQueryParams, { cari: val} );

            $dg.datagrid('load', newQueryParams);

        }

        function AddAction(){           
            var row = $('#dg').datagrid('getSelected');
            
            
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit');               
                $('#ff').form('clear');
                $('#pg').combobox({

                        url:'api/get_one_index.php',
                        valueField:'id',
                        textField:'nama_lengkap',
                        //panelHeight:'auto',
                        queryParams: { 
                            getData: 'm_pegawai', 
                            getID: row.pegawai_id
                        },
                        formatter:function(row){                   
                            return '<b>'+row.nip_baru+'</b><br> '+row.nama_lengkap+'</span>';
                        }

                    });

                 $('#jb').combobox({

                        url:'api/get_one_index.php',
                        valueField:'id',
                        textField:'nama_jabatan',
                        queryParams: { 
                            getData: 'm_jabatan',
                            getID: row.jabatan_id 
                        },
                        formatter:function(row){                   
                           return '<b>'+row.kode_jabatan+'</b><br> '+row.nama_jabatan+'</span>';
                        }
                    });

                    $('#uk').combobox({

                        url:'api/get_one_index.php',
                        valueField:'id',
                        textField:'unit_kerja',
                        queryParams: { 
                            getData: 'm_struktural',
                            getID:row.unit_kerja_id 
                        },
                        formatter:function(row){                   
                           return '<b>'+row.kode+'</b><br> '+row.unit_kerja+'</span>';
                        }
                    });



                if (row.id==null){
                    $('#dlg').dialog('open').dialog('center').dialog('setTitle','Data Baru');               
                    $('#ff').form('clear');
                     url = 'save_index.php';
                    
                }
                else{
                    $('#dlg').dialog('open').dialog('center').dialog('setTitle','Perubahan Data'); 
                   url = 'update_index.php?id='+row.id;
                }

                 
           //alert(row.jabatan_id);

        }
        
    </script>
</body>

</html>