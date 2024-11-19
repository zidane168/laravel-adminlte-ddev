<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory; 
    protected $fillable = ['slug']; 
    
    public function translations() { 
        return $this->hasMany(PostTranslation::class); 
    } 
    
    public function getTranslation($locale) { 
        return $this->translations()->where('locale', $locale)->first();
    }
}
