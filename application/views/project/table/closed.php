
<div class="row">
 <div class="col-md-2">
 	
 </div>

</div>

<table id="dataClosed" class="table table-responsive-sm table-bordered" style="width: 100%;margin-top: 10px;">
	<thead>
      <tr>
        <th style="width: 40%;">PROJECT NAME</th>
        <th style="width: 10%;">SEGMEN</th>
        <th style="width: 20%;">PROJECT MANAGER</th>
        <th style="width: 15%;">VALUE</th>
        <th style="width: 15%;">CLOSED</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script type="text/javascript">    
  var Page = function () {
    var tableInit = function(){                     
        var table = $('#dataClosed').DataTable({
                    initComplete: function(settings, json) {
                                $('.rupiah').priceFormat({
                                    prefix: '',
                                    centsSeparator: ',',
                                    thousandsSeparator: '.',
                                    centsLimit: 0
                                });
                    },
                    processing: true,
                    serverSide: true,
                    ajax: { 
                        'url'  :base_url+'datatable/project_closed', 
                        'type' :'POST',
                        'data' : {
                                  status  : $('#status').val(),
                                  pm      : $('#pm').val(),
                                  customer: $('#customer').val(),
                                  regional: $('#regional').val(),
                                  type    : $('#type').val(),
                                  mitra   : $('#mitra').val(),
                                  segmen  : $('#segmen').val(),
                                  escorded: $('#escorded').val(),
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
                                    var type ="<div style='font-size:10px;'>Type : <strong>"+obj.TYPE+"</strong></div>"

                                    return "<div style='padding: 5px 10px;'>"+id+"<span style='font-size:12px !important;font-family:sans-serif;font-weight:800;'>"+obj.NAME+"</span>"+type+"</div>";   
                            }            
                                    
                        }, 
                        { mData: 'SEGMEN'}, 
                       { 
                            'mRender': function(data, type, obj){   
                                    if(obj.PM_NIK!=null){
                                      return '['+obj.PM_NIK +"] <br><strong style='font-size:11px;'>"+ obj.PM_NAME+"</strong>";  
                                    }else{
                                      return 'NON PM';
                                    }
                           }
                                    
                        },  
                        { 
                            'mRender': function(data, type, obj){   
                                    return "<span class='rupiah pull-right'>"+obj.VALUE+"</span> ";   
                            }            
                                    
                        }, 
                        { 
                            'mRender': function(data, type, obj){   
                                    let a =  "<div style='font-size:12px;'><strong>"+obj.CLOSED_DATE2+"</strong><br>closed by : <br><strong style='font-size:10px;'>"+obj.CLOSED_BY_ID+" - "+obj.CLOSED_BY_NAME+" </strong></div>";
                                    return a; 
                            }            
                                    
                        },
                       ],      
                       fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                          var a = null;
                          if(aData['MANAGE_SERVICE']==1){
                            $(nRow).addClass('bg-primary')  
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
            $(document).on('change','.Jselect2', function (e) {
              e.stopImmediatePropagation();
              $('#datakuProjectClosed').dataTable().fnDestroy();
              tableInit();
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