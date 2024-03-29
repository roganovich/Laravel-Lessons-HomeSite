<div class="row justify-content-center">
	<div class="col-md-12">

		@if(session('success'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				{{ session()->get('success') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		@endIf

		@if($item->is_published)
			<div class="alert alert-success" role="alert">
				Опубликовано
			</div>
		@else
			<div class="alert alert-secondary" role="alert">
				Черновик
			</div>
		@endif

		<div class="card">
			<div class="card-body">
				<div class="form-group">
						<label for="title">Title</label>
						<input type="text"  name="title" class="form-control" value="{{ old('title', $item->title)  }}"/>
				</div>
				<div class="form-group">
						<label for="slug">Slug</label>
						<input type="text" class="form-control" name="slug"  value="{{ old('slug', $item->slug)  }}"/>
				</div>
				<div class="form-group">
						<label for="category_id">Category</label>
						<select class="form-control" name="category_id">
							@foreach ($categoryList as $category)
								<option value="{{ $category->id }}" @if ($category->id == $item->category_id) selected @endif>{{ $category->id_title }}</option>
							@endforeach
						</select>
				</div>
				<div class="form-group">
						<label for="content_raw">Content Raw</label>
						<textarea name="content_raw" class="form-control">{{ old('content_raw', $item->content_raw)  }}</textarea>
				</div>
				<div class="form-group">
					<label for="content_html">Content Html</label>
					<textarea name="content_html" class="form-control">{{ old('content_html', $item->content_html)  }}</textarea>
				</div>
				<div class="form-check">
					<label for="is_published" class="form-check-label">
					<input type="hidden" name="is_published" value="0">
					<input type="checkbox" name="is_published" class="form-check-input" value="1" @if($item->is_published) checked @endif>
					Опубликован?</label>
				</div>
			</div>

		</div>

	</div>
</div>
