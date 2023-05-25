<?php

namespace Tests\Feature;

use App\Models\Apprentice;
use App\Models\Manager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRoleTest extends TestCase
{
    // reset database after testing
    use RefreshDatabase;

    /** @test */
    public function it_can_check_if_user_is_manager()
    {
        // Arrange
        $manager = Manager::factory()->create();
        $user = $manager->user;

        // Act
        $result = $user->isManager();

        // Assert
        $this->assertTrue($result);
    }

    /** @test */
    public function it_can_check_if_user_is_apprentice()
    {
        // Arrange
        $apprentice = Apprentice::factory()->create();
        $user = $apprentice->user;

        // Act
        $result = $user->isApprentice();

        // Assert
        $this->assertTrue($result);
    }
}
