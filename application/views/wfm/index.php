<div class="row">
	<div class="col-md-5">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12">
						<h5 class="card-title mb-0">Validation Project Service Order</h5>
						<div class="small text-muted">Service Delivery</div>
					</div>
				
					<div class="col-sm-12">
						<table id="dataCustomer" 
								class="table table-responsive-sm table-bordered" style="width: 100%;margin-top: 10px;">
							<thead>
								<tr>
									<th style="width: 15%;font-size: 10px;">ID LOP <br> NO P8</th>
									<th style="width: 50%;font-size: 10px;">PROJECT NAME</th>
									<th style="width: 35%;font-size: 10px;">SERIAL ORDER</th>
								</tr>
							</thead>
							 <tbody>
							</tbody>
						</table>

					</div> 

          


				</div>


			</div>
	

		</div>
	</div>


  <div class="col-sm-7">
          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-12">
              <a href="<?= base_url() ?>wfm/upload" class="btn btn-md btn-primary btn-brand pull-right">
                <i class="fa fa-plus"></i>
                <span> Upload Validation Data </span>
              </a>
            </div>
          </div>

            <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <label for="no_p8" class="label">Select NO P8</label>
                  <select id="no_p8" class="form-control"></select>
                </div>
              </div>
            </div>
            
            <div class="card">
              <div class="card-header">
                <h6>Project Detail</h6>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <small>ID LOP</small>
                      <input class="form-control" id="project_lop" readOnly />

                      <small>PARTNER</small>
                      <input class="form-control" id="project_partner" readOnly />

                      <small>NO. P8</small>
                      <input class="form-control" id="project_p8" readOnly />
                    </div>
                    <div class="col-md-6">
                      <small>CUSTOMER</small>
                      <input class="form-control" id="project_customer" readOnly />
                      <small>NAME</small>
                      <textarea class="form-control" id="project_name" rows="3" readOnly></textarea>
                    </div>
                  </div>

              </div>
            </div>

            <div class="card">
              <div class="card-body" id="container_detail">
                
              </div>
            </div>

          </div>
</div>


<script type="text/javascript">    
  var Page = function () {
    var tableInit = function(){    

        var table = $('#dataCustomer').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: { 
                        'url'  :base_url+'datatable/wfmValid', 
                        'type' :'POST',
                    },
                    iDisplayLength: 5,
                    aLengthMenu: [[5,10,25, 50, 100, -1], [5,10,25, 50, 100, "All"]],
                    aoColumns: [
                                { 
                                	mRender : function(data, type, obj){   
                                    if(obj.NO_P8 == null || obj.NO_P8 == 'null'){
                                      return obj.ID_LOP;
                                      }
                                			return obj.ID_LOP + "<br>" + obj.NO_P8;
                                    }
                                },
                                { mData: 'NAME'},
                                { mData: 'NO_SO'},
                               ],            
                });  
    };


    var appendDetail = function(no_p8 = null){
            $.ajax({  type:"post",
                  async: true,
                  data: { no_p8 : no_p8},
                  url: base_url+"wfm/get_view_detail_so",
                      success: function(data) {
                          $('#container_detail').empty();
                          $('#container_detail').append(data);
                      }
                  });
    }

    var projectInitialize = function($no_p8=null) {
            $.ajax({  type:"post",
                data: { no_p8 : $no_p8},
                async: false,
                url: base_url+"master/get_p8",
                success: function(data) {
                  if(data != null){
                      let d = JSON.parse(data).data;
                      $('#project_lop').val(d.ID_LOP);
                      $('#project_p8').val(d.NO_SPK);
                      $('#project_name').val(d.PROJECT_NAME);
                      $('#project_partner').val(d.NAMA_MITRA);
                      $('#project_customer').val(d.NAMA_CC);
                      
                    }   
                }
            }).done(appendDetail($('#no_p8').val()));

                  

            
      }; 

      return {
          init: function() { 
            tableInit();    
            $('body').on('change','#no_p8',function(e){  
                e.stopImmediatePropagation();
                projectInitialize($('#no_p8').val());                             
            });

            $(document).on( 'click', '#addNo', function () {
                let no_p8    = $('#no_p8').val();
                let no_so    = $('#no_so').val();


                if(no_so==""){
                  $('#so_empty').removeClass('hidden');
                }else{
                  $('#so_empty').addClass('hidden');
                  
                  $.ajax({
                          url: base_url + 'wfm/add_no_so',
                          type:'POST',
                          data:  {no_so : no_so, no_p8 : no_p8},
                          success:function(data){
                            $('#container_detail').empty();
                            $('#container_detail').append(data);
                            return true;
                          }
                  });
                }
                
            });


            $("#no_p8").select2({
                    placeholder: "Select Projects",
                    width: 'resolve',
                    allowClear : true,
                    ajax: {
                        type: 'POST',
                        delay: 200,
                        url:base_url+"master/get_project_wfm",
                        dataType: "json",
                        processResults: function (data) {
                            return {
                                results: $.map(data, function(obj) {
                                    return { id: obj.NO_P8, text: obj.PROJECT_NAME};
                                })
                            };
                        },
                        
                    }
            }); 



             $(document).on('change','.validateaction',function(e){
              e.stopImmediatePropagation();
                let valid = 0;
                  if($(this).is(':checked')){
                     valid = 1;   
                  }

                  $.ajax({
                            url: base_url+'wfm/validate_so/'+valid,
                            type:'POST',
                            data: {no_so : $(this).data('so'),  no_p8 : $('#no_p8').val()},
                            success:function(data){                            
                              return true;
                            }
                        });      

            }); 

           }
      };

  }();

  jQuery(document).ready(function() { 
      Page.init();
  });       
           
</script>