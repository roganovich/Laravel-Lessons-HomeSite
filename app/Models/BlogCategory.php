<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class BlogCategory extends Model
{

    use SoftDeletes;

    protected $fillable  = [
        'title',
        'slug',
        'parent_id',
        'description',
    ];

    private $_parent;
    private $_categoriesList;

    public function getParent(){
        if(!$this->_parent){
          $this->_parent = BlogCategory::find(($this->parent_id)?$this->parent_id:1);
        }
        return $this->_parent;
    }

}
