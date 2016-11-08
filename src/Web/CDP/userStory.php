							<div class="form-group">
							<?php 
								if(isset($_POST["modal_description"])){
									$description = $_POST["modal_description"];
									$id_project = $project["id"];
									$check_addResult = add_us($mysql, $id_project, $description);
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
														printf ("<td data-title=\"Description\">%s<td><a href=\"TODO.php?id=%d\">Modifier</a></td>",$row['description'],$row['id']);
														printf("<tr>");
													}
												?>
											</tbody>
									</table>
								</div>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddUSModal">Ajouter</button>
							</div><!--/form-group--> 
							