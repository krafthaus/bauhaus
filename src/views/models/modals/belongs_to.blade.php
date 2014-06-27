{{ Form::open(['route' => ['admin.model.store', $name], 'class' => 'form-horizontal', 'files' => true]) }}
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">Create a new {{ $model->getSingularName() }}</h4>
	</div>
	<div class="modal-body">

		@include('krafthaus/bauhaus::models.partials._form')

	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
		<input type="submit" class="btn btn-default btn-red btn-rounded" value="Create {{ $model->getSingularName() }}">
	</div>
{{ Form::close() }}

