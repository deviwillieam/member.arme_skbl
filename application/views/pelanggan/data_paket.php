<div class="card">
    <div class="card-body">
        <h1 class="card-title">Data paket</h1>
        <br>
        <button class="btn btn-info addpaket" data-id_user='<?php echo $id_user ?>' style="margin-left: 1px;">Add</button> 
        <br>
        <br>
        <table id="example" class="table table-striped table-bordered table-responsive" style="width:100%">
        	<thead>
        		<th>Nama</th>
        		<th>Paket</th>
        		<th>Status</th>
        		<th>Info</th>
        		<th>Tgl verifikasi</th>
        		<th>Tgl limit</th>
        	</thead>
        	<tbody>
        		<?php 
        			foreach ($data->result() as $row) {
        				if($row->status == 'limit')
                        {
                            echo "
                            <tr>
                                <td>$row->username</td>
                                <td>$row->nama_paket</td>
                                <td><span class='badge badge-danger'>$row->status</span></td>
                                <td>
                                    <button data-id_paket='$row->id_paket' class='btn btn-primary btn-sm perpanjang'>perpanjang</button>
                                </td>
                                <td>$row->tgl_verifikasi</td>
                                <td>$row->tgl_limit</td>
                            </tr>
                            ";
                        }
                        else if($row->status == 'not verified')
                        {
                            echo "
                            <tr>
                                <td>$row->username</td>
                                <td>$row->nama_paket</td>
                                <td><span class='badge badge-warning'>not verified</span></td>
                                <td>
                                    <button data-id_paket='$row->id_paket' class='btn btn-primary btn-sm uploadpembayaran'>upload pembayaran</button>
                                </td>
                                <td>$row->tgl_verifikasi</td>
                                <td>$row->tgl_limit</td>
                            </tr>
                            ";
                        }
                        else if($row->status == 'progres')
                        {
                            echo "
                            <tr>
                                <td>$row->username</td>
                                <td>$row->nama_paket</td>
                                <td><span class='badge badge-warning'>progres</span></td>
                                <td>
                                    
                                </td>
                                <td>$row->tgl_verifikasi</td>
                                <td>$row->tgl_limit</td>
                            </tr>
                            ";
                        }
                        else if($row->status == 'verified')
                        {
                            echo "
                            <tr>
                                <td>$row->username</td>
                                <td>$row->nama_paket</td>
                                <td><span class='badge badge-success'>verified</span></td>
                                <td>
                                    
                                </td>
                                <td>$row->tgl_verifikasi</td>
                                <td>$row->tgl_limit</td>
                            </tr>
                            ";
                        }
        			}
        		?>
        	</tbody>
        
        </table>
    </div>
</div>

<div class="modal fade" id="modalUploadPembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="title">Upload pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="formUpload">
            <input type="hidden" name="id_paket" id="id_paket"/>
            <div class="form-group">
                <label for="formGroupExampleInput">Upload image</label>
                <input type="file" class="form-control-file" id="photo" name="photo" >
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalPaket" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"  id="title_paket">Add Paket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form method="post" id="formPaket">
                    <input type="hidden" name="id_users" id="id_users">
               <div class="form-group row">
                    <label for="paket" class="col-sm-2 col-form-label">Paket</label>
                    <div class="col-sm-10">
                        <select name="paket" class="form-control" id="paket">
                            <?php 
                               foreach ($paket->result() as $row) {
                                  ?>
                                    <option value="<?php echo $row->id_paket ?>"><?php echo $row->nama_paket ?></option>
                                  <?php
                               }
                            ?>
                        </select>
                    </div>
                </div>

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function()
    {
        //submit paket
         // submit
        $(document).on('submit', '#formPaket', function(e)
        {
            e.preventDefault();
            var id_user = $('#id_users').val();
            var paket = $('#paket').val();
            // alert(id_user);
            $.ajax({
                url:"<?php echo base_url().'index.php/pelanggan/add_paket'?>",  
                method:'POST',  
                data:{id_user:id_user, paket:paket},
                dataType:'json',
                beforeSend: function()
                {
                    $('#title_paket').text('Inserting, please wait...')
                },
                success:function(data)  
                {  
                    if(data.status == 'ada') 
                    {
                        alert('Maaf, paket ini telah anda beli sebelumnya!');
                        $('#title_paket').text('Add paket');
                        // location.reload();
                    }
                    else
                    {
                        alert('Berhasil');
                        $('#modalPaket').modal('hide');
                        $('#title_paket').text('Add paket');
                        location.reload();
                    }
                   
                }  
            });
        });

        // submit
        $(document).on('submit', '#formUpload', function(e)
        {
            e.preventDefault();
            var x = $('#photo').val().split('.').pop().toLowerCase(); 
            if(x == '')
            {
                alert('Image tidak boleh kosong!');
            } 
            else
            {
                if(jQuery.inArray(x, ['jpeg','jpg','png']) == -1)  
                {  
                     alert("Invalid Image File");  
                     $('#image').val('');  
                     return false;  
                } 
                else
                {
                    $.ajax({  
                         url:"<?php echo base_url().'index.php/pelanggan/upload_pembayaran'?>",  
                         method:'POST',  
                         data:new FormData(this),  
                         contentType:false,  
                         processData:false,  
                         beforeSend: function()
                         {
                            $('#title').text('Uploading, please wait...')
                         },
                         success:function(data)  
                         {  
                            alert(data);  
                            $('#modalUploadPembayaran').modal('hide');
                            $('#title').text('Upload pembayaran');
                            location.reload();
                         }  
                    }); 
                }
            }
            
        });

        $(document).on('click', '.uploadpembayaran', function()
        {
            var id_paket = $(this).attr('data-id_paket');
            $('#id_paket').val(id_paket);
            $('#modalUploadPembayaran').modal('show');
        });

        $(document).on('click', '.perpanjang', function()
        {
            var id_paket = $(this).attr('data-id_paket');
            $.ajax({
                url:'<?php echo base_url() ?>index.php/pelanggan/perpanjang',
                type:'post',
                data:{id_paket:id_paket},
                success: function(data)
                {
                    alert(data);
                    location.reload();
                }
            });
        });

        //paket
        $(document).on('click', '.addpaket', function()
        {
            var id_user = $(this).attr('data-id_user');
            $('#id_users').val(id_user);
            $('#modalPaket').modal('show');
        });


    });

</script>