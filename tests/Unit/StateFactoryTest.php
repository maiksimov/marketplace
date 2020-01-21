<?php

namespace Tests\Unit;

use App\Exceptions\NotFoundStateException;
use App\Factories\StateFactory;
use PHPUnit\Framework\TestCase;

class StateFactoryTest extends TestCase
{
    const WRONG_STATE = 123;
    const IN_PROGRESS_STATE = 0;
    const COMPLETED_STATE = 1;
    const SHIPPED_STATE = 2;
    const IN_PROGRESS_STATE_NAME = 'in progress';
    const COMPLETED_STATE_NAME = 'completed';
    const SHIPPED_STATE_NAME = 'shipped';

    private $stateFactory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->stateFactory = new StateFactory();
    }

    /** @test */

    public function a_state_factory_has_default_state()
    {
        $this->assertEquals(self::IN_PROGRESS_STATE, $this->stateFactory->defaultState());
    }

    /** @test */

    public function a_state_factory_has_return_states_array()
    {
        $this->assertTrue(is_array($this->stateFactory->allStates()));
    }

    /** @test */

    public function a_state_factory_has_in_progress_state()
    {
        $this->assertEquals(self::IN_PROGRESS_STATE_NAME, $this->stateFactory->stateName(self::IN_PROGRESS_STATE));
    }

    /** @test */

    public function a_state_factory_has_completed_state()
    {
        $this->assertEquals(self::COMPLETED_STATE_NAME, $this->stateFactory->stateName(self::COMPLETED_STATE));
    }

    /** @test */

    public function a_state_factory_has_shipped_state()
    {
        $this->assertEquals(self::SHIPPED_STATE_NAME, $this->stateFactory->stateName(self::SHIPPED_STATE));
    }

    /** @test */

    public function a_state_factory_has_return_exception_when_wrong_state()
    {
        $this->expectException(NotFoundStateException::class);
        $this->stateFactory->stateName(self::WRONG_STATE);
    }
}
