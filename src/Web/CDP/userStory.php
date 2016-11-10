							<div class="form-group">
							<?php 
								if(isset($_POST["modale_addUS_submit"])){
									if((!empty($_POST["add_description"]))&&(!empty($_POST["add_priority"]))){
										$description = $_POST["add_description"];
										$priority = $_POST["add_priority"];
										$id_project = $project["id"];
										$check_addResult = add_us($mysql, $id_project, $description, $priority);
										if($check_addResult == true){
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
									else{
										echo "<div class=\"alert alert-warning\">";
										echo "<strong>Echec d'ajout! Tentative d'ajout d'un Element sans Description ou sans Priorite</strong>";
										echo "</div>";
									}
								}
								if(isset($_POST["modale_updateUS_submit"])){
									if((!empty($_POST["update_description"]))&&(!empty($_POST["update_priority"]))){
										$id_US = $_POST["update_id"];
										$description = $_POST["update_description"];
										$priority = $_POST["update_priority"];
										$achievement = $_POST["update_achievement"];
										$commit = $_POST["update_commit"];
										$id_project = $project["id"];
										$check_updateResult = alter_us($mysql, $id_US, $id_project, $description, $priority, $achievement, $commit);
										if($check_updateResult == true){
											echo "<div class=\"alert alert-success\">";
											echo "<strong>Mofication avec Succes!</strong>";
											echo "</div>";
										}
										else{
											echo "<div class=\"alert alert-danger\">";
											echo "<strong>Echec de Modification!</strong>";
											echo "</div>";
										}
									}
									else{
										echo "<div class=\"alert alert-warning\">";
										echo "<strong>Echec de Modification! Tentative de Supprimer la Description ou la Priorite</strong>";
										echo "</div>";
									}
								}
								if(isset($_POST["modale_deleteUS_submit"])){
									$id_US = $_POST["delete_id"];
									$check_deleteResult = delete_us ($mysql, $id_US);
									if($check_deleteResult == true){
											echo "<div class=\"alert alert-success\">";
											echo "<strong>Suppression avec Succes!</strong>";
											echo "</div>";
										}
										else{
											echo "<div class=\"alert alert-danger\">";
											echo "<strong>Echec de Suppression!</strong>";
											echo "</div>";
										}
								}
								?>
						
								<br><br><label class="col-sm-2 control-label">Parametres User Story</label>
								<div class="col-sm-7" id="userStories">
									<table class="table table-striped table-bordered" id="userStories">
										<thead>
											<tr>
												<th>Description</th>
												<th>Action</th>		
											</tr>
										</thead>
											<tbody>
												<?php
													$userStories = get_us($mysql, $project["id"]);
													while ($row = $userStories->fetch_array(MYSQLI_ASSOC)){
														printf("<tr>");
														printf("<td data-title=\"Description\">%s</td>",$row['description']);
														printf("<td data-title=\"Action\">");
														printf("<button type=\"button\" class=\"btn btn-info\" data-toggle=\"modal\" data-target=\"#UpdateUSModal\" data-id=\"%d\" data-description=\"%s\" data-priority=\"%d\" data-achievement=\"%s\" data-commit=\"%s\">Modifier</button>",$row['id'],$row['description'],$row['priority'],$row['achievement'],$row['commit']);
														printf("&emsp;");
														printf("<button type=\"button\" class=\"btn btn-info\" data-toggle=\"modal\" data-target=\"#DeleteUSModal\" data-id=\"%d\" data-description=\"%s\">Supprimer</button>",$row['id'],$row['description']);
														printf("</td>");
														printf("<tr>");
													}
												?>
											</tbody>
									</table>
								</div>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddUSModal">Ajouter</button>
							</div><!--/form-group--> 
							
							
							