@extends($model->getView('master'))

@section('subheader')
	<div class="row">
		<div class="col-sm-12">
			<h3>{{ trans('bauhaus::form.title.create-model', ['model' => $model->getSingularName()]) }}</h3>
		</div>
	</div>
@stop

@section('sidebar')
	<ul class="nav nav-sidebar">
		<li>
			<a href="{{ route('admin.model.index', $name) }}">
				<i class="fa fa-long-arrow-left"></i>
				{{ trans('bauhaus::form.button.back-to-index', ['model' => $model->getPluralName()]) }}
			</a>
		</li>
		<li>
			<a href="{{ route('admin.model.create', $name) }}">
				<i class="fa fa-plus"></i>
				{{ trans('bauhaus::index.button.create-new', ['model' => $model->getSingularName()]) }}
			</a>
		</li>
	</ul>
@stop

@section('content')

	@if (Session::has('message.error'))
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>{{ trans('bauhaus::messages.error.title') }}</strong>
			{{ Session::get('message.error') }}
		</div>
	@endif

	{{ Form::open(['route' => ['admin.model.store', $name], 'class' => 'form-horizontal', 'files' => true]) }}
		@include('krafthaus/bauhaus::models.partials._form')
	{{ Form::close() }}

@stop