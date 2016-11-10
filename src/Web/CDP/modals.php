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
						<textarea placeholder="Description" id="inputEmail3" class="form-control" name="add_description"></textarea>
						<br>
						<input type="text" placeholder="Priorite" id="inputEmail3" class="form-control" name="add_priority"><br>
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

<!-- End Sprint Modals -->
	<!-- Modal Add Sprint --> 
	<div id="AddSprintModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Ajout Sprint</h4>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
						<input type="date" placeholder="Debut"  class="form-control" name="add_start_Sprint"><br>
						<input type="date" placeholder="Fin"  class="form-control" name="add_end_Sprint"><br>
						<input class="btn btn-primary" type="submit" value="Ajouter" name="modale_addSprint_submit">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!--End Modal Add Sprint --> 
	<!-- Modal Update Sprint --> 
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
	<!--End Modal Update Sprint --> 
	<!-- Modal Delete Sprint --> 
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
	<!--End Modal Delete Sprint --> 
<!-- End Sprint Modals -->