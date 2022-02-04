@if (!$model->exists)
 {{ __('page.add-btn') }}
@else
 Edit {{ @$name }}
@endif