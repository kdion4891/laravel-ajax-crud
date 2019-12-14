<?php

namespace Kdion4891\Lac\Components;

class LacBulkAction
{
    private $label;
    private $method;
    private $confirm;
    private $confirm_message;

    public function __get($property)
    {
        return $this->$property;
    }

    public function __construct($label = '', $method = '')
    {
        $this->label = $label;
        $this->method = $method;
    }

    public static function delete()
    {
        return self::make(__('Delete'), 'destroyBulk')->confirm(__('Are you sure?'));
    }

    public static function make($label = '', $method = '')
    {
        return new LacBulkAction($label, $method);
    }

    public function confirm($message = '')
    {
        $this->confirm = true;
        $this->confirm_message = $message;
        return $this;
    }
}
