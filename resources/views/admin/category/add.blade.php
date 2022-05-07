@extends('admin.master')
@section('title')
Danh mục sản phẩm
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
                    <span class="card-title mr-3">Tạo mới</span>
                  </div>
                </div>

                <div class="card-body">
                  <form method="POST" action="{{ route('admin.category.create') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="form-row">
                      {{-- Name --}}
                      <div class="form-group col-md-3">
                        <label for="name">Tên danh mục:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                          name="name" value="{{old('name')}}">
                        @error('name')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Lưu</button>
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