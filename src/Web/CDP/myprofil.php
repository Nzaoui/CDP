<?php
	
    session_start();
		
	if(!isset($_SESSION['pseudo']) or !isset($_SESSION['password'])){
		header("location:login.php");
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
          <li class="left_nav_active theme_border"><a href="myprofil.php"><i class="fa fa-home"></i> Mon Profil <span class="left_nav_pointer"></span>  </a></li>
          <li> <a href="createProject.php"> <i class="fa fa-edit"></i> Créer un projet </a></li> 
          <li> <a href="projects.php"> <i class="fa fa-tasks"></i> Tout les Projets </a></li>
		  <li> <a href="logout.php"> <i class="fa fa-power-off"></i> Se déconnecter </a></li>
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
					  <?php 
					
						 @mysql_connect("localhost","root","");
						@mysql_select_db("gestiondeprojet");
						$result = @mysql_query("SELECT * FROM user WHERE login = '".$_SESSION['pseudo']."'");
													if (!$result) {
													echo 'Impossible d\'exécuter la requête : ' . mysql_error();
													exit;
													}
													$row = mysql_fetch_row($result);
						
 


	  ?>
                        <h4><strong><?php echo $row[2] ; echo " " ; echo $row[1] ;?> </strong></h4>
                        <p><i class="fa fa-map-marker"></i><?php echo $row[4] ;?></p>
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
							

								
							</table>
                    </div>
                  </div>
         
                  <div class="tab-pane" id="user-activities">
                          <table class="table table-bordered" >
								<tr class="danger">

									<td><div style="width : 200px; overflow:auto;">Nom Projet</div></td>
									<td><div style="width : 200px; overflow:auto;">Auteur Projet</div></td>
									
								</tr>
							
							
								
							</table>
                  </div>
                </div>
                <!--/tab-content-->
              </div>
              <!--/block-web-->
            </div>
            <!--/col-md-8-->
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
