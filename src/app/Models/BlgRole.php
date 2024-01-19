<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlgUser;
class BlgRole extends Model
{
    use HasFactory;

    protected $table = 'blg_roles';

    public function users()
    {
        return $this->belongsToMany(BlgUser::class, 'blg_roles_users', 'blg_role_id', 'blg_user_id');
    }
}
