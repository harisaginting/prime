<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-5">
						<h4 class="card-title mb-0">List Users</h4>
						<div class="small text-muted">Prime</div>
					</div>

					<div class="col-sm-7" style="margin-bottom: 15px;">
					</div>
				
					<div class="col-sm-12">
						<table id="dataUser" class="table table-responsive-sm table-bordered table-striped" style="width: 100%;margin-top: 10px;">
			              <thead>
			                <tr>
			                  <th style="min-width: 8% !important">ID</th>
                        <th style="min-width: 50% !important">NAME</th>
			                  <th style="min-width: 15% !important">ROLE</th>
			                  <th style="min-width: 10% !important">DIVISION</th>
                        <th style="min-width: 17% !important">CONTACT</th>
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
						<span> List Users</span>
					</button>
			</div>

		</div>
	</div>
</div>


<script type="text/javascript">    
  var Page = function () {
    var tableInit = function(){    

        var table = $('#dataUser').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: { 
                        'url'  :base_url+'datatable/user', 
                        'type' :'POST',
                    },
                    aoColumns: [
                                { mData: 'ID'},
                                { mData: 'NAME'},
                                { mData: 'ROLE'},
                                { mData: 'DIVISION'},
                                {
                                  mRender : function(data, type, obj){   
                                            return obj.EMAIL +"<br>" +obj.PHONE;   
                                    }            
                                }
                               
                               ],
                               fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                               $(nRow).addClass('row_links');
		                           $(nRow).data('link',base_url+'user/profile/'+aData['ID']); 
		                           return nRow;
                                }            
                });  
    };    
      return {
          init: function() { 
            tableInit();    
            $(document).on('change','.searchOnTable', function (e) {
              e.stopImmediatePropagation();
              $('#dataBast').dataTable().fnDestroy();
              tableInit();
              });

            $(document).on('click','#select2-spk-container .select2-selection__clear',function(e){
                $('#spk').val(null).trigger('change');
              });


            $(document).on('click','.row_links',function(e){
            	e.stopImmediatePropagation();
            	console.log($(this).data('link'));
            	window.location = $(this).data('link');
            })
           }
      };

  }();

  jQuery(document).ready(function() { 
      Page.init();
  });       
           
</script>