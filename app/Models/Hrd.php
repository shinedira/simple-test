<?php

namespace App\Models;

use App\Http\Filters\HrdFilter;
use Laravel\Sanctum\HasApiTokens;
use App\Service\Filter\FilterAble;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Hrd extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, FilterAble;

    protected $filterClass = HrdFilter::class;

    protected $fillable = [
        'name',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    public function getRoleAttribute()
    {
        return $this->roles->first()->name;
    }
}
