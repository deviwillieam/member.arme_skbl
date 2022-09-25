<?php 
    $msg = $this->session->flashdata('msgok');
    if(!empty($msg))
    {
      // echo "ada";
        ?>
            <script type="text/javascript">
                $(document).ready(function()
                {
                  // alert();
                  $('.alert-success').html('<?php echo $msg ?>').show().delay(5000).hide('slow');
                    // $('.alert-success').html('<?php echo $msg?>').show().delay(5000).hide('slow');
                });
            </script>
        <?php
    }

    $msgno = $this->session->flashdata('msgno');
    if(!empty($msgno))
    {
        ?>
            <script type="text/javascript">
                $(document).ready(function()
                {
                    $('.alert-warning').html('<?php echo $msgno ?>').show().delay(5000).hide('slow');
                });
            </script>
        <?php
    }
?>


<div class="alert alert-success" style="display: none;"></div>
<div class="alert alert-warning" style="display: none;"></div>

<div class="card">
	<div class="card-body">
		<h1 class="card-title">Upload marker</h1>
		<br>
		<form id="upload_marker" class="form-inline">
      <input type="hidden" name="id_user" id="id_user" value="<?php echo $id_user ?>">
		  <div class="form-group mx-sm-3 mb-2">
		    <label for="select_option" class="sr-only">Paket</label>
		    <select id="select_option" class="form-control" name="id_paket">
			   	<?php 
			   		foreach ($data->result() as $row) {
			   			?>
			   				<option value="<?php echo $row->id_paket ?>"><?php echo $row->nama_paket ?></option>
			   			<?php
			   		}
			   	?>
			</select>
		  </div>
		  <button type="submit" class="btn btn-primary mb-2">Submit</button>
		</form>
	</div>
</div>

<br><br>

<div class="card" id="uploadaja" style="display: none;">
	<div class="card-body">
		<h1 class="card-title">Upload image</h1>
		<br>
		 <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>index.php/marker/save_marker">
          <input type="hidden" name="id_pemilik" value="<?php echo $id_user ?>">
          <input type="hidden" name="id_paket" id="id_paket">
         
          <div class="form-group">
            <label class="control-label col-sm-2" for="video">Marker:</label>
            <div class="col-sm-10">
              <input type="file" required=""  id="photo" name="photo">
            </div>
           
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form> 
	</div>
</div>

<div class="alert alert-warning" id="limit" style="display: none;">Maaf, paket ini belum bisa digunakan, pastikan status paket telah terverifikasi!</div>

<script type="text/javascript">

	$(document).on('submit', '#upload_marker', function(e)
	{
		e.preventDefault();
		var value = $("#select_option option:selected").val();
		var id_user = $('#id_user').val();
    // alert(value);
    $.ajax(
    {
        url:'<?php echo base_url() ?>index.php/marker/cek_limit_paket',
        type:'post',
        data:{id_paket:value, id_user:id_user},
        dataType:'json',
        success: function(data)
        {
            if(data.status == 'limit')
            {
                $('#limit').show().delay(1500).hide('slow');
                $('#uploadaja').hide();

            }
            else
            {
                $('#id_paket').val(value);
                $('#uploadaja').show();
            }
        }
    });

	});

</script>