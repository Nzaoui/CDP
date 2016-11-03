<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CDP Template</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />
<link href="css/admin.css" rel="stylesheet" type="text/css" />
</head>
<body class="light_theme  fixed_header left_nav_fixed">
<div class="wrapper">
  <!--\\\\\\\ wrapper Start \\\\\\-->
  <div class="header_bar">
    <!--\\\\\\\ header Start \\\\\\-->
    <div class="brand">
      <!--\\\\\\\ brand Start \\\\\\-->
      <div class="logo" style="display:block"><span class="theme_color">CDP</span> Projet</div>
    </div>
    <!--\\\\\\\ brand end \\\\\\-->
    <div class="header_top_bar">
      <!--\\\\\\\ header top bar start \\\\\\-->
      <a href="javascript:void(0);" class="menutoggle"> <i class="fa fa-bars"></i> </a>
    </div>
    <!--\\\\\\\ header top bar end \\\\\\-->
  </div>
  <!--\\\\\\\ header end \\\\\\-->
  <div class="inner">
    <!--\\\\\\\ inner start \\\\\\-->
    <div class="left_nav">
      <!--\\\\\\\left_nav start \\\\\\-->
      <div class="search_bar"> <i class="fa fa-search"></i>
        <input name="" type="text" class="search" placeholder="Search Dashboard..." />
      </div>
      <div class="left_nav_slidebar">
        <ul>
          <li><a href="index.html"><i class="fa fa-home"></i> Acceuil <span class="left_nav_pointer"></span>  </a></li>
          <li class="left_nav_active theme_border"> <a href="inscription.php"> <i class="fa fa-edit"></i> S'inscrire </a></li> 
          <li> <a href="login.php"> <i class="fa fa-tasks"></i> S'authentifier </a></li>
        </ul>
      </div>
    </div>
    <!--\\\\\\\left_nav end \\\\\\-->
    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
	       <div class="row center">
       <div class="col-lg-12 ">
       <section class="panel default blue_title h2">
       <div class="panel-heading border">Page d'inscription</div>
       </section>
       </div>
       </div>
       
       <div class="row">
       <div class="col-md-12">
       <section class="panel default blue_title h2">
       <div class="panel-body">
		  <div class="registration" >	
		 <form role="form" class="form-horizontal" action="inscription.php" method="Post">
			  <div class="form-group">
				<div class="col-sm-10">
				  <input type="text" placeholder="Pseudo" id="Pseudo" class="form-control" name="pseudo">
				</div>
			  </div>
			  <div class="form-group">
			  <div class="col-sm-10">
				  <input type="text" placeholder="Nom" id="inputEmail3" class="form-control" name="nom">
				</div>
			  </div>
			  <div class="form-group">
			  <div class="col-sm-10">
				  <input type="text" placeholder="Prenom" id="inputEmail3" class="form-control" name="prenom">
				</div>
			  </div>
			  <div class="form-group">
			  <div class="col-sm-10">
				  <input type="email" placeholder="Email" id="inputEmail3" class="form-control" name="email">
				</div>
			  </div>
			  <div class="form-group">
				
				<div class="col-sm-10">
				  <input type="password" placeholder="Password" id="password" class="form-control" name="password">
				</div>
			  </div>
			    <div class="form-group">
				
				<div class="col-sm-10">
				  <input type="password" placeholder="Repeat Password" id="repassword" class="form-control" name="re_password">
				</div>
			  </div>
			  <div class="form-group">
				<div class=" col-sm-10">
				  <div class="checkbox checkbox_margin">
					  <a href="index.html">
					  <button class="btn btn-default pull-center" type="submit" name="submit">OK</button>
					  </a></div>
					  <br>
					  <?php 
						include("inscription_check.php"); 
						?>
				</div>
			  </div>
			</form>
		 </div>
       
      
       </div>
       </section>
       </div>
       

       </div>
      <!--\\\\\\\ container  end \\\\\\-->
    </div>
    <!--\\\\\\\ content panel end \\\\\\-->
  </div>
  <!--\\\\\\\ inner end\\\\\\-->
</div>
<!--\\\\\\\ wrapper end\\\\\\-->
<!-- Modal -->




<script src="js/jquery-2.1.0.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/common-script.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<script src="js/jPushMenu.js"></script> 
<script src="js/side-chats.js"></script>
</body>
</html>
