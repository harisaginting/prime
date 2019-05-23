<style type="text/css">
	.received{
      background-color: #bef9ff50;
    }

    .cadm{
      background-color: #7ee8f350;
    }
    .csepmo{
      background-color: #52d5e250;
    }

    .ccoord{
      background-color: #00b7ca50;
    }

    .revision{
      background-color: #f9ff0050;
    }

    .approved{
      background-color: #74f9a250;
    }

    .done{
      background-color: #0dfd6050;
    }
    .takeout{
      background-color: #00cc4650; 
    }

</style>


<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-5">
						<h4 class="card-title mb-0">List Bast</h4>
						<div class="small text-muted">Service Delivery</div>
					</div>

					<div class="col-sm-7" style="margin-bottom: 15px;">
            <div class="float-right">
                <a href="<?= base_url() ?>bast/add" class="btn btn-sm btn-success btn-brand" >
                  <i class="fa fa-plus"></i> <span> Submit &nbsp;&nbsp;&nbsp;&nbsp; </span>
                </a>
            </div>
					</div>
				
					<div class="col-sm-12">
						<table id="dataBast" class="table table-responsive-sm table-bordered" style="width: 100%;margin-top: 10px;">
			              <thead>
			                <tr>
			                  <th style="min-width: 33% !important">Project Name</th>
			                  <th style="min-width: 20% !important">Partner</th>
			                  <th style="min-width: 8% !important">Type</th>
			                  <th style="min-width: 15% !important">Date</th>
			                  <th style="min-width: 10% !important">Value</th>
			                  <th style="min-width: 14% !important">Status</th>
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
						<span> List Bast</span>
					</button>
			</div>

		</div>
	</div>
</div>


<script type="text/javascript">    
  var Page = function () {
    var tableInit = function(){    

        var table = $('#dataBast').DataTable({
                    initComplete: function(settings, json) {
                                $('.rupiah').priceFormat({
                                    prefix: '',
                                    centsSeparator: ',',
                                    thousandsSeparator: '.',
                                    centsLimit: 0
                                });
                                $(function () {
                                  $('[data-toggle="tooltip"]').tooltip()
                                });
                    },
                    processing: true,
                    serverSide: true,
                    ajax: { 
                        'url'  :base_url+'datatable/bast', 
                        'type' :'POST',
                        'data' : {
                                  status  : $('#status').val(),
                                  mitra   : $('#partner').val(),
                                  spk     : $('#spk').val(),                              
                                  segmen  : $('#segmen').val(),
                                  customer: $('#customer').val(),
                                  }    
                        },
                    aoColumns: [
                                { mData: 'PROJECT_NAME'},
                                { 
                                    'mRender': function(data, type, obj){   
                                            return obj.NAMA_MITRA+"</br><span class='badge badge-primary'>"+obj.NO_SPK+"</span>";   
                                    }            
                                            
                                },
                                { mData: 'TYPE_BAST'},
                                { mData: 'TGL_BAST2'},
                                { 
                                    'mRender': function(data, type, obj){   
                                            return "<span class='rupiah pull-right'>"+obj.NILAI_RP_BAST+"</span> ";   
                                    }            
                                            
                                }, 
                                { mData: 'STATUS'}
                               
                               ],
                               fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                                  var s = aData['STATUS'];
                                  switch(s) {
                                      case 'RECEIVED':
                                          $(nRow).addClass('received'); 
                                          break;
                                      case 'REVISION':
                                          $(nRow).addClass('revision'); 
                                          break;
                                      case 'REVISIONED':
                                          $(nRow).addClass('revision'); 
                                          break;    
                                      case 'TAKE OUT (REV)':
                                          $(nRow).addClass('revision'); 
                                          break;
                                      case 'CHECK BY ADM':
                                          $(nRow).addClass('cadm'); 
                                          break;
                                      case 'CHECK BY SE PMO':
                                          $(nRow).addClass('csepmo'); 
                                          break;
                                      case 'CHECK BY SE DI':
                                          $(nRow).addClass('csepmo'); 
                                          break;
                                      case 'CHECK BY COORD':
                                          $(nRow).addClass('ccoord'); 
                                          break;
                                      case 'APPROVED':
                                          $(nRow).addClass('approved'); 
                                          break;    
                                      case 'DONE':
                                          $(nRow).addClass('done'); 
                                          break;
                                      case 'TAKE OUT':
                                          $(nRow).addClass('takeout'); 
                                          break;    
                                      default:
                                          console.log(s);
                                    }

                                   $(nRow).addClass('row_links');
		                           $(nRow).data('link',base_url+'bast/show/'+aData['ID_BAST']); 
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

  $(document).ready(function() { 
      Page.init();
  });       
           
</script>