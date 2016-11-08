							<div class="form-group">
							<?php 
								if((isset($_POST["start_Sprint"]))&&(isset($_POST["end_Sprint"]))){
									$start = $_POST["start_Sprint"];
									$end =  $_POST["end_Sprint"];
									$id_project = $project["id"];
									$check_addResult = add_sprint ($mysql, $id_project, $start, $end);
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
								<div class="col-sm-7" id="sprints">
									<table class="table table-striped table-bordered" id="sprints">
										<thead>
											<tr>
												<th>#Sprint</th>
												<th>Debut</th>
												<th>Fin</th>
												<th>Action</th>
											</tr>
										</thead>
											<tbody>
												<?php
													$sprints = get_sprints($mysql, $project["id"]);
													while ($row = $sprints->fetch_array(MYSQLI_ASSOC)){
														printf("<tr>");
														printf ("<td data-title=\"#Sprint\">%d",$row['id']);
														printf ("<td data-title=\"Debut\">%s",$row['start_date']);
														printf ("<td data-title=\"Fin\">%s",$row['end_date']);
														printf ("<td data-title=\"Action\"><a href=\"TODO.php?id=%d\">Modifier</a></td>",$row['id']);
														printf("<tr>");
													}
												?>
											</tbody>
									</table>
								</div>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddSprintModal">Ajouter</button>
							</div><!--/form-group--> 