<style type="text/css">
  .b-white{
    border-color: #ffffff !important;
  }

    .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  height: 26px;
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 12px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  height: 26px;
  background-color: #2196F3;
}

input:focus + .slider {
  height: 16px;
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(40px);
  -ms-transform: translateX(40px);
  transform: translateX(40px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

</style>

<table id="dataQo" class="table table-responsive-sm table-bordered" style="width: 100% !important;">
    <thead>
      <tr>
        <th style="width: 40%;">No. SO</th>
        <th style="width: 45%;">Valid</th>
        <th style="width: 10%;"><i class="fa fa-times"></i></th>
      </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<div class="row">

  <div class="col-md-12">
    <div class="input-group">
      <input type="text" id="no_so"  name="no_so" class="form-control" placeholder="add No. SO">
      <span class="error hidden" id="so_empty"> this field is required!</span>
      
      <div class="input-group-append" id="addNo">
        <span class="input-group-text bg-success">
        <i class="fa fa-plus"></i>
        </span>
      </div>
    
    </div>
  </div>

</div>

<script type="text/javascript">    
  var Page = function () {  
        var counter = 1; 
          var table = $('#dataQo').DataTable({
                
              destroy: true,
              paging: false,
              searching: false,
              info : false,
              ordering : false,
              });

      <?php if(!empty($data)) : foreach($data as $key => $value): ?>
          table.row.add( [
                      "<input name='no_quote[]' type='text' value='<?= $value['NO_SO']; ?>' class='form-control b-white' />",
                      "<label class='switch'><input class='validateaction' data-quote='<?= $value['NO_QUOTE'];?>' data-so='<?= $value['NO_SO'];?>' type='checkbox' data-lop='<?= $value['ID_LOP'];?>' <?= $value['VALID']==1 ? 'checked' : ''; ?> ><span class='slider round'></span></label>",
                      "<button type='button' class='btn circle btn-danger btn-delete-row' data-quote='<?= $value['NO_QUOTE'];?>' data-so='<?= $value['NO_SO'];?>' data-lop='<?= $value['ID_LOP'];?>' ><i class='fa fa-trash'></i></button>",
                  ] ).draw( false );
            counter++;
        <?php endforeach; endif;?>



      return {
          init: function() {  
            $('#dataQo tbody').on( 'click', '.btn-delete-row', function () {
            table
              .row( $(this).parents('tr') )
              .remove()
              .draw();

            $.ajax({
                  url: base_url+'wfm/delete_so',
                  type:'POST',
                  data: {no_p8 : $('#no_p8').val(),no_so : $(this).data('so') },
                  success:function(data){
                  return true;
                }
              });
            });
      }
    }
  }();

  jQuery(document).ready(function() {
      Page.init();
  });       
           
</script>