<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-5">
						<h4 class="card-title mb-0">List Partners</h4>
						<div class="small text-muted">Service Delivery</div>
					</div>

					<div class="col-sm-7" style="margin-bottom: 15px;">
						<div class="float-right">
						</div>
					</div>
				
					<div class="col-sm-12">
						<table 	id="dataPartner" 
								class="table table-responsive-sm table-bordered" style="width: 100%;margin-top: 10px;">
							<thead>
								<tr>
									<th style="width: 10%">ID</th>
									<th style="width: 40%">NAME</th>
									<th style="width: 20%">EMAIL</th>
									<th style="width: 20%">STATUS</th>
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
						<span> Partners</span>
					</button>
			</div>

		</div>
	</div>
</div>


<script type="text/javascript">    
  var Page = function () {
    var tableInit = function(){    

        var table = $('#dataPartner').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: { 
                        'url'  :base_url+'datatable/partner', 
                        'type' :'POST',
                    },
                    aoColumns: [
                                { mData: 'ID'},
                                { mData: 'NAME'},
                                {
                                  mRender : function(data, type, obj){   
                                  			let v = "-";
                                  			if(obj.EMAIL != null){
                                  				  let email = obj.EMAIL.split(';');
                                  				    v = "";
	                                            email.forEach(function(entry) {
                      												    v = entry + "<br>"; 
                      												});
                                  			    }
                                          return v;   
                                    }            
                                },
                                { mData: 'STATUS'},
                               ],             
                });  
    };    
      return {
          init: function() { 
            tableInit();    
            $(document).on('change','.searchOnTable', function (e) {
              e.stopImmediatePropagation();
              $('#dataPartner').dataTable().fnDestroy();
              tableInit();
              });



            $(document).on('click','.delete_partner',function(e){
            	e.stopImmediatePropagation();
            	console.log($(this).data('id'));
            });

            $(document).on('click','.edit_partner',function(e){
            	e.stopImmediatePropagation();
            	console.log($(this).data('id'));
            	console.log($(this).data('email'));
            });
           }
      };

  }();

  jQuery(document).ready(function() { 
      Page.init();
  });       
           
</script>