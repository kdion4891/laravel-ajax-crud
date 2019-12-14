<div class="text-md-right text-nowrap">
    @foreach($model->actions() as $action)
        @include($action->view)
    @endforeach
</div>
