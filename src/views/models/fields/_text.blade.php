<div class="form-group {{ $errors->has($field->getName()) ? 'has-error' : '' }}">
	<label class="col-sm-3 control-label">{{ $field->getLabel() }}</label>
	<div class="col-sm-9">

		@if ($field->isInfinite())
			@foreach ($field->getValue() as $key => $value)
				<div class="row">
					<div class="col-sm-11">
						{{ Form::text($field->getName() . '[]', $value, $field->getAttributes()) }}
					</div>
					<div class="col-sm-1">
						<div class="field-infinite">
							<a data-event="field-add" style="{{ $key != count($field->getValue()) -1 ? 'display: none;' : '' }}">
								<i class="fa fa-plus"></i>
							</a>

							<a data-event="field-remove" style="{{ $key == count($field->getValue()) -1 ? 'display: none;' : '' }}">
								<i class="fa fa-times"></i>
							</a>
						</div>
					</div>
				</div>
			@endforeach
		@else
			{{ Form::text($field->getName(), $field->getValue(), $field->getAttributes()) }}
		@endif

		@if ($field->getDescription())
			<p class="help-block">{{ $field->getDescription() }}</p>
		@endif
	</div>
</div>