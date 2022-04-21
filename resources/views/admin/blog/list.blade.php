@extends('admin.master')
@section('title')
Bài viết
@endsection
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex  align-items-center">
              <span class="card-title mr-3">Danh sách</span>
              <a href="{{ route('admin.blog.create') }}" class="btn btn-success">Tạo mới</a>
            </div>
          </div>
          <div class="card-body pb-0">
            <form method="GET" action="{{ route('admin.blog.search') }}">
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="title">Title:</label>
                  <input type="text" class="form-control" id="title" name="title" value ="{{ $request['title'] ?? '' }}"
                    autocomplete="off">
                </div>
                <button type="submit" class="btn btn-primary align-self-end mb-3 ml-2">Tìm kiếm</button>
              </div>
            </form>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped table-fix">
              <colgroup>
                <col span="1" style="width: 10%;">
                <col span="1" style="width: 30%;">
                <col span="1" style="width: 15%;">
                <col span="1" style="width: 15%;">
              </colgroup>
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Tiêu đề</th>
                  <th scope="col">Thời gian cập nhật</th>
                  <th scope="col">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($blogs as $item)
                <tr>
                  <th>{{ $item->id }}</th>
                  <td class="td-nowrap" title="{{$item->title}}">{{ $item->title }}</td>
                  <td>{{ $item->updated_at }}</td>
                  <td  width="20%">
                    <div class="d-flex justify-content-center flex-wrap row">
                      <a href="{{ route('admin.blog.detail', ['id'=>$item->id]) }}" class="btn btn-info col-lg-5 col-sm-12">Xem</a>
                        <div class="m-1"></div>
                      <a href="#" class="btn btn-danger btn-delete col-lg-5 col-sm-12" data-id="{{ $item->id }}">Xóa</a>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex mt-4 justify-content-between">
              <div>
                <div class="dataTables_info">Total: {{ $blogs->total() }} entries</div>
              </div>
              <div>
                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                  {{ $blogs->links() }}
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
<script src="{{ asset('admin/dist/js/sweet-alert.js') }}"></script>
<script src="{{ asset('js/ajax.js') }}"></script>
<script>
  $(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  })
</script>
@endsection