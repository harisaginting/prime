 <div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-5">
						<h4 class="card-title mb-0">ROLE ACCESS</h4>
						<div class="small text-muted">Prime Users</div>
					</div>

					<div class="col-sm-7" style="margin-bottom: 15px;">
						<div class="float-right">
						</div>
					</div>
				
					<div class="col-sm-12">
						<table 	id="dataRole" 
								class="table table-responsive-sm table-bordered" style="width: 100%;margin-top: 10px;">
							<thead>
								<tr>
									<th style="width: 40%">ROLE NAME</th>
									<th style="width: 15%">PROJECT</th>
									<th style="width: 15%">BAST</th>
									<th style="width: 15%">MONITORING</th>
									<th style="width: 15%">MASTER</th>
								</tr>
							</thead>
							 <tbody>
							 	<?php foreach ($role as $key => $value) : ?>
							 		<tr>
							 			<td><?= $value['ROLE_NAME'] ?></td>
							 			<td><?= $value['PROJECT'] ?></td>
							 			<td><?= $value['BAST'] ?></td>
							 			<td><?= $value['MONITORING'] ?></td>
							 			<td><?= $value['MASTER'] ?></td>
							 		</tr>
							 	<?php  endforeach; ?>
							</tbody>
						</table>

					</div>
				</div>


			</div>


		</div>
	</div>
</div>