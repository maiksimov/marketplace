<?php
namespace App\Factories;


use App\Exceptions\NotFoundStateException;

class StateFactory
{
    const IN_PROGRESS_STATE = 0;
    const COMPLETED_STATE = 1;
    const SHIPPED_STATE = 2;

    public function stateName(int $state)
    {
        if(!in_array($state, $this->allStates())) {
            throw new NotFoundStateException('Wrong state');
        }

        return array_search($state, $this->allStates());
    }

    public function allStates()
    {
        return [
            'in progress' => self::IN_PROGRESS_STATE,
            'completed' => self::COMPLETED_STATE,
            'shipped' => self::SHIPPED_STATE,
        ];
    }

    public function defaultState()
    {
        return self::IN_PROGRESS_STATE;
    }
}