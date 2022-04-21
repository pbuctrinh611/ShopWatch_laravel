@extends('admin.master')
@section('title')
Thương hiệu sản phẩm
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
                    <span class="card-title mr-3">Chi tiết</span>
                    <a href="{{ route('admin.brand.create') }}" class="btn btn-success">Tạo mới</a>
                  </div>
                </div>

                <div class="card-body">
                  <form method="POST" action="{{ route('admin.brand.update', ['id'=> $brand->id]) }}" 
                      enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{ $brand->id }}" disabled>
                      </div>
                    </div>
                    <div class="form-row">
                      {{-- Name --}}
                      <div class="form-group col-md-3">
                        <label for="name">Tên thương hiệu</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                          name="name" value="{{old('name') ? old('name') : $brand->name}}" autocomplete="off">
                        @error('name')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>

                      <div class="form-group col-md-3">
                        <label for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                          <option value="1">Hiển thị</option>
                          <option value="0" @if (!$brand->status) selected @endif>Ẩn</option>
                        </select>
                        @error('status')
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

@section('script')
<script src="{{ asset('admin/js/slug.js') }}"></script>
<script>
  $(function() {
    changeSlug($('input#name'), $('input#slug'), "{{ old('name') }}")
  })
</script>
@endsection