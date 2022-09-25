<div class="col-lg-12 col-md-12 grid-margin stretch-card" id="content-edit" style="display:none">
    
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Update</h4>
          <p class="card-description" id="title-update">
            Version & News
          </p>
          <form class="forms-sample" id="form-edit">
              <input type="hidden" name="version_id" id="version_id" value=""/>
            <div class="form-group">
              <label for="version">Version</label>
              <input type="text" name="version" class="form-control" id="version" placeholder="Version">
            </div>
            <div class="form-group">
              <label for="version">News</label>
              <textarea cols="50" rows="10" type="text" name="news" class="form-control" id="news" placeholder="News"></textarea>
            </div>
            
            <button type="submit" id="submit-btn" title="Submit" class="btn btn-success mr-2">Submit</button>
            <button class="btn btn-light">Cancel</button>
          </form>
        </div>
      </div>     
</div>


<div class="col-lg-12 col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h3 class="card-title">Version</h3>
    <br>
    <table class="table table-responsive table-striped table-hover" width="100%" id="example">
        <thead>
            <th width="300px">Version</th>
            <th width="300px">News</th>
            <th width="300px">Action</th>
        </thead>
        <tbody>
            <?php 
                foreach($data->result() as $row)
                {
                    echo "<tr>
                            <td>$row->version</td>
                            <td>$row->news</td>
                            <td>
                                <button data-id='$row->id' type='button' id='edit' class='btn btn-dark btn-fw'>
                                      <i class='mdi mdi-cloud-download'></i>Edit
                                </button>
                            </td>
                        </tr>";
                }
            ?>
        </tbody>
        <tfoot>
            <th>Version</th>
            <th>News</th>
            <th>Action</th>
        </tfoot>
  </div>
</div>
</div>


<script>
    
    $(document).ready(function()
    {
        
        $('#edit').on('click', function()
        {
            var id = $(this).attr('data-id');
            $.ajax({
                url:'<?php echo site_url() ?>/app_version/fetch_ajax',
                data:{id:id},
                type:'post',
                dataType:'json',
                success:function(data)
                {
                    $('#version').val(data.version);
                    $('#news').val(data.news);
                },
                error: function()
                {
                    alert('gagal');
                }
            });
            $('#version_id').val(id);
            $('#content-edit').fadeIn();
        });
        
        $('#form-edit').on('submit', function(e)
        {
            var id = $('#version_id').val();
            // alert(id);
            e.preventDefault();
            var data = $('#form-edit').serialize();
            $.ajax({
               type:'post',
               data:data,
               url:'<?php echo site_url() ?>/app_version/update_version',
               beforeSend: function()
                {
                    $("#submit-btn").html("Update  ...");
                },
               success: function(data)
               {
                   alert(data);
                  $("#submit-btn").html("Submit");
                  $('#content-edit').fadeOut();
                  location.reload();
               },
               error: function()
               {
                   alert('error');
               }
            });
           
        });
         
    });
    
</script>