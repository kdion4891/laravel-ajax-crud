<?php

namespace Kdion4891\Lac\Components;

use Illuminate\Support\Str;

class LacField
{
    private $name;
    private $label;
    private $table_column;
    private $table_column_alias;
    private $table_searchable;
    private $table_sortable;
    private $table_order;
    private $table_hidden;
    private $details_view;
    private $details_hidden;
    private $input;
    private $input_view;
    private $input_type;
    private $input_label;
    private $input_options;
    private $input_rows;
    private $input_create;
    private $input_edit;
    private $rules_any = [];
    private $rules_create = [];
    private $rules_edit = [];

    public function __get($property)
    {
        return $this->$property;
    }

    public static function make($label, $name = '')
    {
        return new LacField($label, $name);
    }

    public function __construct($label, $name = '')
    {
        $this->label = $label;
        $this->name = $name ? $name : Str::snake(Str::lower($label));
    }

    public function tableColumn($alias = '')
    {
        $this->table_column = true;
        $this->table_column_alias = $alias ? $alias : null;
        return $this;
    }

    public function tableSearchable()
    {
        $this->table_searchable = true;
        return $this;
    }

    public function tableSortable()
    {
        $this->table_sortable = true;
        return $this;
    }

    public function tableOrder($direction = 'asc')
    {
        $this->table_order = $direction;
        return $this;
    }

    public function tableHidden()
    {
        $this->table_hidden = true;
        return $this;
    }

    public function detailsView($view = '')
    {
        $this->details_view = $view;
        return $this;
    }

    public function detailsHidden()
    {
        $this->details_hidden = true;
        return $this;
    }

    public function input($type = 'text')
    {
        $this->input = 'input';
        $this->input_type = $type;
        return $this;
    }

    public function inputFile($label = '')
    {
        $this->input = 'file';
        $this->input_label = $label;
        return $this;
    }

    public function inputTextarea($rows = 3)
    {
        $this->input = 'textarea';
        $this->input_rows = $rows;
        return $this;
    }

    public function inputSelect($options = [])
    {
        $this->input = 'select';
        $this->input_options = $this->inputOptions($options);
        return $this;
    }

    public function inputRadio($options = [])
    {
        $this->input = 'radio';
        $this->input_options = $this->inputOptions($options);
        return $this;
    }

    public function inputCheckbox($label = '')
    {
        $this->input = 'checkbox';
        $this->input_type = 'checkbox';
        $this->input_label = $label;
        return $this;
    }

    public function inputCheckboxes($options = [])
    {
        $this->input = 'checkboxes';
        $this->input_options = $this->inputOptions($options);
        return $this;
    }

    public function inputSwitch($label = '')
    {
        $this->input = 'checkbox';
        $this->input_type = 'switch';
        $this->input_label = $label;
        return $this;
    }

    public function inputView($view = '')
    {
        $this->input_view = $view;
        return $this;
    }

    public function inputCreate()
    {
        $this->input_create = true;
        return $this;
    }

    public function inputEdit()
    {
        $this->input_edit = true;
        return $this;
    }

    public function rules($rules = [])
    {
        $this->rules_any = $rules;
        return $this;
    }

    public function rulesCreate($rules = [])
    {
        $this->rules_create = $rules;
        return $this;
    }

    public function rulesEdit($rules = [])
    {
        $this->rules_edit = $rules;
        return $this;
    }

    private function inputOptions($options)
    {
        return array_keys($options) === range(0, count($options) - 1) ? array_combine($options, $options) : $options;
    }
}
