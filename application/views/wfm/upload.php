<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card">
			<div class="card-header">
				<h6>Upload WFM Validation File Excel</h6>
			</div>
			<div class="card-body">
				<?=$this->session->flashdata('notification')?>
				<form id="form_upload_wfm" method="post" action="<?= base_url() ?>wfm/upload_proccess" enctype="multipart/form-data">
					<div class="form-group">
						<label class="mini-label"></label>
						<input type="file" name="validation_wfm" id="validation_wfm" accept=".xls,.xlsx"  class="form-control fileinput" required>
					</div>
					<div class="text-center" style="margin-bottom: 20px;">
						<button id="submit_file" type="submit" class="btn btn-success btn-brand">
							<i class="fa fa-upload"></i>
							<span> Validate </span>
						</button>
					</div>  
					<div class="alert alert-primary"><i class="fa fa-info-circle"></i> Pastikan mengupload file dengan extensi .Xls atau Xlxs dengan kolom A sebagai data nomor P8/SPK dan kolom B dengan nomor SO.</div>
				</form>
			</div>
		</div>
	</div>
</div>