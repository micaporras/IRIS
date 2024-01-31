<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    use HasFactory;
    public $table = 'todos';
    protected $fillable = ['name', 'description', 'start', 'end', 'status', 'createdby'];
}
