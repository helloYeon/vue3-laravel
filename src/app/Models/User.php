<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class User extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'state',
        'plan_type',
        'mail',
        'mail_change_req',
        'mail_verified_at',
        'password',
        'access_token',
        'last_login_date',
        'last_name',
        'first_name',
        'display_name',
        'sex',
        'age',
        'reason',
        'line_user_id',
        'line_access_token',
        'line_refresh_token',
        'line_state',
        'line_picture_url',
        'line_error_code',
        'line_id_token',
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y/m/d H:i:s');
    }
}
