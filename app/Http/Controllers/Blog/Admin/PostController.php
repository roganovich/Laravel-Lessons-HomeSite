<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogPostFormRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogPostRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends BaseController
{

    private $blogPostRepository;

    public function __construct() {
        parent::__construct();
        $this->blogPostRepository = app(BlogPostRepository::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginator(25);
        return view('blog.admin.posts.index', ['paginator'=>$paginator]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = $this->blogPostRepository->getCategoriesList();
        return view('blog.admin.posts.edit',['item'=>$item, 'categoryList'=>$categoryList]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogPostFormRequest $request)
    {
        $data= $request->input();
        $data['slug'] = (empty($data['slug']))?Str::slug($data['title']):$data['slug'];

        $item = new BlogCategory();

        if($item->create($data)){
            return redirect()
                ->route('blog.admin.posts.index')
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
        $item = $this->blogPostRepository->getForeEdit($id);
        if(empty($item)){
            abort(404);
        }
        $categoryList = $this->blogPostRepository->getCategoriesList();
        return view('blog.admin.posts.edit',['item'=>$item, 'categoryList'=>$categoryList]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostFormRequest $request, $id)
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
                ->route('blog.admin.posts.edit', $item->id)
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
