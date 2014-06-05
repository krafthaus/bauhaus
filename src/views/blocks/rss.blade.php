<h3>{{ $title }}</h3>

<ul>
	@foreach ($feed->channel->item as $item)
	<li>
		<a href="{{ $item->link }}" target="_blank">
			{{ $item->title }}
		</a>
	</li>
	@endforeach
</ul>