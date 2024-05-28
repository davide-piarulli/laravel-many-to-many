<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    // dato che è una One to Many, il tipo ha molti projects
    // In una One to Many(dalla parte del hasMany) il nome della funzione deve essere il nome del Model (plurale)
    // questa funzione verrà letta come una proprietà del model
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    protected $fillable = [
        'name',
        'slug',
    ];
}
