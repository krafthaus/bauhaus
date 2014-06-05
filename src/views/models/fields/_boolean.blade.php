<div class="form-group {{ $errors->has($field->getName()) ? 'has-error' : '' }}">
	<div class="col-sm-offset-3 col-sm-9">
		<div class="checkbox">
			<label>
				{{ Form::checkbox($field->getName(), 1, $field->getValue()) }}
				{{ $field->getLabel() }}
			</label>
		</div>

		@if ($field->getDescription())
			<p class="help-block">{{ $field->getDescription() }}</p>
		@endif
	</div>
</div>