<?php

namespace App\Models;

use App\Traits\Models\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperRole
 */
class Role extends Model
{
    use HasFactory;
    use HasLog;

    const ADMIN = 1;

    protected $fillable = [
        'title',
    ];
}
