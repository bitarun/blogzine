<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileManager extends Model
{
    protected $table = 'article_files';
    protected $fillable = ['name', 'article_id'];
}
