<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class BlogCategory extends Model
{

    use SoftDeletes;

    const ROOT = 0;

    protected $fillable  = [
        'title',
        'slug',
        'parent_id',
        'description',
    ];

    /**
     * Возвращает объект родительской категории
     * @return BlogCategory
    */
    public function parentCategory(){
        return $this->belongsTo(BlogCategory::class,'parent_id','id');
    }


    /**
     * Возвращает title родительской категории
     * @return string
    */
    public function getParentTitleAttribute(){
        return $this->parentCategory->title ?? ($this->isRoot() ? 'Корень':'?');
    }

    /**
     * определяет корень категорий
     * @return bool
     */
    public function isRoot(){
        return ($this->parent_id === self::ROOT);
    }

}
