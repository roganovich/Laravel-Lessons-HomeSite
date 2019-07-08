<div class="row justify-content-center">
	<div class="col-md-12">
		@if($errors->any())
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  	{{ $errors->first() }}
			  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    	<span aria-hidden="true">&times;</span>
	  			</button>
			</div>
		@endIf

		@if(session('success'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				{{ session()->get('success') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		@endIf

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
					<label for="excerpt">Slug</label>
					<input type="text" class="form-control" name="excerpt"  value="{{ old('excerpt', $item->excerpt)  }}"/>
				</div>
				<div class="form-group">
						<label for="content_raw">Content Raw</label>
						<textarea name="content_raw" class="form-control">{{ old('content_raw', $item->content_raw)  }}</textarea>
				</div>
				<div class="form-group">
					<label for="content_html">Content Html</label>
					<textarea name="content_html" class="form-control">{{ old('content_html', $item->content_html)  }}</textarea>
				</div>
			</div>

		</div>

	</div>
</div>
