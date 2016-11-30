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
  <title>KanBan Projet</title>
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
               <div class="panel-heading border">KanBan</div>
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
              printf("<li class=\"active\"><a href=\"kanBan.php?id=%d\">KanBan</a></li>",$project["id"]);
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
              <?php
                $all_sprints = get_sprints($mysql,$project["id"]);
                $tab = [];
                $num = 1;
                while ($row = $all_sprints->fetch_array(MYSQLI_ASSOC)){
                  $tab[$row["id"]] = $num++;
                }

                $sprints = get_currents_sprints($mysql,$project["id"]);
                $cols = ["To-Do","On Going","Test","Done"];
                $user_valid = isset($_SESSION['id']) && check_user_work_on_project($mysql,$_SESSION['id'],$project["id"]);

                while ($sprint = $sprints->fetch_array(MYSQLI_ASSOC)){
                  $tasks = get_tasks($mysql,$sprint["id"]);
                  printf("<div class = \"panel panel-default\">
                            <div class = \"panel-heading\">
                              <h3 class = \"panel-title\">Sprint #%d (%s / %s)</h3>
                          </div>",$tab[$sprint["id"]], $sprint["start_date"],$sprint["end_date"]);
                  printf("<div class = \"panel-body\">");
                  printf("<div class=\"table-bordered\">
                            <table id=\"tableDnD\" class=\"table table-bordered\">
                              <thread>
                                <tr>");

                                echo" <th>$cols[0]</th>";
                                   echo" <th>$cols[1]</th>";
                                   echo" <th>$cols[2]</th>";
                                   echo" <th>$cols[3]</th>";
                          printf("</tr>
                              </thread>
                              <tbody>");
                  while ($task = $tasks->fetch_array(MYSQLI_ASSOC)){


                    printf("<tr>");
                    foreach ($cols as $col){
						echo "<div id ='external-events'>";
						$id_task = $task["id"];

            /*
            $userStory = get_us_Byid($mysql,$project["id"],$task["id_us"])->fetch_array(MYSQLI_ASSOC);
            style=\"background:".$userStory['color'].";\"
            */

						$user = get_user($mysql,$task["id_user"]);

						$user = $user->fetch_array(MYSQLI_ASSOC);

		              $div = "<div class='external-event'  id=\"".$id_task."\"".(($user_valid)?" ondragstart=\"drag(event)\" draggable=\"true\" >":">").$task["description"]."<span class='badge pull-right'>".$user["login"]."</span></div>";
                      if ($col == $task["state"]){

                        printf("<th id=\"$col\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"  >%s</th>",$div);
					  }
                      else
                        printf("<th id=\"$col\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"  ></th>");


                    }
                    printf("</tr>");

                  }
                  printf("</tbody></table></div></div></div></div>");


                }
              ?>
            </div>

          </div>
        </section>
      </div>




    </div>
  </div>
</div>
</div>
<?php if ($user_valid) { ?>
<script>

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text/html", ev.target.id);
	id_task =$(ev.target).attr("id");


}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text/html");
    ev.target.appendChild(document.getElementById(data));

	//alert(id_task);
	var e =$(event.target).attr("id");
  var usr = <?php echo $_SESSION['id'];?>;
	$.ajax({
                url: 'set_state.php',
                type: 'POST',
                data: {id:id_task, state:e, user:usr},
                success: function(data) {
                    location.reload();
                }
            });
}



</script>
<?php } ?>
<script src="js/jquery-2.1.0.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/common-script.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<script src="js/jPushMenu.js"></script>
<script src="js/side-chats.js"></script>
</body>
</html>
