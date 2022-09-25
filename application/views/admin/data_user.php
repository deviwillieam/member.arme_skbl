<div class="card">
    <div class="card-body">
        <h1 class="card-title">Data user</h1>
        <br>
        <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info " style="margin-left: 10px;">Add</button> 
        <br>
        <br>
        <table id="example" class="table table-striped table-bordered table-responsive" style="width:100%">
        	<thead>
        		<th>Nama</th>
        		<th>Email</th>
        		<th>Umur</th>
        		<th>Alamat</th>
                <th>Perusahaan</th>
                <th>No hp</th>
                <th>Level</th>
                <th>Tgl insert</th>
        		<th>Tgl update</th>
                <th>Action</th>
        	</thead>
        	<tbody>
        		<?php 
        			foreach ($data->result() as $row) {
        				echo "
                            <tr>
                                <td>".$row->username."</td>
                                <td>".$row->email."</td>
                                <td>".$row->umur."</td>
                                <td>".$row->alamat."</td>
                                <td>".$row->perusahaan."</td>
                                <td>".$row->no_hp."</td>
                                <td>".$row->level."</td>
                                <td>".$row->tgl_insert."</td>
                                <td>".$row->tgl_update."</td>
                                <td>
                                    <button class='btn btn-danger btn-sm delete' data-id_user='".$row->id_users."'>Delete</button>
                                </td>
                            </tr>";
        			}    
        		?>
        	</tbody>
        	<tfoot>
        		<tr>
        			<td>Nama</td>
                    <td>Email</td>
                    <td>Umur</td>
                    <td>Alamat</td>
                    <td>Perusahaan</td>
                    <td>No hp</td>
                    <td>Level</td>
                    <td>Tgl insert</td>
                    <td>Tgl update</td>
                    <td>Action</td>
            	</tr>
        	</tfoot>
        </table>
    </div>
</div>

<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="title">Add user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="formUpload">
           <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" name="username">
                </div>
          </div>
          <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password">
                </div>
          </div>
          <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email">
                </div>
          </div>
          <div class="form-group row">
                <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="umur" name="umur">
                </div>
          </div>
          <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat" name="alamat" >
                </div>
          </div>
          <div class="form-group row">
                <label for="perusahaan" class="col-sm-2 col-form-label">Perusahaan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="perusahaan" name="perusahaan">
                </div>
          </div>
          <div class="form-group row">
                <label for="no_hp" class="col-sm-2 col-form-label">No hp</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="no_hp" name="no_hp">
                </div>
          </div>
          <div class="form-group row">
                <label for="level" class="col-sm-2 col-form-label">Level</label>
                <div class="col-sm-10">
                    <select class="form-control" id="level" name="level">
                        <option value="admin">Admin</option>
                        <option value="pelangan">Pelanggan</option>
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


<script type="text/javascript">
    
    $(document).ready(function()
    {
        // submit
        $(document).on('submit', '#formUpload', function(e)
        {
            e.preventDefault();

            $.ajax({  
                 url:"<?php echo base_url().'index.php/admin/add_user'?>",  
                 method:'POST',  
                 data:new FormData(this),  
                 contentType:false,  
                 processData:false,  
                 beforeSend: function()
                 {
                    $('#title').text('Inserting ...')
                 },
                 success:function(data)  
                 {  
                    alert(data);  
                    $('#userModal').modal('hide');
                    $('#title').text('Add user');
                    location.reload();
                 }  
            }); 
             
            
        });

        $(document).on('click', '.delete', function()
        {
            var id_user = $(this).attr('data-id_user');
            var x = confirm("Apakah anda yakin ingin menghapus data ini?");
            if(x == true)
            {
                $.ajax({
                    url:'<?php echo base_url() ?>index.php/admin/delete_user',
                    type:'post',
                    data:{id_user:id_user},
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


    });

</script>