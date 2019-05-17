<style>


	.tab-pane{
		height: 500px;
		max-height: 500px;
		min-height: 500px;
		overflow-y: scroll;
		overflow-x: hidden;
	}

	.table{
		border : 1px solid #acacac;
	}
	.card .card-header { 
    cursor: pointer;
    display: flex;
    align-items: center; 
	}

	.card .card-header .fa-stack-1x {
	  color: white;
	}

	.gantt_cal_template{
		height: 29px;
	}

	.gantt_cal_lsection{
		padding-bottom: 0px !important;
	}

	.gantt_cal_template #description_task{
		height: 80px !important;
	}

	.alert-success{
		width: 100%;
	}

	.bg-navy{
		background-color: #595959;
		color: #e4e5e6;
	}

	td{
		font-size: 12px;
	}
</style>

	<div class="row">

		<div class="col-sm-12 col-sm-12">
			<div class="card">
				<div class="card-header no-border">
					<strong>Base Information</strong>
					<div class="card-actions">
					<a href="#" class="btn-minimize no-border" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="true"><i  class="icon-arrow-down" style="color: #fff;"></i></a>
					</div>
				</div>
				<div class="card-body collapse show" id="collapseExample1" style="">
					<div class="row">
						<div class="col-sm-7">
							<table class="table" style="border:1px solid #29363d;">
								<tr>
									<td class="meta-project">NAME</td>
									<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;" colspan="3" ><?= $project['NAME'];?>
										<?php if($edit == 1) : ?>	
											<span class="btn btn-danger pull-right btn_edit_project btn-sm" data-field="NAME">
											<i class="fa fa-edit"></i>
											</span>
										<?php endif; ?>
									</td>
								</tr>

									<tr>
										<td class="meta-project">DESCRIPTION</td>
										<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;" colspan="3"  ><?= $project['DESCRIPTION'];?>
										<?php if($edit == 1) : ?>	
											<span class="btn btn-danger pull-right btn_edit_project btn-sm" data-field="DESCRIPTION">
											<i class="fa fa-edit"></i>
											</span>
										<?php endif; ?>
										</td>
									</tr>



								<tr>
									<td class="meta-project">VALUE (IDR)</td>
									<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;" colspan="3" class="rupiah" ><?= $project['VALUE'];?>
									</td>
								</tr>
								<tr>
									<td class="meta-project">ID</td>
									<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;"><?= $project['ID_PROJECT'];?>
									</td>

									<td class="meta-project">ID LOP</td>
									<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;"><?= !empty($project['ID_LOP_EPIC']) ? $project['ID_LOP_EPIC'] : " - " ?></td>
								</tr>
								<tr>
									<td class="meta-project">CUSTOMER</td>
									<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;" ><?= $project['STANDARD_NAME'];?>
										<?php if($edit == 1) : ?>	
											<span class="btn btn-danger pull-right btn_edit_project btn-sm" data-field="CUSTOMER">
											<i class="fa fa-edit"></i>
											</span>
										<?php endif; ?>
									</td>
									<td class="meta-project">NIPNAS</td>
									<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;" ><?= $project['NIP_NAS'];?>
									</td>
								</tr>

								<tr>
									<td class="meta-project" >SEGMEN</td>	
									<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;width: 30%;"> <?= $project['SEGMEN'] ?>
										<?php if($edit == 1) : ?>	
											<span class="btn btn-danger pull-right btn_edit_project btn-sm" data-field="SEGMEN">
											<i class="fa fa-edit"></i>
											</span>
										<?php endif; ?>
									</td>	
									<td class="meta-project" >ACCOUNT MANAGER</td>	
									<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;width: 30%;"> <?= $project['AM_NAME'] ?>
										<?php if($edit == 1) : ?>	
											<span class="btn btn-danger pull-right btn_edit_project btn-sm" data-field="AM_NAME">
											<i class="fa fa-edit"></i>
											</span>
										<?php endif; ?>
									</td>
								</tr>

								<tr>
									<td class="meta-project" >TYPE</td>	
									<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;width: 30%;"> <?= $project['TYPE'] ?>
										<?php if($edit == 1) : ?>	
											<span class="btn btn-danger pull-right btn_edit_project btn-sm" data-field="TYPE">
											<i class="fa fa-edit"></i>
											</span>
										<?php endif; ?>
									</td>	
									<td class="meta-project" >SCALE</td>	
									<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;width: 30%;"> <?= $project['SCALE'].' DEAL'; ?>
									</td>
								</tr>

								<?php if (empty($partners[0]['PARTNERS'])) { ?>
									<tr>
										<td class="meta-project">PARTNERS</td>
										<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;" colspan="3" > - </td>
									</tr>
								<?php }else{ ?>
									<tr>
										<td class="meta-project" >PARTNERS</td>
										<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;" colspan="3" ><?=$partners[0]['PARTNERS']?></td>
									</tr>
								<?php } ?>

								<tr>
									<td class="meta-project">NO. KB</td>
									<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;" colspan="3" ><?= $project['NO_KB']?>
										<?php if($edit == 1) : ?>	
											<span class="btn btn-danger pull-right btn_edit_project btn-sm" data-field="NO_KB">
											<i class="fa fa-edit"></i>
											</span>
										<?php endif; ?>
									</td>
								</tr>

								<tr>
									<td class="meta-project">NO. KL</td>
									<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;" colspan="3" ><?= $project['NO_KL']?>
										<?php if($edit == 1) : ?>	
											<span class="btn btn-danger pull-right btn_edit_project btn-sm" data-field="NO_KL">
											<i class="fa fa-edit"></i>
											</span>
										<?php endif; ?>
									</td>
								</tr>
								
								<tr>
									<td class="meta-project">LOCATION</td>
									<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;" colspan="3" ><?= 'REGIONAL '.$project['REGIONAL']?>
										<?php if($edit == 1) : ?>	
											<span class="btn btn-danger pull-right btn_edit_project btn-sm" data-field="REGIONAL">
											<i class="fa fa-edit"></i>
											</span>
										<?php endif; ?>
									</td>
								</tr>


							</table>



							<div class="card" style=" border-radius: 0px;padding: 0px;margin:0px;border:1px solid #29363d;color: #fff">
								<div class="card-header" id="accordionheaderDOCUMENT" data-toggle="collapse" data-target="#accordioncollapseDOCUMENT" aria-expanded="false" aria-controls="accordioncollapseDOCUMENT" style=" border-radius: 0px;padding: 0px;">
							        <div style="width: 100%;background: #29363d;">
							        	<label style="padding: 5px;padding-bottom: 0px;">DOCUMENT</label>

							        <span class="fa-stack pull-right" style="background: #dfdfdf">
							           <i class="icon-arrow-down bg-info" style="background: #29363d;"></i>
							           <i class="icon-arrow-up fa-stack-2x " style="background: #29363d;font-size: 25px;padding-top: 5px;"></i>
							           
							        </span>
							        </div>
							     </div>

							     <div id="accordioncollapseDOCUMENT" class="collapse collapsex" aria-labelledby="accordionheaderDOCUMENT" data-parent="#accordioncollapseDOCUMENT" style="">
							        <div class="card-body" style=" border-radius: 0px;padding: 0px;color: #29363d">
							           <div class="row">
							           		<div class="col-sm-12">
							           			<table class="table table-striped" style="margin-bottom: 0px;margin-top: 0px;">
							           	 <tbody>
							           	 <?php foreach ($project['document'] as $key => $value) : ?>
							           	 	
							           	 		<tr>
								           	 		<td style="width: 30%;overflow: hidden;">
								           	 			<a class="text-black" style="text-decoration: none;"  href="<?= base_url(); ?>../_files/<?= $value['ATTACHMENT'] ?>" target="_blank">
								           	 					<?= $value['CATEGORY'] ?>
								           	 			</a>
								           	 		</td>
								           	 		<td style="width: 70%;overflow: hidden;">
								           	 			<a class="text-black" style="text-decoration: none;overflow: hidden;"  href="<?= base_url(); ?>../_files/<?= $value['ATTACHMENT'] ?>" target="_blank">
								           	 					<?= $value['NAME'] ?>
								           	 			</a>
								           	 		</td>
								           	 	</tr>
							           	 	
							           	 <?php endforeach; ?>
							           	 		<?php if($edit == 1) : ?>	
													<tr>
								           	 			<td colspan="2" style="padding:0px !important;text-align: center;">
								           	 				<button id="btn_add_document" class="btn btn-success" style="width: 100%;">ADD DOCUMENT</button>
								           	 			</td>
								           	 		</tr>
												<?php endif; ?>
							           	 		
							           	</tbody>
							           </table>
							           		</div>
							           </div>
							        </div>
					      		</div>
						     </div>
						</div>

					<div class="col-sm-5">

						<?php if(!empty($project['PM_NAME'])) : ?>

						<div class="callout callout-info" style="margin-top: 0px;border-left-color: #29363d;border-right: 1px solid #29363d !important;border-top: 1px solid #29363d !important;border-bottom: 1px solid #29363d !important;padding:5px !important;padding-bottom: 0px !important; ">
							<div class="row">
								<div class="col-sm-8">
									<small class="h5" style="color:#29363d !important#29363d !important;" ><?= $project['PM_NAME'] ?></small>
									<br>
									<strong class="h6">Project Manager</strong>
									<table class="table" style="margin-top: 20px;margin-left: -5px !important;margin-bottom: 0px !important;">
										<tbody style="">
											<tr>
												<td style="border-top: 0px;border-bottom: 1px solid #acacac;background-color: #29363d;color:#f7f7f7;font-size:11px;width: 31%; ">PHONE</td>
												<td style="border-top: 0px;border-bottom: 1px solid #acacac;background-color: #40404022"><?= $project['pm']['NO_HP'] ?></td>
											</tr>
											<tr>
												<td style="border-top: 0px;background-color: #29363d;color:#f7f7f7;font-size:11px;">EMAIL</td>
												<td style="border-top: 0px;background-color: #40404022"><?= $project['pm']['EMAIL'] ?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-sm-4">
									<div class="" style="width: 90%;">
										<img class="img-avatar" style="width: 100%;height: 100%;" src="https://prime.telkom.co.id/sdv/<?= !empty($project['pm']['PHOTO_URL'])? $project['pm']['PHOTO_URL'] : '../user_picture/default-profile-picture.png' ; ?>" alt="<?= $project['PM_NAME'] ?>">
										<!-- <span class="avatar-status badge-success"></span> -->
									</div>
								</div>
							</div>
						</div>

						<?php endif; ?>

						<table class="table" style="border:1px solid #29363d;">

								<tr>
									<td class="meta-project">STATUS</td>
									<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;" colspan="3" ><?= $project['STATUS']?>
										<?php if($edit == 1) : ?>	
											<span class="btn btn-danger pull-right btn_edit_project btn-sm" data-field="STATUS">
											<i class="fa fa-edit"></i>
											</span>
										<?php endif; ?>
									</td>
								</tr>


								<tr>
									<td class="meta-project" >START DATE</td>	
									<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;width: 30%;"> <?= $project['START_DATE2'] ?>
										<?php if($edit == 1) : ?>	
											<span class="btn btn-danger pull-right btn_edit_project btn-sm" data-field="START_DATE">
											<i class="fa fa-edit"></i>
											</span>
										<?php endif; ?>
									</td>	
									<td class="meta-project" >END DATE</td>	
									<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;width: 30%;"> <?= $project['END_DATE2'] ?>
										<?php if($edit == 1) : ?>	
											<span class="btn btn-danger pull-right btn_edit_project btn-sm" data-field="END_DATE">
											<i class="fa fa-edit"></i>
											</span>
										<?php endif; ?>
									</td>
								</tr>

								<tr>
									<td class="meta-project">DURATION</td>
									<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;" colspan="3" ><?= $project['CURRENT_DAY'].' of '.$project['DAY_DURATION'] ?> Days <br> <?= $current_week ?> of <?= $project['TOTAL_WEEK'] ?> Weeks</td>
								</tr>
								<tr>
									<td class="meta-project">LAST UPDATE</td>
									<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;" colspan="3" ><?= $project['UPDATED_DATE2']?></td>
								</tr>
								
								<tr>
									<td class="meta-project">SYMPTOM</td>
									<td style="background: #e4e5e6;font-family:sans-serif;font-weight:700;padding:0px;" colspan="3" >
									<?php if(!empty($symptoms)) : ?>
										<?php foreach ($symptoms as $key => $value) : ?>
											<div class="col-sm-12" style="padding-left: 10px;">
												<div class="col-sm-12" style="padding-left: 0px !important;background: #b2b3b4;" ><?= $value['DATES'] ?></div>
												<div class="col-sm-12" style="font-weight: 900;padding-bottom: 15px;background: #d2d2d2;"><?= $value['SYMPTOM'] ?></div>
											</div>
										<?php endforeach; ?>	
										<?php endif; ?>	
											<?php if($project['STATUS'] != 'LEAD') : ?>	
												<?php if($edit == 1) : ?>
												<span class="btn btn-danger pull-right btn_edit_project btn-sm" data-field="SYMPTOM" style="margin:3px;margin-right:7px">
													<i class="fa fa-edit"></i>
												</span>					
												<?php endif;  ?>	
											<?php endif; ?>
									</td>
								</tr>
								
						</table>

					</div>
					</div>

				</div>
			</div>
		</div>


<?php 

if($edit==1){
	$this->load->view('project/show_edit');
}else{
	$this->load->view('project/show_no_edit');
}


?>