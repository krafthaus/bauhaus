@extends($model->getView('master'))

@section('subheader')
	<div class="row">
		<div class="col-sm-12">
			<h3>
				{{ trans('bauhaus::index.list-title', ['model' => $model->getPluralName()]) }}
			</h3>
		</div>
	</div>
@stop

@section('sidebar')
	<ul class="nav nav-sidebar">
		<li>
			<a href="{{ route('admin.model.index', $name) }}">
				<i class="fa fa-bars"></i>
				{{ trans('bauhaus::index.button.overview') }}
			</a>
		</li>
		<li>
			<a href="{{ route('admin.model.create', $name) }}">
				<i class="fa fa-plus"></i>
				{{ trans('bauhaus::index.button.create-new', ['model' => $model->getSingularName()]) }}
			</a>
		</li>
	</ul>

	@if ($model->getScopeMapper()->hasScopes())
		<ul class="nav nav-sidebar">
			<li class="title">
				<i class="fa fa-search"></i>
				{{ trans('bauhaus::index.sidebar.scopes') }}
			</li>
			@foreach ($model->getScopeMapper()->getScopes() as $scope)
				<li>
					<a href="?_scope={{ $scope->getScope() }}&_filtering=✓" class="inset">
						{{ $scope->getLabel() }}
					</a>
				</li>
			@endforeach
		</ul>
	@endif

	<ul class="nav nav-sidebar nav-bottom">
		<li>
			<div class="btn-group dropup">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-share-square-o"></i>
					{{ trans('bauhaus::index.sidebar.export') }}
				</button>
				<ul class="dropdown-menu" role="menu">
					@foreach ($model->getExportTypes() as $exportType)
					<li>
						<a href="{{ route('admin.model.export', [$name, $exportType]) }}">{{ $exportType }}</a>
					</li>
					@endforeach
				</ul>
			</div>
		</li>
	</ul>
@stop

@section('content')

	@if (Session::has('message.success'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>{{ trans('bauhaus::messages.success.title') }}</strong>
			{{ Session::get('message.success') }}
		</div>
	@endif

	@if (Input::has('_filtering'))
		<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>{{ trans('bauhaus::messages.warning.title') }}</strong>
			{{ trans('bauhaus::index.browsing-filtered') }}
		</div>
	@endif

	@if (count($model->getListBuilder()->getResult()) == 0)
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<div class="panel panel-default">
					<div class="panel-body text-center">
						@if (Input::has('_filtering'))
							<p>{{ trans('bauhaus::index.no-filter-results', ['model' => $model->getPluralName()]) }}</p>
							<a class="btn btn-default btn-rounded" href="{{ route('admin.model.index', $name) }}">
								{{ trans('bauhaus::index.button.reset-filters') }}
							</a>
						@else
							<p>{{ trans('bauhaus::index.no-items-yet', ['model' => $model->getPluralName()]) }}</p>
							<a href="{{ route('admin.model.create', $name) }}" class="btn btn-default btn-red btn-rounded">
								<i class="fa fa-plus"></i>
								{{ trans('bauhaus::index.button.create-new', ['model' => $model->getSingularName()]) }}
							</a>
						@endif
					</div>
				</div>
			</div>
		</div>
	@else
		<div class="row">
			<div class="col-sm-{{ $model->getFilterBuilder()->getResult()->getFields() ? 8 : 12 }}">
				{{ Form::open(['method' => 'POST', 'route' => ['admin.model.multi-destroy', $name], 'id' => 'delete-multi-form']) }}
					<table class="table table-hover">
						<thead>
							<tr>
								<th width="20"></th>
								@foreach ($model->getListMapper()->getFields() as $field)
									<th>
										<a href="{{ route('admin.model.index', [$name, 'order_by' => $field->getName()]) }}">
											{{ $field->getLabel() }}
										</a>
									</th>
								@endforeach

								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($model->getListBuilder()->getResult() as $item)
								<tr>
									<td><input type="checkbox" name="delete[{{ $item->getIdentifier() }}]"></td>
									@foreach ($item->getFields() as $field)
										<td>{{ $field->render() }}</td>
									@endforeach

									<td align="right">
										<a href="{{ route('admin.model.edit', [$name, $item->getIdentifier()]) }}" class="btn btn-xs btn-default">
											{{ trans('bauhaus::index.button.edit') }}
										</a>
									</td>

								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<td colspan="{{ count($model->getListMapper()->getFields()) + 1 }}">
									<a href="{{ route('modal.delete', $name) }}" class="btn btn-default btn-rounded" data-toggle="modal" data-target="#field-modal">
										{{ trans('bauhaus::index.button.delete-selected', ['model' => $model->getPluralName()]) }}
									</a>
								</td>
								<td align="right">
									{{ $model->getListBuilder()->getPaginator()->links() }}
								</td>
							</tr>
						</tfoot>
					</table>
				{{ Form::close() }}
			</div>

			@if ($model->getFilterBuilder()->getResult()->getFields())
				@include($model->getView('filter'))
			@endif
		</div>
	@endif

@stop