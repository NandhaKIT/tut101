
<!doctype html>
<head>
    <title>PHP Mysql PDO CRUD Server Side Ajax DataTables</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">

</head>
<body>
<div class="container">
    <br />
    <!-- <h3 align="center">PHP Mysql PDO CRUD Server Side Ajax DataTables</h3>    -->
    <br />
    <div align="right">
        <button type="button" id="add_button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
          Add
        </button>
    </div>
    <br />    
    <table id="member_table" class="table table-striped">  
        <thead bgcolor="#6cd8dc">
            <tr class="table-primary">
                <th width="30%">KID</th>
                <th width="30%">Name</th>  
                <th width="30%">Email</th>
                <th width="30%">Password</th>
                <th width="30%">Status</th>
                <th width="30%">Technology</th>
                <th width="30%">Time Available</th>
                <th scope="col" width="5%">Edit</th>
                <th scope="col" width="5%">Delete</th>
            </tr>
        </thead>
    </table>
     
    <div class="modal" id="userModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post" id="member_form" enctype="multipart/form-data">
                <div class="modal-body">
                    <label>Enter KIT ID</label>
                    <input type="text" name="t_kid" id="t_kid" class="form-control" />
                    <br />
                    <label>Enter Name</label>
                    <input type="text" name="t_name" id="t_name" class="form-control" />
                    <br /> 
                    <label>Enter Email</label>
                    <input type="email" name="t_email" id="t_email" class="form-control" />
                    <br /> 
                    <label>Enter Password</label>
                    <input type="password" name="t_pass" id="t_pass" class="form-control" />
                    <br /> 
                    <label>Enter Status</label>
                    <select name="t_status" id="t_status" class="form-select">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    <br /> 
                    <label>Enter Technology</label>
                    <input type="text" name="t_tech" id="t_tech" class="form-control" />
                    <br /> 
                    <label>Enter Time Available</label>
                    <input type="text" name="t_avail" id="t_avail" class="form-control" />
                    <br /> 
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="member_id" id="member_id" />
                    <input type="hidden" name="operation" id="operation" />
                    <input type="submit" name="action" id="action" class="btn btn-primary" value="Add" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>  
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" >
$(document).ready(function(){
    $('#add_button').click(function(){
        $('#member_form')[0].reset();
        $('.modal-title').text("Add New Details");
        $('#action').val("Add");
        $('#operation').val("Add");
    });
     
    var dataTable = $('#member_table').DataTable({
        "paging":true,
        "processing":true,
        "serverSide":true,
        "order": [],
        "info":true,
        "ajax":{
            url:"fetch.php",
            type:"POST"
               },
        "columnDefs":[
            {
                "targets":[0,3,4],
                "orderable":false,
            },
        ],    
    });
 
    $(document).on('submit', '#member_form', function(event){
        event.preventDefault();
        var kid = $('#t_kid').val();
        var name = $('#t_name').val();
        var email = $('#t_email').val();
        var pass = $('#t_pass').val();
        var status = $('#t_status').val();
        var tech = $('#t_tech').val();
        var avail = $('#t_avail').val();
         
        if(kid != '' && name != '' && email != '' && pass != '' && status != '' && tech != '' && avail != '')
        {
            $.ajax({
                url:"insertupdated.php",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    $('#member_form')[0].reset();
                    $('#userModal').modal('hide');
                    dataTable.ajax.reload();
                }
            });
        }
        else
        {
            alert("All Fields are Required");
        }
    });
     
    $(document).on('click', '.update', function(){
        var member_id = $(this).attr("t_kid");
        $.ajax({
            url:"fetch_single.php",
            method:"POST",
            data:{member_id:member_id},
            dataType:"json",
            success:function(data)
            {
                $('#userModal').modal('show');
                $('#t_id').val(data.kid);
                $('#t_name').val(data.name);
                $('#t_email').val(data.email);
                $('#t_pass').val(data.pass);
                $('#t_status').val(data.status);
                $('#t_tech').val(data.tech);
                $('#t_avail').val(data.avail);
                $('.modal-title').text("Edit Member Details");
                $('#member_id').val(member_id);
                $('#action').val("Save");
                $('#operation').val("Edit");
            }
        })
    });
     
    $(document).on('click', '.delete', function(){
        var member_id = $(this).attr("id");
        if(confirm("Are you sure you want to delete this user?"))
        {
            $.ajax({
                url:"delete.php",
                method:"POST",
                data:{member_id:member_id},
                success:function(data)
                {
                    dataTable.ajax.reload();
                }
            });
        }
        else
        {
            return false;   
        }
    });
     
     
});
</script>      
</body>
</html>