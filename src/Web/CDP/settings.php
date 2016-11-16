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
					   <li class=""><a data-toggle="tab" href="#tache">Tâches</a></li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div id="user" class="tab-pane fade active in">
							<div class="form-group">
							  <br><br><label class="col-sm-2 control-label">Ajout User par login</label>
							  <div class="col-sm-3">
							   <form action="#" method="post" enctype="multipart/form-data">
								<select class="selectpicker" data-style="btn-inverse" name="name">
							    
												  <?php
                                                  
												  $mysql = connect();
												 // $id_user = $_SESSION["id"];
												  $id_project= $project["id"];
												  
												  $result = get_potential_user_for_project($mysql,$id_project); 
												  while ($row = $result->fetch_array(MYSQLI_ASSOC)) { 

													$id=$row["id"];   
													$thing=$row["login"];   

													  echo "<OPTION VALUE=$id>$thing</option>";
													} 
												  ?>
												
                                                </select>
												
							  </div>
							  <button type="submit" class="btn btn-primary" name ="submit" value ="submit">Ajouter</button>
							  </form>
							  <?php 
							  if((isset($_POST['submit']))){
							  $name = $_POST["name"];
							  $project = $project["id"];
							  
							  $mysql = connect();
							  $result = add_user_to_project($mysql,$name,$project); 
							  	if($result == true){
											echo "<div class=\"alert alert-success\">";
											echo "<strong>Ajout avec Succes!</strong>";
											echo "</div>";
										}
										else{
											echo "<div class=\"alert alert-danger\">";
											echo "<strong>Echec d'ajout!</strong>";
											echo "</div>";
										}
							  }
							  ?>
							</div><!--/form-group--> 
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
	var id_Sprint = button.data('sprint')
	var id_UserStory = button.data('us')
	var id_User = button.data('user')
	var modal = $(this)
	modal.find('.modal-body #update_description').val(description) //Setting the values to the values that has been sent
	modal.find('.modal-body #update_sprint').val(id_Sprint)
	modal.find('.modal-body #update_us').val(id_UserStory)
	modal.find('.modal-body #update_user').val(id_User)

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
</body>
</html>
