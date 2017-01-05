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
			<input type="submit" class="btn btn-default btn-red btn-rounded" value="{{ trans("bauhaus.".$model->getModel().".form.button.save") }}">
		</div>
	</div>
</div>