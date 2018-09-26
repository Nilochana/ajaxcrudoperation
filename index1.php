<!DOCTYPE html>
<html>
<head>
<title></title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>

<body>
<div class="container">
<h1 class="text-primary text-uppercase text-center">AJAX CRUD 
OPERATION </h1>

<div class="d-flex justify-content-end">
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">
  Open modal
</button>

</div>

<h2 class="text-danger">All Records</h2>
<div id="records_contant">
</div>


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">


    <!-- Modal Header -->
    <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>


      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
        <label>Firstname:</lable>
        <input type="text" name="" id="firstname" class="
        form-control" placeholder="First Name">
        </div>
        <div class="form-group">
        <label>Lastname:</lable>
        <input type="text" name="" id="lastname" class="
        form-control" placeholder="Last Name">
        </div>
        <div class="form-group">
        <label>Email Id:</lable>
        <input type="email" name="" id="email" class="
        form-control" placeholder="Email">
        </div>
        <div class="form-group">
        <label>Mobile:</lable>
        <input type="text" name="" id="mobile" class="
        form-control" placeholder="Mobile Number">
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="addRecord()">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>


      </div>
  </div>
</div>




<!-- /////////update modal -->



<!-- The Modal -->
<div class="modal fade" id="update_user_modal">
  <div class="modal-dialog">
    <div class="modal-content">

    <!-- Modal Header -->
    <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
        <label for="update_firstname">update_Firstname:</lable>
        <input type="text" class="form-control" id="update_firstname">
        </div>
        <div class="form-group">
        <label for="update_lastname">update_Lastname:</lable>
        <input type="text" class="form-control" id="update_lastname">
        </div>
        <div class="form-group">
        <label for="update_email">update_Email Id:</lable>
        <input type="email" class="form-control" id="update_email">
        </div>
        <div class="form-group">
        <label for="update_mobile">update_Mobile:</lable>
        <input type="text" class="form-control" id="update_mobile">
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" 
        onclick="updateuserdetail()">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="hidden" name="" id="hidden_user_id">
        </div>


        </div>
  </div>
</div>



</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script>

$(document).ready(function(){

  readRecords();

});

function readRecords(){
  var readrecord="readrecord";
  $.ajax({
    url:"backend1.php",
    type:"post",
    data:{readrecord:readrecord},
    success:function(data,status){
      $('#records_contant').html(data);
    }
  });
}

</script>


<script type="text/javascript">
function addRecord(){
  var firstname=$('#firstname').val();
  var lastname=$('#lastname').val();
  var email=$('#email').val();
  var mobile=$('#mobile').val();

  $.ajax({
    url:"backend1.php",
    type:'post',
    data:{firstname:firstname,
          lastname:lastname,
          email:email,
          mobile:mobile
          },

          success:function(data,status){
            readRecords();
          }
  });
}


////delete records call

function DeleteUser(deleteid){
  var conf=confirm("Are you sure");
  if(conf==true){
    $.ajax({
      url:"backend1.php",
      type:"post",
      data:{deleteid:deleteid},
      success:function(data,status){
        readRecords();
      }
    });
  }
}


function GetUserDetails(id){
  $('#hidden_user_id').val(id);

  $.post("backend1.php", {
    id:id
  }, function(data,status){

    var user=JSON.parse(data);
    $('#update_firstname').val(user.firstname);
    $('#update_lastname').val(user.lastname);
    $('#update_email').val(user.email);
    $('#update_mobile').val(user.mobile);
  }
  );
  $('#update_user_modal').modal("show");

}



function updateuserdetail(){
  var firstnameupd=$('#update_firstname').val();
  var lastnameupd=$('#update_lastname').val();
  var emailupd=$('#update_email').val();
  var mobileupd=$('#update_mobile').val();

  var hidden_user_idupd=$('#hidden_user_id').val();

  $.post("backend1.php",{

    hidden_user_idupd:hidden_user_idupd,
    firstnameupd:firstnameupd,
    lastnameupd:lastnameupd,
    emailupd:emailupd,
    mobileupd:mobileupd,
    },
    function(data,status){
      $('#update_user_modal').modal("hide");
      readRecords();
    }
  );
}

</script>

</body>
</html>