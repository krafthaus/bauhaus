@extends('krafthaus/bauhaus::layouts.master')

@section('subheader')
	<div class="row">
		<div class="col-sm-12">
			<h3>Dashboard</h3>
		</div>
	</div>
@stop

@section('content')

	@foreach ($blocks as $block)
		{{ $block->render() }}
	@endforeach

@stop