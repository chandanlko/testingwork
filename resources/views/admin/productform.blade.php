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
                            <?php if(isset($data->id))
                              $url="/savediteproduct";
                            else
                              $url="/savproduct";
                               ?>

                            <form class="form-horizontal" action ="{{$url}}" method="post" enctype= multipart/form-data>
                            <div class="card-body">
                            @csrf
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Parent Category</label>
                                <div class="col-sm-10">
                                <select class="form-control" name="parent_id" id="parent_iddd">
                                <option value=0>Select Category</option>
                                @if($category)
                                @foreach($category as $key=>$values)
                                <option value={{$values->id}} @if(isset($data->category_id)) @if($data->category_id==$values->id) selected @endif @endif >{{$values->name}}</option>
                                @endforeach
                                @endif
                                </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Sub Category</label>
                                <div class="col-sm-10">
                                <select class="form-control" name="subcat_id" id="subcat_id">
                                <option value=0>Select Sub Category</option>
                               
                                </select>
                                </div>
                            </div>
                            <input type="hidden" name="product_id_old" value={{isset($data->id)?$data->id:""}}>
                            <div class="form-group row">
                                <label for="product_name" class="col-sm-2 col-form-label">Product Name</label>
                                <div class="col-sm-10">
                                <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Enter Product Name" required value='{{isset($data->product_name)?$data->product_name:''}}'>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_desc" class="col-sm-2 col-form-label">Product Desc</label>
                                <div class="col-sm-10">
                                  <textarea name="product_desc" class="form-control" id="product_desc" placeholder="Enter Desc">{{isset($data->product_desc)?$data->product_desc:''}}</textarea>
                                  
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="default_price" class="col-sm-2 col-form-label">Default Price</label>
                                <div class="col-sm-10">
                                  <input type="text" name="default_price" class="form-control" id="default_price" required placeholder="Enter Product Name" required value='{{isset($data->default_price)?$data->default_price:''}}'>
                                </div>
                            </div>
                            @if(isset($data->image))
                             <div class="form-group row">
                                  <label for="Image" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-8">
                                  <img src="{{asset('proimages')}}/{{$data->image}}" height="100px" width="100px">
                                 
                                </div>
                                <input type="hidden" value="{{$data->image}}" name="old_images">
                                <div class="col-sm-2">
                                <span class="float-right" style="color:red;">Note: Image will be replace by new selected Image</span>
                                </div>
                            </div>
                           @endif
                            <div class="form-group row">
                                  <label for="Image" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                  <input type="file" name="Image" class="form-control" id="Image">
                                 
                                </div>
                            </div>

                            <div class="form-group row">
                                  <label for="default_price" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                  <span class="btn btn-success" id="addvariation">Add Variation</span>
                                 
                                </div>
                            </div>
                            @if(!empty($variation))
                            @foreach($variation as $key=>$valuess)
                            <div class="form-group row">
                              <label for="default_price" class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-2">
                                <input placeholder="Material" type="text" name="material[]" class="form-control" value="{{$valuess->material}}"></div><div class="col-sm-2">
                                <input placeholder="Pack Size" type="text" name="pack_size[]" class="form-control"  value="{{$valuess->pack_size}}">
                              </div><div class="col-sm-2">
                                <input placeholder="Demension" type="text" name="dimension[]" class="form-control" value="{{$valuess->demesion}}"></div><div class="col-sm-2">
                                <input placeholder="Price" type="text" name="price[]" class="form-control" value="{{$valuess->price}}"></div><div class="col-sm-2">
                                <span class="btn btn-danger removebtn" onclick="removebtndata(this)"> X</span>
                                </div>
                              </div>
                              @endforeach
                              @endif
                              
                             <div class="form-group row">
                                  <label for="default_price" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                  <span class="btn btn-success" id="addzipcode">Add Zip Code</span>
                                 
                                </div>
                            </div>
                            @if(!empty($zipcode))
                              @foreach($zipcode as $keuyss=>$valuess)
                              <div class="form-group row">
                                <label for="default_price" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-4">
                                  <input type="text" name="zipcode[]" class="form-control" placeholder="Enter the zip code" value="{{$valuess->zipcode}}"></div><div class="col-sm-4">
                                  <input type="text" name="deliverycharges[]" class="form-control" placeholder="Delivery Charges" value="{{$valuess->price}}"></div><div class="col-sm-2">
                                  <span class="btn btn-danger" onclick="removezip(this)">X</span>
                                </div>
                                </div>
                              @endforeach
                            @endif
                            <?php
                              if(isset($data->subcatgeory_id))
                              $sub=$data->subcatgeory_id;
                              else
                              $sub=0;
                            ?>
                            <div class="card-footer">
                            <button type="submit" class="btn btn-info">Save</button>
                            <button type="submit" class="btn btn-default float-right"> <a href="/products">Cancel </a></button>
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

<script>
var subcategoryid="{{$sub}}";
</script>