@extends('layouts.app')

@section('title', 'Category')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Category</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Category</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
       <section class="content">
        <div class="alert alert-success alert-dismissible fade show Categoryalert" role="alert" style="display:none;">
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
                <h3 class="card-title">Category's List</h3>
                <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#modal-default">
                 <a href="/categoryadd" style="color:white"> Add New Category </a>
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
                        <th>Name</th>
                        <th>Parent Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                  <tbody>
                    @if($cat)
                    @foreach($cat as $key=>$values)
                    <tr>
                      <td>
                        {{$values->name}}
                      </td>
                      <td>
                        {{$values->parentname}} 
                      </td>
                      <td>
                        <a class="btn btn-success" href="/categoryedit/{{$values->id}}"><i class="fa fa-edit"></i></a>
                        <a onclick="return confirm('Confirm Delete ?')" class="btn btn-danger" href="/categorydelete/{{$values->id}}"><i class="fa fa-trash"></i></a>
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

