<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artical extends Model
{
    use HasFactory;

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = null;
}
