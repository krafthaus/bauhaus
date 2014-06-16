<div class="form-group {{ $errors->has($field->getName()) ? 'has-error' : '' }}">
	<label class="col-sm-3 control-label">{{ $field->getLabel() }}</label>
	<div class="col-sm-6">
		{{ Form::select($field->getName() . '_id', $items, $field->getValue(), ['class' => 'form-control']) }}
		@if ($field->getDescription())
			<p class="help-block">{{ $field->getDescription() }}</p>
		@endif
	</div>
	<div class="col-sm-3 text-right">
		<a href="#" class="btn btn-default btn-rounded" data-toggle="modal" data-target="#inline-add-belongsto">
			<i class="fa fa-plus"></i>
			Create from here
		</a>
	</div>
</div>

<div class="modal fade" id="inline-add-belongsto">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close">&times;</button>
				<h4 class="modal-title">test</h4>
			</div>
			<div class="modal-body">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

@section('scripts')
<script>
	
	

</script>
@stop