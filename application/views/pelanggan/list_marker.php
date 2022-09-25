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
        <h1 class="card-title">Pilih paket</h1>
        <br>
        <form id="upload_marker" class="form-inline">
          <div class="form-group mx-sm-3 mb-2">
            <input type="hidden" name="" id="id_user" value="<?php echo $id_user ?>">
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


<div class="card" id="listmarker" style="display: none;">
    <div class="card-body">
        <h1 class="card-title">Data marker</h1>
        <br>
        <a style="margin-left: 10px;" href="<?php echo base_url() ?>index.php/marker/upload_marker" class="btn btn-primary">Add marker</a>
        <br>
        <br>
        <table id="example" class="table table-striped table-bordered table-responsive" style="width:100%">
            <thead>
                <th>Nama</th>
                <th>File</th>
                <th>Status</th>
                <th>Action</th>
                <th>Video</th>
            </thead>
            <tbody id="tableha">

            </tbody>
            <tfoot>
                <tr>
                    <td>Nama</td>
                    <td>File</td>
                    <td>Status</td>
                    <td>Action</td>
                    <td>Video</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div id="tes">
    
</div>

<div class="modal fade" id="modalEditMarker" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="title">Edit marker</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="formUpload">
            <input type="hidden" name="id_marker" id="id_marker"/>
            <input type="hidden" name="nama" id="nama"/>
            <div class="form-group">
                <label for="formGroupExampleInput">Upload image</label>
                <input type="file" class="form-control-file" id="image" name="image" >
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



    //edit marker
    $(document).ready(function()
    {
       // submit
        $(document).on('submit', '#formUpload', function(e)
        {
            e.preventDefault();
            var id_marker = $('#id_marker').val();
            var x = $('#image').val().split('.').pop().toLowerCase(); 
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
                         url:"<?php echo base_url().'index.php/marker/edit_marker'?>",  
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
                            $('#modalEditMarker').modal('hide');
                            $('#title').text('Upload video');
                            location.reload();
                         }  
                    }); 
                }
            }
            
        });

        $(document).on('click', '.edit', function()
        {
            var id_marker = $(this).attr('data-id_marker');
            var nama = $(this).attr('data-nama');
            // alert(nama);
            $('#id_marker').val(id_marker);
            $('#nama').val(nama);
            $('#modalEditMarker').modal('show');
            
        });

            $(document).on('submit', '#upload_marker', function(e)
            {
                e.preventDefault();
                var value = $("#select_option option:selected").val();
                var id_user = $('#id_user').val();
                // alert(id_user);
                $.ajax({
                    url:"<?php echo base_url() ?>index.php/marker/filter_marker_by_paket",
                    type:"POST",
                    data:{id_paket:value, id_user:id_user},
                    dataType:'text',
                    success: function(data)
                    {
                        $('#tableha').html(data);
                        $('#listmarker').show();
                    }
                });

            });
    });
    

   

</script>