<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public const SUPER_ADMIN = 'SuperAdmin';
    public const ADMIN = 'Admin';
    public const MEMBER = 'Member';
    public const SALES = 'Sales';
    public const MANAGER = 'Manager';

    protected $fillable = ['name', 'description'];
    public $timestamps = false;
}
