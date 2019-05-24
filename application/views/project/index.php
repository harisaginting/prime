<style type="text/css">
	.btn-outline-secondary:not(:disabled):not(.disabled).active, .show > .btn-outline-secondary.dropdown-toggle{
		background: #7ab800;
		color: #fff;
	  }

	  .callout{
	    background: #595959;
	    color: #fff;
	  }

	  .table > tbody > tr > td{
	    font-size: 14px;  
	  }

	  .table>tbody>tr.danger>td{
	    background: #fd180033 !important;
	  }
	  .table>tbody>tr.info>td{
	    background: #dfdfdf !important;
	  }

	  .table>tbody>tr.warning>td{
	    background: #ffcc0033 !important;
	  }

	  .table>tbody>tr.success>td{ 
	    background: #00ff5933 !important; 
	  }

	  .table>tbody>tr.disabled>td{
	    background: #f7f7f7 !important;
	  } 

	  .id_project{
	    background-color: #e5e5e550 !important;
	    color: #000;
	    line-height: 1.5;
	    padding-left: 5px !important;
	    padding-top: 5px !important
	  }

	  .sorting_1{
	    padding: 0px !important;
	  }

	  .breadcrumb{
	    margin-bottom: 2px;
	  }

	  .select2-container .select2-selection{
	    background-color: #dfdfdf !important;
	  }

	  .select2-selection__rendered{
	    color: #300 !important;
	  }
</style>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-4">
						<h4 class="card-title mb-0">List Projects</h4>
						<div class="small text-muted">Service Delivery</div>
					</div>

					<div class="col-sm-8" style="margin-bottom: 15px;">
						<div class="btn-group btn-group-toggle float-right">
							<a class="selectTable btn btn-outline-secondary <?= ($type=='active') || (empty($type)) ? 'active' :''; ?>" data-id="active" href="<?= base_url(); ?>project/data/active">
							 Active
							</a>
							<a class="selectTable btn btn-outline-secondary <?= ($type=='closed') ? 'active' :''; ?>" data-id="closed" href="<?= base_url(); ?>project/data/closed" >
							 Closed
							</a>
							<a class="selectTable btn btn-outline-secondary <?= ($type=='no_pm') ? 'active' :''; ?>" data-id="no_pm"  href="<?= base_url(); ?>project/data/no_pm"> 
							 No PM
							</a>
							<a class="selectTable btn btn-outline-secondary <?= ($type=='candidate') ? 'active' :''; ?>" data-id="candidate"  href="<?= base_url(); ?>project/data/candidate">
							 Candidate
							</a>
						</div>


					</div>
				
					<div class="col-sm-12" id="table_content">
						<?php 
							switch ($type) {
								case 'closed':
									$this->load->view("project/table/closed");
									break;
								case 'no_pm':
									echo "not avaliable";
									//$this->load->view("project/table/no_pm");
									break;
								case 'candidate':
									echo "not avaliable";
									//$this->load->view("project/table/candidate");
									break;
								default:
									$this->load->view("project/table/active");
									break;
							}
						?>
					</div>
				</div>


			</div>
	

			<div class="card-footer">
				<button class="btn btn-brand btn-info btn-sm" type="button" style="margin-bottom: 4px">
						<i class="fa fa-download"></i>
						<span> Projects Active</span>
					</button>
			</div>

		</div>
	</div>
</div>