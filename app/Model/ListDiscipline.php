<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListDiscipline extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id_list',
        'id_user',
        'id_discipline'
    ];
}