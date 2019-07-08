<?php
namespace App\Repositories;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BlogCategoryRepository
 * @package App\Repositories
 */
class BlogPostRepository extends CoreRepository  {

    /**
     * @return string
     */
    protected function getModelClass() {

        return BlogPost::class;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getForeEdit($id){
        return $this->startConditions()->find($id);
    }

    /**
     * @return mixed
     */
    public function getCategoriesList(){
        $model = app(BlogCategoryRepository::class);
        return $model->getCategoriesList();

    }

    public function getAllWithPaginator($perPage = null){
        $columns = [
            'id',
            'title',
            'slug',
            'user_id',
            'category_id',
            'is_published',
            'published_at',
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id','DESC')
            //->with('category','author')
            ->with([
                'category' => function($query){
                    $query->select(['id','title']);
                },
                'author:id,name'])
            ->paginate($perPage);

        return $result;
    }
}