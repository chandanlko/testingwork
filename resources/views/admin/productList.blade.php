@extends('layouts.app')

@section('title', 'Product')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Product</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Product</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
       <section class="content">
        <div class="alert alert-success alert-dismissible fade show Productalert" role="alert" style="display:none;">
            <strong id="successmsg"><strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="closemodelparent">
              <span aria-hidden="true">&times;</span>
            </button>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Product's List</h3>
                <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#modal-default">
                 <a href="/productadd" style="color:white"> Add New Product </a>
                  </button>
              </div>
              @if (session('successmessage'))
            <div class="alert alert-success">
                {{ session('successmessage') }}
            </div>
                @endif
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-hover data-table">
                <thead>
                    <tr>  
                        <th>Product Name</th>
                        <th>Default Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                  <tbody>
                    @if($products)
                    @foreach($products as $key=>$values)
                    <tr>
                      <td>
                        {{$values->product_name}}
                      </td>
                      <td>
                        {{$values->default_price}} 
                      </td>
                      <td>
                        <img src="{{asset('proimages')}}/{{$values->image}}" height="100px" width="100px">
                      </td>
                      <td>
                        <a class="btn btn-success" href="/productedit/{{$values->id}}"><i class="fa fa-edit"></i></a>
                        <a onclick="return confirm('Confirm Delete ?')" class="btn btn-danger" href="/productdelete/{{$values->id}}"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
           
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
        <!-- /.content -->

</div>

@endsection

