<?php
session_start();
include("database.php");
if( !$_GET["id"] ) {
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=404.php">';
  exit();
}
else{
  $mysql = connect();
  $user = get_user($mysql,$_GET["id"]);
  if ($user->num_rows == 0 ){
   echo '<META HTTP-EQUIV="Refresh" Content="0; URL=404.php">';
   exit();
 }
 else{
   $user = $user->fetch_array(MYSQLI_ASSOC);
 }
}
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
              <li> <a href="index.html"><i class="fa fa-home"></i> Acceuil <span class="left_nav_pointer"></span>  </a></li>
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
          <div class="container clear_both padding_fix">
            <!--\\\\\\\ container  start \\\\\\-->
            <div class="page-content">
              <div class="row">
                <div class="col-md-4">
                  <div class="profile_bg">
                    <div class="user-profile-sidebar">
                      <div class="row">
                        <div class="col-md-4"><img src="images/pro.png" /></div>
                        <div class="col-md-8">
                          <div class="user-identity">
                            <h4><strong><?php echo  $user['last_name']; echo " ";  echo $user['first_name'];?> </strong></h4>
                            <p><i class="fa fa-map-marker"></i><?php echo $user['email'] ;?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/col-md-4-->
                <div class="col-md-8">
                  <div class="block-web full">
                    <ul class="nav nav-tabs nav-justified nav_bg">
                      <li class="active"><a href="#about" data-toggle="tab"><i class="fa fa-user"></i> Mes projets</a></li>
                      <li class=""><a href="#user-activities" data-toggle="tab"><i class="fa fa-laptop"></i> Mes participations</a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane animated fadeInRight active" id="about">
                        <div class="user-profile-content">
                          <h5><strong>Mes</strong> Projets</h5>
                          <hr>
                          <table class="table table-bordered" >
                            <tr class="danger">

                             <td><div style="width : 200px; overflow:auto;">Nom Projet</div></td>

                           </tr>
                           <?php
                           $projects = get_user_projects($mysql,$user["id"]);
                           while($row =$projects->fetch_array(MYSQLI_ASSOC))
                           {
                            printf("<tr class='active'>");
                            printf("<td><a href='project.php?id=%d'>%s</a></td>",$row['id'],$row['name']);
                            printf("</tr>");
                          }
                          ?>


                        </table>
                      </div>
                    </div>

                    <div class="tab-pane" id="user-activities">
                      <table class="table table-bordered" >
                        <tr class="danger">

                         <td><div style="width : 200px; overflow:auto;">Nom Projet</div></td>
                         <td><div style="width : 200px; overflow:auto;">Auteur Projet</div></td>

                       </tr>
                       <?php 
                       $participations = get_user_participations($mysql,$user["id"]);
                       while($row =$participations->fetch_array(MYSQLI_ASSOC))
                       {
                        printf("<tr class='active'>");
                        printf("<td><a href='project.php?id=%d'>%s</a></td>",$row['id'],$row['name']);
                        $owner = get_user($mysql,$row['owner'])->fetch_array(MYSQLI_ASSOC);
                        printf("<td><a href='myprofil.php?id=%d'>%s (%s %s)</a></td>",$row['owner'],$owner['login'],$owner['last_name'],$owner['first_name']);
                        printf("</tr>");
                      }
                      ?>

                    </table>
                  </div>


                </div>
                <!--/tab-content-->
              </div>
              <!--/block-web-->

            </div>
            <!--/col-md-8-->
            <?php if ($_SESSION['id'] == $user["id"]){?>
            <div class="row">
              <div class="col-lg-12">
                <section class="panel default blue_title h2">
                  <div class="panel-heading"><i class="fa fa-pencil"></i> Editer mes  <span class="semi-bold">Infos</span> </div>
                  <div class="panel-body">

                   <div class="panel-group accordion accordion-semi" id="accordion3">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion3" href="#ac3-1"> <i class="fa fa-angle-right"></i> Modifier mes infos </a> </h4>
                      </div>
                      <div style="height: 0px;" id="ac3-1" class="panel-collapse collapse">
                        <div class="panel-body">
                         <div class="user-profile-content">

                          <?php
                          $result = get_user($mysql,$_SESSION['id']);
                          $row = $result->fetch_array(MYSQLI_NUM);
                          echo "<form method='post' action='ModProfil.php' enctype='multipart/form-data'>
                          <div class='form-group'>
                            <label for='FirstName'>First Name</label>
                            <input type='hidden' class='form-control' id='ID' name='ID' value='".$row[0]."'>
                            <input type='text' class='form-control' id='FirstName' name='FirstName' value='".$row[1]."'>
                          </div> 
                          <div class='form-group'>
                            <label for='LastName'>Last Name</label>
                            <input type='text' class='form-control' id='LastName' name='LastName' value='".$row[2]."'>
                          </div>
                          <div class='form-group'>
                            <label for='Email'>Email</label>
                            <input type='email' class='form-control' id='Email' name='Email' value='".$row[4]."'>
                          </div>
                          <div class='form-group'>
                            <label for='pseudo'>Pseudo</label>
                            <input type='text' class='form-control' id='Pseudo'  name='Pseudo' value='".$row[3]."'>
                          </div> 
                          <div class='form-group'>
                            <label for='Password'>Password</label>
                            <input type='password' class='form-control' id='Password' name='Password' placeholder='6 - 15 Characters'>
                          </div>


                          <button type='submit' class='btn btn-primary'>Save</button>
                        </form>";
                       ?>


                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </section>
      </div>

    </section>
  </div>
</div>
</div>
<!--/row-->
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




<script src="js/jquery-2.1.0.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/common-script.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<script src="js/jPushMenu.js"></script> 
<script src="js/side-chats.js"></script>
</body>
</html>
