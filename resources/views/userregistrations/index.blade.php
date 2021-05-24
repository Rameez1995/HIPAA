@extends('layouts.appsidebar')

@section('content')

<div class="app-content content dashboard">
    <div class="content-wrapper">
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-dashboard">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-sm-flex justify-content-between">
                                                <h2 class="mb-2 ml-2">User Registration</h2>
                                                <div>
                                                    <a data-toggle="modal" data-target=".addUser" class="login-btn d-block px-5 text-center">Add User</a>
                                                    <a href="all-companies.php" class="site-btn d-block mt-1 px-1 text-center">View all companies</a>
                                                    <a data-toggle="modal" data-target=".addCompany" class="site-btn d-block mt-1 px-1 text-center">Add Company</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="row ml-0 mt-1 mr-0">
                                        <div class="col-12">
                                            <label  for="">Sort By:</label>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-xl-flex justify-content-between align-items-center">
                                                <div class="d-sm-flex">
                                                    <input id="datepicker-1" class="site-input site-select border px-2" readonly placeholder="From" type="text">
                                                    <input id="datepicker-2" class="site-input site-select ml-sm-1 mt-1 mt-sm-0 border px-2" readonly placeholder="To" type="text">
                                                </div>
                                                <div class="d-sm-flex">
                                                    <select name="" id="" class="site-input mt-1 site-select w-100 mr-1">
                                                        <option value="">Select Company</option>
                                                        <option value="">Company 1</option>
                                                        <option value="">Company 2</option>
                                                        <option value="">Company 3</option>
                                                    </select>
                                                    <select name="" id="" class="site-input mt-1 site-select w-100">
                                                        <option value="">Select Status</option>
                                                        <option value="">Active</option>
                                                        <option value="">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="maain-tabble table-responsive">
                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th>S.NO</th>
                                                    <th>User Id</th>
                                                    <th>First NAME</th>
                                                    <th>Last NAME</th>
                                                    <th>Email Address</th>
                                                    <th>Training Name</th>
                                                    <th>Company Name</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>ACTIONS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($vendors as $vendor)
                                                <tr>
                                                    <td>{{$vendor->id}}</td>
                                                    <td>{{$vendor->user_id}}</td>
                                                    <td>{{$vendor->firstname}}</td>
                                                    <td>{{$vendor->lastname}}</td>
                                                    <td>{{$vendor->email}}</td>
                                                    <td>{{$vendor->trainings->training_name}}</td>
                                                    <td>{{$vendor->companies->company_name}}</td>
                                                    <td>{{$vendor->created_at}}</td>
                                                    @if($vendor->status=="1")
                                                    <td class="green-text">Active</td>
                                                    @else
                                                    <td class="green-text">In Active</td>
                                                    @endif
                                                    <td>
                                                        <div class="btn-group custom-dropdown ml-2 mb-1">
                                                            <button type="button" class="btn btn-drop-table btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></button>
                                                            <form method="post">
                                                            @csrf
                                                            <div class="dropdown-menu custom-dropdown">
                                                                <form method="post">
                                                                @csrf 
                                                                <a href="{{ url('admin/userregistrationdetails/'.$vendor->id)}}" class="dropdown-item"><i class="fa fa-eye" aria-hidden="true"></i>View</a>
                                                                </form>
                                                                 <a class="dropdown-item" data-toggle="modal" id="edit-customer"data-target=".editUser" data-id="{{ $vendor->id }}" ><i class="fa fa-edit" aria-hidden="true"></i>Edit</a>
                                                                
                                                                <a href="quiz-report.php" class="dropdown-item"><i class="fa fa-file-alt" aria-hidden="true"></i>Quiz Report</a>
                                                                @if($vendor->status=="1")
                                                                <form action="{{route('user-status-inactive-update')}}" method = "post">
                                                                @csrf
                                                                <input type="hidden" name="status" value = "0">
                                                                <input type="hidden" name="id" value = "{{$vendor->id}}">
                                                                <button type = "submit" class = "dropdown-item text-center">INACTIVE</button>
                                                                </form>
                                                                @else
                                                                <form action="{{route('user-status-active-update')}}" method = "post">
                                                                @csrf
                                                                <input type="hidden" name="status" value = "1">
                                                                <input type="hidden" name="id" value = "{{$vendor->id}}">
                                                            <button type = "submit" class = "dropdown-item text-center">ACTIVE</button>
                                                                </form>
                                                                @endif
                                                            </div>
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
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<div class="modal fade addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content site-modal">
            <i class="fas fa-times-circle close modal-close" data-dismiss="modal" aria-label="Close"></i>

            <div class="text-center">
                <p class="modal-heading text-center">Add User</p>
                <form method="POST" action="{{ route('userregistration.store') }}" enctype="multipart/form-data">
                    @CSRF
                    <div class="d-sm-flex">
                        <input name="firstname" type="text" class="site-input w-100 mr-1 mt-1" placeholder="First Name">
                        <input name="lastname" type="text" class="site-input w-100 mt-1" placeholder="Last Name">
                    </div>
                    <input name="email" type="email" class="site-input w-100 mt-1" placeholder="Email Address">
                    <div class="d-sm-flex">
                        <div class="form-field w-100 my-1 mr-1">
                            <input name="password" type="password" class="site-input w-100 login both-icon enter-input" placeholder="Enter Password"  id="">
                            <i class="fa fa-eye-slash enter-icon right-icon" aria-hidden="true"></i>
                        </div>
                        <div class="form-field w-100 my-1">
                            <input name="confirm-password" type="password" class="site-input w-100 login both-icon enter-input" placeholder="Confirm Password"  id="">
                            <i class="fa fa-eye-slash enter-icon right-icon" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="d-sm-flex">
                        
                        <select name="category_id" id="category_id" class="site-input w-100 mr-1">
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                        <select name="training_id" id="training_id" class="site-input w-100 mr-1">
                            @foreach($trainings as $training)
                            <option value="{{$training->id}}">{{$training->training_name}}</option>
                            @endforeach
                        </select>
                        <select name="company_id" id="company_id" class="site-input w-100 mr-1">
                            @foreach($companies as $company)
                            <option value="{{$company->id}}">{{$company->company_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input name="amount"  type="number" class="site-input w-100 mt-1" placeholder="Amount">
                    <div class="modal-btn-div mt-2">
                        <button type="submit" class="site-btn px-5" >Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade addCompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content site-modal">
            <i class="fas fa-times-circle close modal-close" data-dismiss="modal" aria-label="Close"></i>

            <div class="text-center">
                <p class="modal-heading text-center">Add Company</p>
                <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input name="company_name" type="text" class="site-input w-100 mt-1" placeholder="Company Name">
                    <div class="modal-btn-div mt-2">
                        <button type="submit" class="site-btn px-5" >Add Company</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade editUser" id="crud-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content site-modal">
            <i class="fas fa-times-circle close modal-close" data-dismiss="modal" aria-label="Close"></i>

            <div class="text-center">
                <p class="modal-heading text-center">Edit User</p>
                <form method="post" action="{{ route('userregistration.update') }}" enctype="multipart/form-data">
                @csrf
                    <input name="id" id="id" type="hidden" class="site-input w-100 mt-1">

                    <div class="d-sm-flex">
                        <input name="firstname" id="firstname" type="text" class="site-input w-100 mr-1 mt-1" placeholder="First Name" >
                        <input name="lastname" id="lastname" type="text" class="site-input w-100 mt-1" placeholder="Last Name" >
                    </div>
                    <input name="email" id="email" type="email" class="site-input w-100 mt-1" placeholder="Email Address">
                    <div class="d-sm-flex">
                        <div class="form-field w-100 my-1 mr-1">
                            <input name="password" type="password" class="site-input w-100 login both-icon enter-input" placeholder="*********" id="password">
                            <i class="fa fa-eye-slash enter-icon right-icon" aria-hidden="true"></i>
                        </div>
                        <div class="form-field w-100 my-1">
                            <input name="confirm-password" type="password" class="site-input w-100 login both-icon enter-input" placeholder="*********" id="password">
                            <i class="fa fa-eye-slash enter-icon right-icon" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="d-sm-flex">
                        <select name="category_id" id="category_id" class="site-input w-100 mr-1">
                        </select>
                        <select name="training_id" id="training_id" class="site-input w-100 mr-1">
                        </select>
                        <select name="company_id" id="company_id" class="site-input w-100 mr-1">
                        </select>
                    </div>
                    <input name="amount" id="amount" type="text" class="site-input w-100 mt-1">

                    <div class="modal-btn-div mt-2">
                        <button type="submit" class="site-btn px-5" aria-label="Close">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade activeUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content site-modal">
            <i class="fas fa-times-circle close modal-close" data-dismiss="modal" aria-label="Close"></i>

            <div class="text-center">
                <div class="modal-icon-div">
                    <i class="fas fa-question modal-icon yellow-back"></i>
                </div>
                <p class="grey-text">Are You Sure You Want To Activate The User?</p>
                <div class="d-flex align-items-center mt-2 justify-content-center">
                    <button class="site-btn mr-2 px-4" data-toggle="modal" data-target=".userActivated" data-dismiss="modal" aria-label="Close">Yes</button>
                    <button class="login-btn px-4" data-dismiss="modal" aria-label="Close">No</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade userActivated" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content site-modal">
            <i class="fas fa-times-circle close modal-close" data-dismiss="modal" aria-label="Close"></i>

            <div class="text-center">
                <div class="modal-icon-div">
                    <i class="fas fa-check modal-icon"></i>
                </div>
                <p class="grey-text mt-1 pb-5">User Is Now Active</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade inactiveUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content site-modal">
            <i class="fas fa-times-circle close modal-close" data-dismiss="modal" aria-label="Close"></i>

            <div class="text-center">
                <div class="modal-icon-div">
                    <i class="fas fa-question modal-icon yellow-back"></i>
                </div>
                <p class="grey-text">Are You Sure You Want To Inactivate The User?</p>
                <div class="d-flex align-items-center mt-2 justify-content-center">
                    <button class="site-btn mr-2 px-4" data-toggle="modal" data-target=".userInactivated" data-dismiss="modal" aria-label="Close">Yes</button>
                    <button class="login-btn px-4" data-dismiss="modal" aria-label="Close">No</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade userInactivated" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content site-modal">
            <i class="fas fa-times-circle close modal-close" data-dismiss="modal" aria-label="Close"></i>

            <div class="text-center">
                <div class="modal-icon-div">
                    <i class="fas fa-check modal-icon"></i>
                </div>
                <p class="grey-text mt-1 pb-5">User Is Now Inactive</p>
            </div>
        </div>
    </div>
</div>

<!-- Add and Edit customer modal -->
<!-- <div class="modal fade" id="crud-modal" aria-hidden="true" >
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="customerCrudModal"></h4>
</div>
<div class="modal-body">
<form name="custForm" action="{{ route('quizes.store') }}" method="POST">
<input type="hidden" name="cust_id" id="cust_id" >
@csrf
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Name:</strong>
<input type="text" name="name" id="name" class="form-control" placeholder="Name" onchange="validate()" >
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Email:</strong>
<input type="text" name="email" id="email" class="form-control" placeholder="Email" onchange="validate()">
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Address:</strong>
<input type="text" name="address" id="address" class="form-control" placeholder="Address" onchange="validate()" onkeypress="validate()">
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 text-center">
<button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" disabled>Submit</button>
<a href="{{ route('quizes.store') }}" class="btn btn-danger">Cancel</a>
</div>
</div>
</form>
</div>
</div>
</div>
</div> -->

<script>
  $('body').on('click', '#edit-customer', function () {
var customer_id = $(this).data('id');
$.get('/admin/userregistration/'+customer_id+'/edit', function (data) {
$('#customerCrudModal').html("Edit customer");
$('#btn-update').val("Update");
$('#btn-save').prop('disabled',false);
$('#crud-modal').modal('show');
$('#id').val(data.id);
$('#firstname').val(data.firstname);
$('#lastname').val(data.lastname);
$('#email').val(data.email);
$('#password').val(data.password);
$('#confirm-password').val(data.password);
$('#amount').val(data.amount);
// $('select[name="category_id"]').append('<option value="'+ data.email+'">'+ data.email+'</option>');
})
});

</script>


<script type="text/javascript">
jQuery(document).ready(function ()
{
        $('body').on('click', '#edit-customer', function (){
           var customer_id = jQuery(this).data('id');
           jQuery('select[name="category_id"]').empty();
              jQuery.ajax({
                 url : '{{url("/admin/userregistration")}}/getcategories/'+customer_id,
                 type : "GET",
                 dataType : "json",
                 success:function(data) {
                     console.log(data);
                     jQuery('select[name="category_id"]').empty();
                     jQuery.each(data, function (key, value) {
                         $('select[name="category_id"]').append('<option value="' + value.id + '">' + value.category_name + '</option>');
                     });
                    
                 }
              });
        });
});
 </script>

<script type="text/javascript">
jQuery(document).ready(function ()
{
        $('body').on('click', '#edit-customer', function (){
           var company_id = jQuery(this).data('id');
           jQuery('select[name="company_id"]').empty();
              jQuery.ajax({
                 url : '{{url("/admin/userregistration")}}/getcompanies/'+company_id,
                 type : "GET",
                 dataType : "json",
                 success:function(data) {
                     console.log(data);
                     jQuery('select[name="company_id"]').empty();
                     jQuery.each(data, function (key, value) {
                         $('select[name="company_id"]').append('<option value="' + value.id + '">' + value.company_name + '</option>');
                     });
                    
                 }
              });
        });
});
 </script>

<script type="text/javascript">
jQuery(document).ready(function ()
{
        $('body').on('click', '#edit-customer', function (){
           var training_id = jQuery(this).data('id');
           jQuery('select[name="training_id"]').empty();
              jQuery.ajax({
                 url : '{{url("/admin/userregistration")}}/gettrainings/'+training_id,
                 type : "GET",
                 dataType : "json",
                 success:function(data) {
                     console.log(data);
                     jQuery('select[name="training_id"]').empty();
                     jQuery.each(data, function (key, value) {
                         $('select[name="training_id"]').append('<option value="' + value.id + '">' + value.training_name + '</option>');
                     });
                    
                 }
              });
        });
});
 </script>

@endsection

<script>
error=false

function validate()
{
	if(document.custForm.name.value !='' && document.custForm.email.value !='' && document.custForm.address.value !='')
	    document.custForm.btnsave.disabled=false
	else
		document.custForm.btnsave.disabled=true
}
</script>