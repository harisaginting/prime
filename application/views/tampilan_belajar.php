<div class="card">
	<div class="card-body">
		<table class="table table-bordered" id="data_user">
			<thead>
				<tr>
					<th>ID</th>
					<th>NAMA</th>
					<th>ROLE</th>
				</tr>
			</thead>

			<tbody>
			</tbody>
		</table>
	</div>
	<div class="card-footer">
		<button class="btn btn-sm btn-info btn-brand"> <i class="fa fa-download" ></i> <span>Download</span></button>
	</div>

</div>

<script type="text/javascript">
	$('#data_user').DataTable({
        ajax: {
        	url : base_url+'datatable/user',
        	method : 'POST'
        },
        processing: true,
        serverSide: true,
        order :[0,'desc'],
        aoColumns: [
        	{ mData: 'NIK'},
        	{ mData: 'NAMA'},
            { 
                'mRender': function(data, type, obj){
             		let  a = "<a class='nav_link btn btn-info btn-sm' href='"+base_url+"belajar/edit/"+obj.NIK+"'><span>EDIT</span></a>";
                 return a;
             	}                    
            }, 


           ]

	});
</script>
