<?php

namespace Kdion4891\Lac\Traits;

use Illuminate\Support\Facades\Schema;
use Kdion4891\Lac\Components\LacAction;
use Kdion4891\Lac\Components\LacBulkAction;
use Kdion4891\Lac\Components\LacField;

trait LacModel
{
    public function getFillable()
    {
        return Schema::getColumnListing($this->getTable());
    }

    public function getViewTitleAttribute($value)
    {
        return $value ? $value : trim(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', ' $0', class_basename($this)));
    }

    public function fields()
    {
        return [
            LacField::make('ID')
                ->tableColumn()->tableSearchable()->tableSortable()->tableOrder('desc'),

            LacField::make('Name')
                ->tableColumn()->tableSearchable()->tableSortable()
                ->input()->inputCreate()->inputEdit()
                ->rules(['required', 'min:2']),

            LacField::make('Created At')
                ->tableColumn()->tableSearchable()->tableSortable(),

            LacField::make('Updated At'),
        ];
    }

    public function fieldRules($property)
    {
        $field_rules = [];

        foreach ($this->fields() as $field) {
            $field_rules[$field->name] = array_merge($field->rules_any, $field->{$property});
        }

        return $field_rules;
    }

    public function actions()
    {
        return [
            LacAction::details(),
            LacAction::edit(),
            LacAction::delete(),
        ];
    }

    public function bulkActions()
    {
        return [
            LacBulkAction::delete(),
        ];
    }
}
