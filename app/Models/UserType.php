<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserType extends Model
{
    use CrudTrait, HasFactory;

    protected $table = 'user_types';

    protected $fillable = ['name'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
