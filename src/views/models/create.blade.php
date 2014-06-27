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
		@include('krafthaus/bauhaus::models.partials._form')
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