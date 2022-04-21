@extends('admin.master')
@section('title')
Thương hiệu sản phẩm
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
              <a href="{{ route('admin.brand.create') }}" class="btn btn-success">Tạo mới</a>
            </div>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col" width="15%">ID</th>
                  <th scope="col">Tên thương hiệu</th>
                  <th scope="col" width="15%">Trạng Thái</th>
                  <th scope="col" width="15%">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($brands as $item)
                <tr>
                  <th>{{ $item->id }}</th>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->displayStatus() }}</td>
                  <td>
                    <div class="d-flex justify-content-center flex-wrap row">
                      <a href="{{ route('admin.brand.detail', ['id'=>$item->id]) }}" 
                        class="btn btn-info col-lg-5 col-sm-12">Xem</a>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <div class="d-flex mt-4 justify-content-between">
              <div>
                <div class="dataTables_info">Total: {{ $brands->total() }} entries</div>
              </div>
              <div>
                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                  {{ $brands->links() }}
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
