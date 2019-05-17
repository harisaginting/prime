		<div class="col-sm-12">
			<div class="card">
				<div class="card-header no-border">
					Progress
					<div class="card-actions">
					<a href="#" class="btn-minimize no-border" data-toggle="collapse" data-target="#progress_con" aria-expanded="true"><i  class="icon-arrow-down" style="color: #fff;"></i></a>
					</div>
				</div>

				<div class="card-body collapse show" id="progress_con" style="">
				<div class="col-sm-12" style="margin-top: 10px; margin-bottom: 15px;font-size: 14px;">
					<div class="row text-center">
						<div class="col-sm-12 col-md mb-sm-2 mb-0">
							<div class="clearfix">
							<div class="float-left">
								<strong><?= !empty($progress->ACHIEVEMENT) ? floatval($progress->ACHIEVEMENT) : 0; ?>%</strong>
							</div>
							<div class="float-right">
								<small class="text-muted">ACHIEVEMENT</small>
							</div>
							</div>
							<div class="progress progress-xs">
								<div class="progress-bar bg-success" role="progressbar" style="width: <?= !empty($progress->ACHIEVEMENT) ? floatval($progress->ACHIEVEMENT) : 0; ?>%" aria-valuenow="<?= !empty($progress->ACHIEVEMENT) ? floatval($progress->ACHIEVEMENT) : 0; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>

						<div class="col-sm-12 col-md mb-sm-2 mb-0">
							<div class="clearfix">
							<div class="float-left">
								<strong><?= !empty($progress->WEIGHT) ? floatval($progress->WEIGHT) : 0; ?>%</strong>
							</div>
							<div class="float-right">
								<small class="text-muted">WEIGHT DELIVERABLES</small>
							</div>
							</div>
							<div class="progress progress-xs">
								<div class="progress-bar bg-info" role="progressbar" style="width: <?= !empty($progress->WEIGHT) ? floatval($progress->WEIGHT) : 0; ?>%" aria-valuenow="<?= !empty($progress->WEIGHT) ? floatval($progress->WEIGHT) : 0; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
					</div>
				</div>

					<div class="col-sm-12" style="border: 1px solid #acacac;padding: 10px;">
						<div id="chartProgress" class="chart-view" style=""></div>
					</div>

					<div class="col-sm-12" style="padding-left: 0px;padding-right: 0px;">
						<!-- DELIVERABLES -->
						<ul class="nav nav-tabs" style="font-size: 14px;border:1px solid #acacac;margin-top: 5px;display: flex;background: #ddd" role="tablist">
							<li class="nav-item" style="">
								<a class="nav-link active show" data-toggle="tab" href="#deliverables" role="tab" aria-controls="deliverables" aria-selected="true">
								 DELIVERABLE
								</a>
							</li>
							<li class="nav-item" style="">
								<a class="nav-link" data-toggle="tab" href="#issueAp" role="tab" aria-controls="issueAp" aria-selected="false">
								 ISSUE & ACTION PLAN
								</a>
							</li>
							<li class="nav-item" style="">
								<a class="nav-link" data-toggle="tab" href="#bast" role="tab" aria-controls="bast" aria-selected="false">
								BAST
								</a>
							</li>
							<li class="nav-item" style="">
								<a class="nav-link" data-toggle="tab" href="#acquisition" role="tab" aria-controls="acquisition" aria-selected="false">
								ACQUISITION
								</a>
							</li>
							<li class="nav-item" style="">
								<a class="nav-link" data-toggle="tab" href="#history" role="tab" aria-controls="acquisition" aria-selected="false">
								HISTORY
								</a>
							</li>
						</ul>

						<div class="tab-content">
							<div class="tab-pane active show" id="deliverables" role="tabpanel">
									<div class="row">
										<div class="col-sm-12" style="margin-top: 10px;margin-bottom: 10px;padding-right: 5px !important;">
											<button id="btnDeliverables" type="button" class="pull-right btn-sm btn btn-success btn-brand" style="margin-right: 10px;"> 
												<i class="fa fa fa-plus"></i> <span style="font-size: 12px;"><strong>add deliverable</strong></span>
											</button>
										</div>
									</div>
									<table id="datakuProjectClosed" class="table table-responsive-sm" style="width: 100% !important;border: 2px solid #29363d;">
						              <thead style="color: #fff; border:1px solid #595959;background: #595959;">
						                <tr>
						                  <th style="width: 32%;border-right: 1px solid #29363d;">Deliverable Name</th>
						                  <th style="width: 12%;border-right: 1px solid #29363d;">Period</th>
						                  <th style="width: 24%;border-right: 1px solid #29363d;">Description</th>
						                  <th style="width: 10%;border-right: 1px solid #29363d;">Weight</th>
						                  <th style="width: 10%;border-right: 1px solid #29363d;">Ach.</th>
						                  <th style="width: 12%;text-align: center;">...</th>
						                </tr>
						              </thead>
						              <tbody style="border:1px solid #29363d;">
						              	<?php foreach ($deliverables as $key => $value) : ?>
						              		<tr style="background: #bbeaf7;border-top:2px solid #29363d; ">
						              			<td id="<?= $value['ID_DELIVERABLE'] ?>name" style="border-right: 1px solid #29363d;"><?= $value['NAME']; ?></td>
						              			<td style="border-right: 1px solid #29363d;"><?= $value['START_DATE2']; ?><br><?= $value['END_DATE2']; ?></td>
						              			<td style="border-right: 1px solid #29363d;"><?= $value['DESCRIPTION']; ?></td>
						              			<td style="border-right: 1px solid #29363d;"><?= floatval($value['WEIGHT']); ?>%</td>
						              			<td style="border-right: 1px solid #29363d;"><?= floatval($value['PROGRESS_VALUE']); ?>%</td>
						              			<td >
						              				<div data-id="<?= $value['ID_DELIVERABLE'] ?>" class="col-sm-12 btn btn-primary text-left btn_update_deliverable btn-sm btn-brand" ><i class="fa fa-edit"></i> <span style="font-size: 10px;">update</span></div>
						              				<div data-id="<?= $value['ID_DELIVERABLE'] ?>" style="margin-top: 1px;" class="btn btn-primary col-sm-12  text-left btnissue btn-sm btn-brand"> <i class="fa fa fa-plus"></i><span style="font-size: 10px;"> issue</span>
													</div>
						              				<div data-id="<?= $value['ID_DELIVERABLE'] ?>" class="col-sm-12 btn btn-primary text-left btn_delete_deliverable btn-brand btn-sm" style="margin-top: 1px;"><i class="fa fa-trash"></i><span style="font-size: 10px;"> delete</span></div>
						              			</td>
						              		</tr>
						              		<?php if (!empty($value['issue'])) : ?>
						              			<tr >
						              				<td colspan="6" style="padding-top: 0px;padding-bottom: 0px;border: 0px;border-top: 1px solid #29363d ">
						              					<div class="col-sm-12" style="padding-left: 7px;padding-right: 7px;">
						              						<div class="row" style="margin-bottom: 0px;background: #bbeaf7;">
						              							<div class="container py-2 col-sm-12" style="margin:0px;padding: 0px;padding-top: 0px !important;padding-bottom: 0px !important;">
																	  <div class="accordion" id="accordion<?= $value['ID_DELIVERABLE'] ?>">
																	    <div class="card" style=" border-radius: 0px;padding: 0px;margin:0px;border:0px;">
																	      <div class="card-header" id="accordionheader<?= $value['ID_DELIVERABLE'] ?>" data-toggle="collapse" data-target="#accordioncollapse<?= $value['ID_DELIVERABLE'] ?>" aria-expanded="false" aria-controls="accordioncollapse<?= $value['ID_DELIVERABLE'] ?>" style=" border-radius: 0px;padding: 0px;">
																	        <div class="col-sm-12">
																	        	<div class="row">
																		        	<div class="col-sm-6" style="background: #f42020;font-size: 15px;">
																				        <span style="padding-left: 9%;">
																				        	Issue
																				        </span>
																		        	</div>
							              											<div class="col-sm-6" style="background: #1bc155;font-size: 15px;padding-right: 0px;">
							              												Action Plan
							              												<span class="fa-stack pull-right" style="background: #0c69cd">
																				           <i class="fas fa-square fa-stack-2x" style="background: #595959" ></i>
																				           <i class="fas fa fa-chevron-up fa-stack-1x" style="background: #595959;padding-top: 5px;padding-bottom: 5px;height: 30px;"></i>
																				        </span>
							              											</div>
																		        </div>
																	        </div>
																	      </div> 
																	      <div id="accordioncollapse<?= $value['ID_DELIVERABLE'] ?>" class="collapse" aria-labelledby="accordionheader<?= $value['ID_DELIVERABLE'] ?>" data-parent="#accordion<?= $value['ID_DELIVERABLE'] ?>">
																	        <div class="card-body" style=" border-radius: 0px;padding: 0px;">
																	          	<table class="table" style="margin: 0px;">
																	          		<tbody>
																	          			<?php foreach ($value['issue'] as $key1 => $value1) : ?>
																              			<tr>
																              				<td colspan="6" style="padding-top: 0px;padding-bottom: 10px;border: 0px;">
																              					<div class="col-sm-12" style="padding-left: 7px;padding-right: 7px;">
																              						<div class="row">
																              									<div class="col-sm-1" style="padding-right: 0px;padding-left: 0px;">
																	              									<button class="col-sm-12 btn btn-sm btn-danger text-left btn_update_issue btn-brand " style="background: #e56f6f;" data-id="<?= $value1['ID_ISSUE'] ?>"  data-id_deliverable="<?= $value['ID_DELIVERABLE'] ?>"  ><i class="fa fa-edit"></i><span style="font-size: 9px">&nbsp;UPDATE</span></button>

																	              									<button class="col-sm-12 btn btn-sm btn-danger text-left btn-brand btn_action" style="background: #e56f6f;margin-top:1px;text-align: left;" data-id="<?= $value1['ID_ISSUE'] ?>"  data-pic="<?= $value1['IN_CHARGE'] ?>" ><i class="fa fa fa-plus"></i><span style="font-size: 9px">&nbsp;ACTION</span></button>

																	              									<button class="btn_delete_issue col-sm-12 btn btn-sm btn-danger text-left  btn-brand" data-id="<?= $value1['ID_ISSUE'] ?>" style="margin-top: 1px;background: #ef8c8c;text-align: left;"><i class="fa fa-trash"></i><span style="font-size: 9px">&nbsp;DELETE</span></button>
																	              								</div>
																			              						<div class="col-sm-5 con_issue">
																			              							<div style="margin-bottom: 5px;">
																		              									<?= $value1['INSERTED_DATE'] ?> <span class="text-danger" style="" ><?= $value1['RISK_IMPACT'] ?></span> 
																		              									<span class="text-white pull-right" style="" ><?= $value1['STATUS_ISSUE'] ?></span> 
																		              								</div>
																		              								<div style="">
																		              									PIC : <span id="<?= $value1['ID_ISSUE'] ?>pic"><?= $value1['IN_CHARGE'] ?></span``>
																		              								</div><div style="margin-bottom: 5px;font-size: 14px;border-bottom: 1px solid red;">
																		              									<strong id="<?= $value1['ID_ISSUE'] ?>name"><?= $value1['ISSUE_NAME'] ?></strong>
																		              								</div>
																		              								<div style="padding-left: 10px;margin-bottom: 5px;">
																		              									<?= $value1['IMPACT'] ?>
																		              								</div>
																			              						</div>


																			              						<?php if (empty($value1['action'])) : ?>
																				              						<div class="col-sm-6" style="">
																				              							&nbsp;
																				              						</div>
																		              							</div>
																			              						<?php else : ?>
																			              							<?php foreach ($value1['action'] as $key2 => $value2) : ?>
																			              								<div class="col-sm-5 <?= $key2 == 0 ? '' : 'offset-md-6' ?>" style="background: #73c08e;border:1px solid #1bc155;<?= $key2!=0 ? 'margin-top: 1px;' : ''; ?>">
																					              								
																					              								<div style="margin-bottom: 5px;width: 100%;">
																					              									<?= $value2['DUE_DATE'] ?> 
																					              									<span class="text-white pull-right" style="" ><?= $value2['ACTION_STATUS'] ?></span> 
																					              								</div>
																					              								
																					              								<div style="margin-bottom: 5px;font-size: 14px;border-bottom: 1px solid green;width: 100%;">
																					              									<strong class="" style="font-size: 14px;"><?= $value2['ACTION_NAME'] ?></strong><br>
																					              									<span style="font-size: 10px;" >Assgined To : <?= $value2['ASSIGN_TO'] ?></span>
																					              								</div>
																					              								<div style="padding-left: 10px;margin-bottom: 5px;">
																					              									<?= $value2['ACTION_REMARKS'] ?>
																					              								</div>
																					              						</div>
																					              						<div class="col-sm-1" style="padding-right: 0px;padding-left: 0px;" >
																			              									<button class="btn col-sm-12 btn_update_action btn-sm btn-success btn-brand text-left" data-id="<?= $value2['ID_ACTION_PLAN']; ?>" data-id_issue="<?= $value2['ID_ISSUE'] ?>"  data-issue_name="<?= $value1['ISSUE_NAME'] ?>" style="background: #61b77f;<?= $key==0 ? 'margin-top: 1px;' : ''; ?>"><i class="fa fa-edit" ></i> <span style="font-size: 9px;">UPDATE</span></button>
																			              									<button class="btn col-sm-12 btn_delete_action btn-sm btn-brand btn-danger text-left" data-id="<?= $value2['ID_ACTION_PLAN']; ?>" style="margin-top: 1px;background: #ef8c8c"><i class="fa fa-trash"></i> <span style="font-size: 9px;">DELETE</span></button>
																			              								</div>
																			              							<?php endforeach; ?>
																			              							</div>
																			              						<?php endif; ?>
																              					</div>
																              				</td>
																              			</tr>
																              		<?php endforeach;  ?>
																	          		</tbody>
																	          	</table>
																	        </div>
																	      </div>
																	    </div>
																	  </div>
																	</div>

						              							
						              						</div>
						              					</div>
						              				</td>
						              			</tr>
						              		<?php endif; ?>
						              	<?php endforeach; ?>
						              </tbody>
						          	</table>
							</div>

							<div class="tab-pane" id="issueAp" role="tabpanel">
									<div class="row">
										<div class="col-sm-12" style="margin-top: 10px;margin-bottom: 10px;padding-right: 30px !important;">
											<label class="h4" style="width: 100%">Issue</label>
										</div>
										<div class="col-sm-12">
											       	<table id="dataIssue" class="table table-striped" style="width:100% !important;border:1px solid #acacac">
										                <thead>
											                <tr style="font-size: 12px;">
											                    <th style="width:30% !important">Issue Name</th>
											                    <th style="width:20% !important">Impact</th>
											                    <th style="width:10% !important">Risk Impact</th>
											                    <th style="width:10% !important">Deliverable</th>
											                    <th style="width:25% !important">Status</th>
											                    <th style="width:5% !important">Action</th>
											                </tr>
										                </thead>
										                <tbody style="font-size: 12px;">
										                </tbody>
										            </table> 
										</div>


										<div class="col-sm-12" style="margin-top: 20px;margin-bottom: 10px;padding-right: 30px !important;">
											<label class="h4" style="width: 100%">Action Plan</label>
										</div>
										<div class="col-sm-12">
											       	<table id="dataAction" class="table table-striped" style="width:100% !important;border:1px solid #acacac">
										                <thead class="thead-bg-blue">
											                <tr style="font-size: 12px;">
											                    <th style="width:20% !important">Action Name</th>
											                    <th style="width:20%">Issue Name</th>
											                    <th style="width:20%">Due Date</th>
											                    <th style="width:10%">Remarks</th>
											                    <th style="width:10%">Risk Impact</th>
											                    <th style="width:4%">Action</th>
											                </tr>
										                </thead>
										                <tbody style="font-size: 12px;">
										                </tbody>
										            </table> 
										</div>
									</div>
							</div>

							<div class="tab-pane" id="bast" role="tabpanel">
								<label style="font-size: 12px;font-weight: 900">Total : <span style="font-size: 14px;" class="rupiah"><?= !empty($sum_bast) ? $sum_bast['TOTAL2'] : '0'; ?></span></label>
										<div id="" class="table-responsive w-xm wrapper">
											       	<table id="dataBAST" class="table table-striped b-t" style="width:100% !important;">
										                <thead class="thead-bg-blue"> 
										                <tr style="font-size: 12px;">
										                    <th style="width:20% !important">Date Received</th>
										                    <th style="width:25%">No. SPK</th>
										                    <th style="width:25%">No. BAST</th>
										                    <th class="center" style="width:10%">Value</th>
										                    <th class="center" style="width:10%">Progress</th>
										                    <th style="width:10%">Status</th>
										                </tr>
										                </thead>
										                <tbody style="font-size: 12px;">
										                	<?php
										                	if(!empty($project['bast'])) :
										                	 	foreach ($project['bast'] as $key => $value) :
										                	 ?>
										                	 	<tr class="nav-link-hgn" data-url="<?= base_url(); ?>bast/view/<?= $bast[$key]['ID_BAST']?>">
										                	 		<td><?= $bast[$key]['DATE_CREATED']; ?></td>
										                	 		<td><a href="<?= base_url().'bast/view/'.$bast[$key]['ID_BAST']; ?>"><?= $bast[$key]['NO_SPK']; ?></a></td>
										                	 		<td><?= $bast[$key]['NO_BAST']; ?></td>
										                	 		<td><span class='rupiah pull-right'><?= $bast[$key]['NILAI_RP_BAST']; ?></span></td>
										                	 		<td>
										                	 		<?php 
										                	 			if($bast[$key]['TYPE_BAST']=='OTC'||$bast[$key]['TYPE_BAST']=='PROGRESS'){ 
										                	 				echo $bast[$key]['PROGRESS_LAPANGAN']."%";
										                	 			}elseif ($bast[$key]['TYPE_BAST']=='TERMIN') {
										                	 			 	echo $bast[$key]['NAMA_TERMIN'];
										                	 			}else{
										                	 				echo $bast[$key]['RECC_START_DATE']." - ".$bast[$key]['RECC_END_DATE'];
										                	 				} ?>

										                	 		</td>
										                	 		<td><?= $bast[$key]['STATUS']; ?></td>
										                	 	</tr>
										                	<?php 
										                		endforeach;
										                	endif;
										                	?>
										                </tbody>
										            </table>
								            </div> 
							</div>

							<div class="tab-pane" id="acquisition" role="tabpanel">
									<div class="row">
										<div class="col-sm-12" style="margin-top: 10px;margin-bottom: 10px;padding-right: 30px !important;">
											<button id="btnAcquisition" type="button" class="pull-right btn-brand btn-sm btn btn-success" style="margin-right: 10px;"> 
												<i class="fa fa-circle"></i> <span style="font-size: 12px;"><strong>Update Acquisition</strong></span>
											</button>
										</div>
									</div>		

										<div id="" class="table-responsive w-xm wrapper">
										       		<table id="dataAcq" class="table table-striped" style="max-width:100% !important;border:1px solid #29363d;">
										                <thead class="thead-bg-blue">
										                <tr style="font-size: 12px;">
										                    <th style="width:10% !important;vertical-align: sub;text-align: center; border-right:1px solid #29363d;" rowspan="2">Year, Month</th>
										                    <th style="text-align: center;width:10% !important;border-right:1px solid #29363d;" rowspan="2">Progress</th>
										                    <!-- <th style="text-align: center;width:30% !important;border-right:1px solid #29363d;" colspan="3">Progress</th> -->
										                    <th style="text-align: center;width:30% !important;border-right:1px solid #29363d;" colspan="3">Value</th>
										                    <th style="width:30% !important;vertical-align: sub;text-align: center; border-right:1px solid #29363d;" rowspan="2">Note</th>
										                </tr>
										                <tr>
										                	<!-- <th style="border-right:1px solid #29363d;">Target</th>
										                	<th style="border-right:1px solid #29363d;">Acquisited</th>
										                	<th style="border-right:1px solid #29363d;">Total</th> -->
										                	<th style="border-right:1px solid #29363d;">Target</th>
										                	<th style="border-right:1px solid #29363d;">Acquisited</th>
										                	<th style="border-right:1px solid #29363d;">Comulative</th>
										                </tr>
										                </thead>
										                <tbody style="font-size: 12px;">
										                	<?php 	if(!empty($acq2['MONTH'])) : 
										                			$c=0;$total = 0; foreach ($acq2['MONTH'] as $key => $value) :
										                			$dateObj = DateTime::createFromFormat('!m', intval($acq2['MONTH'][$c]));
										                			?>
										                	<tr  class="<?= date('n') == intval($acq2['MONTH'][$c])? 'bg-info' : ''; ?>" >
										                		<td style="border-right:1px solid #29363d;" ><?=  $dateObj->format('F').', '.$acq2['YEAR'][$c]; ?></td>
										                		<!-- <td class="" ><?=  $acq2['PROG1'][$c]; ?>%</td>
										                		<td class="" ><?=  $acq2['PROG2'][$c]; ?>%</td>
										                		<td class="h" ><?=  $acq2['PROG_C'][$c]; ?>%</td> -->
										                		<td style="border-right:1px solid #29363d;"><?=  $acq2['EXP'][$c]; ?></td>
										                		<td style="border-right:1px solid #29363d;" class="rupiah" ><?=  $acq2['PLAN'][$c]; ?></td>
										                		<td style="border-right:1px solid #29363d;" class="rupiah" ><?=  $acq2['REAL'][$c]; ?></td>
										                		<td style="border-right:1px solid #29363d;" class="rupiah" ><?=  $acq2['REAL2'][$c]; ?></td>
										                		<td><?=  $acq2['NOTE'][$c]; ?></td>
										                	</tr>
										                	<?php  	$c++; 
										                			endforeach; 
										                			endif;
										                			?>
										                </tbody>
										            </table>
							            </div> 
							</div>

							<div class="tab-pane" id="history" role="tabpanel">
										<div id="" class="table-responsive w-xm wrapper">
										       		<table id="dataHistory" class="table table-striped b-t" style="max-width:100% !important;">
										                <thead class="thead-bg-blue">
										                <tr style="font-size: 12px;">
										                    <th style="min-width:20% !important;">Date</th>
										                    <th style="min-width:20% !important;">User</th>
										                    <th style="min-width:20% !important;">Action</th>
										                </tr>
										                </thead>
										                <tbody style="font-size: 12px;">
										                	<?php foreach ($project['history'] as $key => $value) : ?>
										                	<tr>
										                		<td><?=date('d F Y',strtotime($value['DATE_CREATED']))?></td>
										                		<td><?= '['.$value['ID_USER'].'] '.$value['NAME_USER']; ?></td>
										                		<td><?= $value['STATUS']; ?></td>
										                	</tr>
										                	<?php endforeach; ?>
										                </tbody>
										            </table>
							            </div> 
							</div>
						</div>
					</div>

					<div class="col-sm-4 hidden">
						<div class="card">
							<div class="card-header no-border">
								Acquistion Chart
								<div class="card-actions">
								<a href="#" class="btn-minimize no-border" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="true"><i  class="icon-arrow-down" style="color: #fff;"></i></a>
								</div>
							</div>
							<div class="card-body collapse show" id="collapseExample3" style="">
								<div id="chartAcquistion" class="chart-view"></div>
							</div>
						</div>
					</div>


				</div>
			</div>
		</div>


		<div class="col-sm-12 hidden">
			<div class="card">
				<div class="card-header no-border">
					Project Deliverables
					<div class="card-actions">
						<a href="#" class="btn-minimize no-border" data-toggle="collapse" data-target="#projectinformation" aria-expanded="true"><i  class="icon-arrow-down" style="color: #fff;"></i></a>
					</div>
				</div>
				<div class="card-body collapse show" id="projectinformation" style="">
					<div id="gantt_here" style='width:100%; height:400px;'></div>
				</div>
			</div>
		</div>


		<!-- EDIT PROJECT MODAL  -->
		<div class="modal  fade"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_edit_project">
		  <div class="modal-dialog modal-warning  modal-lg" style="top:10%;">
		    <div class="modal-content">
		    	<div class="modal-header">
		              <h4 class="modal-title">Edit Project <span class="title_edit_project"></span> </h4>
		              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		              <span aria-hidden="true">×</span>
		              </button>
		        </div>
		        <div class="modal-body relative">
		    		<form method="POST" enctype="multipart/form-data" id="form_edit_project">
		                        <div class="form-group row">
		                            <div class="col-md-4">
		                                <label class="form-control-label" >Project <span class="title_edit_project"></span></label>
		                            </div>
		                            <div class="col-md-8">
		                            	<input type="hidden" name="id_project" id="id_project_edit" value="<?= $project['ID_PROJECT'] ?>">

		                            	<input class="form-control edit_project_form" type="text" name="project_name" 	placeholder="New Project Name" 	id="project_name" required>
		                            	<input class="form-control edit_project_form date-picker" type="text" name="project_start_date" placeholder="New Start Date" id="project_start_date" required>
		                            	<input class="form-control edit_project_form date-picker" type="text" name="project_end_date" placeholder="New End Date" 	id="project_end_date" required>

		                            	<input class="form-control edit_project_form" type="text" name="project_description" 	placeholder="Project Descrption" 	id="project_description" required>

		                            	<input class="form-control edit_project_form" type="text" name="project_no_kb" 	placeholder="Nomor Kontrak Bersama" 	id="project_no_kb" required>

		                            	<input class="form-control edit_project_form" type="text" name="project_no_kl" 	placeholder="Nomor Kontrak Layanan" 	id="project_no_kl" required>

		                            	<div id="c_project_customer" class="edit_project_form">
		                            		<select id="project_customer" class="form-control edit_project_form" name="project_customer"></select>
		                            	</div>

		                            	<div id="c_project_am" class="edit_project_form">
		                            		<select id="project_am" class="form-control edit_project_form" name="project_am"></select>
		                            	</div>

		                            	<div id="c_project_type" class="edit_project_form">
		                            		<select id="project_type" class="form-control edit_project_form Jselect2" name="project_type">
			                            		<?php foreach ($list_type as $key => $value) : ?>
			                            			<option value="<?= $value['VALUE'] ?>" <?= $project['TYPE'] == $value['VALUE'] ? 'selected' : '';  ?> > <?= $value['VALUE'] ?></option>
			                            		<?php endforeach; ?>
			                            		<option value></option>
			                            	</select>
		                            	</div> 

		                            	<div id="c_project_regional"  class="edit_project_form" >
		                            		<select id="project_regional" name="project_regional" class="form-control Jselect2 edit_project_form">
											    <option value="1" <?= $project['REGIONAL'] == '1' ? 'selected' : ''; ?> >Regional 1</option>
											    <option value="2" <?= $project['REGIONAL'] == '2' ? 'selected' : ''; ?>>Regional 2</option>
											    <option value="3" <?= $project['REGIONAL'] == '3' ? 'selected' : ''; ?>>Regional 3</option>
											    <option value="4" <?= $project['REGIONAL'] == '4' ? 'selected' : ''; ?>>Regional 4</option>
											    <option value="5" <?= $project['REGIONAL'] == '5' ? 'selected' : ''; ?>>Regional 5</option>
											    <option value="6" <?= $project['REGIONAL'] == '6' ? 'selected' : ''; ?>>Regional 6</option>
											    <option value="7" <?= $project['REGIONAL'] == '7' ? 'selected' : ''; ?>>Regional 7</option>
										    </select>
		                            	</div>

		                            	<div id="c_project_status"  class="edit_project_form" >
		                            		<select id="project_status" name="project_status" class="form-control Jselect2 edit_project_form">
											    <option value="LEAD" <?= $project['STATUS']	== 'LEAD' ? 'selected' : ''; ?> >LEAD</option>
											    <option value="LAG" <?= $project['STATUS'] 	== 'LAG' ? 'selected' : ''; ?> >LAG</option>
											    <option value="DELAY" <?= $project['STATUS'] 	== 'DELAY' ? 'selected' : ''; ?> >DELAY</option>
											    <option value="TECHNICAL_CLOSE" <?= $project['STATUS'] == 'TECHNICAL_CLOSE' ? 'selected' : ''; ?> >TECHNICAL CLOSE</option>
										    </select>
		                            	</div>

		                            	<div id="c_project_symptom"  class="edit_project_form" >
		                            		<select id="project_symptom" name="project_symptom" class="form-control Jselect2 edit_project_form">
											    
														<option value="" <?= empty($project['REASON_OF_DELAY']) ? 'selected' : ''; ?>>Select Reason Of Delay</option>
														<option value="1.Delivery barang/jasa (mitra)" <?= $project['REASON_OF_DELAY'] == "1.Delivery barang/jasa (mitra)" ? 'selected' : ''; ?> >1.Delivery barang/jasa (mitra)</option>
														<option value="2.Kesiapan lokasi ( customer)"  <?= $project['REASON_OF_DELAY'] == "2.Kesiapan lokasi ( customer)" ? 'selected' : ''; ?>>2.Kesiapan lokasi ( customer)</option>
														<option value="3.Perubahan desain/spek pelanggan (customer)"  <?= $project['REASON_OF_DELAY'] == "3.Perubahan desain/spek pelanggan (customer)" ? 'selected' : ''; ?> >3.Perubahan desain/spek pelanggan (customer)</option>
														<option value="4.Keterlambatan BAST (customer)" <?= $project['REASON_OF_DELAY'] == "4.Keterlambatan BAST (customer)" ? 'selected' : ''; ?> >4.Keterlambatan BAST (customer)</option>
														<option value="5.Keterlambatan SPK ke mitra (di awal) (Telkom)" <?= $project['REASON_OF_DELAY'] == "5.Keterlambatan SPK ke mitra (di awal) (Telkom)" ? 'selected' : ''; ?> >5.Keterlambatan SPK ke mitra (di awal) (Telkom)</option>
														<option value="6.Masalah Administrasi & pembayaran mitra (Telkom)" <?= $project['REASON_OF_DELAY'] == "6.Masalah Administrasi & pembayaran mitra (Telkom)" ? 'selected' : ''; ?> >6.Masalah Administrasi & pembayaran mitra (Telkom)</option>
														<option value="7.SoW belum sepakat (Telkom)" <?= $project['REASON_OF_DELAY'] == "7.SoW belum sepakat (Telkom)" ? 'selected' : ''; ?> >7.SoW belum sepakat (Telkom)</option>
														<option value="8.CR (perubahan yang belum terkendali) & amandemen (customer)" <?= $project['REASON_OF_DELAY'] == "8.CR (perubahan yang belum terkendali) & amandemen (customer)" ? 'selected' : ''; ?>> 8.CR (perubahan yang belum terkendali) & amandemen (customer)</option>
														<option value="9.Produk non core &non enterprise level solution (mitra)" <?= $project['REASON_OF_DELAY'] == "9.Produk non core &non enterprise level solution (mitra)" ? 'selected' : ''; ?> >9.Produk non core &non enterprise level solution (mitra)</option>
														<option value="10.Keterbatasan kapabilitas mitra (mitra)" <?= $project['REASON_OF_DELAY'] == "10.Keterbatasan kapabilitas mitra (mitra)" ? 'selected' : ''; ?> >10.Keterbatasan kapabilitas mitra (mitra)</option>
														<option value="11.Komitmen mitra(termasuk deal harga)(mitra)" <?= $project['REASON_OF_DELAY'] == "11.Komitmen mitra(termasuk deal harga)(mitra)" ? 'selected' : ''; ?> >11.Komitmen mitra(termasuk deal harga)(mitra)</option>
														<option value="12.Keterbatasan kapabilitas Telkom (Telkom)" <?= $project['REASON_OF_DELAY'] == "12.Keterbatasan kapabilitas Telkom (Telkom)" ? 'selected' : ''; ?> >12.Keterbatasan kapabilitas Telkom (Telkom)</option>
														<option value="13.Kendala Finansial ( Customer )" <?= $project['REASON_OF_DELAY'] == "13.Kendala Finansial ( Customer )" ? 'selected' : ''; ?> >13.Kendala Finansial ( Customer )</option>
													</select>
											    
										    </select>
		                            	</div>



		                            	<div id="c_project_segmen" class="edit_project_form">
		                            		<select id="project_segmen" class="form-control edit_project_form Jselect2" name="project_segmen">
			                            		<?php foreach ($list_segmen as $key => $value) : ?>
			                            			<option value="<?= $value['SEGMEN'] ?>" <?= $project['SEGMEN'] == $value['SEGMEN'] ? 'selected' : '';  ?> > <?= $value['SEGMEN'].' - '.$value['SEGMENT_6_LNAME'] ?></option>
			                            		<?php endforeach; ?>
			                            	</select>
		                            	</div> 


		                            </div>
		                        </div>

		                        <div class="form-group row hidden" id="adendum_note">
		                            <div class="col-md-4">
		                                <label class="form-control-label" >Note <span class="title_edit_project"></span></label>
		                            </div>
		                            <div class="col-md-8">
		                            	<textarea class="form-control edit_project_form" required name="end_date_note" id="end_date_note"></textarea>
		                            </div>
		                        </div>

		                        <div class="row">
		                        		<button type="button" id="btn_save_edit_project" class="col-sm-4 offset-md-4 btn btn-sm btn-success" >Save Change</button>
		                        </div>
		    		</form>
		    	</div>
		    </div>
		  </div>
		</div>

		<!-- MODAL DOCUMENT -->
		<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_document" aria-hidden="true" id="modal_document">
		  <div class="modal-dialog modal-md modal-primary">
		    <div class="modal-content">
		      	<div class="modal-header">
					<h4 class="modal-title" id="modal-title-deliverable">Add Document</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
						</button>
				</div>
				<div class="modal-body relative">
		                	<div class="modalLoading" style="display:none;">
								<div class="progress">
								  <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" style="width: 100%">
								  </div>
								</div>
		                	</div>
		                    <form method="POST" enctype="multipart/form-data" id="frmDocumentProject">
		                         <div class="row">
		                         	<div class="col-sm-12">   
		                         				<div class="form-group col-sm-12">
		                         					   <label>Name</label>
						                               <input type="text" name="document_name" id="document_name" class="form-control"  placeholder="Document Name" required>
						                        </div>
		                         				<div class="form-group col-sm-12">
		                         					   <label>Category</label>
						                               <select class="form-control" name="document_category" id="document_category">
							                               	<option value="Documentation">Documentation</option>
							                               	<option value="MOM">Minute Of Meeting</option>
							                               	<option value="Presentation">Presentation</option>
							                               	<option value="Others">Others</option>
						                               </select>
						                        </div>
			                         			<div class="form-group col-sm-12">
						                                <input type="file" class="form-control" name="documentProject[]" id="documentProject" required>
						                        </div>
			                         			
		                         		<div class="offset-md-4 col-md-4">
		                         			<button type="button" 
		                         			style="width: 100%;" 
		                         			class="btn btn-success" 
		                         			id="btnDocumentSubmit">
		                         				Upload Document
		                         			</button>
		                         		</div>
		                         		</div>	
		                         	</div>
		                         </div>
				           </form>
		        </div>
		    </div>
		  </div>
		</div>

		<!-- Issue modals -->
		<div class="modal  fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal-issue">
		  <div class="modal-dialog modal-primary modal-md">
		    <div class="modal-content">
		    	<form method="POST" enctype="multipart/form-data" id="frmissue">
		      	<div class="modal-header">
					<h4 class="modal-title" id="modal-title-issue">Add Issue</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
						</button>
				</div>
				 <div class="modal-body">
	                    
	                        <div class="col-sm-12" style="padding: 10px">

	                        			<div class="form-group row">
				                            <div class="col-sm-3">
				                                <label class="form-control-label" >Deliverable</label>
				                            </div>
				                            <div class="col-sm-9">
				                            	<input type="text" class="hidden form-control  issue_field " name="id_deliverable_issue" id="id_deliverable_issue">
				                              	<textarea class="form-control" id="deliverable_issue" readonly rows="3"></textarea>
				                            </div>
				                        </div>

	                        			<div class="form-group row">
				                            <div class="col-sm-3">
				                                <label class="form-control-label" >In Charge</label>
				                            </div>
				                            <div class="col-sm-9">
				                               <select name="responsible" id="responsible" class="form-control issue_field " required>
				                               	<option value="" disabled selected>Select Responsible Side</option>
				                               	<option value="MITRA">Mitra</option>
				                               	<option value="CUSTOMER">Customer</option>
				                               	<option value="BDM">Biding Management (BDM)</option>
				                               	<option value="SDV">Service Delivery (SDV)</option>
				                               </select>
				                            </div>
				                        </div>

				                        <div class="form-group row hidden c_issue_symptom" id="c_symptom_mitra">
				                            <div class="col-sm-3">
				                                <label class="form-control-label" >Issue Category</label>
				                            </div>
				                            <div class="col-sm-9">
				                               <select  id="symptom_mitra" name="symptom_issue" class="form-control issue_symptom issue_field " disabled required>
				                               	<option value="" disabled selected>Select Issue Category</option>
				                               	<option value="Delivery Barang / Jasa">Delivery Barang / Jasa</option>
				                               	<option value="Produk Non Core & Non Enterprise Level Solution">Produk Non Core & Non Enterprise Level Solution</option>
				                               	<option value="Keterbatasan Kapabilitas Mitra">Keterbatasan Kapabilitas Mitra</option>
				                               	<option value="Komitmen Mitra (Termasuk harga deal)">Komitmen Mitra (Termasuk harga deal)</option>
				                               </select>
				                            </div>
				                        </div>

				                        <div class="form-group row hidden c_issue_symptom" id="c_symptom_customer">
				                            <div class="col-sm-3">
				                                <label class="form-control-label issue_field " >Issue Category</label>
				                            </div>
				                            <div class="col-sm-9">
				                               <select name="symptom_issue"  id="symptom_customer" class="form-control issue_symptom issue_field " disabled required>
				                               	<option value="" disabled selected>Select Issue Category</option>
				                               	<option value="Kesiapan Lokasi">Kesiapan Lokasi</option>
				                               	<option value="Perubahan Desain / Spesifikasi Pelanggan">Perubahan Desain / Spesifikasi Pelanggan</option>
				                               	<option value="Keterlambatan BAST">Keterlambatan BAST</option>
				                               	<option value="Amandemen & CR (Perubahan yang belum terkendali)">Amandemen & CR (Perubahan yang belum terkendali)</option>
				                               	<option value="Kendala Finansial">Kendala Finansial</option>
				                               </select>
				                            </div>
				                        </div>

				                        <div class="form-group row hidden c_issue_symptom" id="c_symptom_sdv">
				                            <div class="col-sm-3">
				                                <label class="form-control-label" >Issue Category</label>
				                            </div>
				                            <div class="col-sm-9">
				                               <select  id="symptom_sdv" class="form-control issue_symptom issue_field " name="symptom_issue" disabled required>
				                               	<option value="" disabled selected>Select Issue Category</option>
				                               	<option value="PM Slow Report">PM Slow Report</option>
				                               	<option value="PM Slow Respon">PM Slow Respon</option>
				                               </select>
				                            </div>
				                        </div>

				                        <div class="form-group row hidden c_issue_symptom" id="c_symptom_bdm">
				                            <div class="col-sm-3">
				                                <label class="form-control-label" >Issue Category</label>
				                            </div>
				                            <div class="col-sm-9">
				                            	<input type="text"  id="symptom_bdm" name="symptom_issue" class="form-control issue_symptom" value="Keterlambatan SPK (P8)" readOnly disabled required>
				                        	</div>
				                        </div>


	                        			<div class="form-group row ">
				                            <div class="col-sm-3">
				                                <label class="form-control-label" >Name</label>
				                            </div>
				                            <div class="col-sm-9">
				                            	<textarea class="form-control issue_field " name="issue_name" placeholder="Issue Name" id="issue_name" required></textarea>
				                            </div>

				                                <input type="hidden" name="issue_id"  id="issue_id">
				                        </div>

				                        <div class="form-group row">
				                            <div class="col-sm-3">
				                                <label class="form-control-label" >Risk Impact</label>
				                            </div>
				                            <div class="col-sm-9">
				                               <select name="risk_impact" id="risk_impact" class="form-control issue_field " required>
				                               	<option value="" disabled selected>Select Risk Impact</option>
				                               	<option value="No Impact">No Impact</option>
				                               	<option value="Potential Risk">Potential Risk</option>
				                               	<option value="Significant Risk">Significant Risk</option>
				                               </select>
				                            </div>
				                        </div>

				                        <div class="form-group row">
				                            <div class="col-sm-3">
				                                <label class="form-control-label">Remarks</label>
				                            </div>
				                            <div class="col-sm-9">
				                                <textarea name="impact" id="impact" class="form-control issue_field" maxlength="300" rows="5" placeholder="Impact (Max. 300 Characters)" id="impact" required></textarea>
				                            </div>
				                        </div>                  	
	                        </div>
	                        <div class="form-group row" id="c_issue_status">
		                        <div class="col-sm-12">
		                        	<label class="form-control-label">Status</label>
		                        	<select class="form-control issue_field " id="issue_status" name="issue_status">
		                        		<option value="OPEN">OPEN</option>
		                        		<option value="CLOSED">CLOSED</option>
		                        	</select>
		                        </div>
		                    </div>

		                    <div class="form-group row hidden" id="c_issue_closed_date">
		                        <div class="col-sm-12">
		                        	<label class="form-control-label">CLOSED DATE</label>
		                        	<input type="text" name="issue_closed_date" id="issue_closed_date" class="form-control date-picker issue_field" readOnly placeholder="Closed Date">
		                        </div>
		                    </div>

	                        <div class="row">
	                        		<div class="col-sm-2 offset-md-5 btn btn-sm btn-success" id="btnSaveissue">Save Issue</div>
	                        		<div class="col-sm-2 offset-md-5 btn btn-sm btn-success hidden" id="btnUpdateissue">Update</div>
	                        </div>
	                    
	                </div>
		    	</form>
		    </div>
		  </div>
		</div>

		<!-- Action modals -->
		<div class="modal  fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal-action">
		  <div class="modal-dialog modal-primary  modal-md">
		    <div class="modal-content">
		    	<form method="POST" enctype="multipart/form-data" id="form_action">
		      	<div class="modal-header">
					<h4 class="modal-title" id="modal-title-action">Add Action Plan</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
						</button>
				</div>
				 <div class="modal-body">
	                    
	                        <div class="col-sm-12" style="padding: 10px">

	                        			<div class="form-group row">
				                            <div class="col-sm-3">
				                                <label class="form-control-label" >Issue</label>
				                            </div>
				                            <div class="col-sm-9">
				                            	<input type="text" class="hidden form-control action_field" name="action_issue_id " id="action_issue_id">
				                            	<input type="text" class="hidden form-control action_field" name="action_id" id="action_id">
				                              	<textarea class="form-control action_field" id="action_issue"  name="action_issue" readonly rows="3"></textarea>
				                            </div>
				                        </div>

	                        			<div class="form-group row">
				                            <div class="col-sm-3">
				                                <label class="form-control-label" >Action Name</label>
				                            </div>
				                            <div class="col-sm-9">
				                               <textarea name="action_name" id="action_name" class="form-control action_field" required rows="3"></textarea>
				                            </div>
				                        </div>

				                        <div class="form-group row">
				                            <div class="col-sm-3">
				                                <label class="form-control-label" >Due Date</label>
				                            </div>
				                            <div class="col-sm-9">
				                               <input type="text" name="action_due_date" id="action_due_date" class="form-control date-picker action_field" required>
				                            </div>
				                        </div>

				                        <div class="form-group row">
				                            <div class="col-sm-3">
				                                <label class="form-control-label" >In Charge</label>
				                            </div>
				                            <div class="col-sm-9">
				                            	<input type="text" name="action_in_charge" id="action_in_charge" class="form-control action_field" readOnly>
				                            </div>
				                        </div>

				                        <div class="form-group row" style="margin-bottom: 0px !important;">
				                            <div class="col-md-3">
				                                <label class="form-control-label">PIC 1  </label>
				                            </div>
				                            <div class="col-md-9">
				                            </div>
				                        </div>

				                        <div class="form-group row">
				                            <div class="col-md-2 offset-md-1">
				                            	<label>Name</label>
				                            	<label>Email</label>
				                            </div>
				                            <div class="col-md-9">
				                            	<div class="input-group margin-bottom-5">
				                                    <input type="text" name="pic_name[]" id="action_picname0" class="form-control picClass action_field " placeholder="PIC Name"   aria-selected=true>
				                                </div>
				                                <div class="input-group margin-bottom-10">
				                                    <input type="email" name="pic_email[]" id="action_picemail0" class="form-control picClass action_field " placeholder="PIC email" >
				                                </div>
				                            </div>
				                        </div>

				                        <div class="form-group row" style="margin-bottom: 0px !important;">
				                            <div class="col-md-3">
				                                <label class="form-control-label">PIC 2 <span style="color: #ddd;">*Optional</span></label>
				                            </div>
				                            <div class="col-md-9">
				                            </div>
				                        </div>

				                        <div class="form-group row">
				                            <div class="col-md-2 offset-md-1">
				                            	<label>Name</label>
				                            	<label>Email</label>
				                            </div>
				                            <div class="col-md-9">
				                            	<div class="input-group margin-bottom-5">
				                                    <input type="text" name="pic_name[]" id="action_picname1" class="form-control picClass action_field" placeholder="PIC Name"   aria-selected=true >
				                                </div>
				                                <div class="input-group margin-bottom-10">
				                                    <input type="email" name="pic_email[]" id="action_picemail1" class="form-control picClass action_field" placeholder="PIC email">
				                                </div>
				                            </div>
				                        </div>


				                        <div class="form-group row">
				                            <div class="col-md-3">
				                                <label class="form-control-label">Remarks</label>
				                            </div>
				                            <div class="col-md-9">
				                                <textarea name="action_remarks" class="form-control action_field" rows="5" maxlength="300" placeholder="Remarks (Max. 300 Characters)" id="action_remarks" ></textarea>
				                            </div>
				                        </div>


				                       
	                        </div>

	                        <div class="form-group row hidden" id="c_action_status">
		                        <div class="col-sm-12">
		                        	<label class="form-control-label">Status</label>
		                        	<select class="form-control" id="action_status" name="action_status">
		                        		<option value="OPEN">OPEN</option>
		                        		<option value="CLOSED">CLOSED</option>
		                        	</select>
		                        </div>
		                    </div>

		                    <div class="form-group row hidden" id="c_action_closed_date">
		                        <div class="col-sm-12">
		                        	<label class="form-control-label">CLOSED DATE</label>
		                        	<input type="text" name="action_closed_date" id="action_closed_date" class="form-control date-picker action_field" readOnly placeholder="Closed Date">
		                        </div>
		                    </div>

	                        <div class="row">
	                        		<div class="col-sm-4 offset-md-4 btn btn-sm btn-success" id="btnSaveAction">Save Action Plan</div>
	                        		<div class="col-sm-4 offset-md-4 btn btn-sm btn-success hidden" id="btnUpdateAction">Update Action Plan</div>
	                        </div>
	                    
	                </div>
		    	</form>
		    </div>
		  </div>
		</div>

		<!-- Deliverables modals -->
		<div class="modal  fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_deliverable">
		  <div class="modal-dialog modal-primary  modal-md">
		    <div class="modal-content">
		    	<div class="modal-header">
		              <h4 class="modal-title" id="modal_title_deliverable">Add Deliverable</h4>
		              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		              <span aria-hidden="true">×</span>
		              </button>
		        </div>
		        <div class="modal-body relative">
		    		<form method="POST" enctype="multipart/form-data" id="frmDeliverables">
		      		<input class="deliverable_field" type="hidden" name="deliverable_id_project" id="deliverable_id_project" value="<?= $id_project ?>">
		                        <div class="form-group row">
		                            <div class="col-md-4">
		                                <label class="form-control-label" >Deliverable Name</label>
		                            </div>
		                            <div class="col-md-8">
		                                <input type="text" class="form-control deliverable_field" maxlength="200" name="deliverable_name" placeholder="Name" id="deliverable_name">
		                            </div>
		                        </div>

		                        <div class="form-group row">
		                            <div class="col-md-4">
		                                <label class="form-control-label" >Start Date</label>
		                            </div>
		                            <div class="col-md-8">
		                                <input type='text' class="form-control deliverable_field date-picker" id="deliverable_start_date" placeholder="mm/dd/yyyy" name="deliverable_start_date" readOnly/>
		                            </div> 
		                        </div>
		                        <div class="form-group row">
		                            <div class="col-md-4">
		                                <label class="form-control-label" >End Date</label>
		                            </div>
		                            <div class="col-md-8">
		                                <input type='text' class="form-control deliverable_field date-picker"  placeholder="mm/dd/yyyy" id="deliverable_end_date" name="deliverable_end_date" readOnly/>
		                            </div> 
		                        </div>

		                        <div class="form-group row">
		                            <div class="col-md-4">
		                                <label class="form-control-label" >Weight (%)</label>
		                            </div>
		                            <div class="col-md-8">
		                                <input type="number" class="form-control deliverable_field" name="deliverable_weight" placeholder="Weight (Ex: 2.5)" min="0" max="<?= 100 - floatval($project['ACH']);?>" id="deliverable_weight">
		                            	<span class="text-small">* Max. Input Weight <strong id="devWeigVal"><?= 100 - (!empty($progress->WEIGHT) ? floatval($progress->WEIGHT) : 0);?></strong></span>
		                            </div>
		                        </div>

		                        <div class="form-group row hidden" id="c_deliverable_achievement">
		                            <div class="col-md-4">
		                                <label class="form-control-label" >Achievement (%)</label>
		                            </div>
		                            <div class="col-md-8">
		                                <input type="number" class="form-control deliverable_field " name="deliverable_achievement" placeholder="achievement deliverable" id="deliverable_achievement">
		                            </div>
		                        </div>
		                        
		                        <div class="form-group row">
		                            <div class="col-md-4">
		                                <label class="form-control-label" >Description</label>
		                            </div>
		                            <div class="col-md-8">
		                                <textarea name="deliverable_description" cols="10" rows="3" class="form-control deliverable_field " maxlength="300" placeholder="Description" id="deliverable_description"></textarea>
		                            </div>
		                        </div>

		                        <div class="row">
		                        		<button type="button" id="saveAddDeliverable" class="col-sm-4 offset-md-4 btn btn-sm btn-success" >Save Deliverable</button>
		                        		<button type="button" id="saveUpdateDeliverable" class="col-sm-4 offset-md-4 btn btn-sm btn-success hidden" >Update Deliverable</button>
		                        </div>
		    		</form>
		    	</div>
		    </div>
		  </div>
		</div>

		<!-- ASSIGN ISSUE MODAL -->
		<div class="modal  fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_assign_issue">
		  <div class="modal-dialog modal-primary  modal-md">
		    <div class="modal-content">
		    	<div class="modal-header">
		              <h4 class="modal-title" >Assign Issue</h4>
		              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		              <span aria-hidden="true">×</span>
		              </button>
		        </div>
		        <div class="modal-body relative">
		    		<form method="POST" enctype="multipart/form-data" id="form_assign_issue">
		      		<input class="deliverable_field" type="hidden" name="deliverable_id_project" id="deliverable_id_project" value="<?= $id_project ?>">
		                        <div class="form-group row">
		                            <div class="col-md-4">
		                                <label class="form-control-label" >Select Deliverable</label>
		                            </div>
		                            <input type="hidden" name="assign_issue_id" id="assign_issue_id">
		                            <div class="col-md-8">
		                                <select class="form-control deliverable_field" maxlength="200" name="select_deliverable_assign" placeholder="Select Deliverable For This Issue" id="select_deliverable_assign" required>
		                                		<option value="" disabled selected>Select Deliverable For This Issue</option>
		                                	<?php foreach ($deliverables_2 as $key => $value) : ?>
		                                		<option value="<?= $value['ID_DELIVERABLE'] ?>"><?= $value['NAME'] ?></option>
		                                	<?php endforeach; ?>

		                                </select>
		                            </div>
		                        </div>
		                        <div class="row">
		                        		<button type="button" id="btn_save_assign_issue" class="col-sm-4 offset-md-4 btn btn-sm btn-success" >Assign Issue</button>
		                        </div>
		    		</form>
		    	</div>
		    </div>
		  </div>
		</div>

		<!-- ASSIGN ACTION MODAL -->
		<div class="modal  fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_assign_action">
		  <div class="modal-dialog modal-primary  modal-md">	
		    <div class="modal-content">
		    	<div class="modal-header">
		              <h4 class="modal-title" >Assign Action Plan</h4>
		              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		              <span aria-hidden="true">×</span>
		              </button>
		        </div>
		        <div class="modal-body relative">
		    		<form method="POST" enctype="multipart/form-data" id="form_assign_action">
		      		<input class="deliverable_field" type="hidden" name="issue_id_project" id="issue_id_project" value="<?= $id_project ?>">
		                        <div class="form-group row">
		                            <div class="col-md-4">
		                                <label class="form-control-label" >Select Issue</label>
		                            </div>
		                            <input type="hidden" name="assign_action_id" id="assign_action_id">
		                            <div class="col-md-8">
		                                <select class="form-control deliverable_field" maxlength="200" name="select_issue_assign" placeholder="Select Issue For This Action Plan" id="select_issue_assign" required>
		                                		<option value="" disabled selected>Select Issue For This Action Plan</option>
		                                	<?php foreach ($issue as $key => $value) : ?>
		                                		<option value="<?= $value['ID_ISSUE'] ?>"><?= $value['ISSUE_NAME'] ?></option>
		                                	<?php endforeach; ?>

		                                </select>
		                            </div>
		                        </div>
		                        <div class="row">
		                        		<button type="button" id="btn_save_assign_action" class="col-sm-4 offset-md-4 btn btn-sm btn-success" >Assign Issue</button>
		                        </div>
		    		</form>
		    	</div>
		    </div>
		  </div>
		</div>

		<!-- Acquisition modals -->
		<div class="modal fade"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="acquisitionModal">
		  <div class="modal-dialog modal-lg modal-primary">
		    <div class="modal-content">
		        <div class="modal-header">
		              <h4 class="modal-title" id="modal-title-acquisition">Update Acquisition</h4>
		              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		              <span aria-hidden="true">×</span>
		              </button>
		        </div>
		              <div class="modal-body relative">
		              <form method="POST" enctype="multipart/form-data" id="frmAcquisition">
		              	<div id="gained_acq" class="">
		                        <div class="col-sm-12 bg-info text-white" style="text-align: left;padding:5px;margin-bottom: 5px;">
		                          <span><h5>Actual Acquisition <?= date('F', mktime(0, 0, 0, (date('m')-1) , 10));?>, <?= (date('m') - 1 == 0) ? date('Y') - 1 : date('Y') ?></h5></span>
		                        </div>
		                        <div class="col-sm-12 bg-grey " id="con_termin">
		                            <div class="col-sm-12">
		                              	<div class="row">
			                                <div class="col-sm-6" >
			                                  <div class="form-group">
			                                    <label>Value</label>
			                                    <input type="text" id="actual_value" name="actual_value" class="form-control rupiah"  value="<?= !empty($l_acq['A_VALUE']) ? $l_acq['A_VALUE'] : (!empty($l_acq['T_VALUE']) ? $l_acq['T_VALUE'] : '0'); ?>">
			                                  </div>
			                                   
			                                  <div class="form-group">
			                                    <label>Term Of Payment </label>
			                                    <select id="actual_top" name="actual_top" class="form-control" value="" >
			                                  		<option value="OTC" <?= $l_acq['TOP'] == 'OTC' ? 'selected':''; ?> >OTC</option>
			                                  		<option value="TERMIN" <?= $l_acq['TOP'] == 'TERMIN' ? 'selected':''; ?> >Termin</option>
			                                  		<option value="PROGRESS" <?= $l_acq['TOP'] == 'PROGRESS' ? 'selected':''; ?> >Progress</option>
			                                  		<option value="DP" <?= $l_acq['TOP'] == 'DP' ? 'selected':''; ?>>DP (Down Payment)</option>
			                                    </select>
			                                  </div>

			                                  <div class="form-group">
			                                    <label>Term Of Payment Description</label>
			                                    <input type="text" id="actual_top_exp" name="actual_to_exp" class="form-control" value="<?= !empty($l_acq['TOP_EXPLANATION']) ? $l_acq['TOP_EXPLANATION'] :''; ?>" placeholder="Termin Ke - (?) / Periode Reccuring / Persentasi Progress">
			                                  </div>

			                                 </div>
			                               

			                                  <div class="col-sm-6">
			                                    <div class="form-group">
			                                      <label>Note</label>
			                                      <textarea  rows="8" type="text" id="actual_note" name="actual_note" class="form-control" placeholder="Description"><?= !empty($l_acq['A_NOTE']) ? $l_acq['A_NOTE'] : (!empty($l_acq['T_NOTE']) ? $l_acq['T_NOTE'] : '') ?></textarea>
			                                    </div>
			                                  </div>
			                              </div>
		                            </div>
		                        </div>
		                </div>
		                <div id="target_acq" class="">
		                        <div class="col-sm-12 bg-info text-white>"  style="text-align: left;padding:5px;margin-bottom: 5px;">
		                          <span><h5>Estimated Acquisition <?= date('F');?>, <?= date('Y') ?>  </h5></span>
		                        </div>
		                        <input type="hidden"  id="month" name="month" value="<?= date('n'); ?>">
		                        <input type="hidden"  id="id_project" name="id_project" value="<?= $id_project; ?>">
		                        <div class="col-sm-12 bg-grey " id="con_termin">
		                            <div class="col-sm-12">
		                              <div class="row">
		                                <div class="col-sm-6" >
		                                  <div class="form-group">
		                                    <label>Value</label>
		                                    <input type="text" id="target_value" name="target_value" class="form-control rupiah"  value="<?= !empty($c_acq['A_VALUE']) ? $c_acq['A_VALUE'] : (!empty($c_acq['T_VALUE']) ? $c_acq['T_VALUE'] : '') ?>" placeholder="<?= !empty($c_acq['T_VALUE']) ? $c_acq['T_VALUE'] : '0' ?>" >
		                                  </div>
		                                   
		                                  <div class="form-group">
		                                    <label>Term Of Payment </label>
		                                    <select id="target_top" name="target_top" class="form-control" value="" >
		                                  		<option value="OTC" <?= $c_acq['TOP'] == 'OTC' ? 'selected':''; ?> >OTC</option>
		                                  		<option value="TERMIN" <?= $c_acq['TOP'] == 'TERMIN' ? 'selected':''; ?> >Termin</option>
		                                  		<option value="PROGRESS" <?= $c_acq['TOP'] == 'PROGRESS' ? 'selected':''; ?> >Progress</option>
		                                  		<option value="DP" <?= $c_acq['TOP'] == 'DP' ? 'selected':''; ?>>DP (Down Payment)</option>
		                                    </select>
		                                  </div>

		                                  <div class="form-group">
		                                    <label>Term Of Payment Description</label>
		                                    <input type="text" id="target_top_exp" name="target_to_exp" class="form-control" value="<?= !empty($c_acq['TOP_EXPLANATION']) ? $c_acq['TOP_EXPLANATION'] :''; ?>" placeholder="Termin Ke - (?) / Periode Reccuring / Persentasi Progress" >
		                                  </div>

		                                 </div>
		                               

		                                  <div class="col-sm-6">
		                                    <div class="form-group">
		                                      <label>Note</label>
		                                      <textarea  rows="8" type="text" id="target_note" name="target_note" class="form-control" placeholder="<?= !empty($c_acq['A_NOTE']) ? $c_acq['A_NOTE'] : (!empty($c_acq['T_NOTE']) ? $c_acq['T_NOTE'] : '') ?>" ><?= !empty($c_acq['A_NOTE']) ? $c_acq['A_NOTE'] : (!empty($c_acq['T_NOTE']) ? $c_acq['T_NOTE'] : '') ?></textarea>
		                                    </div>
		                                  </div>
		                              </div>
		                            </div>
		                        </div>
		                </idv>    
		                
		            	<div class="col-sm-6 offset-md-6">
		            		<span>Gunakan klausul pada Kontrak Berlangganan (KB) antara Telkom dengan Customer (nilai sebelum PPN10%)</span>
		            	</div>
		                        
		                  <div class="modal-footer" id="">
		                    <button type="button" class="btn btn-danger z-index-top" data-dismiss="modal">Cancel</button>
		                    <button type="button" id="btnUpdateAcquisition" class="btn btn-success">Update Acquisition</button>
		                  </div>
		              </form>
		            </div>
		    </div>
		  </div>
		</div>




	</div>




<script>
 var id_project 	= "<?= $id_project; ?>";
 var total_weight 	= "<?= !empty($total_weight) ? $total_weight : 0; ?>";
 var field_edit 	= null;
 var Page = function () {

 		$(function(){
		  $(".collapse").on("shown.bs.collapse", function(event){
		    let header = "#" + $(event.currentTarget).attr("aria-labelledby");
		    $($(header).children().children().children().children().children()[1]).removeClass("icon-arrow-up").addClass("icon-arrow-down");
		  });
		  
		  $(".collapse").on("hidden.bs.collapse", function(event){
		    let header = "#" + $(event.currentTarget).attr("aria-labelledby");
		    $($(header).children().children().children().children().children()[1]).removeClass("icon-arrow-down").addClass("icon-arrow-up");
		  });
		});


 		$(function(){
		  $(".collapsex").on("shown.bs.collapse", function(event){
		    let header = "#" + $(event.currentTarget).attr("aria-labelledby");
		    $($(header).children().children().children()[1]).removeClass("icon-arrow-up").addClass("icon-arrow-down");
		  });
		  
		  $(".collapsex").on("hidden.bs.collapse", function(event){
		    let header = "#" + $(event.currentTarget).attr("aria-labelledby");
		    $($(header).children().children().children()[1]).removeClass("icon-arrow-down").addClass("icon-arrow-up");
		  });
		});

   

    	var linechart = function(){
    		var chartLine = Highcharts.chart('chartProgress', {
	        
			        chart: {
					        height: 400
							},
							credits: {
								enabled: false
							},
					        title: {
				                    text: '',
				                    x: -20, //center
				                    style: {
				                     // color: '#f42020',
				                     textTransform: 'uppercase',
				                     fontSize: '12px'
				                    },
				                },
				                subtitle: {
				                    text: "",
				                },
					        xAxis: {
					            categories: [<?php echo "'".implode("','", $kurva['WEEK'])."'"?>]
					        },
					        yAxis: {
					        	// max : 100,
					            title: {
					                text: ''
					            },
					            max: 100,
					            plotLines: [{
					                value: 0,
					                width: 1,
					                color: '#808080'
					            }]
					        },
					        tooltip: {
					            // valueSuffix: '%'
					            formatter: function () {
					                var tooltipsArr = [<?php echo "'".implode("','", $kurva['PERIOD'])."'"?>];
					                return tooltipsArr[this.point.index] +'<br>'+ this.series.name +' : '+ Highcharts.numberFormat(this.point.y, 2) +'%';
					            }
					        },
					        legend: {
					            layout: 'horizontal',
					            align: 'center',
					            verticalAlign: 'bottom',
					            borderWidth: 0
					        },
					        series: [{
					            name: 'Plan',
					            color: '#016ead',
					            data: [<?php echo implode(",", $kurva['PLAN'])?>]
					        }, {
					            name: 'Achievement',
					            color: '#06bd3e',
					            data: [<?php echo implode(",", $kurva['REAL'])?>]
					        }]
				    });


				    var render_width  = chartLine.chartWidth;
				    var render_height = render_width * chartLine.chartHeight / chartLine.chartWidth;

				    var svg = chartLine.getSVG({
				        exporting: {
				            sourceWidth: chartLine.chartWidth,
				            sourceHeight: chartLine.chartHeight
				        }
				    });
				    var canvas = document.createElement('canvas');
				    canvas.height = render_height;
				    canvas.width = render_width;
    	}


    	var linechartAcq = function(){
    		var chartLine2 = Highcharts.chart('chartAcquistion', {
	        
			        chart: {
					        height: 400
							},
							credits: {
								enabled: false
							},
					        title: {
				                    text: '',
				                    x: -20, //center
				                    style: {
				                     // color: '#f42020',
				                     textTransform: 'uppercase',
				                     fontSize: '12px'
				                    },
				                },
				                subtitle: {
				                    text: "",
				                },
					        xAxis: {
					            categories: [<?php echo "'".implode("','", $acq['MONTH'])."'"?>]
					        },
					        yAxis: {
					        	// max : 100,
					            title: {
					                text: ''
					            },
					            plotLines: [{
					                value: 0,
					                width: 1,
					                color: '#808080'
					            }]
					        },
					        tooltip: {
					            // valueSuffix: '%'
					            formatter: function () {
					                var tooltipsArr = [<?php echo "'".implode("','", $acq['PERIOD'])."'"?>];
					                return tooltipsArr[this.point.index] +'<br>'+ this.series.name +' : '+ Highcharts.numberFormat(this.point.y, 2);
					            }
					       		 },
					        legend: {
					            layout: 'horizontal',
					            align: 'center',
					            verticalAlign: 'bottom',
					            borderWidth: 0
					        },
					        series: [{
					            name: 'Target',
					            color: '#20a8d8',
					            data: [<?php echo implode(",", $acq['PLAN2'])?>]
					        }, {
					            name: 'Acquisited',
					            color: '#4dbd74',
					            data: [<?php echo implode(",", $acq['REAL2'])?>]
					        }]
				    });


				    var render_width  = chartLine2.chartWidth;
				    var render_height = render_width * chartLine2.chartHeight / chartLine2.chartWidth;

				    var svg = chartLine2.getSVG({
				        exporting: {
				            sourceWidth: chartLine2.chartWidth,
				            sourceHeight: chartLine2.chartHeight
				        }
				    });
				    var canvas = document.createElement('canvas');
				    canvas.height = render_height;
				    canvas.width = render_width;
    	}



	return {
		init: function() { 
		linechart();
		linechartAcq();

		// ASSIGN ISSUE AND ACTION
		$(document).on('click','.btn_assign_issue', function () { 
						var id = $(this).data('id');
						$('#assign_issue_id').val(id);
						$('#modal_assign_issue').modal('show');
	            });



		$(document).on('click','#btn_save_assign_issue', function (e) {
				e.stopImmediatePropagation();
				if($('#form_assign_issue').valid()){

						var dataForm  = $('#form_assign_issue').serialize();
						var url = base_url + "project/assign_issue/"+id_project;
						$('#issue').modal('hide');
						$.ajax({
			                    url: url,
			                    type:'POST',
			                    data:  dataForm ,
			                    dataType : "json",
			                    success:function(result){
			                    	if(result.data == 'success'){
			                    		location.reload();
			                    	}
			                    		//location.reload();
			                         	//return result;
			                    }

			            });
				}
				
			});

		$(document).on('click','#btn_save_assign_action', function (e) {
				e.stopImmediatePropagation();
				if($('#form_assign_action').valid()){

						var dataForm  = $('#form_assign_action').serialize();
						var url = base_url + "project/assign_action/"+id_project;
						$('#issue').modal('hide');
						$.ajax({
			                    url: url,
			                    type:'POST',
			                    data:  dataForm ,
			                    dataType : "json",
			                    success:function(result){
			                    	if(result.data == 'success'){
			                    		location.reload();
			                    	}
			                    		//location.reload();
			                         	//return result;
			                    }

			            });
				}
				
			});


		// ASSIGN ISSUE AND ACTION
		$(document).on('click','.btn_assign_action', function () { 
						var id = $(this).data('id');
						$('#assign_action_id').val(id);
						$('#modal_assign_action').modal('show');
	            });

		$(document).on('click','#btn_save_assign_action', function (e) {
				e.stopImmediatePropagation();

				if($('#form_assign_action').valid()){
						var dataForm  = $('#form_assign_action').serialize();
						var url = base_url + "project/assign_action/"+id_project;
						$('#issue').modal('hide');
						$.ajax({
			                    url: url,
			                    type:'POST',
			                    data:  dataForm ,
			                    dataType : "json",
			                    success:function(result){
			                    	if(result.data == 'success'){
			                    		location.reload();
			                    	}
			                    		//location.reload();
			                         	//return result;
			                    }

			            });
				}
				
			});

		$(document).on('click','#btn_save_assign_action', function (e) {
				e.stopImmediatePropagation();
				if($('#form_assign_action').valid()){

						var dataForm  = $('#form_assign_action').serialize();
						var url = base_url + "project/assign_action/"+id_project;
						$('#issue').modal('hide');
						$.ajax({
			                    url: url,
			                    type:'POST',
			                    data:  dataForm ,
			                    dataType : "json",
			                    success:function(result){
			                    	if(result.data == 'success'){
			                    		location.reload();
			                    	}
			                    		//location.reload();
			                         	//return result;
			                    }

			            });
				}
				
			});


		$(document).on('click','#btn_save_edit_project', function (e) {
				e.stopImmediatePropagation();
				if($('#form_edit_project').valid()){

						var dataForm  = $('#form_edit_project').serialize();
						var url = base_url + "project/update_base_project/"+field_edit;
						$('#issue').modal('hide');
						$.ajax({
			                    url: url,
			                    type:'POST',
			                    data:  dataForm ,
			                    dataType : "json",
			                    success:function(result){
			                    	if(result.data == 'success'){
			                    		location.reload();
			                    	}
			                    		//location.reload();
			                         	//return result;
			                    }

			            });
				}
				
			});


		$(document).on('click','#btnDeliverables', function () {
						$('#modal_title_deliverable').text('Add Deliverable');
						$("#saveUpdateDeliverable").addClass('hidden');
						$("#saveAddDeliverable").removeClass('hidden');
						$("#c_deliverable_achievement").addClass('hidden');
						$(".deliverable_field").val('');
						
						$("#deliverable_weight").attr('max', 100 - Number(total_weight));
						$("#devWeigVal").text(100 - Number(total_weight));

						$('#modal_deliverable').modal('show');
	            });

		$(document).on('click','.btn_update_deliverable', function () { 
					$('#modal_title_deliverable').text('Update Deliverable');
					$("#c_deliverable_achievement").removeClass('hidden');
					$("#saveUpdateDeliverable").removeClass('hidden');
					$("#saveAddDeliverable").addClass('hidden');

	                $.ajax({
	                        type:"POST",
	                        url:base_url+"project/get_deliverable/"+ $(this).data('id'),
	                        success: function(datajson) {
	                            var data = jQuery.parseJSON(datajson);

	                            $("#deliverable_id_project").val(data['ID_DELIVERABLE']);
	                            $("#deliverable_name").val(data['NAME']);
	                            $("#deliverable_start_date").datepicker('setDate', new Date(data['START_DATE']));
	                            $("#deliverable_end_date").datepicker('setDate',new Date(data['END_DATE']));
	                            $("#deliverable_weight").val(Number(data['WEIGHT']));
	                            $("#deliverable_achievement").val(Number(data['ACHIEVEMENT']))
	                            $("#deliverable_description").val(data['DESCRIPTION']);
	                            
	                            $("#deliverable_weight").attr('max',(100 - Number(total_weight)) + Number(data['WEIGHT']) );
	                            $("#devWeigVal").text((100 - Number(total_weight)) + Number(data['WEIGHT']) );

	                        }
	                    })
						$('#modal_deliverable').modal('show');
	            });

		$(document).on('click','.btnissue', function () {
						$('.issue_field').val('');
	        			$("#issue_id").val('');
                		$('#c_issue_status').addClass('hidden');
                		$('.c_issue_symptom').addClass('hidden');
                		$('#c_issue_closed_date').addClass('hidden');
                		$('.issue_symptom').attr('disabled',true);
                		$('#id_deliverable_issue').val($(this).data('id'));
                		$('#deliverable_issue').val($('#'+$(this).data('id')+'name').text());
						$('#btnUpdateissue').addClass('hidden');
                		$('#btnSaveissue').removeClass('hidden');
						$('#modal-issue').modal('show');
	            });

		// UPDATE ISSUE
		$(document).on('click','.btn_update_issue', function () {
	        			$(".issue_field").val('');
                		$('#c_issue_status').removeClass('hidden');
                		$('.c_issue_symptom').addClass('hidden');
                		$('.issue_symptom').attr('disabled',true);
                		$('#deliverable_issue').val($('#'+$(this).data('id_deliverable')+'name').text());

                		$('#btnUpdateissue').removeClass('hidden');
                		$('#btnSaveissue').addClass('hidden');

                		$.ajax({
		                        type:"POST",
		                        url:base_url+"project/get_issue/"+ $(this).data('id'),
		                        success: function(datajson) {
		                            var data = jQuery.parseJSON(datajson);
		                            $('#issue_id').val(data['ID_ISSUE']);
		                            $('#issue_name').val(data['ISSUE_NAME']);
		                            $('#impact').val(data['IMPACT']);
		                            $("#id_deliverable_issue").val(data['ID_DELIVERABLE']);
		                            $("#risk_impact").val(data['RISK_IMPACT']);
		                            $("#responsible").val(data['IN_CHARGE']);
		                            $("#issue_status").val(data['STATUS_ISSUE']);
		                            if(data['STATUS_ISSUE']=='CLOSED'){
		                            	$('#c_issue_closed_date').removeClass('hidden');
		                            	$('#issue_closed_date').val(data['CLOSED_DATE']);	
		                            }else{
		                            	$('#c_issue_closed_date').addClass('hidden');
		                            }

		                            if(data['CATEGORY'] != null){
		                            	$('#c_symptom_'+ data['IN_CHARGE'].toLowerCase()).removeClass('hidden');
										$('#symptom_'+ data['IN_CHARGE'].toLowerCase()).attr('disabled',false);
										$('#symptom_'+ data['IN_CHARGE'].toLowerCase()).val(data['CATEGORY']);
		                            }
		                        }
		                 });

						$('#modal-issue').modal('show');
	            });

		// DELETE ISSUE
		$(document).on('click','.btn_delete_issue', function (e) {
	        	e.stopImmediatePropagation();
	                var id_issue = $(this).data('id');
	                bootbox.confirm({
	                    message: "<span style='font-size:14px;'><b>Delete</b> this <i><b> Issue </b><i> permanently?</span>",
	                    buttons: {
	                            cancel: {
	                                label: 'No',
	                                className: 'btn-danger col-md-offset-4 col-md-2'
	                            },
	                            confirm: {
	                                label: 'Yes',
	                                className: 'btn-success col-md-2'
	                            }
	                    },
	                    callback: function (result) {
	                        if(result){
									$.ajax({
						                    url: base_url + "project/delete_issue/"+id_project,
						                    type:'POST',
						                    data:  {id : id_issue} ,
						                    dataType : "json",
						                    success:function(result){
						                         if(result.data == 'success'){
						                    		location.reload();
						                    	}
						                    }

						            });
	                            
	                        }
	                    }
	                });
	        });

		$(document).on('click','.btn_action', function () {
						$('#btnSaveAction').removeClass('hidden');
						$('#btnUpdateAction').addClass('hidden');
						$('#c_action_status').addClass('hidden');
						$('#action_closed_date').addClass('hidden');
						$(".action_field").val('');
						$("#action_id").val('');
	        			$('#action_issue_id').val($(this).data('id'));
	        			$('#action_issue').val($('#'+$(this).data('id')+'name').text());
                		$('#action_in_charge').val($(this).data('pic'));
						
						$('#modal-action').modal('show');
	            });

		$(document).on('click','.btn_update_action', function () {
						$(".action_field").val('');
						$('#btnSaveAction').addClass('hidden');
						$('#btnUpdateAction').removeClass('hidden');
						$('#c_action_status').removeClass('hidden');

	        			$('#action_issue_id').val($(this).data('id_issue'));
	        			$('#action_issue').val($(this).data('issue_name'));
                		
                		$.ajax({
	                        type:"POST",
	                        url:base_url+"project/get_action/"+ $(this).data('id'),
	                        success: function(datajson) {
	                            var data = jQuery.parseJSON(datajson);
	                            $('#action_id').val(data['ID_ACTION_PLAN']);
	                            $('#action_name').val(data['ACTION_NAME']);
	                            $('#action_due_date').datepicker('setDate',new Date(data['DUE_DATE']));;
	                            $('#action_in_charge').val(data['ASSIGN_TO']);
	                            $('#action_remarks').val(data['ACTION_REMARKS']);
	                            $('#action_issue_id').val(data['ID_ISSUE']);
	                            $('#action_status').val(data['ACTION_STATUS']);

	                            if(data['ACTION_STATUS']=='CLOSED'){
	                            	$('#action_closed_date').datepicker('setDate', data['ACTION_CLOSED_DATE']);	
	                            	$('#c_action_closed_date').removeClass('hidden');
	                            }else{
	                            	$('#c_action_closed_date').addClass('hidden');
	                            }
	                            
	                            
	                            $.each( data['pics'], function( key, value ) {
	                            	$('#action_picname'+key).val(value.PIC_NAME);
	                            	$('#action_picemail'+key).val(value.PIC_EMAIL)
								});

	                        }
	                    })
						
						$('#modal-action').modal('show');
	            });

		$(document).on('change','#responsible', function () {
                		let res = $(this).val();
                		$('.c_issue_symptom').addClass('hidden');
                		$('.issue_symptom').attr('disabled',true);
                		$('#c_symptom_'+res.toLowerCase()).removeClass('hidden');
                		$('#symptom_'+res.toLowerCase()).attr('disabled',false);
                	console.log($(this).val());
	    });




		$(document).on('click','#saveAddDeliverable', function (e) {
				e.stopImmediatePropagation();
				if($('#frmDeliverables').valid()){

						var dataForm  = $('#frmDeliverables').serialize();
						var url = base_url + "project/add_deliverable/"+id_project;
						$('#issue').modal('hide');
						$.ajax({
			                    url: url,
			                    type:'POST',
			                    data:  dataForm ,
			                    dataType : "json",
			                    success:function(result){
			                    	if(result.data == 'success'){
			                    		location.reload();
			                    	}
			                    		//location.reload();
			                         	//return result;
			                    }

			            });
				}
				
			});


		$(document).on('click','#saveUpdateDeliverable', function (e) {
				e.stopImmediatePropagation();
				if($('#frmDeliverables').valid()){

						var dataForm  = $('#frmDeliverables').serialize();
						var url = base_url + "project/update_deliverable/"+id_project;
						$('#issue').modal('hide');
						$.ajax({
			                    url: url,
			                    type:'POST',
			                    data:  dataForm ,
			                    dataType : "json",
			                    success:function(result){
			                    	if(result.data == 'success'){
			                    		location.reload();
			                    	}
			                    		//location.reload();
			                         	//return result;
			                    }

			            });
				}
				
			});

		// DELETE DELIVERABLE
		$(document).on('click','.btn_delete_deliverable', function (e) {
	        	e.stopImmediatePropagation();
	                var id_deliverable = $(this).data('id');
	                bootbox.confirm({
	                    message: "<span style='font-size:14px;'><b>Delete</b> this <i><b> Deliverable </b><i> permanently?</span>",
	                    buttons: {
	                            cancel: {
	                                label: 'No',
	                                className: 'btn-danger col-md-offset-4 col-md-2'
	                            },
	                            confirm: {
	                                label: 'Yes',
	                                className: 'btn-success col-md-2'
	                            }
	                    },
	                    callback: function (result) {
	                        if(result){
									$.ajax({
						                    url: base_url + "project/delete_deliverable/"+id_project,
						                    type:'POST',
						                    data:  {id : id_deliverable} ,
						                    dataType : "json",
						                    success:function(result){
						                         if(result.data == 'success'){
						                    		location.reload();
						                    	}
						                    }

						            });
	                            
	                        }
	                    }
	                });
	        });

		$(document).on('click','#btnSaveissue', function (e) {
				e.stopImmediatePropagation();

				if($('#frmissue').valid()){

						var dataForm  = $('#frmissue').serialize();
						var url = base_url + "project/add_issue/"+id_project;
						$('#issue').modal('hide');
						$.ajax({
			                    url: url,
			                    type:'POST',
			                    data:  dataForm ,
			                    dataType : "json",
			                    success:function(result){
			                    	if(result.data == 'success'){
			                    		location.reload();
			                    	}
			                    		//location.reload();
			                         	//return result;
			                    }

			            });
				}
				
			});


		// UPDATE ACTION
		$(document).on('click','#btnSaveAction', function (e) {
				e.stopImmediatePropagation();

				if($('#form_action').valid()){

						var dataForm  = $('#form_action').serialize();
						var url = base_url + "project/add_action/"+id_project;
						$('#issue').modal('hide');
						$.ajax({
			                    url: url,
			                    type:'POST',
			                    data:  dataForm ,
			                    dataType : "json",
			                    success:function(result){
			                    	if(result.data == 'success'){
			                    		location.reload();
			                    	}
			                    		//location.reload();
			                         	//return result;
			                    }

			            });
				}
				
			});

		$(document).on('click','#btnUpdateAction', function (e) {
				e.stopImmediatePropagation();

				if($('#form_action').valid()){

						var dataForm  = $('#form_action').serialize();
						var url = base_url + "project/update_action/"+id_project;
						$('#issue').modal('hide');
						$.ajax({
			                    url: url,
			                    type:'POST',
			                    data:  dataForm ,
			                    dataType : "json",
			                    success:function(result){
			                    	if(result.data == 'success'){
			                    		location.reload();
			                    	}
			                    		//location.reload();
			                         	//return result;
			                    }

			            });
				}	
			});

		// DELETE ACTION
		$(document).on('click','.btn_delete_action', function (e) {
	        	e.stopImmediatePropagation();
	                var id_action = $(this).data('id');
	                bootbox.confirm({
	                    message: "<span style='font-size:14px;'><b>Delete</b> this <i><b> Action Plan </b><i> permanently?</span>",
	                    buttons: {
	                            cancel: {
	                                label: 'No',
	                                className: 'btn-danger col-md-offset-4 col-md-2'
	                            },
	                            confirm: {
	                                label: 'Yes',
	                                className: 'btn-success col-md-2'
	                            }
	                    },
	                    callback: function (result) {
	                        if(result){
									$.ajax({
						                    url: base_url + "project/delete_action/"+id_project,
						                    type:'POST',
						                    data:  {id : id_action} ,
						                    dataType : "json",
						                    success:function(result){
						                         if(result.data == 'success'){
						                    		location.reload();
						                    	}
						                    }

						            });
	                            
	                        }
	                    }
	                });
	        });


		$(document).on('change','#issue_status', function (e) {
			if($('#issue_status').val()=='CLOSED'){
				$('#c_issue_closed_date').removeClass('hidden');
				$('#issue_closed_date').prop('required',true);
			}else{
				$('#c_issue_closed_date').addClass('hidden');
				$('#issue_closed_date').prop('required',false);
				$('#issue_closed_date').val('');

			}
		});


		$(document).on('change','#action_status', function (e) {
			if($('#action_status').val()=='CLOSED'){
				$('#c_action_closed_date').removeClass('hidden');
				$('#action_closed_date').prop('required',true);
			}else{
				$('#c_action_closed_date').addClass('hidden');
				$('#action_closed_date').prop('required',false);
				$('#action_closed_date').val('');

			}
		});

		$(document).on('click','#btnUpdateissue', function (e) {
				e.stopImmediatePropagation();

				if($('#frmissue').valid()){

						var dataForm  = $('#frmissue').serialize();
						var url = base_url + "project/update_issue/"+id_project;
						$('#issue').modal('hide');
						$.ajax({
			                    url: url,
			                    type:'POST',
			                    data:  dataForm ,
			                    dataType : "json",
			                    success:function(result){
			                    	if(result.data == 'success'){
			                    		location.reload();
			                    	}
			                    		//location.reload();
			                         	//return result;
			                    }

			            });
				}	
			});

		$(document).on('click','#btnAcquisition', function () {
						$('#acquisitionModal').modal('show');
	        });

		$(document).on('click','.btn_edit_project', function () {
						field_edit 	= null;
						let field 	= $(this).data('field');
						console.log(field);
						$('.edit_project_form').attr('disabled',true);
						$('.edit_project_form').attr('required',false);
						$('.edit_project_form').addClass('hidden');
						$('#adendum_note').addClass('hidden');
						field_edit = field;
						switch(field) {
						  case 'NAME':
						    	$('.title_edit_project').text("Name");
						    	$('#project_name').removeClass('hidden');
						    	$('#project_name').attr('disabled',false);
						    	$('#project_name').attr('required',true);
						    break;
						   case 'CUSTOMER':
						    	$('.title_edit_project').text("Customer");
				                    $('#c_project_customer').removeClass('hidden');
				                    $('#project_customer').removeClass('hidden');
				                    $('#project_customer').attr('required',true);
				                    $('#project_customer').attr('disabled',false);
				                    $('#project_customer').empty();
				                    $("#project_customer").select2({
				                            placeholder: "Select Customer",
				                            width: 'resolve',
				                            ajax: {
				                                type: 'POST',
				                                delay: 200,
				                                url:base_url+"json/get_json_customer?",
				                                dataType: "json",
				                                data: function (params) {
				                                    return {
				                                        q: params.term,
				                                        page: params.page,
				                                    };
				                                },
				                                processResults: function (data) {
				                                    return {
				                                        results: $.map(data, function(obj) {
				                                            return { id: obj.NIP_NAS, text: obj.STANDARD_NAME, name: obj.STANDARD_NAME};
				                                        })
				                                    };
				                                },
				                                
				                            }
				                    });  
						    break;
						   case 'AM_NAME':
						    	$('.title_edit_project').text("Account Manager");
						    	$('#c_project_am').removeClass('hidden');
						    	$('#project_am').removeClass('hidden');
						    	$('#project_am').attr('required',true);
			                    $('#project_am').attr('disabled',false);
			                    $('#project_am').empty();
						    	$("#project_am").select2({
			                            placeholder: "Select Account Manager",
			                            width: 'resolve',
			                            ajax: {
			                                type: 'POST',
			                                delay: 200,
			                                url:base_url+"json/get_json_am",
			                                dataType: "json",
			                                data: function (params) {
			                                    return {
			                                        q: params.term,
			                                        page: params.page,
			                                    };
			                                },
			                                processResults: function (data) {
			                                    return {
			                                        results: $.map(data, function(obj) {
			                                            return { id: obj.NIK, text: obj.NAME, name:obj.NAME};
			                                        })
			                                    };
			                                },
			                                
			                            }
			                    }); 
						    break;
						   case 'TYPE':
						    	$('.title_edit_project').text("Type");
						    	$('#c_project_type').removeClass('hidden');
						    	$('#project_type').removeClass('hidden');
			                    $('#project_type').attr('disabled',false);
			                    $('#project_type').attr('disabled',false);
						    break;
						   case 'START_DATE':
						    	$('.title_edit_project').text("Start Date");
						    	$('#project_start_date').removeClass('hidden');
						    	$('#project_start_date').attr('disabled',false);
						    	$('#project_start_date').attr('required',true);
						    break;
						   case 'END_DATE':
						    	$('.title_edit_project').text("End Date");
						    	$('#project_end_date').removeClass('hidden');
						    	$('#project_end_date').attr('disabled',false);
						    	$('#project_end_date').attr('required',true);

						    	$('#adendum_note').removeClass('hidden');
						    	$('#end_date_note').removeClass('hidden');
						    	$('#end_date_note').attr('disabled',false);
						    	$('#end_date_note').attr('required',true);
						    break;
						   case 'REGIONAL':
						    	$('.title_edit_project').text("Regional");
						    	$('#c_project_regional').removeClass('hidden');
						    	$('#project_regional').removeClass('hidden');
						    	$('#project_regional').attr('disabled',false);
						    	$('#project_regional').attr('required',true);
						    break;
						   case 'SEGMEN':
						    	$('.title_edit_project').text("End Date");
						    	$('#c_project_segmen').removeClass('hidden');
						    	$('#project_segmen').removeClass('hidden');
						    	$('#project_segmen').attr('disabled',false);
						    	$('#project_segmen').attr('required',true);
						    break;
						   case 'NO_KB':
						    	$('.title_edit_project').text("Name");
						    	$('#project_no_kb').removeClass('hidden');
						    	$('#project_no_kb').attr('disabled',false);
						    	$('#project_no_kb').attr('required',true);
						    break;
						   case 'NO_KL':
						    	$('.title_edit_project').text("Name");
						    	$('#project_no_kl').removeClass('hidden');
						    	$('#project_no_kl').attr('disabled',false);
						    	$('#project_no_kl').attr('required',true);
						    break;
						   case 'DESCRIPTION':
						    	$('.title_edit_project').text("Description");
						    	$('#project_description').removeClass('hidden');
						    	$('#project_description').attr('disabled',false);
						    	$('#project_description').attr('required',true);
						    break;
						    case 'STATUS':
						    	$('.title_edit_project').text("Status");
						    	$('#c_project_status').removeClass('hidden');
						    	$('#project_status').removeClass('hidden');
						    	$('#project_status').attr('disabled',false);
						    	$('#project_status').attr('required',true);
						    break;
						    case 'SYMPTOM':
						    	$('.title_edit_project').text("SYMPTOMS");
						    	$('#c_project_symptom').removeClass('hidden');
						    	$('#project_symptom').removeClass('hidden');
						    	$('#project_symptom').attr('disabled',false);
						    	$('#project_symptom').attr('required',true);
						    break;
						  default:
						    	alert('something wrong');
						    	return true;
						}

						$('#modal_edit_project').modal('show');
	        });

		$(document).on('click','#btnUpdateAcquisition', function (e) {
				e.stopImmediatePropagation();
				if($('#frmAcquisition').valid()){
						$('#target_value').val($('#target_value').unmask());
						$('#actual_value').val($('#actual_value').unmask());
						var dataForm  = $('#frmAcquisition').serialize();
						var url = base_url + "project/update_acquisition/"+id_project;
						$.ajax({
			                    url: url,
			                    type:'POST',
			                    data:  dataForm ,
			                    dataType : "json",
			                    success:function(result){
			                    	if(result.data == 'success'){
			                    		location.reload();
			                    	}
			                    		//location.reload();
			                         	//return result;
			                    }

			            });
				}
					
			});

		// ADD DOCUMENT
		$(document).on('click','#btnDocumentSubmit', function (e) {
                e.stopImmediatePropagation();
                if($('#frmDocumentProject').valid()){
                    $('#pre-load-background').fadeIn();
                    var form = $('#frmDocumentProject')[0];
                    var formData = new FormData(form);
                    $.ajax({
                                  url: base_url+'project/add_document/'+id_project,
                                  type:'POST',
                                  dataType : "json",
                                  data:  formData ,
                                  async : true, 
                                  processData: false,
                                  contentType: false,
                                  processData:false
                          	}).done(function(result) {
							  	$('#pre-load-background').fadeOut();
                                  if(result.result.trim()=='success'){
                                  	bootbox.alert("Success!", function(){ 
                                    	location.reload(); 
                                	});
                                  }else{
                                  	console.log(result);
                                  }
							});;
                  }

              });

		// AWESOMPLETE
		var tmp = "";
	    var awesomplete5 = new Awesomplete('#action_picname0', {
	        minChars: 1,
	    });

	    var awesomplete6 = new Awesomplete('#action_picname1', {
	        minChars: 1,
	    });

	    $('#action_picname0').on("keyup", function(){
	    	
		        var q = $(this).val();
		        if(tmp!=q){
		        	setTimeout(function(){
		        		$.ajax({
				            type:"GET",
				            url: base_url + "master/get_all_pic?q="+q,
				            success : function(data){
				                tmp = q;
				                var results = JSON.parse(data).map(function(i){
				                        return { label: i.NAMA+' - '+i.EMAIL, value: i.NAMA };
				                    });
				                awesomplete5.list = results;
				            }
				        });
	    			}, 1000);
			        
			    }
		    });

		    Awesomplete.$('#action_picname0').addEventListener("awesomplete-selectcomplete", function() {
		        var q = $(this)[0]['value'];
		        $.ajax({
		            type:"GET",
		            url: base_url+ "master/get_all_pic_email?q="+q,
		            success : function(data){
		                $("#action_picemail0").val(data);
		            }
		        });
		    });

		    

		    $('#action_picname1').on("keyup", function(){
		        var q = $(this).val();
		        if(tmp!=q){
		        	setTimeout(function(){
		        		$.ajax({
				            type:"GET",
				            url: base_url + "master/get_all_pic?q="+q,
				            success : function(data){
					                var results = JSON.parse(data).map(function(i){
					                        return { label: i.NAMA+' - '+i.EMAIL, value: i.NAMA };
					                    });
				                    awesomplete6.list = results;
				            }
				        });
		        	},1000);	        
			    }
		    });

		    Awesomplete.$('#action_picname1').addEventListener("awesomplete-selectcomplete", function() {
		        var q = $(this)[0]['value'];
		        $.ajax({
		            type:"GET",
		            url: base_url+ "master/get_all_pic_email?q="+q,
		            success : function(data){
		                $("#action_picemail1").val(data);
		            }
		        });
		    });


		    $(document).on('click','#btn_add_document', function () {
				$('#documentProject').fileinput({
		            maxFileCount: 1,    
		            autoReplace: true,               
		            dropZoneEnabled: false,
		            mainClass: "input-group",
		            showUpload:false,
		            showRemove:false,
		            initialPreview  : false,
		            uploadAsync     : false,
		            autoReplace: true, 
		            maxFileCount: 1,
				});  
				$("#modal_document").modal('show');
			});



		}
	};

}();

jQuery(document).ready(function() {
      Page.init(event);
  }); 
</script>