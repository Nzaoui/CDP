<?php
session_start ();
include("database.php");
if( !$_GET["id"] ) {
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=404.php">';
  exit();
}
else{
  $mysql = connect();
  $project = get_project($mysql,$_GET["id"]);
  if ($project->num_rows == 0 ){
   echo '<META HTTP-EQUIV="Refresh" Content="0; URL=404.php">';
   exit();
 }
 else{
   $project = $project->fetch_array(MYSQLI_ASSOC);
 }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Accueil Projet</title>
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/animate.css" rel="stylesheet" type="text/css" />
    <link href="css/admin.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>
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
              <li class="left_nav_active theme_border"><a href="index.html"><i class="fa fa-home"></i> Acceuil <span class="left_nav_pointer"></span>  </a></li>
              
             <?php
              if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {
                printf("<li> <a href=\"myprofil.php?id=%d\"> <i class=\"fa fa-home\"></i> Mon Profil </a></li>",$_SESSION['id']);
                printf("<li> <a href=\"createProject.php\"> <i class=\"fa fa-edit\"></i> Créer un projet </a></li>");
                printf("<li> <a href='projects.php'> <i class='fa fa-tasks'></i> Tout les Projets </a></li>");
                printf("<li> <a href=\"logout.php\"> <i class=\"fa fa-power-off\"></i> Se déconnecter </a></li>");
              }
              else{
                printf("<li> <a href='projects.php'> <i class='fa fa-tasks'></i> Tout les Projets </a></li>");
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
               <?php
               printf("<div class=\"panel-heading border\">%s</div>",$project["name"]);
               ?>
             </section>
           </div>
         </div>
         <nav class="navbar navbar-inverse" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav nav-justified">
              <?php
              printf("<li class=\"active\"><a href=\"project.php?id=%d\">Accueil</a></li>",$project["id"]);
              printf("<li><a href=\"backLog.php?id=%d\">BackLog</a></li>",$project["id"]);
              printf("<li><a href=\"kanBan.php?id=%d\">KanBan</a></li>",$project["id"]);
              printf("<li><a href=\"burnDownChart.php?id=%d\">BurnDown Chart</a></li>",$project["id"]);
              printf("<li><a href=\"history.php?id=%d\">Historique</a></li>",$project["id"]);
              if(isset($_SESSION['id']) && check_user_work_on_project($mysql,$_SESSION['id'],$project["id"]))
                printf("<li><a href=\"settings.php?id=%d\">Paramètres</a></li>",$project["id"]);
              ?>
            </ul>

          </div>
        </nav>
        <div class="row">
         <div class="col-md-12">
           <section class="panel default blue_title h2">
             <div class="panel-body">
               <div class="container">
                   <div class="container clear_both padding_fix">
					<!--\\\\\\\ container  start \\\\\\-->
					<ul class="nav nav-tabs" id="myTab">
					  <li class="active"><a data-toggle="tab" href="#user">AddUser</a></li>
					  <li class=""><a data-toggle="tab" href="#sprints">Sprints</a></li>
					  <li class=""><a data-toggle="tab" href="#us">User Story</a></li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div id="user" class="tab-pane fade active in">
							<div class="form-group">
							  <br><br><label class="col-sm-2 control-label">Ajout User par login</label>
							  <div class="col-sm-3">
								<input type="text" class="form-control">
							  </div>
							  <button type="submit" class="btn btn-primary">Valider</button>
							</div><!--/form-group--> 
						</div>
						<div id="sprints" class="tab-pane fade">
						<div id="user" class="tab-pane fade active in">
							<div class="form-group">
							  <br><br><label class="col-sm-2 control-label">Ajout Sprint : Numéro</label>
							  <div class="col-sm-2">
							  <select class="form-control" id="source">
							  <option value="one"> 1 </option>
							  <option value="two"> 2 </option>
							  <option value="two"> 3 </option>
							  <option value="two"> 4 </option>
							  <option value="two"> 5 </option>
							  </select>
							  </div>
							  <br><br><label class="col-sm-2 control-label">Ajout Sprint date</label>
							  <div class="col-sm-3">
								<input type="text" class="form-control">
							  </div>
							 
							  <button type="submit" class="btn btn-primary">Valider</button>
							  
							</div><!--/form-group--> 
							
							
						</div>
						</div>
						<div id="us" class="tab-pane fade">
						<div class="form-group">
							  <br><br><label class="col-sm-2 control-label">Ajout User Story</label>
							  <div class="col-sm-3">
								<input type="text" class="form-control">
							  </div>
							  <button type="submit" class="btn btn-primary">Valider</button>
							</div><!--/form-group--> 

						</div>
					
					</div>
				</div>

			</div>
			<!--\\\\\\\ container  end \\\\\\-->
			</div>
			<!--\\\\\\\ content panel end \\\\\\-->
			</section>
</div>
<!--\\\\\\\ inner end\\\\\\-->
</div>
<!--\\\\\\\ wrapper end\\\\\\-->
<!-- Modal -->
<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>

<script src="js/bootstrap.min.js"></script>
<script src="js/common-script.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<script src="js/jPushMenu.js"></script> 
<script src="js/side-chats.js"></script>

</body>
</html>