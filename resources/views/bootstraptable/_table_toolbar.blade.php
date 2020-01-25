<form class="form-inline container ">
        <div id="toolbar">
         <div class="form-group mx-sm-3 mb-2"> 
          <div class="input-group  mr-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">序列号</span>
              </div>
              <input type="text" class="form-control" id="input_serial">
            </div>
            <div class="input-group mr-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">代理商</span>
                </div>
                <input type="text" class="form-control" id="input_agent">
              </div>
              <div class="input-group mr-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">K米商户号</span>
                  </div>
                  <input type="text" class="form-control" id="input_kme">
                </div>
          </div>
          <div class="form-group mx-sm-3 mb-2 justify-content-between"> 
          <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text" >发货日期</div>
              </div>
          <input type="text" class="form-control" id="datepicker" >
        </div>
      
        <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text" >机具类型</div>
            </div>
            <select class="form-control" id="select_device_type">
                <option value="1">裸机</option>
                <option value="2">灌装</option>
                <option value=" ">全部</option>
              
            </select>
          </div>
          <div class="input-group">
          <button type='button'  id ='query_button' class="btn btn-primary mr-2 ">查询</button>
          <button type='button' id="export_button" class='btn btn-success mr-2'>导出</button>
          <button type='button' id="resetSearch_button" class="btn btn-secondary mr-2">重置</button>
          <button type='button' id="select_delete_button" class="btn btn-danger">删除</button>
        </div>
      </div>
      </form>