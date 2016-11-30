<?php
session_start();
if (!isset($_SESSION['pseudo']) || !isset($_SESSION['password'])){
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=restricted.php">';
  exit();
}
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
    <style>
      textarea { resize: vertical; }
    </style>
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
              printf("<li> <a href=\"myprofil.php?id=%d\"> <i class=\"fa fa-home\"></i> Mon Profil </a></li>",$_SESSION['id']);
              printf("<li class=\"left_nav_active theme_border\"> <a href=\"createProject.php\"> <i class=\"fa fa-edit\"></i> Créer un projet </a></li>");
              printf("<li> <a href='projects.php'> <i class='fa fa-tasks'></i> Tout les Projets </a></li>");
              printf("<li> <a href=\"logout.php\"> <i class=\"fa fa-power-off\"></i> Se déconnecter </a></li>");
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
               <div class="panel-heading border">Creation Projet</div>
             </section>
           </div>
         </div>

         <div class="row">
			<div class="col-md-12">
				<section class="panel default blue_title h2">
					<div class="panel-body">
						<div class="registration" >
							<form role="form" class="form-horizontal" action="createProject.php" method="Post">
								<div class="form-group">
									<div class="col-sm-10">
										<input type="text" placeholder="Nom" class="form-control" name="name">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-10">
										<textarea placeholder="Description" class="form-control" name="description"></textarea>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-10">
										<input type="text" placeholder="Langage de Programmation" class="form-control" name="language">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-10">
										<input type="text" placeholder="Nombre de Sprint" class="form-control" name="nbrSprint">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-10">
										<input type="text" placeholder="Duree d'un Sprint en jours" class="form-control" name="lenghtSprint">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-10">
										<label class="col-sm-10">Date de debut du projet</label>
										<input type="date" placeholder="aaaa-mm-jj" class="form-control" name="startDate">
									</div>
								</div>
								<div class="form-group">
									<div class=" col-sm-10">
										<button class="btn btn-default pull-center" type="submit" name="submit">OK</button>
									</div>
								</div>
								<?php
									include("createProject_check.php");
								?>
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




<script src="elements/js/jquery-2.1.0.js"></script>
<script src="elements/js/bootstrap.min.js"></script>
<script src="elements/js/common-script.js"></script>
<script src="elements/js/jquery.slimscroll.min.js"></script>
<script src="elements/js/jPushMenu.js"></script>
<script src="elements/js/side-chats.js"></script>
</body>
</html>
