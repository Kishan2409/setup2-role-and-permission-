<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'status',
        'password',
        'password_view',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_users');
    }


    public function permissions_user()
    {
        return $this->belongsToMany(PermissionUser::class, 'permission_users', 'user_id', 'permission_id');
    }

    public function hasPermission($per)
    {
        if (auth()->user()->role_id == 1) {
            return (bool) true;
        } else {
            $user = User::with(['permissions'])->where('id', auth()->user()->id)->get()->first();
            $access = false;

            if ($user->permissions->count() > 0) {
                foreach ($user->permissions as $p) {
                    if ($p->slug == $per) {
                        return true;
                    } else {
                        $access = false;
                    }
                }
            } else {
                $access = false;
            }

            if (!$access) {
                return false;
            }
        }
    }
}
