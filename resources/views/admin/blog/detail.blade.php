@extends('admin.master')
@section('title')
Manage Blog
@endsection
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="d-flex  align-items-center">
                    <span class="card-title mr-3">Blog Detail</span>
                    <a href="{{ route('admin.blog.create') }}" class="btn btn-success">Create new</a>
                  </div>
                </div>

                <div class="card-body">
                  <form method="POST" action="{{ route('admin.blog.update', ['id' => $blog->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-row">
                      {{-- ID --}}
                      <div class="form-group col-md-3">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" value="{{ $blog->id }}" disabled>
                      </div>
                      {{-- Update at --}}
                      <div class="form-group col-md-3">
                        <label>Create at</label>
                        <input type="text" class="form-control" value="{{ $blog->created_at }}" disabled>
                      </div>
                      {{-- Update at --}}
                      <div class="form-group col-md-3">
                        <label>Updated at</label>
                        <input type="text" class="form-control" value="{{ $blog->updated_at }}" disabled>
                      </div>
                    </div>
                    {{-- Title --}}
                    <div class="form-group">
                      <label for="title">Title:</label>
                      <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{old('title') ?? $blog->title}}" autocomplete="off">
                      @error('title')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    
                    {{-- Thumbnail --}}
                    <div class="form-group">
                      <label for="file">Thumbnail:</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input name="image" type="file" class="custom-file-input @error('image') is-invalid @enderror" 
                            id="file" accept="image/*">
                          <label class="custom-file-label" for="file">Choose file</label>
                        </div>
                      </div>
                      @error('image')
                      <div class="invalid-feedback d-block">
                        {{ $message }}
                      </div>
                      @enderror
                      <div id="preview-image" class="preview-image d-flex flex-wrap">
                        <div id="preview-image" class="preview-image mb-2">
                          <div class="contain-image">
                            <img class="image" src="{{ asset('storage/'.$blog->image) }}">
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- Content --}}
                    <div class="form-group">
                      <label for="content">Content</label>
                      @error('content')
                      <div class="invalid-feedback d-block">
                        {{ $message }}
                      </div>
                      @enderror
                      <textarea class="form-controls" id="content" rows="4" name="content">
                        {{old('content') ?? $blog->content}}
                      </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</section>
@endsection

@section('link_css')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
@endsection

@section('script')
<script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('admin/js/preview-image.js') }}"></script>
<script src="{{ asset('admin/js/slug.js') }}"></script>
<script>
  $(function() {
    $('#content').summernote({
      height: 400,
    })
    
    imagePreview('#file');
    bsCustomFileInput.init();
    
    changeSlug($('input#title'), $('input#slug'), "{{ old('title') }}")
  })
</script>
@endsection