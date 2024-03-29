<?php

namespace Model;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 0c6c70b21a890443d6c7ce3c7b62d7a8fba6474e
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
<<<<<<< HEAD
    protected $fillable = ['title_discipline'];

    public static function create($attributes): bool
    {
        $discipline = new self($attributes);
        return $discipline->save();
    }
=======
    
>>>>>>> 0c6c70b21a890443d6c7ce3c7b62d7a8fba6474e
}