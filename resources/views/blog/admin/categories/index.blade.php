@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<nav class="navbar">
				<a class="btn btn-primary" href="{{ route('blog.admin.categories.create') }}">Добавить</a>
			</nav>
			<div class="card">
				<div class="card-body">
					<table class="table table-border-white">
						<thead>
							<tr>
								<th>#</th>
								<th>Название</th>
								<th>Slug</th>
								<th>Родитель</th>
								<th>Действие</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($paginator as $item)
							<tr>
								<td>{{ $item->id }}</td>
								<td>{{ $item->title }}</td>
								<td>{{ $item->slug }}</td>
								<td  @if (in_array($item->parent_id,[0,1])) style="color:#ccc"  @endif style="">
									{{ $item->getParent()->title }}
								</td>
								<td><a href="{{ route('blog.admin.categories.edit',$item->id) }}">Изменить</a></td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
			@if( $paginator->total() > $paginator->count() )
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								{{ $paginator->links() }}
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
</div>
@endsection
