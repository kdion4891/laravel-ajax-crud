<?php

namespace Kdion4891\Lac\Traits;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;

trait LacController
{
    protected $model;

    public function index(Request $request, Builder $builder)
    {
        $fields = $this->model->fields();
        $actions = $this->model->actions();
        $bulk_actions = $this->model->bulkActions();
        $columns = [];
        $order = null;

        if ($request->ajax()) {
            $datatables = datatables($this->model->select($this->model->getTable() . '.*'));

            foreach ($fields as $field) {
                if ($field->details_view) {
                    $datatables->editColumn($field->name, function ($model) use ($field) {
                        return view($field->details_view, ['model' => $model, 'field' => $field]);
                    });
                }
            }

            if ($actions) {
                $datatables->editColumn('action', function ($model) {
                    return view('lac::models.datatables.action', ['model' => $model]);
                });
            }
            if ($bulk_actions) {
                $datatables->editColumn('checkbox', function ($model) {
                    return view('lac::models.datatables.checkbox', ['model' => $model]);
                });
            }

            return $datatables->toJson();
        }

        foreach ($fields as $index => $field) {
            if ($field->table_column) {
                $column = [];
                $column['title'] = $field->label;
                $column['data'] = $field->table_column_alias ? $field->table_column_alias : $field->name;
                if (!$field->table_searchable) $column['searchable'] = false;
                if (!$field->table_sortable) $column['orderable'] = false;
                if ($field->table_order) $order = [$index, $field->table_order];
                if ($field->table_hidden) $column['visible'] = false;
                $columns[] = $column;
            }
        }

        $html = $builder->columns($columns);
        $html->setTableId('datatables_' . $this->model->getTable());
        $html->setTableAttribute('table-hover');
        if ($order) $html->orderBy($order);
        if ($actions) $html->addAction(['title' => '']);
        if ($bulk_actions) $html->addCheckbox(['title' => view('lac::models.datatables.checkbox-all')->render()]);

        return view('lac::models.index', ['model' => $this->model, 'html' => $html]);
    }

    public function create()
    {
        return view('lac::models.create', ['model' => $this->model]);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->model->fieldRules('rules_create'));
        $this->model->create($this->requestData($request));

        return response()->json([
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }

    public function show($id)
    {
        return view('lac::models.show', ['model' => $this->model->findOrFail($id)]);
    }

    public function edit($id)
    {
        return view('lac::models.edit', ['model' => $this->model->findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $model = $this->model->findOrFail($id);
        $this->validate($request, $model->fieldRules('rules_edit'));
        $model->update($this->requestData($request));

        return response()->json([
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }

    public function destroy($id)
    {
        $this->model->findOrFail($id)->delete();

        return response()->json([
            'reload_datatables' => true,
        ]);
    }

    public function destroyBulk($ids = [])
    {
        foreach ($ids as $id) {
            $this->model->findOrFail($id)->delete();
        }

        return response()->json([
            'reload_datatables' => true,
        ]);
    }

    public function bulk(Request $request, $method)
    {
        $ids = array_filter(explode(',', $request->input('ids')));
        return $this->$method($ids);
    }

    private function requestData(Request $request)
    {
        $request_data = $request->all();

        foreach ($request->files->all() as $key => $uploaded_file) {
            $request_data[$key] = $request->file($key)->store('files');
        }

        return $request_data;
    }
}
