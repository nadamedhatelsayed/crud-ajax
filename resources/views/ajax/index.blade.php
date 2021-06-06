<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  
 <style>
   .container{
    padding: 0.5%;
   } 
</style>
</head>
<body>
 
<div class="container">
     <div class="row">
        <div class="col-12"  id="table_data">
          <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-user">Add User</a> 
          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"   id="laravel_crud">
           <thead>
              <tr>
                 <th>Id</th>
                 <th>Name</th>
                 <td >Action</td>
              </tr>
           </thead>
           <tbody id="users-crud">
              @foreach($users as $user)
              <tr id="user_id_{{ $user->id }}">
                 <td>{{ $user->id  }}</td>
                 <td>{{ $user->name }}</td>
                 
                 <td>
                    <a href="javascript:void(0)" id="edit-user" data-id="{{ $user->id }}" class="btn btn-info mr-2">Edit</a>
                    <a href="javascript:void(0)" id="delete-user" data-id="{{ $user->id }}" class="btn btn-danger delete-user">Delete</a>
                  </td>
              </tr>
              @endforeach
           </tbody>
          </table>
          
          {!! $users->links()!!}
       </div> 
    </div>
    <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="userCrudModal"></h4>
              </div>
              <form id="userForm" name="userForm" class="form-horizontal">
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group">
                      <label for="name" class="col-sm-2 control-label">Name</label>
                      <div class="col-sm-12">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-save" value="create">
                      Save changes
                    </button>
                </div>
              </form>
          </div>
        </div>
      </div>
</div>
@include('ajax.ajaxCode')
</body>
</html>