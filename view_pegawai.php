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
                data-options="field:'nama_lengkap',sortable:true, width:150,
                  editor:{
                    type:'validatebox',
                    options:{
                        required:true
                    }
                 }

                ">Nama Lengkap</th>
                 <th 
                data-options="field:'tempat_lahir',sortable:true, width:50,
                  editor:{
                    type:'validatebox',
                    options:{
                        required:true
                    }
                 }

                ">Tempat Lahir</th>
                
            </tr>
        </thead>
    </table>
    <!-- TOOLBAR -->
    <div id="toolbar">
         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="append()">Append</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true" onclick="removeit()">Remove</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-save',plain:true" onclick="acceptit()">Accept</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-undo',plain:true" onclick="reject()">Reject</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-search',plain:true" onclick="getChanges()">GetChanges</a>
    
    </div>
    <!-- END TOOLBAR -->
    
    <script>
        var editIndex = undefined;
        $(function () { // jQuery onReady
            $('#dg').datagrid({
                url: "api/get_all_index.php",
                queryParams: { getData: 'pegawai' },
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
                },
                onClickCell: onClickCell,
                onEndEdit: onEndEdit
              
            })
        })
       
        function doSearch(val){
            var $dg = $('#dg'),
            prevQueryParams = $dg.datagrid('options')['queryParams'],
            newQueryParams = $.extend(prevQueryParams, { cari: val} );

            $dg.datagrid('load', newQueryParams);

        }
        function endEditing(){
            if (editIndex == undefined){return true}
            if ($('#dg').datagrid('validateRow', editIndex)){
                $('#dg').datagrid('endEdit', editIndex);
                editIndex = undefined;
                return true;
            } else {
                return false;
            }
        }
        function onClickCell(index, field){
            if (editIndex != index){
                if (endEditing()){
                    $('#dg').datagrid('selectRow', index)
                            .datagrid('beginEdit', index);
                    var ed = $('#dg').datagrid('getEditor', {index:index,field:field});
                    if (ed){
                        ($(ed.target).data('textbox') ? $(ed.target).textbox('textbox') : $(ed.target)).focus();
                    }
                    editIndex = index;
                } else {
                    setTimeout(function(){
                        $('#dg').datagrid('selectRow', editIndex);
                    },0);
                }
            }
        }
        function onEndEdit(index, row){
            var ed = $(this).datagrid('getEditor', {
                index: index,
                field: 'satuan_code'
            });
            row.satuan_name = $(ed.target).combobox('getText');
        }
        function append(){
            if (endEditing()){
                $('#dg').datagrid('appendRow',{});
                editIndex = $('#dg').datagrid('getRows').length-1;
                $('#dg').datagrid('selectRow', editIndex)
                        .datagrid('beginEdit', editIndex);
            }
        }
        function removeit(){
            if (editIndex == undefined){return}
            $('#dg').datagrid('cancelEdit', editIndex)
                    .datagrid('deleteRow', editIndex);
            editIndex = undefined;
        }
        function acceptit(){
            if (endEditing()){
                $('#dg').datagrid('acceptChanges');
            }
        }
        function reject(){
            $('#dg').datagrid('rejectChanges');
            editIndex = undefined;
        }
        function getChanges(){
            var rows = $('#dg').datagrid('getChanges');
            alert(rows.length+' rows are changed!');
        }
    </script>
</body>

</html>