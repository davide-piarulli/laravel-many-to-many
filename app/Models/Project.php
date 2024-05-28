<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // dato che è una One to Many, il Project appartiene ad un Type e quindi anche il Model.
    // In una One to Many(dalla parte del belongsTo) il nome della funzione deve essere il nome del Model (singolare)
    // questa funzione verrà letta come una proprietà del model
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
    protected $fillable = [
        'title',
        'slug',
        'link',
        'type_id',
        'img',
        'img_original_name',
        'description',
    ];
}
