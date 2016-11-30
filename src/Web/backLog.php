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
  <title>Backlog Projet</title>
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
         <div class="panel-heading border">BackLog</div>
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
        printf("<li  class=\"active\"><a href=\"backLog.php?id=%d\">BackLog</a></li>",$project["id"]);
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
        <table class="table table-striped table-bordered" id="backlog">
          <thead>
            <tr>
              <th class="col-md-1">id</th>
              <th class="col-md-3">Description</th>
              <th class="col-md-1">Priorité</th>
              <th class="col-md-1">Difficulté</th>
              <th class="col-md-1">Sprint</th>
              <th class="col-md-1">Commit</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sprints = get_sprints($mysql,$project["id"]);
            $tab = [];
            $num = 1;
            while ($row = $sprints->fetch_array(MYSQLI_ASSOC)){
              $tab[$row["id"]] = $num++;
            }

            $us = get_us($mysql,$project["id"]);
            $num = 1;
            while ($row = $us->fetch_array(MYSQLI_ASSOC)){
              printf("<tr>");
              printf("<td data-title=\"id\">%s</td>",$num++);
              printf("<td data-title=\"Description\">%s</td>",$row["description"]);
              printf("<td data-title=\"Priorité\">%s</td>",$row["priority"]);
              printf("<td data-title=\"Difficulté\">%s</td>",$row["difficulty"]);
              printf("<td data-title=\"Sprint\">%s</td>",$tab[$row["id_sprint"]]);
              printf("<td data-title=\"commit\">%s</td>",$row["commit"]);
              printf("</tr>");
            }
            close($mysql);
            ?>

          </tbody>
        </table>
      </div>

    </div>
  </section>
</div>


</div>
</div>
</div>
</div>

<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#backlog').DataTable({
      "language": {
        "sProcessing":     "Traitement en cours...",
        "sSearch":         "Rechercher&nbsp;:",
        "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
        "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
        "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        "sInfoPostFix":    "",
        "sLoadingRecords": "Chargement en cours...",
        "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
        "oPaginate": {
          "sFirst":      "Premier",
          "sPrevious":   "Pr&eacute;c&eacute;dent",
          "sNext":       "Suivant",
          "sLast":       "Dernier"
        },
        "oAria": {
          "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
          "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
        }
      }
    });
  });
</script>
<script src="elements/js/bootstrap.min.js"></script>
<script src="elements/js/common-script.js"></script>
<script src="elements/js/jquery.slimscroll.min.js"></script>
<script src="elements/js/jPushMenu.js"></script>
<script src="elements/js/side-chats.js"></script>
</body>
</html>
