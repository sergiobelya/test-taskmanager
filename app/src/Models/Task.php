<?php

namespace sergiobelya\TestTaskmanager\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @author Serg
 */
class Task extends Model
{
    protected $fillable = ['username', 'email', 'task_body'];

    public function photo()
    {
        return $this->hasOne(Photo::class);
    }
    
}
