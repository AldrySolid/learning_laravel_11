<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperLog
 */
class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'parent_class',
        'parent_id',
        'event',
        'before',
        'after',
    ];
}
