<div class="form-group {{ $errors->has($field->getName()) ? 'has-error' : '' }}">
	<label class="col-sm-3 control-label">{{ $field->getLabel() }}</label>
	<div class="col-sm-{{ $field->getInline() ? 6 : 9 }}">
		{{ Form::select($field->getName() . '_id', $items, $field->getValue(), $field->getAttributes()) }}
		@if ($field->getDescription())
			<p class="help-block">{{ $field->getDescription() }}</p>
		@endif
	</div>

	@if ($field->getInline() === true)
		<div class="col-sm-3 text-right">
			<a href="{{ route('modal.belongs_to.create', $field->getName()) }}" class="btn btn-default btn-rounded" data-toggle="modal" data-target="#field-modal">
				<i class="fa fa-plus"></i>
				Create from here
			</a>
		</div>
	@endif
</div>