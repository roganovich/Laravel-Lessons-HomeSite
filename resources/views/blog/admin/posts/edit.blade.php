@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					@if($item->exists)
						<form method="POST" action="{{ route('blog.admin.posts.update',$item->id) }}">
						@method('PATCH')
					@else
						<form method="POST" action="{{ route('blog.admin.posts.store') }}">
					@endif
					@csrf
						<div class="container">

							@if($errors->any())
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
								  	{{ $errors->first() }}
								  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    	<span aria-hidden="true">&times;</span>
						  			</button>
								</div>
							@endIf

							<div class="row justify-content-center">
								<div class="col-md-8">
									@include('blog.admin.posts.include.item_main_col')
								</div>
								<div class="col-md-3">
									@include('blog.admin.posts.include.item_add_col')
								</div>
							</div>
						</div>
					</form>
				</div>

				@if($item->exists)
					<br>
					<form method="POST" action="{{ route('blog.admin.posts.destroy',$item->id) }}">
						@method('DELETE')
						@csrf
						<button type="submit" class="btn btn-danger"/>Удалить</button>
					</form>
				@endif
			</div>

		</div>
	</div>
</div>
@endsection
