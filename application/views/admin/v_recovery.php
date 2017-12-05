<!DOCTYPE html>
<html lang="en">
<head>
  <base href="<?php echo base_url('assets/admin');?>/" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo $this->master->getOption(1) ?> </title>
  <link rel="shortcut icon" type="image/png" href="../frontend/uploads/logobakti.png"/
  <!-- Bootstrap core CSS -->

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">
</head>

<body style="background:#F7F7F7;">

  <div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>
    <div id="wrapper">

      <div id="login" class="animate form">
      <?php if(isset($err)){ ?>
            <div class="alert alert-danger" role="alert">

              <strong>Ooopsss!</strong> <?php echo $err; ?><br>
              <a href="<?php echo base_url();?>" style="color: #fff;text-decoration: underline">Kembali ke halaman utama</a>
            </div>
      <?php } elseif(isset($success)) { ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close closeButton" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Berhasil! </strong><?php echo $success; ?><br>
            <a href="<?php echo base_url('admin');?>" style="color: #fff">Login</a>
          </div>
      <?php } else { ?>
        <?php if(isset($err2)){ ?>
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close closeButton" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Ooopsss!</strong> <?php echo $err2; ?><br>

          </div>
        <?php } ?>
        <section class="login_content">
          <form method="POST" action="">
            <h1>Recovery Password</h1>
            <div>
              <label for="" style="float: left">Email</label>
              <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off" />
            </div>
            <div>
              <label for="" style="float: left">Password Baru</label>
              <input type="password" name="password" class="form-control" placeholder="Password" required="required" autocomplete="off" />
            </div>
            <div>
              <label for="" style="float: left">Konfirmasi Password</label>
              <input type="password" name="repassword" class="form-control" placeholder="Konfirmasi Password" required="required" autocomplete="off" />
            </div>
            <div>

              <button class="btn btn-default submit">Recovery</button>
              <a class="reset_pass" href="<?php echo $this->master->adminUrl('login/forgot')?>">Lost your password?</a>
            </div>
            <div class="clearfix"></div>
            <div class="separator">
              <div class="clearfix"></div>
              <br />
              <div>
                <h1> Bakti Pemuda Nusantara</h1>
                <p>©2016 <a href="http://alterationstudio.web.id" target="_blank">Alteration Studio</a></p>
              </div>
            </div>
          </form>
          <!-- form -->
        </section>
        <?php } ?>
        <!-- content -->
      </div>
      <div id="register" class="animate form">
        <section class="login_content">
          <form>
            <h1>Create Account</h1>
            <div>
              <input type="text" class="form-control" placeholder="Username" required="" />
            </div>
            <div>
              <input type="email" class="form-control" placeholder="Email" required="" />
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Password" required="" />
            </div>
            <div>
              <a class="btn btn-default submit" href="index.html">Submit</a>
            </div>
            <div class="clearfix"></div>
            <div class="separator">

              <p class="change_link">Already a member ?
                <a href="#tologin" class="to_register"> Log in </a>
              </p>
              <div class="clearfix"></div>
              <br />
              <div>
                <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!</h1>

                <p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
              </div>
            </div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
    </div>
  </div>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script>
    $('.closeButton').on('click', function() {
      $(this).alert('close');
    });
  </script>
</body>

</html>
