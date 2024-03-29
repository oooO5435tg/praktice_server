<?php

namespace Model;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 0c6c70b21a890443d6c7ce3c7b62d7a8fba6474e
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
<<<<<<< HEAD
    protected $fillable = ['title_department'];

    public static function create($attributes): bool
    {
        $department = new self($attributes);
        return $department->save();
    }
=======
    
>>>>>>> 0c6c70b21a890443d6c7ce3c7b62d7a8fba6474e
}