<?php 
	$this->load->view($filter);
?>

<br>
<div class="card">
    <div class="card-body">
        <h1 class="card-title">Data Pendaftaran KP </h1>
        <br>
       
        <br>
      	<table id="example" class="table table-striped table-bordered table-responsive" style="width:100%">
	        <thead>
	            <tr>
	                <th>Pemilik</th>
	                <th>Pembayaran</th>
	                <th>Status</th>
	                <th>Tgl verifikasi</th>
	                <th>Tgl limit</th>
	                <th>Action</th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php 
	        		foreach ($data->result() as $row) {
	        			if($row->status == 'not verified')
	        			{
	        				echo "
	        					<tr>
	        						<td>$row->username</td>
	        						<td><a target='_blank' href=".base_url()."assets/images/pembayaran/$row->bukti_pembayaran>$row->bukti_pembayaran</a></td>
	        						<td><span class='badge badge-danger'>not verified</span></td>
	        						<td>$row->tgl_verifikasi</td>
	        						<td>$row->tgl_limit</td>
	        						<td>
	        							<button class='btn btn-primary approve' data-id_pembelian='$row->id_pembelian'>Approve</button>
	        							<button class='btn btn-danger delete' data-id_pembelian='$row->id_pembelian'>Delete</button>
	        						</td>
	        					</tr>";
	        			}
	        			else if($row->status == 'verified')
	        			{
	        				echo "
	        					<tr>
	        						<td>$row->username</td>
	        						<td><a target='_blank' href=".base_url()."assets/images/pembayaran/$row->bukti_pembayaran>$row->bukti_pembayaran</a></td>
	        						<td><span class='badge badge-success'>verified</span></td>
	        						<td>$row->tgl_verifikasi</td>
	        						<td>$row->tgl_limit</td>
	        						<td>
	        							<button class='btn btn-warning pending' data-id_pembelian='$row->id_pembelian'>Pending</button>
	        							<button class='btn btn-danger delete' data-id_pembelian='$row->id_pembelian'>Delete</button>
	        						</td>
	        					</tr>";
	        			}
	        			else if($row->status == 'progres')
	        			{
	        				echo "
	        					<tr>
	        						<td>$row->username</td>
	        						<td><a target='_blank' href=".base_url()."assets/images/pembayaran/$row->bukti_pembayaran>$row->bukti_pembayaran</a></td>
	        						<td><span class='badge badge-warning'>progres</span></td>
	        						<td>$row->tgl_verifikasi</td>
	        						<td>$row->tgl_limit</td>
	        						<td>
	        							<button class='btn btn-primary approve' data-id_pembelian='$row->id_pembelian'>Approve</button>
	        							<button class='btn btn-danger delete' data-id_pembelian='$row->id_pembelian'>Delete</button>
	        						</td>
	        					</tr>";
	        			}
	        			else if($row->status == 'limit')
	        			{
	        				echo "
	        					<tr>
	        						<td>$row->username</td>
	        						<td><a target='_blank' href=".base_url()."assets/images/pembayaran/$row->bukti_pembayaran>$row->bukti_pembayaran</a></td>
	        						<td><span class='badge badge-danger'>limit</span></td>
	        						<td>$row->tgl_verifikasi</td>
	        						<td>$row->tgl_limit</td>
	        						<td>
	        							<button class='btn btn-primary approve' data-id_pembelian='$row->id_pembelian'>Approve</button>
	        							<button class='btn btn-danger delete' data-id_pembelian='$row->id_pembelian'>Delete</button>
	        						</td>
	        					</tr>";
	        			}
	        		}
	        	?>
	        </tbody>
	        <tfoot>
	        	<tr>
	        		<td>Pemilik</td>
	        		<td>Pembayaran</td>
	        		<td>Status</td>
	        		<td>Tgl verifikasi</td>
	        		<td>Tgl limit</td>
	        		<td>Action</td>
	        	</tr>
	        </tfoot>
        </table>
    </div>
</div>


<script type="text/javascript">
	
	$('.pending').on('click', function()
	{
		var id = $(this).attr('data-id_pembelian');
		var x = confirm('Apakah anda yakin ingin memending data ini?');
		if(x == true)
		{
			$.ajax({
				url:'<?php echo base_url() ?>index.php/pembelian/pending_pembelian',
				method:'post',
				data:{id:id},
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

	$('.approve').on('click', function()
	{
		var id = $(this).attr('data-id_pembelian');
		var x = confirm('Apakah anda yakin ingin memverifikasi data ini?');
		if(x == true)
		{
			$.ajax({
				url:'<?php echo base_url() ?>index.php/pembelian/approve_pembelian',
				method:'post',
				data:{id:id},
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

	$('.delete').on('click', function()
	{
		var id = $(this).attr('data-id_pembelian');
		var x = confirm('Apakah anda yakin ingin menghapus data ini?');
		if(x == true)
		{
			$.ajax({
				url:'<?php echo base_url() ?>index.php/pembelian/delete_pembelian',
				method:'post',
				data:{id:id},
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

</script>