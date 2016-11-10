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
						<input class="btn btn-primary" type="submit" value="Ajouter" name="modale_add_submit">
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
						<input type="date" class="form-control" name="update_achievement" id="update_achievement"><br>
						<label for="update_commit">#Commit:</label>
						<input type="text" class="form-control" name="update_commit" id="update_commit"><br>
						<input class="btn btn-primary" type="submit" value="Valider" name="modale_update_submit">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End Modal Update User Story -->
<!-- End User Storie Modals -->

<!-- Modal Add Sprint --> 
<div id="AddSprintModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ajout Sprint</h4>
			</div>
			<div class="modal-body">
				<form action="#" method="post">
					<input type="text" placeholder="Numero du Sprint" id="inputEmail3" class="form-control" name="numSprint"><br>
					<input type="date" placeholder="Debut" id="inputEmail3" class="form-control" name="start_Sprint"><br>
					<input type="date" placeholder="Fin" id="inputEmail3" class="form-control" name="end_Sprint"><br>
					<input class="btn btn-primary" type="submit" value="Ajouter" name="modale_submit">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
