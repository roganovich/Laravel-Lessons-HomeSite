<?php

namespace App\Http\Controllers\Blog\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Http\Requests\BlogCategoryFormRequest;
use App\Repositories\BlogCategoryRepository;


/**
 * Class CategoryController
 * @package App\Http\Controllers\Blog\Admin
 */
class CategoryController extends BaseController
{

    /*
     * @var BlogCategoryRepository
    */
    private $blogCategoryRepository;

    public function __construct() {
        parent::__construct();
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$paginator = $this->blogCategoryRepository->getAllWithPaginator(10);
		return view('blog.admin.categories.index', ['paginator'=>$paginator]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$item = new BlogCategory();
        $categoryList = $this->blogCategoryRepository->getCategoriesList();
        return view('blog.admin.categories.edit',['item'=>$item, 'categoryList'=>$categoryList]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(BlogCategoryFormRequest $request)
	{
		$item = new BlogCategory();
		if($item->create($request->input())){
			return redirect()
				->route('blog.admin.categories.index')
				->with(['success'=>'Успешно!']);
		}else{
			return back()
		  		->withErrors(['msg'=>"Ошибка сохранения!"])
		  		->withInput();
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$item = $this->blogCategoryRepository->getForeEdit($id);
		if(empty($item)){
		    abort(404);
        }
		$categoryList = $this->blogCategoryRepository->getCategoriesList();
		return view('blog.admin.categories.edit',['item'=>$item, 'categoryList'=>$categoryList]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(BlogCategoryFormRequest $request, $id)
	{
  		$item = BlogCategory::find($id);
		if(empty($item)){
			return back()
		  		->withErrors(['msg'=>"Запись #{$id} не найдена!"])
		  		->withInput();
		}
		$data= $request->input(); //Не валидированные данные
		//$validateData = $request->validate();//Валидированные данные

		//dd($validateData);
		$data['slug'] = (empty($data['slug']))?Str::slug($data['title']):$data['slug'];
		//$result = $item->fill($data);
		//$result->save()
		if($item->update($data)){
			return redirect()
				->route('blog.admin.categories.edit', $item->id)
				->with(['success'=>'Успешно!']);
		}else{
			return back()
		  		->withErrors(['msg'=>"Ошибка сохранения!"])
		  		->withInput();
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
