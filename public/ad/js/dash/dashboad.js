toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

// edit role
function editrole(id,role){
  $.ajax({
      type: 'POST',
      url: 'admintp/block',
      "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
      data: {
        id: id,
        role: role
      },
      dataType: 'json',
      success: function(data) {
          console.log(data);
          $("#myText"+data.id).text(data.role);
          if(data.role ==0){
            console.log(data.role);
            $("#btnB"+data.id).hide();
            $("#btnN"+data.id).show();
          }else{
            $("#btnN"+data.id).hide();
            $("#btnB"+data.id).show();
            
          }
          toastr["success"]("Edit success!");
          // window.location.reload();
      },
      error: function(data) {
        var errors = $.parseJSON(data.responseText);
        $.each(errors.messages, function(key, value) {
            toastr["error"](value)
        });
      }
  });
}

//edit category
function editcategory(id){
  if (document.getElementById('name'+id).value =="") {
    toastr["error"]("Null Input")
  }else{
      $.ajax({
        type: 'POST',
        url: 'admintp/post/editcategory',
        "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        data: {
          id: id,
          name: document.getElementById('name'+id).value
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            toastr["success"]("Edit success!");
            document.getElementById("name"+id).disabled = true;
            // window.location.reload();
        },
        error: function(data) {
          var errors = $.parseJSON(data.responseText);
          $.each(errors.messages, function(key, value) {
              toastr["error"](value)
          });
        }
      });
  }
}

//add category
function addcategory(){
  var name = document.getElementById('nameCate').value;
  if (name =="") {
    toastr["error"]("Null Input")
  }else{
      $.ajax({
        type: 'POST',
        url: 'admintp/post/addcatogory',
        "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        data: {
          name: name,
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            toastr["success"]("Edit success!");
            document.getElementById('addinput').style.display = "none";
            $("#datatable-fixed-header").find('tbody').append("<tr><td>"+data.id+"</td><td><input type='text' value='"+data.name+"' disabled='disabled'></td></tr>");
        },
        error: function(data) {
          var errors = $.parseJSON(data.responseText);
          $.each(errors.messages, function(key, value) {
              toastr["error"](value)
          });
        }
      });
  }
}


function test() {
  // body...
}
