<?php

namespace App\Models;

use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;
    
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    public $timestamps = false;

    protected $fillable = [
        'menu_name',
        'price',
        'id_category',
        'description',
        'status'
    ];

    public function category() {
        return $this->belongsTo(Categories::class, 'id_category');
    }
}
