@extends('layouts.dashboard')

@section('Brand')
active
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin.dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Brand</li>
    </ol>
  </nav>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
           <div class="card">
               <div class="card-body">Add Brand</div>
               <div class="card-header">
                <div class="card pd-20 pd-sm-40">
                    <div class="table-wrapper">
                      <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                          <tr>
                            <th class="wd-25p">Brand Image</th>
                            <th class="wd-25p">Brand Name</th>
                            <th class="wd-25p">status</th>
                            <th class="wd-25p">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($brands as $brand)
                          <tr>
                            <td>
                              <img width="100" src="{{ asset($brand->brand_image) }}" alt="">
                            </td>
                            <td>{{ $brand->brand_name }}</td>
                            <td>
                              @if ($brand->status == 1)
                               <span class="badge badge-pill badge-success">Active</span>
                               @else
                                 <span class="badge badge-pill badge-danger">Deactive</span>
                              @endif
                          </td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ url('admin/edit') }}/{{ $brand->id }}" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a href="{{ url('admin/brand/soft') }}/{{ $brand->id }}"  type="button" class="btn btn-info btn-sm" title="Soft Delete"><i class="fa fa-trash"></i></a>
                                @if ($brand->status == 1)
                                 <a href="{{ url('admin/inactive') }}/{{ $brand->id }}"  type="button" class="btn btn-danger btn-sm" title="Inactive"><i class="fa fa-arrow-down"></i></a>
                                 @else  
                                  <a href="{{ url('admin/active') }}/{{ $brand->id }}"  type="button" class="btn btn-info btn-sm" title="Active"><i class="fa fa-arrow-up"></i></a>
                                   @endif 
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
               </div>
           </div>
           <br>
        {{--    <div class="card">
            <div class="card-body">Trash Data</div>
            <div class="card-header">
             <div class="card pd-20 pd-sm-40">
                 <div class="table-wrapper">
                   <table id="datatable2" class="table display responsive nowrap">
                     <thead>
                       <tr>
                         <th class="wd-25p">Brand Image</th>
                         <th class="wd-25p">Brand Name En</th>
                         <th class="wd-25p">Brand Name Bn</th>
                         <th class="wd-25p">Action</th>
                       </tr>
                     </thead>
                     <tbody>
                       @foreach ($trashed as $trash)
                       <tr>
                         <td>
                           <img width="100" src="{{ asset('uploaded/brand_image') }}/{{ $trash->brand_image }}" alt="">
                         </td>
                         <td>{{ $trash->brand_name_en }}</td>
                         <td>{{ $trash->brand_name_bn }}</td>
                         <td>
                           <div class="btn-group" role="group" aria-label="Basic example">
                             <a href="{{ url('admin/trashed') }}/{{ $trash->id }}" class="btn btn-info btn-sm" title="restore">restore</a>
                             <a href="{{ url('admin/delete') }}/{{ $trash->id }}" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i></a>
                           </div>
                         </td>
                       </tr>
                       @endforeach
                     </tbody>
              
                   </table>
                 </div>
               </div>
            </div>
        </div> --}}
        </div>
        <div class="col-md-4">
         <div class="card">
             <div class="card-header">Add Brand</div>
             <div class="card-body">
                <form method="POST" action="{{ route('brand.post') }}" enctype="multipart/form-data">
                  @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Brand Name</label>
                      <input type="text" class="form-control" name="brand_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Brand Name">
                      @error('brand_name')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror

                    </div>
                       <div class="form-group">
                      <label for="exampleInputPassword1">Brnad Image</label>
                      <input type="file" name="brand_image" class="form-control" id="exampleInputPassword1" placeholder="Brand Image</th">
                      @error('brand_image')
                      <span class="text-danger">{{ $message }}</span>
                     @enderror
                    </div>
                    <button type="submit" style="cursor: pointer" class="btn btn-primary">Add Brand</button>
                  </form>
             </div>
         </div>
        </div>
    </div>
</div>

@endsection