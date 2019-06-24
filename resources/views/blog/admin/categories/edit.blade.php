@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form method="POST" action="{{ route('blog.admin.categories.update',$item->id) }}">
						@method('PATCH')
						@csrf
						<div class="container">
							<div class="row justify-content-center">
								<div class="col-md-8">
									@include('blog.admin.categories.include.item_main_col')
								</div>
								<div class="col-md-3">
									@include('blog.admin.categories.include.item_add_col')
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection
