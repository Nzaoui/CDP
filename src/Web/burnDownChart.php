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

function php_array_to_js_array($array){
  $result = "[";
  $count = count($array);
  $i = 0;
  for (;$i < $count-1; $i++) {
    $result.="\"".$array[$i]."\",";
  }
  $result.="\"".$array[$i]."\"]";
  return $result;
}

function compute_estimated_sprints_difficulty(){
  global $mysql,$project;
  $sprints = get_sprints($mysql,$project["id"]);
  $graph = [];
  $graph["labels"] = [];
  $graph["data"] = [];
  $project_difficulty = get_project_difficulty($mysql,$project["id"]);
  $sprint_difficulty = $project_difficulty;
  $sprint = $sprints->fetch_array(MYSQLI_ASSOC);
  array_push($graph["labels"],$sprint["start_date"]);
  array_push($graph["data"],$project_difficulty);

  do{
    array_push($graph["labels"],$sprint["end_date"]);
    $sprint_difficulty -= get_sprint_difficulty($mysql,$sprint["id"]);
    array_push($graph["data"],$sprint_difficulty);
  }while($sprint = $sprints->fetch_array(MYSQLI_ASSOC));

  return $graph;
}

/*function compute_past_sprints_difficulty(){
  global $mysql,$project;
  $stories = get_us($mysql,$project["id"]);
  $tab_stories = [];
  while ($story = $stories->fetch_array(MYSQLI_ASSOC)){
    $tab_stories[$story["id"]] = $story["difficulty"];
  }
  $sprints = get_past_sprints($mysql,$project["id"]);
  $graph = [];
  $graph["label"] = [];
  $graph["data"] = [];
  $project_difficulty = get_project_difficulty($mysql,$project["id"]);
  $sprint_difficulty = $project_difficulty;
  $sprint = $sprints->fetch_array(MYSQLI_ASSOC);
  array_push($graph["label"],$sprint["start_date"]);
  array_push($graph["data"],$project_difficulty);
  do{
    array_push($graph["label"],$sprint["end_date"]);
    $tasks = get_tasks($mysql,$sprint["id"]);
    $us_not_done = [];
    while ($task = $tasks->fetch_array(MYSQLI_ASSOC)) {
      if((strcmp($task["state"],"Done")!=0) && !in_array($task["id_us"], $us_not_done))
        array_push($us_not_done, $task["id_us"]);
    }
    $sprint_difficulty -= get_sprint_difficulty($mysql,$sprint["id"]);
    foreach ($us_not_done as $key => $value) {
      printf("var a%d=%d;",$sprint["id"],count($us_not_done));
      $sprint_difficulty+=$tab_stories[$value];
    }
    array_push($graph["data"],$sprint_difficulty);
  }while($sprint = $sprints->fetch_array(MYSQLI_ASSOC));

  return $graph;
}*/

function compute_past_sprints_difficulty(){
  global $mysql,$project;
  $stories = get_us($mysql,$project["id"]);
  $tab_stories = [];
  while ($story = $stories->fetch_array(MYSQLI_ASSOC)){
    $tab_stories[$story["id"]] = $story["difficulty"];
  }
  $sprints = get_past_sprints($mysql,$project["id"]);
  $graph = [];
  $graph["label"] = [];
  $graph["data"] = [];
  $past_us = [];
  $project_difficulty = get_project_difficulty($mysql,$project["id"]);
  $sprint = $sprints->fetch_array(MYSQLI_ASSOC);
  array_push($graph["label"],$sprint["start_date"]);
  array_push($graph["data"],$project_difficulty);
  do{
    array_push($graph["label"],$sprint["end_date"]);
    $tasks = get_tasks($mysql,$sprint["id"]);
    $us_not_done = [];
    $us_done = [];
    while ($task = $tasks->fetch_array(MYSQLI_ASSOC)) {
      if((strcmp($task["state"],"Done")!=0) && !in_array($task["id_us"], $us_not_done))
        array_push($us_not_done, $task["id_us"]);
      if (!in_array($task["id_us"], $us_done))
        array_push($us_done, $task["id_us"]);
    }
    foreach ($us_done as $key => $value) {
      if (!in_array($value, $us_not_done) && !in_array($value, $past_us)){
        $project_difficulty -= $tab_stories[$value];
        array_push($past_us, $value);
        
      }
    }
    array_push($graph["data"],$project_difficulty);
  }while($sprint = $sprints->fetch_array(MYSQLI_ASSOC));

  return $graph;
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BurnDown Chart Projet</title>
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link href="elements/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="elements/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="elements/css/animate.css" rel="stylesheet" type="text/css" />
    <link href="elements/css/admin.css" rel="stylesheet" type="text/css" />
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
<script src="elements/js/jquery-2.1.0.js"></script>
<script src="elements/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>
<script type="text/javascript">
<?php
  $estimated = compute_estimated_sprints_difficulty();
  $real = compute_past_sprints_difficulty();
  printf("var sprints_end_dates = %s ;\n",php_array_to_js_array($estimated["labels"]));
  printf("var charge_estimee = %s ;\n",php_array_to_js_array($estimated["data"]));
  printf("var charge_real = %s ;\n",php_array_to_js_array($real["data"]));
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
            data: charge_real,
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
<script src="elements/js/common-script.js"></script>
<script src="elements/js/jquery.slimscroll.min.js"></script>
<script src="elements/js/jPushMenu.js"></script>
<script src="elements/js/side-chats.js"></script>
</body>
</html>
