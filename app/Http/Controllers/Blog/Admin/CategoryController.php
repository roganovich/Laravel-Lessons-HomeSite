<?php

namespace App\Http\Controllers\Blog\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;

class CategoryController extends BaseController
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$paginator = BlogCategory::paginate(10);
		return view('blog.admin.categories.index', ['paginator'=>$paginator]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
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
		$item = BlogCategory::findOrFail($id);
		return view('blog.admin.categories.edit',['item'=>$item]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
  		$item = BlogCategory::find($id);
		if(empty($item)){
			return back()
		  		->withErrors(['msg'=>"Запись #{$id} не найдена!"])
		  		->withInput();
		}
		$data= $request->input();
		$result = $item->fill($data);
		if($result->save()){
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
