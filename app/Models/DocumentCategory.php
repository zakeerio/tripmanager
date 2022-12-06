<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Node\Block\Document;

class DocumentCategory extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'image'
    ];


    public function GetFiles(){
        return $this->hasMany(Documents::class, 'category_id', 'id');
    }
}


