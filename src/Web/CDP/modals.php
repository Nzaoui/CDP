<!-- Modal Add User Story --> 
<div id="AddUSModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ajout US</h4>
			</div>
			<div class="modal-body">
				<form action="#" method="post">
					<textarea placeholder="Description" id="inputEmail3" class="form-control" name="modal_description"></textarea>
					<br>
					<input type="text" placeholder="Priorite" id="inputEmail3" class="form-control" name="priority"><br>
					<input class="btn btn-primary" type="submit" value="Ajouter" name="modale_submit">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

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