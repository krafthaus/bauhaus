<div class="col-sm-4">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">{{ trans("bauhaus.".$model->getModel().".index.filter-title") }}</h3>
		</div>
		<div class="panel-body">
			{{ Form::open(['method' => 'get', 'class' => 'form-horizontal']) }}
				<input type="hidden" name="_filtering" value="✓">

				@foreach ($model->getFilterBuilder()->getResult()->getFields() as $field)
					{{ $field->render() }}
				@endforeach

				<div class="row">
					<div class="col-sm-9 col-sm-offset-3">
						<div class="pull-right">
							<input type="submit" class="btn btn-default btn-rounded btn-red" value="{{ trans("bauhaus.".$model->getModel().".index.button.filter-submit") }}">
						</div>
						<a class="btn btn-default btn-rounded" href="{{ route('admin.model.index', $name) }}">
							{{ trans('bauhaus::index.button.reset') }}
						</a>
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div>
</div>