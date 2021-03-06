<?php

namespace Ludo237\EloquentTraits\Tests\Stubs;

use Illuminate\Database\Eloquent\Model;
use Ludo237\EloquentTraits\OwnedByUser;

/**
 * Class Post
 * @package Ludo237\EloquentTraits\Tests\Stubs
 */
class Post extends Model
{
    use OwnedByUser;
    
    protected $fillable = ["user_id"];
    
    protected function ownerClass() : string
    {
        return User::class;
    }
}
