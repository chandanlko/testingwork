@extends('layouts.app')

@section('title', 'Company')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Company</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Company</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
       <section class="content">
        <div class="alert alert-success alert-dismissible fade show companyalert" role="alert" style="display:none;">
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
                <h3 class="card-title">Company's List</h3>
                <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#modal-default">
                  Add New Company
                  </button>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-hover data-table">
                <thead>
                    <tr>  
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                  <tbody>
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



<div class="modal fade" id="modal-default2" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title">Edit New Company</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true" id="closeParentModelEdit">×</span>
    </button>
    </div>
    <div class="modal-body">
          <div class="form-group">
          <label for="exampleInputEmail1">Company Name</label>
          <input type="text" class="form-control" id="company_name_edit" placeholder="Enter Company Name">
          <input type="hidden" id="companynameid_edit">
          <span id="error_comapny_name_edit" style="color:red; display:none;"></span>
          </div>
    </div>
    <div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" id="ClickToEditCompany">Save changes</button>
    </div>
    </div>

    </div>

</div>







<div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title">Add New Company</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true" id="closeParentModel">×</span>
    </button>
    </div>
    <div class="modal-body">
          <div class="form-group">
          <label for="exampleInputEmail1">Company Name</label>
          <input type="email" class="form-control" id="CompanyNameId" placeholder="Enter Company Name" autocomplete="off">
          <span id="error_comapny_name" style="color:red; display:none;"></span>
          </div>
    </div>
    <div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" id="ClickToSaveCompany">Save changes</button>
    </div>
    </div>

    </div>

</div>

<div class="modal fade show" id="modal-sm" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title">Delete Company ?</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true" id="deletedataidd">×</span>
    </button>
    </div>
    <div class="modal-body">
    <p>Once you delete it'll permanently deleted</p>
    <input type="hidden" id="company_iid">
    </div>
    <div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <button type="button" class="btn btn-primary" id="companyidd">Delete</button>
    </div>
    </div>

</div>

</div>
@endsection

