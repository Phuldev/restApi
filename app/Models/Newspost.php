<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newspost extends Model
{
    protected $table = 'newsposts';
    protected $fillable = [
      'user_id',
      'title',
      'details',
      'category',
      'custom_url',
      'tags',
      'story_external_source_name',
      'story_external_source_url',
      'image_external_source_credit',
      'image_external_source_url',
      'created_at',
      'updated_at'
    ];
    use HasFactory;
}
