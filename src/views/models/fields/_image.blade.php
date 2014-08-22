<div class="form-group {{ $errors->has($field->getName()) ? 'has-error' : '' }}">
    <label class="col-sm-3 control-label">{{ $field->getLabel() }}</label>
    <div class="col-sm-9">

        @if ($field->isMultiple())
            <div class="row">
                @foreach ($field->getValue() as $key => $value)

                    <div class="col-sm-3" data-multiply>
                        <div class="image-file-wrapper">
                            {{ Form::file($field->getName() . '[]', $field->getAttributes()) }}

                            @if ($value)
                                <div class="image-preview" style="background-image: url('{{ asset($value) }}');"></div>
                            @else
                                <div class="image-preview"></div>
                            @endif

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
            </div>
        @else
            {{ Form::file($field->getName(), $field->getAttributes()) }}
        @endif

    </div>
</div>

{{--
<div class="form-group {{ $errors->has($field->getName()) ? 'has-error' : '' }}">
	<label class="col-sm-3 control-label">{{ $field->getLabel() }}</label>
	<div class="col-sm-9">
		{{ Form::file($field->getName(), $field->getAttributes()) }}
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
--}}