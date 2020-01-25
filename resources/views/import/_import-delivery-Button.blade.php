<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#import_delivery_Modal">
  发货数据导入
</button>

<!-- Modal -->
<div class="modal fade" id="import_delivery_Modal" tabindex="-1" role="dialog" aria-labelledby="import_delivery_ModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="import_delivery_ModalLabel">发货数据导入</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        {!! Form::open(['route' =>'excel.import_delivery','method'=>'post','files'=>'true'])!!}
        <div class="modal-body">
          <div class="form-group">
          {{Form::label('excelfile','选择导入的文件:')}}<br/><br/>
          {{Form::file('excelfile',['class'=>'form-control-file'])}}
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">导入文件</button>
      </div>
      {!! Form::close()!!}
    </div>
  </div>
</div>
</div>
