<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'id_user',
        'surname',
        'name',
        'patronymic',
        'gender',
        'birthday',
        'adress',
        'id_department',
        'id_position',
    ];
}