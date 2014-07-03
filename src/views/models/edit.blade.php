@extends('krafthaus/bauhaus::layouts.master')

@section('subheader')
	<div class="row">
		<div class="col-sm-6">
			<h3>{{ trans('bauhaus::form.button.edit-model', ['model' => $model->getSingularName()]) }}</h3>
		</div>
		<div class="col-sm-6 text-right">
			<a href="{{ route('admin.model.index', $name) }}" class="btn btn-default btn-rounded">
				<i class="fa fa-long-arrow-left"></i>
				{{ trans('bauhaus::form.button.back-to-index', ['model' => $model->getPluralName()]) }}
			</a>
		</div>
	</div>
@stop

@section('content')

	@if (Session::has('message.error'))
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>{{ trans('bauhaus::messages.error.title') }}</strong>
			{{ Session::get('message.error') }}
		</div>
	@endif

	{{ Form::open(['method' => 'PUT', 'route' => ['admin.model.update', $name, $id], 'class' => 'form-horizontal', 'files' => true]) }}

		<input type="hidden" name="{{ Str::singular($model->getTable()) }}_id" value="{{ $id }}">

		@include('krafthaus/bauhaus::models.partials._form')
	{{ Form::close() }}

	<div class="modal fade" id="field-modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close">&times;</button>
					<h4 class="modal-title">
						{{ trans('bauhaus::form.modal.loading') }}
					</h4>
				</div>
			</div>
		</div>
	</div>

@stop