<div class="row">
	<div class="col-sm-6 offset-md-3">
		<div class="card">
			<div class="card-header">
				<h6>Select Partner & P8</h6>
			</div>
			<div class="card-body">
				<form action="<?= base_url(); ?>bast/add"  method="post">
					<div class="form-group">
						<label> Select Partner</label>
						<select id="init_partner" name="init_partner" class="form-control Jselect2" required>
							<?php foreach ($partner as $key => $value) : ?>
										<option value="<?= $value['KODE_PARTNER'] ?>" ><?= $value['NAMA_PARTNER'] ?></option>
							 <?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label> Select P8</label>
						<select class="form-control" id="init_p8" name="init_p8" required disabled></select>
					</div>

					<div class="form-group text-center">
						<button class="btn btn-success btn-brand btn-md" type="submit">
							<i class="fa fa-forward"></i><span> Next &nbsp;</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
var Page = function (){
	return {
          init: function() { 
          	$(document).on('change','#init_partner',function(){
          		 $('#init_p8').attr("disabled",false);
          		 $("#init_p8").select2({
                            width: 'resolve',
                            ajax: {
                                type: 'POST',
                                url:base_url+"master/get_all_p8/"+ $('#init_partner').val(),
                                dataType: "json",
                                data: function (params) {
                                    return {
                                        q: params.term,
                                        page: params.page,
                                    };
                                },
                                processResults: function (data) {
                                    return {
                                        results: $.map(data.data, function(obj) {
                                            return { id: obj['NO_SPK'], text: obj['NO_SPK']};
                                        })
                                    };
                                },
                                
                            }
                    }); 
          	});

           }
      };
}();



$(document).ready(
	function(){
		Page.init();
	}
);
</script>