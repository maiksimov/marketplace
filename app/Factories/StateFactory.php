<?php
namespace App\Factories;


class StateFactory
{
    const IN_PROGRESS_STATE = 0;
    const COMPLETED_STATE = 1;
    const SHIPPED_STATE = 2;

    public function defaultState()
    {
        return self::IN_PROGRESS_STATE;
    }
}