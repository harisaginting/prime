
<style type="text/css">
  @import url(https://fonts.googleapis.com/css?family=Open+Sans);

/*Page styles*/


/*Checkboxes styles*/
input[type="checkbox"] { display: none; }

input[type="checkbox"] + label {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 10px;
  font: 14px/20px;
  color: #000;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
}

input[type="checkbox"] + label:last-child { margin-bottom: 0; }

input[type="checkbox"] + label:before {
  content: ''; 
  display: block;
  width: 20px;
  height: 20px;
  border : 2px solid #21b900;
  position: absolute;
  left: 0;
  top: 0;
  opacity: .6;
  -webkit-transition: all .12s, border-color .08s;
  transition: all .12s, border-color .08s;
}

input[type="checkbox"]:checked + label:before {
  width: 10px;
  top: -5px;
  left: 5px;
  border-radius: 0;
  opacity: 1;
  border-top-color: transparent;
  border-left-color: transparent;
  -webkit-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>


<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<span class="text-muted">Form submit BAST</span>
				<h6><?= $NAMA_MITRA?></h6>
			</div>
			<div class="card-body">
				<form id="form_bast" method="post" action="<?= base_url() ?>add_proccess" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="mini-label">ID  LOP</label>
								<input type="text" name="id_lop" id="id_lop" class="form-control" value="<?= $ID_LOP?>" readOnly>
							</div>
							<div class="form-group">
								<label class="mini-label">No. P8</label>
								<input type="text" name="no_p8" id="no_p8" class="form-control" value="<?= $NO_SPK ?>" required readOnly>
							</div>

							<div class="form-group">
								<label class="mini-label">P8 Date</label>
								<input type="text" name="no_p8" id="no_p8" class="form-control date-picker" value="<?= $DATE_P8 ?>" required>
							</div>
				
							<div class="form-group">
								<label class="mini-label">Customer</label>
								<input type="hidden" name="nipnas" id="nipnas" value="<?= $NIPNAS ?>">
								<input type="text" name="customer" id="customer" value="<?= $NAMA_CC ?>" class="form-control" readOnly required>
							</div>

							<div class="form-group">
								<label class="mini-label">Segmen</label>
								<input type="text" name="segmen" id="segmen" value="<?= $SEGMEN ?>" class="form-control" required readOnly>
							</div>

							<div class="form-group">
								<label class="mini-label">Project Name</label>
								<textarea type="text" name="project" id="project" rows="4" class="form-control"><?= $PROJECT_NAME ?></textarea>
							</div>
							
							<div class="form-group">
								<label class="mini-label">Value</label>
								<input type="text" name="value" id="value" class="form-control rupiah" value="<?= $VALUE ?>" required>
							</div>

							<div class="form-group">
								<label class="mini-label">KL</label>
								<input type="text" name="kl" id="kl" class="form-control" placeholder="no. kontrak layanan">
							</div>

							<div class="form-group">
								<label class="mini-label">KL Date</label>
								<input type="text" name="kl_date" id="kl_date" class="form-control date-picker" placeholder="tanggal kontrak layanan">
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label class="mini-label"> BAST Date</label>
								<input type="text" name="bast_date" id="bast_date" class="form-control date-picker">
							</div>

							<div class="form-group">
								<label class="mini-label"> BAST Value</label>
								<input type="text" name="bast_value" id="bast_value" class="form-control rupiah">
							</div>
							

							<div class="form-group">
								<label class="mini-label"> Progress Project(%)</label>
								<input type="number" name="progress" id="progress" class="form-control">
							</div>

							<div class="form-group">
								<label class="mini-label"> Signer</label>
								<select id="signer" name="signer" class="form-control Jselect2" required>
									<option value="" disabled selected>Select Signer</option>
					                <option value="Coordinator Project Management">OSM Service Delivery - Sosro Hutomo Karsosoemo</option>
					                <option value="Senior Expert Project Management Office 1">Senior Expert Project Management Office 1 - Ristyawan Fauzi Mubarok</option>
					                <option value="Senior Expert Project Management Office 2">Senior Expert Project Management Office 2 - Heri Ikhwan Diana</option>
					                <option value="Senior Expert Delivery and Integration">Senior Expert Delivery and Integration - Retno Kurniawati</option>  
								</select>
							</div>

							<div class="form-group">
								<label class="mini-label">Term Of Payment</label>
								<select id="top" name="top" class="form-control Jselect2" required >
									 <option value="" disabled selected>Select Type</option>
					                  <option value="OTC">OTC</option>
					                  <option value="TERMIN">TERMIN</option>
					                  <option value="PROGRESS">PROGRESS</option>
					                  <option value="RECURRING">RECURRING</option>
					                  <option value="OTC & RECURRING">OTC & RECURRING</option>
								</select>
							</div>

							<div id="progress_periode" class="form-group container_top">
					            <label class="control-label">Periode Progress Reccuring</label>
					              <div class="input-daterange input-group">
					                <input type="text" class="form-control date-picker" name="recc_start_date" placeholder="mm/dd/yyyy">
					                  <span class="input-group-addon" style="color:#000;">&nbsp;&nbsp; to &nbsp;&nbsp;</span>
					                  <input type="text" class="form-control date-picker" name="recc_end_date" placeholder="mm/dd/yyyy">
					                </div>
					            </div>

					          <div id="c_reccuring_val" class="form-group container_top">
					            <label class="control-label">Reccuring Value (Rp.)</label>
					                <input type="text" class="form-control rupiah" id="reccuring_val" name="reccuring_val" placeholder="Reccuring value">
					            </div>

					          <div class="form-group container_top" id="c_termin">
					            <label for="name">Termin</label>
					            <input type="text" class="form-control" id="termin" name="termin" placeholder="Termin Remarks">
					          </div>

							<div id="evidence" class="form-group" style="margin-bottom: 7px !important">
				               <label>Evidence</label>
				               <div class="row">
				               <div class="col-sm-2">
				                 <div class="boxes">
				                    <input type="checkbox" id="cP71" name="cP71" data-val="P71">
				                    <label for="cP71">P7-1</label>

				                    <input type="checkbox" id="cSP" name="cSP" data-val="SP">
				                    <label for="cSP">SP</label>

				                    <input type="checkbox" id="cSPK" name="cSPK" data-val="SPK">
				                    <label for="cSPK">SPK</label>

				                    <input type="checkbox" id="cWO" name="cWO"  data-val="WO">
				                    <label for="cWO">WO</label>

				                    <input type="checkbox" id="cKL" name="cKL" data-val="KL">
				                    <label for="cKL">KL</label>
				                  </div>
				               </div>

				               <div class="col-sm-10">
				                 <div class="boxes">

				                    <input type="checkbox" id="Baut" name="Baut" data-val="Baut">
				                    <label for="Baut" >BA Uji Terima (BAUT) / BAPP Smart Building</label>

				                    <input type="checkbox" id="BAprogress2" name="BAprogress2" data-val="BAprogress2">
				                    <label for="BAprogress2" >Lampiran Rincian Perhitungan Progress</label>

				                    <input type="checkbox" id="BAcustomer" name="BAcustomer" data-val="BAcustomer">
				                    <label for="BAcustomer">BA Customer (BASO/BAST Customer)</label>

				                    <input type="checkbox" id="BAperformansi" name="BAperformansi" data-val="BAperformansi">
				                    <label for="BAperformansi">BA Performansi (Untuk layanan berbasis SLG)</label>

				                    <input type="checkbox" id="BArekonsiliasi" name="BArekonsiliasi" data-val="BArekonsiliasi">
				                    <label for="BArekonsiliasi">BA Rekonsiliasi (Untuk layanan Transaksional berbasis rekon)</label>

				                    <input type="checkbox" id="BAketerlambatan" name="BAketerlambatan" data-val="BAketerlambatan">
				                    <label for="BAketerlambatan" >BA Keterlambatan Delivery</label>

				                    <input type="checkbox" id="BAprogress" name="BAprogress" data-val="BAprogress">
				                    <label for="BAprogress" >BAPP (BA Progress Pekerjaan)</label>

				                    <input type="checkbox" id="OtherE" name="OtherE" data-val="Other" class="OtherE">
				                    <label for="OtherE" class="OtherE" >Other</label>
				                    <input type="text" class="form-control hidden" name="val_other" id="val_other" placeholder="type another attached evidence">
				                  
				                  </div>          
				               </div>
				               </div>
				           </div> 

				           <div class="form-group" id="c_pic_email">
				            <label class="mini-label">Email Person In Charge</label>
				             <select type="text" class="form-control" id="pic_email" name="pic_email" placeholder="Email Person In Charge"></select>
				             <input type="hidden" class="form-control" id="pic_email2" name="pic_email2">
				          </div>

				          <div class="form-group hidden" id="c_pic">
				            <label class="mini-label">PIC Partner / Subsidiary *</label>
				             <input type="text" class="form-control" id="pic" name="pic" placeholder="Person In Charge">
				          </div>

				          <input type="hidden" class="form-control" id="evidence_field" name="evidence">
						</div>
						
						
						<div class="col-md-12 text-center">
							<button class="btn btn-success btn-brand btn-md" type="button" id="btn_submit"> <i class="fa fa-plus"></i> <span> Submit &nbsp;</span> </button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
var Page = function (){

	var top_bast = function($vals=null) {
          $(".container_top").addClass('hidden');     
          $("#bast_value").removeClass('readOnly',false);  

           switch ($vals) {
              case "OTC":
                  $("#bast_value").val($('#value').val()); 
                  $("#bast_value").removeClass('readOnly',true); 
                  break;
              case "TERMIN":
                  $("#c_termin").removeClass('hidden');  
                  break;
              case "PROGRESS":
                  $("#c_progress_actual").removeClass('hidden');   
                  break;
              case "RECURRING":
                  $("#progress_periode").removeClass('hidden');  
                  break;
              case "OTC & RECURRING":
                  $("#progress_periode").removeClass('hidden');  
                  $("#c_reccuring_val").removeClass('hidden');  
                  break;
           } 
        };


return{
		init : function (){
			top_bast();
			$(document).on('change','#top',function(e){
                    e.stopImmediatePropagation();
                    top_bast($(this).val());
              });

			$("#pic_email").select2({
                placeholder: "select email PIC",
                width: 'resolve',
                allowClear:true,
                tags:true,
                ajax: {
                    type: 'POST',
                    delay: 200,
                    url: base_url+"bast/get_all_pic",
                    dataType: "json",
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page,
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function(obj) {
                                return { id: obj.NAME+'||'+obj.EMAIL, text: obj.EMAIL };
                            })
                        };
                    },
                    
                }
            });


            $(document).on('change','#pic_email',function(e){
                  var eMval = $('#pic_email').val();
                  var eMitra = eMval.split("||");
                  console.log(eMitra);
                  if(eMitra.length<=1){
                      $('#c_pic').removeClass('hidden');
                      $('#pic_email2').val(eMval);
                  }else{
                      $('#c_pic').addClass('hidden');
                      $('#pic_email2').val(eMitra[1]);
                      $('#pic').val(eMitra[0]);
                    }
              });

              $(document).on('click','.OtherE',function(e){
                if ($('#OtherE').is(':checked')) {
                      $('#val_other').removeClass('hidden');
                }else{
                      $('#val_other').addClass('hidden');
                }  
              }); 



              $(document).on('click','#btn_submit',function(e){
                    e.stopImmediatePropagation();
                      var evidence = [];
                      if ($('#BAcustomer').is(':checked')) {evidence.push($('#BAcustomer').data('val'))}else{evidence.push(' ');}
                      if ($('#BAperformansi').is(':checked')) {evidence.push($('#BAperformansi').data('val'))}else{evidence.push(' ');}
                      if ($('#BArekonsiliasi').is(':checked')) {evidence.push($('#BArekonsiliasi').data('val'))}else{evidence.push(' ');}
                      if ($('#BAprogress').is(':checked')) {evidence.push($('#BAprogress').data('val'))}else{evidence.push(' ');}
                      if ($('#BAketerlambatan').is(':checked')) {evidence.push($('#BAketerlambatan').data('val'))}else{evidence.push(' ');}   
                      if ($('#cSPK').is(':checked')) {evidence.push($('#cSPK').data('val'))}else{evidence.push(' ');}    
                      if ($('#cWO').is(':checked')) {evidence.push($('#cWO').data('val'))}else{evidence.push(' ');}    
                      if ($('#cKL').is(':checked')) {evidence.push($('#cKL').data('val'))}else{evidence.push(' ');}       
                     /*8*/ evidence.push($('#termin').val());    
                      if ($('#Baut').is(':checked')) {evidence.push($('#Baut').data('val'))}else{evidence.push(' ');} 
                      if ($('#cP71').is(':checked')) {evidence.push($('#cP71').data('val'))}else{evidence.push(' ');}   
                      if ($('#cSP').is(':checked')) {evidence.push($('#cSP').data('val'))}else{evidence.push(' ');}  
                      if ($('#BAprogress2').is(':checked')) {evidence.push($('#BAprogress2').data('val'))}else{evidence.push(' ');}  
                      if ($('#OtherE').is(':checked')) {evidence.push($('#val_other').val())}else{evidence.push(' ');}  
                      $('#evidence_field').val(evidence);
                      if($('#form_bast').valid()){
                          bootbox.prompt({
                                  title: "Confirm Data",
                                  placeholder: "Write some note?",
                                  inputType: 'textarea',
                                  buttons: {
                                      confirm: {
                                          label: '<i class="fa fa-check"></i><span> Submit </span>',
                                          className: 'btn-success'
                                      },
                                      cancel: {
                                          label: '<i class="fa fa-times"></i><span> Cancel </span>',
                                          className: 'btn-danger col-sm-offset-4'
                                      }
                                  },
                                  callback: function(result) {
                                    console.log(result);
                                      if(result!=null){
                                        $('#commend').val(result);
                                        $('#pre-load-background').fadeIn();
                                        $('.rupiah').unmask();
                                        $('#value').val($('#value').unmask());
                                        $('#bast_value').val($('#bast_value').unmask());
                                        $('#reccuring_val').val($('#reccuring_val').unmask());

                                        var form = $('form')[0];
                                        var formData = new FormData(form);
                                        $.ajax({
                                                      url: base_url+'bast/submitBast',
                                                      type:'POST',
                                                      dataType : "json",
                                                      data:  formData ,
                                                      async : true, 
                                                      processData: false,
                                                      contentType: false,
                                                      processData:false,
                                                      success:function(result){
                                                        if(result.data=='success'){
                                                        bootbox.alert("Success!", function(){ 
                                                        var url = base_url+"bast/view/"+result.id_bast;
                                                        window.location.href = url;
                                                        
                                                        console.log('success Add BAST!'); 
                                                        });
                                                        }else{
                                                        bootbox.alert("Failed!", function(){ 
                                                        console.log('failed Add BAST!'); });
                                                        }
                                                      return result;
                                                      },
                                                       error: function(xhr, error){
                                                              bootbox.alert("Failed!", function(){ 
                                                              console.log('failed update BAST!'); });
                                                       },

                                              });
                                        $('#pre-load-background').fadeOut();
                                      }
                                      else{
                                          bootbox.hideAll();
                                      }
                                  }
                              }); 
                            
                      }else{
                      	console.log('something wrong');
                      }

                       

              });
		}
	}
}()


$(document).ready(
	function(){
		Page.init();
	}
);
</script>