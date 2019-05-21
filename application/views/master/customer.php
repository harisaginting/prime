<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-5">
						<h4 class="card-title mb-0">List Customers</h4>
						<div class="small text-muted">Service Delivery</div>
					</div>

					<div class="col-sm-7" style="margin-bottom: 15px;">
						<div class="float-right">
						</div>
					</div>
				
					<div class="col-sm-12">
						<table 	id="dataCustomer" 
								class="table table-responsive-sm table-bordered" style="width: 100%;margin-top: 10px;">
							<thead>
								<tr>
									<th style="width: 10%">NIPNAS</th>
									<th style="width: 40%">NAME</th>
									<th style="width: 20%">SEGMEN</th>
									<th style="width: 20%">AM</th>
									<th style="width: 10%"></th>
								</tr>
							</thead>
							 <tbody>
							</tbody>
						</table>

					</div>
				</div>


			</div>
	

			<div class="card-footer">
				<button class="btn btn-brand btn-info btn-sm" type="button" style="margin-bottom: 4px">
						<i class="fa fa-download"></i>
						<span> Customers</span>
					</button>
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
                        'url'  :base_url+'datatable/customer', 
                        'type' :'POST',
                    },
                    aoColumns: [
                                { mData: 'NIPNAS'},
                                { mData: 'NAME'},
                                { mData: 'SEGMEN'},
                                {
                                  mRender : function(data, type, obj){   
                                  			let v = "-";
                                  			if(obj.AM != null){
                                  				let am = obj.AM.split(',');
                                  				v = "";
	                                            am.forEach(function(entry) {
                    												    v = v+"<i class='fa fa-user-circle'></i> <small>"+entry + "</small><br>"; 
                    												    });
                                            }
                                            return v;   
                                    }            
                                },
                                {
                                  mRender : function(data, type, obj){   
                                  			let dlt 	= "<button class='w-100 text-left btn btn-sm btn-danger btn-brand delete_customer' data-id='"+obj.NIPNAS+"'><i class='fa fa-trash'></i> <span>Delete</span></button>";
                                  			let edt  	= "<button class='w-100 text-left btn btn-sm btn-info btn-brand edit_customer' data-id='"+obj.NIPNAS+"' ><i class='fa fa-edit'></i> <span>Edit</span></button>";
                                            return edt+dlt;   
                                    }            
                                },
                               ],            
                });  
    };    
      return {
          init: function() { 
            tableInit();    
            $(document).on('change','.searchOnTable', function (e) {
              e.stopImmediatePropagation();
              $('#datacustomer').dataTable().fnDestroy();
              tableInit();
              });



            $(document).on('click','.delete_customer',function(e){
            	e.stopImmediatePropagation();
            	console.log($(this).data('id'));
            });

            $(document).on('click','.edit_customer',function(e){
            	e.stopImmediatePropagation();
            	console.log($(this).data('id'));
            });
           }
      };

  }();

  jQuery(document).ready(function() { 
      Page.init();
  });       
           
</script>