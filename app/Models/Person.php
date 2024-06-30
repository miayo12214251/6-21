<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    
    protected $table = 'person';
    
    public function posts()
    {
        return $this->hasMany(Post::class);  
    }

    protected $fillable = [
        'name',
        'team',
    ];
    
    public function getPaginateByLimit(int $limit_count = 5)
    {
     return $this->orderBy('created_at2', 'DESC')->paginate($limit_count);
    }
}