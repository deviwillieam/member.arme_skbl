<?php 
	$this->load->view($filter)
?>
<br>
<div class="card">
    <div class="card-body">
        <h1 class="card-title">Data marker</h1>
        <br>
       
        <br>
      	<table id="example" class="table table-striped table-bordered table-responsive" style="width:100%">
	        <thead>
	            <tr>
	                <th>Pemilik</th>
	                <th>File</th>
	                <th>Status</th>
	                <th>Action</th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        		foreach ($data->result() as $row) {
	        			if($row->status == 1)
	        			{
	        				echo "
	        					<tr>
	        						<td>$row->username</td>
	        						<td><img style='height: 50px; width:50px;' src=".base_url()."assets/images/marker/".$row->nama_file.">
	    						</td>
	        						<td><span class='badge badge-warning'>pending</span></td>
	        						<td>
	        							<button class='btn btn-primary approve' data-id_marker='$row->id_marker'>approve</button>
	        							<button class='btn btn-danger delete' data-id_marker='$row->id_marker' data-nama='$row->nama_file'>Delete</button>
	        						</td>
	        					</tr>";
	        			}
	        			else if($row->status == 2)
	        			{
	        				echo "
	        					<tr>
	        						<td>$row->username</td>
	        						<td><img style='height: 50px; width:50px;' src=".base_url()."assets/images/marker/".$row->nama_file.">
	    							</td>
	        						<td><span class='badge badge-success'>switch</span></td>
	        						<td>
	        							<button class='btn btn-primary pending' data-id_marker='$row->id_marker'>pending</button>
	        							<button class='btn btn-danger delete' data-id_marker='$row->id_marker' data-nama='$row->nama_file'>Delete</button>
	        						</td>
	        					</tr>";
	        			}
	        		}
	        	?>
	        </tbody>
	        <tfoot>
	        	<tr>
	        		<td>Pemilik</td>
	        		<td>File</td>
	        		<td>Status</td>
	        		<td>Action</td>
	        	</tr>
	        </tfoot>
        </table>
    </div>
</div>


<script type="text/javascript">
	
	$('.delete').on('click', function()
	{
		var id = $(this).attr('data-id_marker');
		var nama = $(this).attr('data-nama');
		var x = confirm('apakah anda yakin ingin menghapus data ini?');
		if(x == true)
		{
			$.ajax({
				url:'<?php echo base_url() ?>index.php/marker_admin/delete_marker',
				method:'post',
				data:{id:id, nama:nama},
				success: function(data)
				{
					alert(data);
					location.reload();
				}
			});
		}
		else
		{
			return false;
		}
	});

	$('.pending').on('click', function()
	{
		var id = $(this).attr('data-id_marker');
		$.ajax({
			url:'<?php echo base_url() ?>index.php/marker_admin/pending_marker',
			method:'post',
			data:{id:id},
			success: function(data)
			{
				alert(data);
				location.reload();
			}
		});
	});


	$('.approve').on('click', function()
	{
		var id = $(this).attr('data-id_marker');
		$.ajax({
			url:'<?php echo base_url() ?>index.php/marker_admin/approve_marker',
			method:'post',
			data:{id:id},
			success: function(data)
			{
				alert(data);
				location.reload();
			}
		});
	});

</script>