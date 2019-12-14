<form method="POST" action="{{ route($model->getTable() . '.destroy', $model->id) }}" class="d-inline-block" data-ajax-form>
    @method('DELETE')
    @csrf
    <button type="submit" class="btn btn-outline-danger px-2" title="{{ __('Delete') }}" data-confirm="{{ __('Are you sure?') }}">
        <i class="fa fa-fw fa-trash"></i>
    </button>
</form>
