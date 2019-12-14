<?php

namespace Kdion4891\Lac\Components;

class LacAction
{
    private $view;

    public function __get($property)
    {
        return $this->$property;
    }

    public function __construct($view = '')
    {
        $this->view = $view;
    }

    public static function details()
    {
        return self::make('lac::models.actions.details');
    }

    public static function edit()
    {
        return self::make('lac::models.actions.edit');
    }

    public static function delete()
    {
        return self::make('lac::models.actions.delete');
    }

    public static function make($view = '')
    {
        return new LacAction($view);
    }
}
