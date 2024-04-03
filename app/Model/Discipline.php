<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id_discipline',
        'title_discipline'
    ];

    public function employers()
    {
        return $this->belongsToMany(Employer::class, 'list_disciplines', 'id_discipline', 'id_user');
    }
}