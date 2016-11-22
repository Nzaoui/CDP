<?php
session_start();
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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BurnDown Chart Projet</title>
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/animate.css" rel="stylesheet" type="text/css" />
    <link href="css/admin.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>
	<style>
	.navbar-collapse a { color: #FB5C4A}
	</style>
  </head>
  <body class="light_theme  fixed_header left_nav_fixed">
    <div class="wrapper">
      <div class="header_bar">
        <div class="brand">
          <div class="logo" style="display:block"><span class="theme_color">CDP</span> Projet</div>
        </div>
        <div class="header_top_bar">
          <a href="javascript:void(0);" class="menutoggle"> <i class="fa fa-bars"></i> </a>
        </div>
      </div>
      <div class="inner">
        <div class="left_nav">
          <div class="search_bar"> <i class="fa fa-search"></i>
            <input type="text" class="search" placeholder="Search Dashboard..." />
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
        <div class="contentpanel">
          <div class="row center">
           <div class="col-lg-12 ">
             <section class="panel default blue_title h2">
               <div class="panel-heading border">BurnDown Chart</div>
             </section>
           </div>
         </div>
        <nav class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav nav-pills nav-justified">
              <?php
              printf("<li><a href=\"project.php?id=%d\">Accueil</a></li>",$project["id"]);
              printf("<li><a href=\"backLog.php?id=%d\">BackLog</a></li>",$project["id"]);
              printf("<li><a href=\"kanBan.php?id=%d\">KanBan</a></li>",$project["id"]);
              printf("<li  class=\"active\"><a href=\"burnDownChart.php?id=%d\">BurnDown Chart</a></li>",$project["id"]);
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
             <canvas id="graph"></canvas>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>
</div>
<script src="js/jquery-2.1.0.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>
<script type="text/javascript">
<?php
  $stories = get_us($mysql,$project["id"]);
  $sprints = get_sprints($mysql,$project["id"]);
  $sprints_end_dates = "var sprints_end_dates = [";
  $sprint = $sprints->fetch_array(MYSQLI_ASSOC);
  $project_difficulty = get_project_difficulty($mysql,$project["id"]);
  $tmp = $project_difficulty;
  $charge_estimee = "var charge_estimee = [project_difficulty";
  if ($sprint != null)
    $sprints_end_dates.="\"".$sprint["start_date"]."\",";
  while ($sprint != NULL){
    $sprints_end_dates.="\"".$sprint["end_date"]."\"";
    $sprint_difficulty = get_sprint_difficulty($mysql,$sprint["id"]);
    $charge_estimee.=",".($tmp-$sprint_difficulty);
    $sprint = $sprints->fetch_array(MYSQLI_ASSOC);
    $tmp -= $sprint_difficulty;
    if($sprint != NULL){
      $sprints_end_dates.=",";
    }
  }
  $sprints_end_dates.="];";
  printf($sprints_end_dates."\n");
  printf("var project_difficulty = %d ;\n",$project_difficulty);
  printf("%s];\n",$charge_estimee);
?>
var ctx = document.getElementById("graph");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: sprints_end_dates,
        datasets: [{
            lineTension: 0,
            label: "charge estimée",
            data: charge_estimee,
            backgroundColor: [
                'rgba(44, 217, 44, 0)'
            ],
            borderColor: [
                'rgba(44, 217, 44, 0.5)'
            ],
            borderWidth: 2
        },{
            lineTension: 0,
            label: "charge réelle",
            data: [project_difficulty],
            backgroundColor: [
                'rgba(255,99,132,0)'
            ],
            borderColor: [
                'rgba(255,99,132,1)'
            ],
            borderWidth: 2
        }]
    },
    options: {
        scales:{
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
<script src="js/common-script.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<script src="js/jPushMenu.js"></script> 
<script src="js/side-chats.js"></script>
</body>
</html>