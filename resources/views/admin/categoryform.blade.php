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
            
              
            @if (session('errormsg'))
            <div class="alert alert-danger">
                {{ session('errormsg') }}
            </div>
                @endif
        <div class="card card-info">
                            <div class="card-header">
                            <h3 class="card-title">{{$title}}</h3>
                            </div>


                            <form class="form-horizontal" action ="/savecategory" method="post">
                            <div class="card-body">
                            @csrf
                            <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Parent Category</label>
                            <div class="col-sm-10">
                            <select class="form-control" name="parent_id">
                            <option value=0>Select Parent Category</option>
                            @if($category)
                            @foreach($category as $key=>$values)
                            <option value={{$values->id}} @if(isset($data->parent_id)) @if($data->parent_id==$values->id) selected @endif @endif >{{$values->name}}</option>
                            @endforeach
                            @endif
                            </select>
                            </div>
                            </div>
                            <input type="hidden" name="category_old_id" value={{isset($data->id)?$data->id:""}}>
                            <div class="form-group row">
                            <label for="category_idd" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                            <input type="text" name="category_name" class="form-control" id="category_idd" placeholder="Enter Unique Category" required value='{{isset($data->name)?$data->name:''}}'>
                            </div>
                            </div>

                            </div>

                            <div class="card-footer">
                            <button type="submit" class="btn btn-info">Save</button>
                            <button type="submit" class="btn btn-default float-right"> <a href="/categories">Cancel </a></button>
                            </div>

                            </form>
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

