							<div class="form-group">
							<?php 
								if(isset($_POST["modale_addTask_submit"])){
									if(!empty($_POST["add_Tdescription"])){
										$description = $_POST["add_Tdescription"];
										$id_us = $_POST["add_us"];
										//$id_user = $_POST["add_user"];
										$id_sprint = $_POST["add_sprint"];
										$id_project = $project["id"];
										$state= "To-Do";
										$check_addResult = add_task($mysql, $id_sprint, $id_us, $description,$state);
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
										echo "<strong>Echec d'ajout! Tentative d'ajout d'un Element sans Description </strong>";
										echo "</div>";
									}
									
								}
								
								if(isset($_POST["modale_updateTask_submit"])){
									if((!empty($_POST["update_description"]))){
										$id_us = $_POST["update_us"];
										$description = $_POST["update_description"];
										$id_sprint = $_POST["update_sprint"];
										$id_user= $_POST["update_user"];
										$id = $_POST["update_id"];
										$check_updateResult = alter_task($mysql,$id,$id_sprint,$id_us,$id_user,$description);
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
								}
								if(isset($_POST["modale_deleteTask_submit"])){
									$id = $_POST["delete_id"];
									$check_deleteResult = delete_task ($mysql, $id);
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
						
								<br><br><label class="col-sm-2 control-label">Parametres Tâches</label>
								<div class="col-sm-7" id="tasks">
									<table class="table table-striped table-bordered" id="tasks">
										<thead>
											<tr>
												<th>Description</th>
												<th>Action </th>		
											</tr>
										</thead>
											<tbody>
												<?php
												    $sprints = get_sprints($mysql,$project["id"]);
													while ($sprint = $sprints->fetch_array(MYSQLI_ASSOC)){
													$tasks = get_tasks($mysql,$sprint["id"]);
													while ($row = $tasks->fetch_array(MYSQLI_ASSOC)){
														printf("<tr>");
														printf("<td data-title=\"Description\">%s</td>",$row['description']);
														printf("<td data-title=\"Action\">");
														printf("<button type=\"button\" class=\"btn btn-info\" data-toggle=\"modal\" data-target=\"#UpdateTaskModal\""); 
														printf("data-id=\"%d\" data-sprint=\"%d\" data-us=\"%d\" data-user=\"%d\" data-description=\"%s\">Modifier</button>",$row['id'],$row['id_sprint'],$row['id_us'],$row['id_user'],$row['description']);
														printf("&emsp;");
														printf("<button type=\"button\" class=\"btn btn-info\" data-toggle=\"modal\" data-target=\"#DeleteTaskModal\" data-id=\"%d\" data-description=\"%s\">Supprimer</button>",$row['id'],$row['description']);
														printf("</td>");
														printf("<tr>");
													}
													}
												?>
											</tbody>
									</table>
								</div>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddTaskModal">Ajouter</button>
							</div><!--/form-group--> 
							
							
							