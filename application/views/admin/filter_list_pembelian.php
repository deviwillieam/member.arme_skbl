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
                          <p class="mb-0 text-right">Total pembelian</p>
                          <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0" id="lulus"><?php echo $total_pembelian ?></h3>
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
                          <p class="mb-0 text-right">Total not verified</p>
                          <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0" id="lulus"><?php echo $not_pembelian ?></h3>
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
                          <p class="mb-0 text-right">Total verified</p>
                          <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0" id="progres"><?php echo $acc_pembelian ?></h3>
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
                          <p class="mb-0 text-right">Total progres</p>
                          <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0" id="gagal"><?php echo $progres_pembelian ?></h3>
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
                          <p class="mb-0 text-right">Total limit</p>
                          <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0" id="gagal"><?php echo $limit_pembelian ?></h3>
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
    <h3 class="card-title">Pilih status</h3>
    <br>
    <form method="post" action="<?php echo base_url() ?>index.php/pembelian/filter_pembelian">
         <div class="form-row">
          <div class="form-group col-md-3">
              <label for="status">Status</label>
              <select class="form-control"  name="status" id="status">
                  <option value="not verified">not verified</option>
                  <option value="verified">verified</option>
                  <option value="progres">progres</option>
                  <option value="limit">limit</option>
              </select>
          </div>
          <div class="form-group col-md-3">
              <button type="submit" class="btn btn-primary" style="margin-top: 25px;">submit</button>
          </div>
        </div>
    </form>
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