@extends('krafthaus/bauhaus::layouts.master')

@section('subheader')
	<div class="row">
		<div class="col-sm-6">
			<h3>Create new {{ $model->getSingularName() }}</h3>
		</div>
		<div class="col-sm-6 text-right">
			<a href="{{ route('admin.model.index', $name) }}" class="btn btn-default btn-rounded">
				<i class="fa fa-long-arrow-left"></i>
				Back to {{ $model->getPluralName() }}
			</a>
		</div>
	</div>
@stop

@section('content')

	@if (Session::has('message.error'))
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Whoops!</strong>
			{{ Session::get('message.error') }}
		</div>
	@endif

	{{ Form::open(['route' => ['admin.model.store', $name], 'class' => 'form-horizontal', 'files' => true]) }}
		<div class="row">
			<div class="col-sm-8">

				@if ($model->getFormMapper()->hasTabs())
					<ul class="nav nav-tabs">
						@foreach ($model->getFormMapper()->getTabs() as $key => $tab)
							<li>
								<a href="#tab-{{ $key }}" data-toggle="tab">{{ $tab }}</a>
							</li>
						@endforeach
					</ul>
				@endif

				@if ($model->getFormMapper()->hasTabs())
					<div class="tab-content">
						@foreach ($model->getFormMapper()->getTabs() as $key => $tab)
							<div class="tab-pane" id="tab-{{ $key }}">
								@foreach ($model->getFormBuilder()->getResult()->getFields() as $field)
									@if ($field->getTab() == $tab && $field->getPosition() == 'left')
										{{ $field->render() }}
									@endif
								@endforeach
							</div>
						@endforeach
					</div>
				@else
					@foreach ($model->getFormBuilder()->getResult()->getFields() as $field)
						@if ($field->getPosition() == 'left')
							{{ $field->render() }}
						@endif
					@endforeach
				@endif

			</div>
			<div class="col-sm-4">
				@if ($model->getFormMapper()->hasFieldsOnPosition('right'))
					<div class="panel panel-default">
						<div class="panel-body">
							@foreach ($model->getFormBuilder()->getResult()->getFields() as $field)
								@if ($field->getPosition() == 'right')
									{{ $field->render() }}
								@endif
							@endforeach
						</div>
					</div>
				@endif

				<div class="col-sm-12">
					<input type="submit" class="btn btn-default btn-red btn-rounded" value="Create {{ $model->getSingularName() }}">
				</div>
			</div>
		</div>
	{{ Form::close() }}

	<div class="modal fade" id="field-modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close">&times;</button>
					<h4 class="modal-title">Loading</h4>
				</div>
			</div>
		</div>
	</div>

@stop