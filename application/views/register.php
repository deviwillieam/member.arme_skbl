<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Please Register</title>
   
    <!-- Bootstrap -->
    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url() ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url() ?>assets/css/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url() ?>assets/css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url() ?>assets/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" action="<?php echo site_url() ?>/login/prosesregister" id="form-register">
              <h1>Create Account</h1>
              <div class="alert alert-success" style="display:none; margin-bottom:20px;">Create account berhasil!</div>
              <div class="alert alert-danger" style="display:none; margin-bottom:20px;">Create account gagal! </div>
              <div>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required="" />
                <p style="color:red; display:none; text-align:left; margin-top:-20px; margin-bottom:10px;" id="pesan" class="label-control">Username sudah ada!</p>
              </div>
              <div>
                <input type="text" class="form-control" id="password" name="password" placeholder="Password" required="" />
                <p style="color:red; display:none; text-align:left; margin-top:-20px; margin-bottom:10px;" id="pesan1" class="label-control">Password tidak boleh sama dengan username!</p>
              </div>
              <div>
                <input type="text" class="form-control" name="email" placeholder="Email" required="" />
              </div>
              <div>
                <input type="text" class="form-control" name="umur" placeholder="Umur" required="" />
              </div>
              <div>
                <input type="text" class="form-control" name="alamat" placeholder="Alamat" required="" />
              </div>
              <div>
                <input type="text" class="form-control" name="perusahaan" placeholder="Perusahaan" required="" />
              </div>
              <div>
                <input type="text" class="form-control" name="no_hp" placeholder="No HP" required="" />
              </div>
              <div style='margin-left: -38px; margin-right:39px;'>
                <input class="btn btn-default form-control " type="submit" value="Submit"></input>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                

                <div class="clearfix"></div>
                <br />

                <div>
                  <i class=""></i> <a href="<?php echo site_url() ?>/login">Have account? login here</a>
                  
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form method="post" action="<?php echo base_url() ?>index.php/login/getlogin">
              <h1>Create Account</h1>
              
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
                
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Umur" required="" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Alamat" required="" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Perusahaan" required="" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="No HP" required="" />
              </div>
              <div>
               
              </div>
              <div>
                <input class="btn btn-default submit" type="submit">Submit</input>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <!-- <a href="#signin" class="to_register"> Log in </a> -->
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
   <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-3.3.1.js"></script>
   <script>
      
    $(document).ready(function()
    {
        $(document).on('submit', '#form-register', function(e)
        {
            e.preventDefault();
            var data = $('#form-register').serialize();
            $.ajax({
				type: 'POST',
				url: "<?php echo site_url() ?>/login/prosesregister",
				data: data,
				dataType:'json',
				success: function(data) {
					if ( data.result == "berhasil")
					{
					    $('.alert-success').show();
					    $('.alert-danger').hide();
					}
					else if ( data.result == "gagal")
					{
					    $('.alert-danger').show();
					    $('.alert-success').hide();
					}
				}
			});
        });
    });
      
    $('#username').keyup(function(e){
        
        var username = $(this).val();
        
        $.ajax({
            
            url:'<?php echo site_url() ?>/login/cekusername',
            data:{username:username},
            method:'POST',
            dataType:'json',
            success: function (data)
            {
                if (data.result == "ada")
                {
                    $('#pesan').show();
                    $('.btn').hide();
                }
                else
                {
                    $('#pesan').hide();
                }
            }
             
        });
        
    });
    
    $('#password').keyup(function(e){
        
        var password = $(this).val();
        var username = $('#username').val();
        
        if (password == username)
        {
            $('#pesan1').show();
            $('.btn').hide();
        }
        else
        {
            $('#pesan1').hide();
            $('.btn').show();
        }
        
        
    });
      
  </script>
  
  
</html>
