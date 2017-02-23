<?php

namespace sergiobelya\TestTaskmanager\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @author Serg
 */
class Photo extends Model
{
    protected $fillable = ['url'];

    public function task()
    {
        return belongsTo(Task::class);
    }

    public function uri()
    {
        return '/uploads/photo/' . $this->url;
    }
}
