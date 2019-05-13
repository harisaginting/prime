
<div class="row">
 <div class="col-md-2">
 	
 </div>




</div>

<table id="dataActive" class="table table-responsive-sm table-bordered" style="width: 100%;margin-top: 10px;">
	<thead>
		<tr>
			<th style="width: 50%">NAME</th>
			<th style="width: 25%">VALUE</th>
			<th style="width: 20%">PROGRESS</th>
		</tr>
	</thead>
	 <tbody>
	</tbody>
</table>

<script type="text/javascript">    
  var Page = function () {

    var tableInit = function(){                     
        var table = $('#dataActive').DataTable({
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
                    order :[0,'desc'],
                    ajax: { 
                        'url'  :base_url+'datatable/project_active', 
                        'type' :'POST',
                        'data' : {
                                  status  : $('#status').val(),
                                  pm      : $('#pm').val(),
                                  customer: $('#customer').val(),
                                  regional: $('#regional').val(),
                                  type    : $('#type').val(),
                                  mitra   : $('#mitra').val(),
                                  segmen  : $('#segmen').val()
                                  }   
                        },
                    aoColumns: [
                        { 
                            'mRender': function(data, type, obj){
                            		var LOP = obj .ID_LOP_EPIC;
                                    if(obj .ID_LOP_EPIC == null){
                                       LOP = '-';                     
                                    }

                                    var id = "<div><small>ID: <strong>"+obj.ID_PROJECT+"</strong>&nbsp;&nbsp;&nbsp; LOP: <strong>"+LOP+"</strong></small></div>";



                                    var w = "";
                                    if((obj.STATUS=='DELAY'||obj.STATUS=='LAG')){
                                      if(obj.REASON_OF_DELAY == ""||obj.REASON_OF_DELAY == null){
                                        w = "&nbsp;&nbsp;&nbsp;<br><span  class='fa fa-exclamation-circle text-danger' data-toggle='tooltip' data-placement='right' data-original-title='Please fill reason of delay (Symptom)' aria-describedby='tooltip549771'></span>";
                                      }else{
                                        w = "<span class='text-primary'><br>SYMPTOM <span class='text-danger'>"+obj.REASON_OF_DELAY+"</span></span>";
                                      }
                                      
                                    }   

                                    return "<div style='padding: 5px 10px;'>"+id+"<span style='font-size:12px !important;font-family:sans-serif;font-weight:800;'>"+obj.NAME+"</span>"+"<div class='text-primary' style='font-size:12px;' >[SEGMEN <strong class='text-info' >"+obj.SEGMEN+"</strong>], "
                                      +"[PM <strong class='text-info' >"+obj.PM_NAME+"</strong>]"+w+"</div></div>";   
                            }            
                                    
                        }, 
                        { 
                            'mRender': function(data, type, obj){   
                                     return "<div style='margin:0px;'>"
                                      +"<div style='font-size:9px !important;margin-top:2px;background:#d5d5d550;padding-left:5px;font-family:sans-serif;font-weight:900;'>CONTRACT  <br><div class='rupiah' style='font-size:12px;width:100%;text-align:right;padding-right:5px;font-family:sans-serif;font-weight:900;'>"+obj.VALUE+"</div></div>"+
                                     "<div style='font-size:9px !important;background:#e5e5e550;padding-left:5px;'>PROGRESS TO ACHIEVE THIS WEEK<br><div class='rupiah' style='font-size:12px;text-align:right;width:100%;padding-right:5px;'>"+obj.POTENTIAL_WEEK+"</div></div>"+
                                     "<div style='font-size:9px !important;background:#f5f5f550;padding-left:5px;'>REMAINING PROGRESS TO ACHIEVE<br><div style='font-weight: bold;color:#000;font-size:12px;text-align:right;width:100%;padding-right:5px;' class='rupiah'>"+obj.POTENTIAL+"</div></div>"
                                     +"</div>"; 
                                    // return "<span class='rupiah pull-right'>"+obj.VALUE+"</span> ";   
                            }            
                                    
                        }, 
                        { 
                            'mRender': function(data, type, obj){   
                                    return "<div class='clearfix'>"
                                            +"<div class='float-left'>"
                                            +"<strong>"+obj.WEIGHT+"%</strong>"
                                            +"</div>"
                                            +"<div class='float-right'>"
                                            +"<small class='text-muted'>PLAN</small>"
                                            +"</div>"
                                            +"</div>"
                                            +"<div class='progress progress-xs'>"
                                            +"<div class='progress-bar bg-info' role='progressbar' "
                                            +"style='width: "+obj.WEIGHT+"%' aria-valuenow='"+obj.WEIGHT+"' aria-valuemin='0' "
                                            +"aria-valuemax='100'></div>"
                                            +"</div>"
                                            +"<div class='clearfix'>"
                                            +"<div class='float-left'>"
                                            +"<strong>"+obj.ACH+"%</strong>"
                                            +"</div>"
                                            +"<div class='float-right'>"
                                            +"<small class='text-muted'>ACHIEVEMENT</small>"
                                            +"</div>"
                                            +"</div>"
                                            +"<div class='progress progress-xs'>"
                                            +"<div class='progress-bar bg-success' role='progressbar' "
                                            +"style='width: "+obj.ACH+"%' aria-valuenow='"+obj.ACH+"' aria-valuemin='0' "
                                            +"aria-valuemax='100'></div>"
                                            +"</div>"
                                            ; 
                            }            
                                    
                        },  


                       ],  
                       fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                          var a = null;
                          if(aData['WEIGHT']==0){
                            $(nRow).addClass('disabled')  
                          }else{
                            $(nRow).addClass( aData['INDICATOR'] );  
                          }  
                          $(nRow).addClass('row_links');
                          $(nRow).data('link',base_url+'project/show/'+aData['ID_PROJECT']); 
                          return nRow;
                          }    
                });  
    };    
      return {
          init: function() { 
            tableInit();
            $(document).on('change','.Jselect2Active', function (e) {
              e.stopImmediatePropagation();
              $('#dataku').dataTable().fnDestroy();
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