							<div class="form-group">
							<?php 
								if(isset($_POST["modale_addSprint_submit"])){
									if((isset($_POST["add_start_Sprint"]))&&(isset($_POST["add_end_Sprint"]))){
										$start = $_POST["add_start_Sprint"];
										$end =  $_POST["add_end_Sprint"];
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
									else{
										echo "<div class=\"alert alert-warning\">";
										echo "<strong>Echec d'ajout! Tentative d'ajout d'un Element sans Date de debut ou Date de Fin</strong>";
										echo "</div>";
									}
								}
								if(isset($_POST["modale_updateSprint_submit"])){
									if((isset($_POST["update_start_Sprint"]))&&(isset($_POST["update_end_Sprint"]))){
										echo "<div class=\"alert alert-info\">";
										echo "<strong>TODO</strong> In Sprint 3 with Tasks";
										echo "</div>";
									}
									else{
										echo "<div class=\"alert alert-warning\">";
										echo "<strong>Echec de Modification! Tentative de modifier un Element en supprimant sa Date de debut ou Date de Fin</strong>";
										echo "</div>";
									}
								}
								if(isset($_POST["modale_deleteSprint_submit"])){
									$id_Sprint = $_POST["delete_numSprint"];
									$check_deleteResult = delete_spint ($mysql, $id_Sprint);
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
							  <br><br><label class="col-sm-2 control-label">Liste des Sprints</label>
								<div class="col-sm-7" id="sprints">
									<table class="table table-striped table-bordered table-hover" id="sprints">
										<thead>
											<tr>
												<th>#Sprint</th>
												<th>Debut</th>
												<th>Fin</th>
											</tr>
										</thead>
											<tbody>
												<?php
													$sprints = get_sprints($mysql, $project["id"]);
													$i=0;
													while ($row = $sprints->fetch_array(MYSQLI_ASSOC)){
														$i = $i+1;
														printf("<tr>");
														printf("<td data-title=\"#Sprint\">%d",$i);
														printf("<td data-title=\"Debut\">%s",$row['start_date']);
														printf("<td data-title=\"Fin\">%s",$row['end_date']);
														printf("<tr>");
													}
												?>
											</tbody>
									</table>
								</div>
							</div><!--/form-group--> 