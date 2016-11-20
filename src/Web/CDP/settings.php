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
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
	<style>
    textarea { resize: vertical; }
	.navbar-collapse a { color: #FB5C4A}
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
               <?php
               printf("<div class=\"panel-heading border\">%s</div>",$project["name"]);
               ?>
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
              printf("<li><a href=\"burnDownChart.php?id=%d\">BurnDown Chart</a></li>",$project["id"]);
              printf("<li><a href=\"history.php?id=%d\">Historique</a></li>",$project["id"]);
              if(isset($_SESSION['id']) && check_user_work_on_project($mysql,$_SESSION['id'],$project["id"]))
                printf("<li class=\"active\"><a href=\"settings.php?id=%d\">Paramètres</a></li>",$project["id"]);
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
					   <li class=""><a data-toggle="tab" href="#tache">Tâches</a></li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div id="user" class="tab-pane fade active in">
							<div class="form-group">
							  <form action="#" method="post" enctype="multipart/form-data">
							      <table class="table table-striped table-bordered" id="projects">
								  <thead>
									<tr>
									  <th class="col-md-2">Login</th>
									  <th class="col-md-2">Nom</th>
									  <th class="col-md-2">Prenom</th>
									  <th class="col-md-2"> Action</th>
									  </tr>
								  </thead>
								  <tbody>

									<?php
						 
								  $mysql = connect();
								  $id_project= $project["id"];
								  $user = get_developers($mysql, $id_project);
								  while ($row = $user->fetch_array(MYSQLI_ASSOC)){
									printf("<tr>");
									$id_user = $row["id"];
									printf("<td data-title=\"Login\">%s</td>",$row["login"]);
									printf("<td data-title=\"Nom\">%s</td>",$row["last_name"]);
									printf("<td data-title=\"Prenom\">%s</td>",$row["first_name"]);
									printf("<td data-title=\"Action\">");
									echo "<button type='submit' class='btn btn-primary' name ='delete' value ='".$id_user."' >Supprimer</button>";
									printf("</td>");
									printf("</tr>");
									}
									$potential = get_potential_user_for_project($mysql,$id_project);
									 while ($res = $potential->fetch_array(MYSQLI_ASSOC)){
										printf("<tr>");
										$id_puser = $res["id"];
										printf("<td data-title=\"Login\">%s</td>",$res["login"]);
										printf("<td data-title=\"Nom\">%s</td>",$res["last_name"]);
										printf("<td data-title=\"Prenom\">%s</td>",$res["first_name"]);
										printf("<td data-title=\"Action\">");
										echo "<button type='submit' class='btn btn-primary' name ='submit' value ='".$id_puser."'>Ajouter</button>";
										echo "&nbsp &nbsp &nbsp &nbsp";
										printf("</td>");
										printf("</tr>");
									}
									
								?>
							   </tbody>
							  </table>
							  </form>
	  
							<?php  
							
							  if((isset($_POST['submit']))){
								if($_POST['submit']){
							  $mysql = connect();
							  $project = $project["id"];
							  $id_puser = $_POST['submit'];
							  $result = add_user_to_project($mysql,$id_puser,$project); 
							  	if($result == true){
											echo "<div class=\"alert alert-success\">";
											echo "<strong>Ajout avec Succes!</strong>";
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=settings.php?id='.$_GET["id"].'">';
											echo "</div>";	
										}
										else{
											echo "<div class=\"alert alert-danger\">";
											echo "<strong>Echec d'ajout!</strong>";
											echo "</div>";
										}
								  }
							  }
							  if((isset($_POST['delete']))){
								  if($_POST['delete']){
							  $mysql = connect();
							  $project = $project["id"];
							  $id_user = $_POST['delete'];
							  $result = delete_user_participation($mysql, $id_user, $project);
							  	if($result == true){
											echo "<div class=\"alert alert-success\">";
											echo "<strong>Suppression avec Succes!</strong>";
											 echo '<META HTTP-EQUIV="Refresh" Content="0; URL=settings.php?id='.$_GET["id"].'">';
											echo "</div>";
										}
										else{
											echo "<div class=\"alert alert-danger\">";
											echo "<strong>Echec de supression!</strong>";
											echo "</div>";
										}
								  }
							  }
							  ?>
							</div>
						</div>
						<div id="sprints" class="tab-pane fade">
							<?php include("sprints.php"); ?>
						</div>
						<div id="us" class="tab-pane fade">
							<?php include("userStory.php"); ?>
						</div>
						<div id="tache" class="tab-pane fade">
							<?php include("task.php"); ?>
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

<!-- The Modals -->
<?php include("modals.php"); ?>




<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#projects').DataTable({
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

<script src="js/common-script.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<script src="js/jPushMenu.js"></script> 
<script src="js/side-chats.js"></script>

<script>
$('#UpdateUSModal').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) //Getting the Button that launched the event
	var description = button.data('description') // Getting data from data-* attributes on the button
	var id_UserStory = button.data('id')
	var priority = button.data('priority')
	var difficulty = button.data('difficulty')
	var id_Sprint = button.data('sprint')
	var achievement = button.data('achievement')
	var commit = button.data('commit')
	var modal = $(this)
	modal.find('.modal-body #update_description').val(description) //Setting the values to the values that has been sent
	modal.find('.modal-body #update_id').val(id_UserStory)
	modal.find('.modal-body #update_priority').val(priority)
	modal.find('.modal-body #update_difficulty').val(difficulty)
	modal.find('.modal-body #update_sprint').val(id_Sprint)
	//modal.find('.modal-body #update_sprint option[value='+id_sprint+']').attr('selected','selected')
	modal.find('.modal-body #update_achievement').val(achievement)
	modal.find('.modal-body #update_commit').val(commit)
})
$('#DeleteUSModal').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget)
	var id_UserStory = button.data('id')
	var description = button.data('description')
	var modal = $(this)
	modal.find('.modal-body #delete_id').val(id_UserStory)
	modal.find('.modal-body #delete_description').val(description)
})
$('#UpdateSprintModal').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget)
	var id_Sprint = button.data('id')
	var start = button.data('start')
	var end = button.data('end')
	var modal = $(this)
	modal.find('.modal-body #update_id').val(id_Sprint)
	modal.find('.modal-body #update_start_Sprint').val(start)
	modal.find('.modal-body #update_end_Sprint').val(end)
})

$('#UpdateTaskModal').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) //Getting the Button that launched the event
	var description = button.data('description') // Getting data from data-* attributes on the button
	var id = button.data('id')
	var id_Sprint = button.data('sprint')
	var id_UserStory = button.data('us')
	var id_User = button.data('user')
	var modal = $(this)
	 //Setting the values to the values that has been sent
	modal.find('.modal-body #update_id').val(id)
	modal.find('.modal-body #update_sprint').val(id_Sprint)
	modal.find('.modal-body #update_us').val(id_UserStory)
	modal.find('.modal-body #update_user').val(id_User)
	modal.find('.modal-body #update_description').val(description)

})

$('#DeleteTaskModal').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget)
	var id_UserStory = button.data('id')
	var description = button.data('description')
	var modal = $(this)
	modal.find('.modal-body #delete_id').val(id_UserStory)
	modal.find('.modal-body #delete_description').val(description)
})

$('#DeleteSprintModal').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget)
	var id_Sprint = button.data('id')
	var start = button.data('start')
	var end = button.data('end')
	var modal = $(this)
	modal.find('.modal-body #delete_numSprint').val(id_Sprint)
	modal.find('.modal-body #delete_start_Sprint').val(start)
	modal.find('.modal-body #delete_end_Sprint').val(end)
})
</script>

<script type="text/javascript">
$('#myTab a').click(function(e) {
  e.preventDefault();
  $(this).tab('show');
});

// store the currently selected tab in the hash value
$("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
  var id = $(e.target).attr("href").substr(1);
  window.location.hash = id;
});

// on load of the page: switch to the currently selected tab
var hash = window.location.hash;
$('#myTab a[href="' + hash + '"]').tab('show');
</script>
</body>
</html>
