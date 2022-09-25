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
        <h1 class="card-title">Data video</h1>
        <!-- a style="margin-left: 10px;" href="<?php //echo base_url() ?>index.php/video/upload_video" class="btn btn-primary">Add video</a> -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUploadVideo">
          Add video
        </button>
        <br>
        <br>
        <table id="example" class="table table-striped table-bordered table-responsive" style="width:100%">
            <thead>
                <th>Judul</th>
                <th>Video</th>
                <th>Status</th>
                <th>Action</th>
                <th>Switch</th>
            </thead>
            <tbody>
                <?php 
                    if($switch == 'ada')
                    {
                        foreach ($data->result() as $row) {
                            if($row->status == '1')
                            {
                                echo "
                                <tr>
                                    <td>$row->judul</td>
                                    <td>
                                        <video width='200' height='200' controls>
                                            <source src='".base_url()."assets/videos/".$row->nama_file."' type='video/mp4'>
                                        </video>
                                    </td>
                                    <td><span class='badge badge-warning'>pending</span></td>
                                    <td>
                                        <button class='btn btn-info edit' data-id_video='$row->id_video' data-nama='$row->nama_file' data-judul='$row->judul'>Edit</button>
                                        <button class='btn btn-danger delete' data-id_video='$row->id_video' data-nama='$row->nama_file'>Delete</button>
                                    </td>
                                    <td>
                                        
                                    </td>   
                                </tr>"
                                ;
                            }
                            else if($row->status == '2')
                            {
                                echo "
                                <tr>
                                    <td>$row->judul</td>
                                    <td>
                                        video diswitch
                                    </td>
                                    <td><span class='badge badge-success'>switch</span></td>
                                    <td>
                                        <button class='btn btn-info edit' data-id_video='$row->id_video' data-nama='$row->nama_file' data-judul='$row->judul'>Edit</button>
                                       
                                    </td>
                                    <td>
                                        <button class='btn btn-warning pending' data-id_video='$row->id_video' data-id_paket='$id_paket' data-id_marker='$id_marker' data-nama='$row->nama_file'>Pending</button>
                                    </td>   
                                </tr>"
                                ;
                            }
                        }
                    }
                    else
                    {
                        foreach ($data->result() as $row) {
                            if($row->status == '1')
                            {
                                echo "
                                <tr>
                                    <td>$row->judul</td>
                                    <td>
                                        <video width='200' height='200' controls>
                                            <source src='".base_url()."assets/videos/".$row->nama_file."' type='video/mp4'>
                                        </video>
                                    </td>
                                    <td><span class='badge badge-warning'>pending</span></td>
                                    <td>
                                        <button class='btn btn-info edit' data-id_video='$row->id_video' data-nama='$row->nama_file' data-judul='$row->judul'>Edit</button>
                                        <button class='btn btn-danger delete' data-id_video='$row->id_video' data-nama='$row->nama_file'>Delete</button>
                                    </td>
                                    <td>
                                        <button class='btn btn-success switch' data-id_video='$row->id_video' data-id_paket='$id_paket' data-id_marker='$id_marker' data-nama='$row->nama_file'>Switch</button>
                                    </td>   
                                </tr>"
                                ;
                            }
                            else if($row->status == '2')
                            {
                                echo "
                                <tr>
                                    <td>$row->judul</td>
                                    <td>
                                        video diswitch
                                    </td>
                                    <td><span class='badge badge-success'>switch</span></td>
                                    <td>
                                        <button class='btn btn-info edit' data-id_video='$row->id_video' data-nama='$row->nama_file' data-judul='$row->judul'>Edit</button>
                                        <button class='btn btn-danger delete' data-id_video='$row->id_video' data-nama='$row->nama_file'>Delete</button>
                                    </td>
                                    <td>
                                        
                                    </td>   
                                </tr>"
                                ;
                            }
                        }
                    }

                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>Judul</td>
                    <td>Video</td>
                    <td>Status</td>
                    <td>Action</td>
                    <td>Switch</td>
                </tr>
            </tfoot>
    </div>
</div>


<div class="modal fade" id="modalUploadVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="title">Upload video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="formUpload">
            <input type="hidden" name="id_marker" id="id_marker" value="<?php echo $id_marker ?>">
            <input type="hidden" name="id_user" id="id_user" value="<?php echo $id_user ?>">
            <input type="hidden" name="id_paket" id="id_paket" value="<?php echo $id_paket ?>">
            <div class="form-group">
                <label for="formGroupExampleInput">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Upload video</label>
                <input type="file" class="form-control-file" id="video" name="video" >
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

<div class="modal fade" id="modalEditVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="title1">Edit video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="formEdit">
            <input type="hidden" name="id_marker" id="id_marker" value="<?php echo $id_marker ?>">
            <input type="hidden" name="id_user" id="id_user" value="<?php echo $id_user ?>">
            <input type="hidden" name="id_video" id="id_video" >
            <input type="hidden" name="nama_old" id="nama_old">
            <div class="form-group">
                <label for="formGroupExampleInput">Judul</label>
                <input type="text" class="form-control" id="judul1" name="judul1" placeholder="Judul">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Upload video</label>
                <input type="file" class="form-control-file" id="video" name="video" >
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
    
    //edit video
     $(document).on('submit', '#formEdit', function(e)
    {
        e.preventDefault();
        var id_user = $('#id_user').val();
        var id_marker = $('#id_marker').val();
        var old = $('#old').val();
        var judul = $('#judul1').val();

        var x = $('#video').val().split('.').pop().toLowerCase(); 
        if(judul == '')
        {
            alert('Judul tidak boleh kosong!');
        } 
        else
        {
            if(x != '')
            {
                if(jQuery.inArray(x, ['mp4','avi','wmw']) == -1)  
                {  
                     alert("Invalid Video File");  
                     $('#video').val('');  
                     return false;  
                } 
            }
            else
            {
                $.ajax({  
                     url:"<?php echo base_url().'index.php/video/edit_video'?>",  
                     method:'POST',  
                     data:new FormData(this),  
                     contentType:false,  
                     processData:false,  
                     beforeSend: function()
                     {
                        $('#title1').text('Uploading, please wait...')
                     },
                     success:function(data)  
                     {  
                        $('#title1').text('Selesai');
                        alert(data);  
                        $('#modalUploadVideo').modal('hide');
                        $('#title1').text('Edit video');
                        location.reload();
                     }  
                }); 
            } 
        }
    });

    //add video
    $(document).on('submit', '#formUpload', function(e)
    {
        e.preventDefault();
        var id_user = $('#id_user').val();
        var id_marker = $('#id_marker').val();
        var judul = $('#judul').val();
        var x = $('#video').val().split('.').pop().toLowerCase(); 
        if(judul == '' || x == '')
        {
            alert('Field tidak boleh kosong!');
        }
        else
        {
            if(jQuery.inArray(x, ['mp4','avi','wmw']) == -1)  
            {  
                 alert("Invalid Video File");  
                 $('#video').val('');  
                 return false;  
            }  
            else
            {
                $.ajax({  
                     url:"<?php echo base_url().'index.php/video/simpan_video'?>",  
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
                        $('#title').text('Selesai');
                        $('#modalUploadVideo').modal('hide');
                        $('#title').text('Upload video');
                        location.reload();
                     }  
                }); 
            } 
        }
    });


    //edit
    $(document).on('click', '.edit', function()
    {
        var id_video = $(this).attr('data-id_video');
        var old = $(this).attr('data-nama');
        var judul = $(this).attr('data-judul');

        $('#id_video').val(id_video);
        $('#nama_old').val(old);
        $('#judul1').val(judul);

        $('#modalEditVideo').modal('show');

    })

    //hapus
     $(document).on('click', '.delete', function()
    {
        var id_video = $(this).attr('data-id_video');
        var nama = $(this).attr('data-nama');
        var x = confirm("Apakah anda yakin ingin menghapus video ini?");
        if(x == true)
        {
            $.ajax({
                url:'<?php echo base_url() ?>index.php/video/delete_video',
                type:'POST',
                data:{id_video:id_video, nama:nama},
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

    //switch
    $(document).on('click', '.switch', function()
    {
        var id_paket = $(this).attr('data-id_paket');
        var id_marker = $(this).attr('data-id_marker');
        var nama = $(this).attr('data-nama');
        var id_video = $(this).attr('data-id_video');
        // alert(id_video);
        $.ajax({
            url:'<?php echo base_url() ?>index.php/video/switch_video',
            type:'post',
            data:{id_paket:id_paket, id_marker:id_marker, nama:nama, id_video:id_video},
            success: function(data)
            {
                alert(data);
                location.reload();
            }
        });
    });

    //pending
    //switch
    $(document).on('click', '.pending', function()
    {
        var id_paket = $(this).attr('data-id_paket');
        var id_marker = $(this).attr('data-id_marker');
        var nama = $(this).attr('data-nama');
        var id_video = $(this).attr('data-id_video');
        // alert(id_video);
        $.ajax({
            url:'<?php echo base_url() ?>index.php/video/pending_video',
            type:'post',
            data:{id_paket:id_paket, id_marker:id_marker, nama:nama, id_video:id_video},
            success: function(data)
            {
                alert(data);
                location.reload();
            }
        });
    });

</script>
























