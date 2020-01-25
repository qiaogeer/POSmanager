<div class="modal" id="edit_Modal" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="document" style="z-index:2">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">编辑</h5>
              <button type="button" class="close" onclick="hideMask()" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {!! Form::open()!!}
              <div class="form-group   mb-2">
                      {{Form::label('serial_number','序列号',['class'=>'mr-3'])}}
                      {{Form::text('serial_number',null,['class'=>'form-control  col-6 ','id'=>'serial_number'])}}
              </div>
              <div class="form-group mb-2">
                      {{Form::label('delivery_time','发货时间',['class'=>'mr-3'])}}
                      {{Form::date('delivery_time',null,['class'=>'form-control','id'=>'delivery_time'])}}
              </div>
              
              <div class="form-group mb-2">
                      {{Form::label('receive_name','收件名称',['class'=>'mr-3'])}}
                      {{Form::text('receive_name',null,['class'=>'form-control col-6','id'=>'receive_name'])}}
              </div>
              <div class="form-group mb-2">
                      {{Form::label('agent_name','代理商',['class'=>'mr-3'])}}
                      {{Form::text('agent_name',null,['class'=>'form-control col-6','id'=>'agent_name'])}}
              </div>
              <div class="form-group mb-2">
                  {{Form::label('config_time','灌装时间',['class'=>'mr-3'])}}
                  {{Form::date('config_time',null,['class'=>'form-control','id'=>'config_time'])}}
              </div>
              <div class="form-group mb-2">
                  {{Form::label('company_name','商户名称',['class'=>'mr-3'])}}
                  {{Form::text('company_name',null,['class'=>'form-control col-6','id'=>'company_name'])}}
              </div>
              <div class="form-group mb-2">
                  {{Form::label('william_id','通联商户号',['class'=>'mr-3'])}}
                  {{Form::text('william_id',null,['class'=>'form-control col-6','id'=>'william_id'])}}
              </div>
              <div class="form-group mb-2">
                  {{Form::label('kme_id','K米商户号',['class'=>'mr-3'])}}
                  {{Form::text('kme_id',null,['class'=>'form-control col-6','id'=>'kme_id'])}}
              </div>
              <div class="form-group mb-2">
                  {{Form::label('terminal_number','终端号',['class'=>'mr-3'])}}
                  {{Form::text('terminal_number',null,['class'=>'form-control col-6','id'=>'terminal_number'])}}
              </div>
      
              {!! Form::close()!!}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="hideMask()">关闭</button>
          <button type="button" class="btn btn-primary"  id='updatePos'>提交</button>
        </div>
    </div>
  </div>