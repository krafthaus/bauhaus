@extends('krafthaus/bauhaus::layouts.master')

@section('subheader')
	<div class="row">
		<div class="col-sm-12">
			<h3>Dashboard</h3>
		</div>
	</div>
@stop

@section('content')

	@if (Session::has('message.success'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>{{ trans('bauhaus::messages.success.title') }}</strong>
			{{ Session::get('message.success') }}
		</div>
	@endif

	@foreach ($blocks as $block)
		{{ $block->render() }}
	@endforeach

@stop