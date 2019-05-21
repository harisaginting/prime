<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-5">
						<h4 class="card-title mb-0">Validation Project Service Order</h4>
						<div class="small text-muted">Service Delivery</div>
					</div>

					<div class="col-sm-7" style="margin-bottom: 15px;">
						<div class="float-right">
						</div>
					</div>
				
					<div class="col-sm-8">
						<table 	id="dataCustomer" 
								class="table table-responsive-sm table-bordered" style="width: 100%;margin-top: 10px;">
							<thead>
								<tr>
									<th style="width: 20%;font-size: 10px;">SERIAL ORDER</th>
									<th style="width: 25%;font-size: 10px;">ID LOP / NO P8</th>
									<th style="width: 40%;font-size: 10px;">PROJECT NAME</th>
									<th style="width: 15%;font-size: 10px;">VALIDATED BY</th>
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
                        'url'  :base_url+'datatable/wfmValid', 
                        'type' :'POST',
                    },
                    iDisplayLength: 5,
                    aLengthMenu: [[5,10,25, 50, 100, -1], [5,10,25, 50, 100, "All"]],
                    aoColumns: [
                                { mData: 'NO_P8'},
                                { mData: 'NO_P8'},
                                { mData: 'NO_P8'},
                                { mData: 'NO_P8'},
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