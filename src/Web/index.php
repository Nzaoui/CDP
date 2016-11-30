<?php
session_start ();
include("database.php");



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CDP Template</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="elements/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="elements/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="elements/css/animate.css" rel="stylesheet" type="text/css" />
<link href="elements/css/admin.css" rel="stylesheet" type="text/css" />
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


             <?php
              if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {
                printf("<li> <a href=\"myprofil.php?id=%d\"> <i class=\"fa fa-home\"></i> Mon Profil </a></li>",$_SESSION['id']);
                printf("<li> <a href=\"createProject.php\"> <i class=\"fa fa-edit\"></i> Créer un projet </a></li>");
                printf("<li class=\"left_nav_active theme_border\"> <a href='projects.php'> <i class='fa fa-tasks'></i> Tout les Projets </a></li>");
                printf("<li> <a href=\"logout.php\"> <i class=\"fa fa-power-off\"></i> Se déconnecter </a></li>");
              }
              else{
			    printf("<li class=\"left_nav_active theme_border\"> <a href='index.php'> <i class='fa fa-home'></i> Acceuil </a></li>");
                printf("<li > <a href='projects.php'> <i class='fa fa-tasks'></i> Tout les Projets </a></li>");
                printf("<li> <a href=\"inscription.php\"> <i class=\"fa fa-edit\"></i> S'inscrire </a></li>");
                printf("<li> <a href=\"login.php\"> <i class=\"fa fa-tasks\"></i> S'authentifier </a></li>");
              }
              ?>

            </ul>
          </div>
    </div>
    <!--\\\\\\\left_nav end \\\\\\-->
    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
	       <div class="row center">
       <div class="col-lg-12 ">
       <section class="panel default blue_title h2">
       <div class="panel-heading border">Page d'Acceuil</div>
       </section>
       </div>
       </div>

       <div class="row">
       <div class="col-md-12">
       <section class="panel default blue_title h2">
       <div class="panel-body">
		<p> HELLOOOO</p>
         <div class=""><h3 style="text-decoration:underline;">Meet Our Team</h3></div>
        <div class="row">
        <div class="col-lg-3 col-sm-6">
        <h5>ELASSAOUI Chaimae  <br/></h5>
        </div>
        <div class="col-lg-3 col-sm-6">
        <h5>Rey Emile  <br/></h5>
        </div>
        <div class="col-lg-3 col-sm-6">
        <h5>Zaoui Naji  <br/></h5>
        </div>
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




<script src="elements/js/jquery-2.1.0.js"></script>
<script src="elements/js/bootstrap.min.js"></script>
<script src="elements/js/common-script.js"></script>
<script src="elements/js/jquery.slimscroll.min.js"></script>
<script src="elements/js/jPushMenu.js"></script>
<script src="elements/js/side-chats.js"></script>
</body>
</html>
