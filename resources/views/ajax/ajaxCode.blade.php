<script>
    $(document).ready(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      /*  When user click add user button */
      $('#create-new-user').click(function () {
          $('#btn-save').val("create-user");
          $('#userForm').trigger("reset");
          $('#userCrudModal').html("Add New User");
          $('#ajax-crud-modal').modal('show');
      });
   
     /* When click edit user */
      $('body').on('click', '#edit-user', function () {
        var user_id = $(this).data('id');
        $.get('ajax-crud/' + user_id +'/edit', function (data) {
            $('#userCrudModal').html("Edit User");
           $('#btn-save').val("edit-user");
            $('#ajax-crud-modal').modal('show');
            $('#user_id').val(data.id);
            $('#name').val(data.name);
            
        })
     });
     //delete user login
      $('body').on('click', '.delete-user', function () {
          var user_id = $(this).data("id");
          if(confirm("Are You sure want to delete !")) {
   
          $.ajax({
              type: "DELETE",
              url: "{{ url('ajax-crud')}}"+'/'+user_id,
              success: function (data) {
                  $("#user_id_" + user_id).remove();
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });
         }
      });   
    });
   
   if ($("#userForm").length > 0) {
        $("#userForm").validate({
   
       submitHandler: function(form) {
   
        var actionType = $('#btn-save').val();
        $('#btn-save').html('Sending..');
        
        $.ajax({
            data: $('#userForm').serialize(),
            url: "http://127.0.0.1:8000/ajax-crud",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                var user = '<tr id="user_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td>' ;
                    user += '<td ><a href="javascript:void(0)" id="edit-user" data-id="' + data.id + '" class="btn btn-info mr-2">Edit</a>';
                    user += '<a href="javascript:void(0)" id="delete-user" data-id="' + data.id + '" class="btn btn-danger delete-user ml-1">Delete</a></td></tr>';
                 
                
                if (actionType == "create-user") {
                    $('#users-crud').prepend(user);
                } else {
                    $("#user_id_" + data.id).replaceWith(user);
                }
   
                $('#userForm').trigger("reset");
                $('#ajax-crud-modal').modal('hide');
                $('#btn-save').html('Save Changes');
                
            },
            error: function (data) {
                console.log('Error:', data);
                $('#btn-save').html('Save Changes');
            }
        });
      }
    });
  }
     
    
//  pagination code

    $(document).ready(function(){

    $(document).on('click', '.page-link', function(event){
         
    event.preventDefault(); 
    var page = $(this).attr('href').split('page=')[1];
    // alert(page);
    fetch_data(page);
    });

        function fetch_data(page)
        {
        var _token = $("input[name=_token]").val();
        $.ajax({
            url:" {{route('ajax.crud')}}",
            method:"POST",
            data:{_token:_token, page:page},
            success:function(data)
            {
            $('#table_data').html(data);
            }
        });
        }

    });
    </script> 