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
        'id_position'
    ];

    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class, 'list_disciplines', 'id_user', 'id_discipline');
    }

    public function position()
    {
        return $this->hasOne(Position::class, 'id_position', 'id_position');
    }
}