<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">Are you sure you want to continue?</h4>
</div>
<div class="modal-body">
	<p>This action is irreversible.</p>
	<button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Cancel</button>
	<button type="button" id="post-delete" class="btn btn-default btn-red btn-rounded">
		Yes, delete the {{ $model->getSingularName() }}
	</button>
</div>

<script>
	$('#post-delete').click(function () {
		$('#delete-multi-form').submit();
	});
</script>