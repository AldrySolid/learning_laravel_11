<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperProfile
 */
class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'second_name',
        'third_name',
        'phone',
        'status',
        'birthday',
        'login',
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
