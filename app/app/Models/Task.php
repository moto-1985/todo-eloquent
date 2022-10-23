<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'attached_file_path',
        'status',
        'start_date',
        'end_date',
    ];
    
    public function users()
    {
        return $this->belongsToMany(User::class)
        ->withPivot('is_bookmarked');
    }
}
