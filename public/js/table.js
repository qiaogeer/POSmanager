$(function($) { 
$table=$('#table');
$table.bootstrapTable({
  url:'http://posmanager.local/pos/list',
  dataField:"data",
  totalField:"total",
  striped: true,//是否显示行间隔色
  cache: false,//是否使用缓存，默认为true
  pagination: true, //获得分页功能
  pageSize: 10, //默认分页数量
  pageNumber:1,
  sidePagination: "server",
  queryParams:function queryParams(params){
    var param = {  
      offset: params.offset, 
      limit: params.limit,   
      serial_number:$('#input_serial').val(),
      agent_name:$('#input_agent').val(),
      kem_id:$('#input_kme').val(),
      device_type:$('#select_device_type').val(),
      delivery_time:$('#datepicker').val(),
  }; 
  return param;
  },
  columns: [{
				field : 'select',
				checkbox : true,
				align : "center",
        valign : 'middle',    
			},
    {
      field: 'id',
      title: 'id',
      align : "center",
			valign : 'middle'
  }, {
      field: 'serial_number',
      title: '设备序列号',
      align : "center",
      valign : 'middle',
      editable :{
        type:'text'
      }
  },  {
      field: 'delivery_time',
      title: '发货时间',
      align : "center",
      valign : 'middle'
  },  {
      field: 'receive_name',
      title: '收件名称',
      align : "center",
      valign : 'middle'
  }, {
      field: 'agent_name',
      title: '代理商',
      align : "center",
      valign : 'middle'
  }, {
      field: 'config_time',
      title: '灌装时间',
      align : "center",
      valign : 'middle'
  },{
      field: 'company_name',
      title: '商户名称',
      align : "center",
      valign : 'middle'
  },{
      field: 'william_id',
      title: '通联商户号',
      align : "center",
      valign : 'middle'
  },
  {
      field: 'kme_id',
      title: 'K米商户号',
      align : "center",
      valign : 'middle'
  },{
      field: 'terminal_number',
      title: '终端号',
      align : "center",
      valign : 'middle'
  },
  {
    field: 'operate',
    title: '操作',
    align: 'center',
    valign: 'middle',
    formatter:AddFunctionAlty,//表格中增加按钮
    events :{
      "click #edit_button" : function(e, value, row, index) {
        var delivery_time=null;
        var config_time=null;
        if(!!(row.delivery_time)){
           var delivery_time_tmp=row.delivery_time.split(" ");
           delivery_time=delivery_time_tmp[0];
        }
        if(!!(row.config_time)){
          var config_time_tmp=row.config_time.split(" ");
          config_time=config_time_tmp[0];
        }
        pos_id=row.id;
       $('#serial_number').val(row.serial_number);
       $('#delivery_time').val(delivery_time);
       $('#receive_name').val(row.receive_name);
       $('#agent_name').val(row.agent_name);
       $('#config_time').val(config_time);
       $('#company_name').val(row.company_name);
       $('#william_id').val(row.william_id);
       $('#kem_id').val(row.kem_id);
       $('#terminal_number').val(row.terminal_number);
      },
      "click #delete_button" : function(e, value, row, index) {
        $.ajax({
          url : "http://posmanager.local/pos/delete",
          dataType:'json',
          type:'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        }, 
          data :{
            ids:row.id
          },
          success : function(data) {
              $table.bootstrapTable('refresh');
          }
        });
    }
 }}
],
});
function AddFunctionAlty(value,row,index){
  return [
    '<button id = "edit_button"  type="button" class="btn btn-primary " ><i class="fa fa-cog"></i></button>',
    '<button id = "delete_button"  type="button" class = "btn btn-danger" ><i class="fa fa-window-close"></i></button>',
  ].join('');
}

$('#resetSearch_button').click(function () {
      $('#input_serial').val('');
      $('#input_agent').val('');
      $('#input_kme').val('');
      $('#select_device_type').val(1);
      $('#datepicker').val(''),
      $table.bootstrapTable('refresh');
});



$('#query_button').click(function(){
  $table.bootstrapTable('refresh');
});

$("#datepicker").datepicker({
  format: "yyyy-mm",
  language: "zh-CN",
  autoclose: true,
  clearBtn: true,
  startView: 1,
  minViewMode: 1,
  maxViewMode: 2,
  viewDate:new Date(),
});


//修改记录
var pos_id;
function updatePos(){
  var param ={
    id:pos_id,
    serial_number : $("#serial_number").val(),
    delivery_time : $("#delivery_time").val(), 
    receive_name : $("#receive_name").val(), 
    agent_name : $("#agent_name").val(), 
    config_time : $("#config_time").val(), 
    company_name : $("#company_name").val(), 
    william_id : $("#william_id").val(), 
    kme_id : $("#kme_id").val(), 
    terminal_number : $("#terminal_number").val()
  };
  $.ajax({
    url : "http://posmanager.local/pos/update",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
  }, 
    type:'post',
    dataType :'JSON',
    data : param,
    success : function(data) {
      $table.bootstrapTable('refresh');
      hideMask();
    },
    error : function(msg){
      alert(msg);
    },
  });
};
$('#updatePos').bind('click',updatePos);

//删除记录
function deletePos(){
  var selects = $table.bootstrapTable("getSelections");
  if (selects.length == 0) {
    alert('请勾选要删除的记录');
    return;
  }
  var ids = "";
  for (var i = 0; i < selects.length; i++) {
    ids = ids + selects[i].id + ",";
  }
  ids=ids.substring(0,ids.length-1);
$.ajax({
  url : "http://posmanager.local/pos/delete",
  type:'POST',
  dataType:'json',
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
}, 
  data :{
    ids:ids
  },
  success : function(data) {
    $table.bootstrapTable('refresh');
},
  error : function(msg){
    alert(msg);
},
});

}
$(document).on("click","#select_delete_button",function(){
  deletePos();
}
  )

//导出记录
function exportData(){
  var param={
    serial_number:$('#input_serial').val(),
      agent_name:$('#input_agent').val(),
      kem_id:$('#input_kme').val(),
      device_type:$('#select_device_type').val(),
      delivery_time:$('#datepicker').val(),
  }
  $.ajax({
    url : "http://posmanager.local/excel/export",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
  }, 
    type:'get',
    dataType :'JSON',
    data : param,
    success : function(data) {
      location.href = data.data;
    },
    error : function(msg){
      alert(msg);
    },
  });
}
$('#export_button').bind('click',exportData);
});

//显示遮罩层
function showMask(){
  $("#mask").css("height",'100%');
  $("#mask").css("width",'100%');
  $("#mask").show();
  $("#edit_Modal").show();
}

//隐藏遮罩层
function hideMask(){
  $("#mask").hide();
  $("#edit_Modal").hide();
}

$(document).on("click","#edit_button",function(){
  showMask();
})
