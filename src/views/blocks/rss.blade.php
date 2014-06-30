<ul>
	@foreach ($feed->entry as $item)
	<li>
		<a href="{{ $item->link['href'] }}" target="_blank">
			{{ $item->title }}
		</a>
	</li>
	@endforeach
</ul>