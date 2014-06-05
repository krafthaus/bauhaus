<div class="form-group {{ $errors->has($field->getName()) ? 'has-error' : '' }}">
	<label class="col-sm-3 control-label">{{ $field->getLabel() }}</label>
	<div class="col-sm-9">
		{{ Form::file($field->getName(), ['class' => 'form-control']) }}
		@if ($field->getDescription())
			<p class="help-block">{{ $field->getDescription() }}</p>
		@endif

		@if ($field->getValue() !== null)
		<div class="row">
			<div class="col-sm-12">
				<img src="{{ asset($field->getValue()) }}" width="100%">
			</div>
		</div>
		@endif
	</div>
</div>