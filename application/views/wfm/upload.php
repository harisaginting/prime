<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card">
			<div class="card-header">
				<h6>Upload WFM Validation File Excel</h6>
			</div>
			<div class="card-body">
				<form id="form_upload_wfm" method="post" action="<?= base_url() ?>wfm/upload_proccess" enctype="multipart/form-data">
					<div class="form-group">
						<label class="mini-label"></label>
						<input type="file" name="validation_wfm" id="validation_wfm" accept=".xls,.xlsx"  class="form-control fileinput" required>
					</div>
					<div class="text-center">
						<button id="submit_file" type="submit" class="btn btn-info btn-brand">
							<i class="fa fa-upload"></i>
							<span> Validate </span>
						</button>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>