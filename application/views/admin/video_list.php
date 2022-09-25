<div class="col-lg-12 col-md-12 totalnya">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body">
                      <div class="clearfix">
                        <div class="float-left">
                          <i class="mdi mdi-cube text-danger icon-lg"></i>
                        </div>
                        <div class="float-right">
                          <p class="mb-0 text-right">Total video</p>
                          <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0" id="lulus"><?php echo $total_video ?></h3>
                          </div>
                        </div>
                      </div>
                      <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> 
                      </p>
                    </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body">
                      <div class="clearfix">
                        <div class="float-left">
                          <i class="mdi mdi-cube text-danger icon-lg"></i>
                        </div>
                        <div class="float-right">
                          <p class="mb-0 text-right">Total switch</p>
                          <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0" id="progres"><?php echo $switch_video ?></h3>
                          </div>
                        </div>
                      </div>
                      <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> 
                      </p>
                    </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body">
                      <div class="clearfix">
                        <div class="float-left">
                          <i class="mdi mdi-cube text-danger icon-lg"></i>
                        </div>
                        <div class="float-right">
                          <p class="mb-0 text-right">Total pending</p>
                          <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0" id="gagal"><?php echo $pending_video ?></h3>
                          </div>
                        </div>
                      </div>
                      <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> 
                      </p>
                    </div>
                </div>
              </div>
        </div>
    </div>


<div class="card">
  <div class="card-body">
    <h3 class="card-title">Data video</h3>
    <br>
    <table class="table table-responsive table-striped table-hover" id="example">
        <thead>
            <th>Judul</th>
            <th>Pemilik</th>
            <th>File</th>
            <th>Status</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php 
                foreach ($data->result() as $row) {
                    if($row->status == '1')
                    {
                        echo "
                        <tr>
                            <td>$row->judul</td>
                            <td>$row->username</td>
                            <td>
                             
                            </td>
                            <td>
                              <span class='badge badge-warning'>pending</span>
                            </td>
                            <td>
                              <button class='btn btn-danger delete' data-nama='$row->nama_file' data-id_video='$row->id_video'>Delete</button>
                            </td>
                        </tr>";
                    }
                    else if($row->status == '2')
                    {
                        echo "
                        <tr>
                            <td>$row->judul</td>
                            <td>$row->username</td>
                            <td>
                                 <video width='200' height='200' controls>
                                            <source src='".base_url()."assets/videos/".$row->nama_file."' type='video/mp4'>
                                  </video>
                            </td>
                            <td>
                              <span class='badge badge-success'>switch</span>
                            </td>
                            <td>
                              <button class='btn btn-danger delete' data-nama='$row->nama_file' data-id_video='$row->id_video'>Delete</button>
                            </td>
                        </tr>";
                    }
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
              <td>Judul</td>
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
      var id = $(this).attr('data-id_video');
      var nama = $(this).attr('data-nama');
      $.ajax({
          url:"<?php echo base_url() ?>index.php/video_admin/delete_video",
          method:'post',
          data:{id:id, nama:nama},
          success: function(data)
          {
            alert(data);
            location.reload();
          }
      });
  });

</script>