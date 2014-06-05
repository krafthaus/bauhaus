@extends('krafthaus/bauhaus::layouts.master')

@section('subheader')
	<div class="row">
		<div class="col-sm-6">
			<h3>List {{ $model->getPluralName() }}</h3>
		</div>
		<div class="col-sm-6 text-right">
			<a href="{{ route('admin.model.create', $name) }}" class="btn btn-default btn-red btn-rounded">
				<i class="fa fa-plus"></i>
				Create new {{ $model->getSingularName() }}
			</a>
		</div>
	</div>
@stop

@section('content')

	@if (Session::has('message.success'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Success!</strong>
			{{ Session::get('message.success') }}
		</div>
	@endif

	@if (Input::has('_filtering'))
		<div class="alert alert-warning">
			<strong>Warning!</strong>
			You are currently browsing filtered results.
		</div>
	@endif

	@if (count($model->getListBuilder()->getResult()) == 0)
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<div class="panel panel-default">
					<div class="panel-body text-center">

						@if (Input::has('_filtering'))
							<p>The filter query did not return any results.</p>
							<a class="btn btn-default btn-rounded" href="{{ route('admin.model.index', $name) }}">
								Reset filters
							</a>
						@else
							<p>You have no {{ strtolower($model->getPluralName()) }} created yet.</p>
							<a href="{{ route('admin.model.create', $name) }}" class="btn btn-default btn-red btn-rounded">
								<i class="fa fa-plus"></i>
								Create new {{ $model->getSingularName() }}
							</a>
						@endif
					</div>
				</div>
			</div>
		</div>
	@else
		<div class="row">
			<div class="col-sm-{{ $model->getFilterBuilder()->getResult()->getFields() ? 8 : 12 }}">
				{{ Form::open(['method' => 'POST', 'route' => ['admin.model.multi-destroy', $name]]) }}
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
											Edit
										</a>
									</td>

								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<td colspan="{{ count($model->getListMapper()->getFields()) + 1 }}">
									<input type="submit" class="btn btn-default btn-rounded" value="Delete selected {{ $model->getPluralName() }}">
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
				<div class="col-sm-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							Filter {{ $model->getPluralName() }}
						</div>
						<div class="panel-body">
							{{ Form::open(['method' => 'get', 'class' => 'form-horizontal']) }}
							<input type="hidden" name="_filtering" value="✓">

								@foreach ($model->getFilterBuilder()->getResult()->getFields() as $field)
									{{ $field->render() }}
								@endforeach

								<div class="row">
									<div class="col-sm-9 col-sm-offset-3">
										<a class="btn btn-default btn-rounded" href="{{ route('admin.model.index', $name) }}">
											Reset
										</a>
										<div class="pull-right">
											<input type="submit" class="btn btn-default btn-rounded btn-red" value="Filter {{ $model->getPluralName() }}">
										</div>
									</div>
								</div>
							{{ Form::close() }}
						</div>
					</div>
				</div>
			@endif
		</div>
	@endif

@stop