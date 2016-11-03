<?php
  session_start ();
?>

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
          <li><a href="index.html"><i class="fa fa-home"></i> Acceuil <span class="left_nav_pointer"></span>  </a></li>
		  <li class="left_nav_active theme_border"> <a href="projects.php"> <i class="fa fa-tasks"></i> Tout les Projets </a></li>
          <?php
            if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {
				printf("<li> <a href=\"myprofil.php\"> <i class=\"fa fa-edit\"></i> Mon Profil </a></li>");
				printf("<li> <a href=\"createProject.php\"> <i class=\"fa fa-edit\"></i> Créer un projet </a></li>");
				printf("<li> <a href=\"logout.php\"> <i class=\"fa fa-tasks\"></i> Se déconnecter </a></li>");
            }
            else{
              printf("<li> <a href=\"login.php\"> <i class=\"fa fa-tasks\"></i> S'authentifier </a></li>");
			  printf("<li> <a href=\"inscription.php\"> <i class=\"fa fa-tasks\"></i> S'inscrire </a></li>");
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
       <div class="panel-heading border">Liste des projets</div>
       </section>
       </div>
       </div>
       
       <div class="row">
       <div class="col-md-12">
       <section class="panel default blue_title h2">
       <div class="panel-body">
       <div class="container">
        <table class="table table-striped table-bordered" id="projects">
          <thead>
            <tr>
              <th class="col-md-2">Langage</th>
              <th>Nom</th>
              <th class="col-md-3">Product Owner</th>
              </tr>
          </thead>
          <tbody>

		    <?php
          include("database.php");
          $mysql = connect();
          $projects = get_projects($mysql);
          while ($row = $projects->fetch_array(MYSQLI_ASSOC)){
            printf("<tr>");
            printf("<td data-title=\"Langage\">%s</td>",$row["language"]);
            printf("<td data-title=\"Nom\">%s</td>",$row["name"]);
            $user = get_user($mysql,$row["owner"]);
            while ($row2 = $user->fetch_array(MYSQLI_ASSOC)){
              printf ("<td data-title=\"Product Owner\">%s (%s %s)</td>",$row2["login"],$row2["last_name"],$row2["first_name"]);
            }
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
      <!--\\\\\\\ container  end \\\\\\-->
    </div>
    <!--\\\\\\\ content panel end \\\\\\-->
  </div>
  <!--\\\\\\\ inner end\\\\\\-->
</div>
<!--\\\\\\\ wrapper end\\\\\\-->
<!-- Modal -->



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
<script src="js/bootstrap.min.js"></script>
<script src="js/common-script.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<script src="js/jPushMenu.js"></script> 
<script src="js/side-chats.js"></script>

</body>
</html>
