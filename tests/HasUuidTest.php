<?php

namespace Ludo237\EloquentTraits\Tests;

use Ludo237\EloquentTraits\Tests\Stubs\User;
use Ramsey\Uuid\Uuid;

/**
 * Class HasUuidTest
 * @package Ludo237\EloquentTraits\Tests;
 */
class HasUuidTest extends TestCase
{
    /**
     * @test
     * @covers \Ludo237\EloquentTraits\HasUuid::uuidField
     */
    public function it_returns_the_right_uuid_field()
    {
        $this->assertEquals("uuid", User::uuidField());
    }
    
    /**
     * @test
     * @covers \Ludo237\EloquentTraits\HasUuid::bootHasUuid
     */
    public function an_uuid_will_be_assigned_on_creating()
    {
        $user = User::query()->create(["name" => "foo"]);
        
        $this->assertTrue(
            Uuid::isValid($user->uuid)
        );
    }
    
    /**
     * @test
     * @covers \Ludo237\EloquentTraits\HasUuid::getShortUuidAttribute
     */
    public function it_returns_the_short_uuid()
    {
        $user = User::query()->create(["name" => "foo"]);
        
        $this->assertStringEndsWith($user->short_uuid, $user->uuid);
    }
    
    /**
     * @test
     * @covers \Ludo237\EloquentTraits\HasUuid::scopeWhereUuid
     */
    public function it_can_be_scoped_by_the_uuid()
    {
        $user = User::query()->create(["name" => "foo"]);
        
        $fetchedUser = User::whereUuid($user->uuid)->first();
        
        $this->assertNotNull($fetchedUser);
        $this->assertEquals($user->id, $fetchedUser->id);
    }

    /**
     * @test
     * @covers \Ludo237\EloquentTraits\HasUuid::scopeOrWhereUuid
     */
    public function it_can_be_scoped_eventually_by_the_uuid()
    {
        $user = User::query()->create(["name" => "foo"]);
        
        $fetchedUser = User::where("name", "invalid")->orWhereUuid($user->uuid)->first();
        
        $this->assertNotNull($fetchedUser);
        $this->assertEquals($user->id, $fetchedUser->id);
    }
}
