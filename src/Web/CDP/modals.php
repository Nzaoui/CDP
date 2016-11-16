<!-- User Stories Modals -->
	<!-- Modal Add User Story --> 
	<div id="AddUSModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Ajout User Story</h4>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
						<textarea placeholder="Description" class="form-control" name="add_description"></textarea>
						<br>
						<input type="text" placeholder="Priorite"  class="form-control" name="add_priority"><br>
						<input type="text" placeholder="Difficulte"  class="form-control" name="add_difficulty"><br>
						<select class="selectpicker" data-style="btn-inverse" name="add_sprint">
							<?php                
								$mysql = connect();
								$id_project = $project["id"];
								$result = get_sprints($mysql, $id_project); 
								$i=0;
								while ($row = $result->fetch_array(MYSQLI_ASSOC)) { 
									$i = $i+1;
									printf("<option value=\"%d\">Sprint #%d</option>",$row["id"],$i);
								} 
							?>	
                        </select>
						<input class="btn btn-primary" type="submit" value="Ajouter" name="modale_addUS_submit">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End Modal Update User Story -->	
	<!-- Modal Update User Story --> 
	<div id="UpdateUSModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Modifier User Story</h4>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
						<input type='hidden' class='form-control' id='update_id' name='update_id'>
						<label for="update_description">Description:</label>
						<textarea class="form-control" name="update_description" id="update_description"></textarea><br>
						<label for="update_priority">Priorite:</label>
						<input type="text" class="form-control" name="update_priority" id="update_priority"><br>
						<label for="update_difficulty">Difficulte:</label>
						<input type="text" class="form-control" name="update_difficulty" id="update_difficulty"><br>
						<label for="update_sprint">#Sprint:</label>
						<!--<input type="text" class="form-control" name="update_sprint" id="update_sprint"><br>-->
						<select class="selectpicker form-control" data-style="btn-inverse" name="update_sprint" id="update_sprint">
							<?php                
								$mysql = connect();
								$id_project = $project["id"];
								$result = get_sprints($mysql, $id_project); 
								$i=0;
								while ($row = $result->fetch_array(MYSQLI_ASSOC)) { 
									$i = $i+1;
									printf("<option value=\"%d\">Sprint #%d</option>",$row["id"],$i);
								} 
							?>	
                        </select><br>
						<label for="update_achievement">Date de Realisation:</label>
						<input type="date" class="form-control" name="update_achievement" id="update_achievement" placeholder="aaaa-mm-jj"><br>
						<label for="update_commit">#Commit:</label>
						<input type="text" class="form-control" name="update_commit" id="update_commit"><br>
						<input class="btn btn-primary" type="submit" value="Valider" name="modale_updateUS_submit">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End Modal Update User Story -->
	<!-- Modal Delete User Story --> 
	<div id="DeleteUSModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Supprimer User Story</h4>
				</div>
				<form action="#" method="post">
					<div class="modal-body">
							<input type='hidden' class='form-control' id='delete_id' name='delete_id'>
							<label for="update_description">Est ce que vous etes sur de vouloir supprimer la User Story:</label>
							<textarea class="form-control" name="delete_description" id="delete_description" readonly></textarea><br>					
					</div>
					<div class="modal-footer">
						<input class="btn btn-primary" type="submit" value="Supprimer" name="modale_deleteUS_submit">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- End Modal Delete User Story -->
<!-- End User Storie Modals -->



	<div id="AddTaskModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Ajout Taches</h4>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
						<textarea placeholder="Description" class="form-control" name="add_Tdescription"></textarea>
						
						<br>
						<select class="selectpicker" data-style="btn-inverse" name="add_sprint">
							<?php                
								$mysql = connect();
								$id_project = $project["id"];
								$result = get_sprints($mysql, $id_project); 
								$i=0;
								while ($row = $result->fetch_array(MYSQLI_ASSOC)) { 
									$i = $i+1;
									printf("<option value=\"%d\">Sprint #%d</option>",$row["id"],$i);
								} 
							?>	
                        </select>
						<br>
						<br>
						<select class="selectpicker" data-style="btn-inverse" name="add_us">
							<?php                
								$mysql = connect();
								$id_project = $project["id"];
								$result = get_us($mysql, $id_project); 
								$i=0;
								while ($row = $result->fetch_array(MYSQLI_ASSOC)) { 
									$i = $i+1;
									printf("<option value=\"%d\">US #%d</option>",$row["id"],$i);
								} 
							?>	
                        </select>
						<br>
						<br>
						<select class="selectpicker" data-style="btn-inverse" name="add_user">
							<?php                
								$mysql = connect();
								$result = get_all_user($mysql); 
								$i=0;
								while ($row = $result->fetch_array(MYSQLI_ASSOC)) { 
									
									$id=$row["id"];   
									$thing=$row["login"];   

									 echo "<OPTION VALUE=$id>$thing</option>";
								} 
							?>	
                        </select>
						<input class="btn btn-primary" type="submit" value="Ajouter" name="modale_addTask_submit">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	
		<div id="UpdateTaskModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Modifier Taches</h4>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
						<label for="update_description">Description:</label>
						<textarea class="form-control" name="update_description" id="update_description"></textarea><br>
						<label for="update_sprint">#Sprint:</label>
						<!--<input type="text" class="form-control" name="update_sprint" id="update_sprint"><br>-->
						<select class="selectpicker form-control" data-style="btn-inverse" name="update_sprint" id="update_sprint">
							<?php                
								$mysql = connect();
								$id_project = $project["id"];
								$result = get_sprints($mysql, $id_project); 
								$i=0;
								while ($row = $result->fetch_array(MYSQLI_ASSOC)) { 
									$i = $i+1;
									printf("<option value=\"%d\">Sprint #%d</option>",$row["id"],$i);
								} 
							?>	
                        </select><br>
						<select class="selectpicker form-control" data-style="btn-inverse" name="update_us" id="update_us">
							<?php                
								$mysql = connect();
								$id_project = $project["id"];
								$result = get_us($mysql, $id_project); 
								$i=0;
								while ($row = $result->fetch_array(MYSQLI_ASSOC)) { 
									$i = $i+1;
									printf("<option value=\"%d\">US #%d</option>",$row["id"],$i);
								} 
							?>	
                        </select><br>
						<select class="selectpicker form-control" data-style="btn-inverse" name="update_user" id="update_user">
							<?php                
								$mysql = connect();
								$result = get_all_user($mysql); 
								$i=0;
								while ($row = $result->fetch_array(MYSQLI_ASSOC)) { 
									$id=$row["id"];   
									$thing=$row["login"];   

									 echo "<OPTION VALUE=$id>$thing</option>";
								} 
							?>	
                        </select><br>
						<input class="btn btn-primary" type="submit" value="Valider" name="modale_updateTask_submit">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<div id="DeleteTaskModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Supprimer Tache</h4>
				</div>
				<form action="#" method="post">
					<div class="modal-body">
							<input type='hidden' class='form-control' id='delete_id' name='delete_id'>
							<label for="update_description">Est ce que vous etes sur de vouloir supprimer la tache:</label>
							<textarea class="form-control" name="delete_description" id="delete_description" readonly></textarea><br>					
					</div>
					<div class="modal-footer">
						<input class="btn btn-primary" type="submit" value="Supprimer" name="modale_deleteTask_submit">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	<!-- Sprint Modals -->
	<!-- Modal Add Sprint --> 
	<!--
	<div id="AddSprintModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Ajout Sprint</h4>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
						<input type="date" placeholder="Debut (aaaa-mm-jj)"  class="form-control" name="add_start_Sprint"><br>
						<input type="date" placeholder="Fin (aaaa-mm-jj)"  class="form-control" name="add_end_Sprint"><br>
						<input class="btn btn-primary" type="submit" value="Ajouter" name="modale_addSprint_submit">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	-->
	<!--End Modal Add Sprint --> 
	<!-- Modal Update Sprint --> 
	<!--
	<div id="UpdateSprintModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Modifier Sprint</h4>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
						<input type="hidden" id="update_numSprint" name="update_numSprint">
						<input type="date" placeholder="Debut" id="update_start_Sprint" class="form-control" name="update_start_Sprint"><br>
						<input type="date" placeholder="Fin" id="update_end_Sprint" class="form-control" name="update_end_Sprint"><br>
						<input class="btn btn-primary" type="submit" value="Modifier" name="modale_updateSprint_submit">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	-->
	<!--End Modal Update Sprint --> 
	<!-- Modal Delete Sprint --> 
	<!--
	<div id="DeleteSprintModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Supprimer Sprint</h4>
				</div>
				<form action="#" method="post">
					<div class="modal-body">
						<input type='hidden' id='delete_numSprint' name='delete_numSprint'>
						<label>Est ce que vous etes sur de vouloir supprimer le Sprint de la periode:</label>
						<input type="date" placeholder="Debut" id="delete_start_Sprint" class="form-control" name="delete_start_Sprint" readonly><br>
						<input type="date" placeholder="Fin" id="delete_end_Sprint" class="form-control" name="delete_end_Sprint" readonly><br>					
					</div>
					<div class="modal-footer">
						<input class="btn btn-primary" type="submit" value="Supprimer" name="modale_deleteSprint_submit">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div> 
	-->
	<!--End Modal Delete Sprint --> 
<!-- End Sprint Modals -->