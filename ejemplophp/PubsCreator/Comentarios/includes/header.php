<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet"
                href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
      
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
        <script src="../../../d/js/scrollreveal.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://use.fontawesome.com/fe459689b4.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Sección de Comentarios</title>
  </head>
  <style media="screen">
    .selected{
      color: #2980B9;
      outline: 1px solid
    }
  </style>
  <body>
  <?php
  if(isset($_SESSION['status'])){
  if( $_SESSION['status'] == 'Ingreso Exitoso'){
    ?>
    <script>
      var status = <?php echo json_encode($_SESSION['status']); ?>;
      window.alert(status);
    </script>
    <?php
    unset($_SESSION['status']);
  }
  elseif($_SESSION['status'] == 'Email o Contraseña Invalidos'){
    ?>
    <script>
    var status = <?php echo json_encode($_SESSION['status']); ?>;
    window.alert(status);
    </script>
    <?php 
    unset($_SESSION['status']);

  }
  elseif( $_SESSION['status'] == 'Cierre de Sesión Éxitoso'){
    ?>
    <script>
    var status = <?php echo json_encode($_SESSION['status']); ?>;
    window.alert(status);
    </script>
    <?php
    unset($_SESSION['status']);
  }
}
  if(!isset($_SESSION['auth_user_id'])){
  ?>
  <script> 
  $(document).ready(function(){
  load_comment();
    function load_comment(){
      var cmt_id = []
      
        $.ajax({
            type: "POST",
            url: "../Comentarios/code.php",
            data: {
                'comment_load_data': true
            },
            success: function (response) {
              alert(response)
                $('.comment-container').html('');
                $.each(response, function(key, value){
                cmt_id.push(value.cmt['id'])
                })
                $.each(response, function (key, value){
                    $('.comment-container').append('<div class="reply_box border p-2 mb-2">\
                    <h6 class="border-bottom d-inline"> '+value.user['name']+' : '+value.cmt['created_at']+' </h6>\
                    <p class = "para">'+value.cmt['msg']+'</p> \
                    <div>\
                    <button value="'+value.cmt['id']+'" class="like mb-2" disabled><i class="fa fa-thumbs-up fa-lg"></i><span id = "like'+value.cmt['id']+'">0</span></button><button value="'+value.cmt['id']+'" class="dislike mb-2" disabled><i class="fa fa-thumbs-down fa-lg" disabled></i><span id = "dislike'+value.cmt['id']+'">0</span></button>\
                    </div>\
                    <div class="ml-4 show_btn">\
                    <button value="'+value.cmt['id']+'" class="badge btn-danger view_reply_btn" id ="reply_btn'+value.cmt['id']+'">No hay respuestas</button>\
                    </div>\
                    <div class="ml-4 reply_section">\
                    </div>\
                </div>\
                ');     
                var cmt_id = value.cmt['id'];
                var data1 = {
                'cmt_id': cmt_id,
                'get_likes': true,
               };
               var data2 = {
                'cmt_id': cmt_id,
                'get_dislikes': true,
               };
               $.ajax({
                type: "POST",
                url: "../Comentarios/code.php",
                data: data1,
                success: function(response){
                  $('#like'+cmt_id+'').html("");
                  $('#like'+cmt_id+'').append(response);         
                }
               })
               $.ajax({
                type: "POST",
                url: "../Comentarios/code.php",
                data: data2,
                success: function(response){
                  $('#dislike'+cmt_id+'').html("");
                  $('#dislike'+cmt_id+'').append(response);         
                }
               })
    });
    var rL = response.length;
    for(var i = 0; i < rL; i++){
      var cmtId = cmt_id[i]
      $.ajax({
             type: "POST",
             url: "../Comentarios/code.php",
             data: {
                 'cmt_id': cmtId,
                 'get_reply_num': true
             },
             success: function (response){
              var comment_id = response[0].cmt['comment_id'];
                if(response.length == 1){
                  $('#reply_btn'+comment_id+'').html("");
                  $('#reply_btn'+comment_id+'').append('Ver '+response.length+' respuesta')
                }
                else{
                $('#reply_btn'+comment_id+'').html("");
                $('#reply_btn'+comment_id+'').append('Ver '+response.length+' respuestas')
                }

                

        }
      });
    }
    }
  });
      var contador = 0;
      $(document).on('click', '.view_reply_btn', function(e){
        e.preventDefault();
        var thisClicked = $(this);
        var cmt_id = thisClicked.val();
        if(contador != cmt_id){
        contador = cmt_id;
        $.ajax({
            type: "POST",
            url: "../Comentarios/code.php",
            data: {
                'cmt_id': cmt_id,
                'view_comment_data': true
            },
            success: function (response){
                $('.reply_section').html('');
                $.each(response, function (key, value){
              thisClicked.closest('.reply_box').find('.reply_section')
                .append('<div class="sub_reply_box border-bottom p-2 mb-2" id="sub_reply_box'+value.cmt['id']+'">\
                            <input type="hidden" class="get_username" value="'+value.user['name']+'">\
                            <h6 class="border-bottom d-inline">'+value.user['name']+' : '+value.cmt['created_at']+'</h6>\
                            <p class = "para">'+value.cmt['reply_msg']+'</p>\
                            <div>\
                            <button value="'+value.cmt['id']+'" class="like mb-2" disabled><i class="fa fa-thumbs-up fa-lg"></i><span id = "like'+value.cmt['id']+'">0</span></button><button value="'+value.cmt['id']+'" class="dislike mb-2" disabled><i class="fa fa-thumbs-down fa-lg"></i><span id = "dislike'+value.cmt['id']+'">0</span></button>\
                            </div>\
                            <div class="ml-4 sub_reply_section">\
                            </div>\
                        </div>');
                        var cmt_id = value.cmt['id'];
                var data1 = {
                'cmt_id': cmt_id,
                'get_likes': true,
               };
               var data2 = {
                'cmt_id': cmt_id,
                'get_dislikes': true,
               };
               $.ajax({
                type: "POST",
                url: "../Comentarios/code.php",
                data: data1,
                success: function(response){
                  $('#like'+cmt_id+'').html("");
                  $('#like'+cmt_id+'').append(response);         
                }
               })
               $.ajax({
                type: "POST",
                url: "../Comentarios/code.php",
                data: data2,
                success: function(response){
                  $('#dislike'+cmt_id+'').html("");
                  $('#dislike'+cmt_id+'').append(response);         
                }
               })      
          });

            }
        });
      }
      else{
        $('.reply_section').html("");
        contador = 0;
      }
    });
  }
});
  </script>
  <?php
  }
  else
  {
  $user_id = $_SESSION['auth_user_id'];
  $postId = $_SESSION['postId'];
  ?>
  <script type="text/javascript">
  $(document).ready(function(){
  load_comment();
    function load_comment(){
      var cmt_id = []
      var user_id = <?php echo json_encode($user_id); ?>;
      var postId = <?php echo json_encode($postId); ?>;
        $.ajax({
            type: "POST",
            url: "../Comentarios/code.php",
            data: {
                'comment_load_data': true
            },
            success: function (response) {
                $('.comment-container').html('');
                $.each(response, function(key, value){
                cmt_id.push(value.cmt['id'])
                })
                $.each(response, function (key, value){
                    if(value.user['id'] == user_id){  
                    $('.comment-container').append('<div class="reply_box border p-2 mb-2" id ="reply_box'+value.cmt['id']+'">\
                    <input type="hidden" class="get_username" value="'+value.user['name']+'">\
                    <h6 class="border-bottom d-inline"> '+value.user['name']+' : '+value.cmt['created_at']+'</h6>\
                    <input type="hidden" class="get_cmt" value="'+value.cmt['msg']+'">\
                    <p class = "para" id="edit_cmt'+value.cmt['id']+'">'+value.cmt['msg']+'</p>\
                    <div>\
                    <button value="'+value.cmt['id']+'" class="like mb-2" id="selectedLi'+value.cmt['id']+'"><i class="fa fa-thumbs-up fa-lg"></i><span id = "like'+value.cmt['id']+'">0</span></button><button value="'+value.cmt['id']+'" class="dislike mb-2" id="selectedDis'+value.cmt['id']+'"><i class="fa fa-thumbs-down fa-lg" disabled></i><span id = "dislike'+value.cmt['id']+'">0</span></button>\
                    </div>\
                    <div class="ml-4 show_btn">\
                    <button value="'+value.cmt['id']+'" class="badge btn-primary delete_btn"><i class="bi bi-trash3-fill"></i></button>\
                    <button value="'+value.cmt['id']+'" class="badge btn-secondary edit_btn"><i class="bi bi-pencil-square"></i></button>\
                    <button value="'+value.cmt['id']+'" class="badge btn-warning reply_btn"><i class="bi bi-reply-fill"></i></button>\
                    <button value="'+value.cmt['id']+'" class="badge btn-danger view_reply_btn" id ="reply_btn'+value.cmt['id']+'">No hay respuestas</button>\
                    </div>\
                    <div class="ml-4 reply_section">\
                    </div>\
                </div>\
                '); 
                }
                if(value.user['id'] != user_id){
                  $('.comment-container').append('<div class="reply_box border p-2 mb-2" id ="reply_box'+value.cmt['id']+'">\
                    <input type="hidden" class="get_username" value="'+value.user['name']+'">\
                    <h6 class="border-bottom d-inline"> '+value.user['name']+' : '+value.cmt['created_at']+'</h6>\
                    <p class = "para">'+value.cmt['msg']+'</p>\
                    <div>\
                    <button value="'+value.cmt['id']+'" class="like mb-2" id="selectedLi'+value.cmt['id']+'"><i class="fa fa-thumbs-up fa-lg"></i><span id = "like'+value.cmt['id']+'">0</span></button><button value="'+value.cmt['id']+'" class="dislike mb-2" id="selectedDis'+value.cmt['id']+'"><i class="fa fa-thumbs-down fa-lg"></i><span id = "dislike'+value.cmt['id']+'">0</span></button>\
                    </div>\
                    <div class="ml-4 show_btn">\
                    <input type="hidden" class="get_cmt_id" value="'+value.cmt['id']+'">\
                    <button value="'+value.cmt['id']+'" class="badge btn-warning reply_btn"><i class="bi bi-reply-fill"></i></button>\
                    <button value="'+value.cmt['id']+'" class="badge btn-danger view_reply_btn" id ="reply_btn'+value.cmt['id']+'">No hay respuestas</button>\
                    </div>\
                    <div class="ml-4 reply_section">\
                    </div>\
                </div>\
                '); 
                }
                var cmt_id = value.cmt['id'];
                var data1 = {
                'cmt_id': cmt_id,
                'get_likes': true,
               };
               var data2 = {
                'cmt_id': cmt_id,
                'get_dislikes': true,
               };
               $.ajax({
                type: "POST",
                url: "../Comentarios/code.php",
                data: data1,
                success: function(response){
                  $('#like'+cmt_id+'').html("");
                  $('#like'+cmt_id+'').append(response); 
                }
               })
               $.ajax({
                type: "POST",
                url: "../Comentarios/code.php",
                data: data2,
                success: function(response){
                  $('#dislike'+cmt_id+'').html("");
                  $('#dislike'+cmt_id+'').append(response); 
                }
               })
               var data3 = {
                'cmt_id': cmt_id,
                'user_id': user_id,
                'selection_like': true,
               }
               $.ajax({
                type: "POST",
                url: "../Comentarios/code.php",
                data: data3,
                success: function(response){
                  if(response == 1){
                    $('#selectedLi'+cmt_id+'').addClass("selected");   
                  }
                }
               })
               var data4 = {
                'cmt_id': cmt_id,
                'user_id': user_id,
                'selection_dislike': true,
               }
               $.ajax({
                type: "POST",
                url: "../Comentarios/code.php",
                data: data4,
                success: function(response){
                  if(response == 1){
                    $('#selectedDis'+cmt_id+'').addClass("selected");   
                  }
                }
               })
              });
                
              var rL = response.length;
              for(var i = 0; i < rL; i++){
                var cmtId = cmt_id[i]
                $.ajax({
                      type: "POST",
                      url: "../Comentarios/code.php",
                      data: {
                          'cmt_id': cmtId,
                          'get_reply_num': true
                      },
                      success: function (response){
                        var comment_id = response[0].cmt['comment_id'];
                          if(response.length == 1){
                        
                            $('#reply_btn'+comment_id+'').html("");
                            $('#reply_btn'+comment_id+'').append('Ver '+response.length+' respuesta')
                          }
                          else{
                          $('#reply_btn'+comment_id+'').html("");
                          $('#reply_btn'+comment_id+'').append('Ver '+response.length+' respuestas')
                          }
          }
        });
      }
    }
  }); 
      var contador = 0;
       $(document).on('click', '.reply_btn', function(){

        var thisClicked = $(this);
        var cmt_id = thisClicked;
        contador = 0;
        
        $('#edit_alert_error').html("");

        $('#edit-form').html("");

         thisClicked.closest('.reply_box').find('.reply_section').html('<div id="alert_error"></div>\
         <div id = "reply-form">\
         <input type="text" class="reply_msg form-control my-2" placeholder="Responder">\
            <div class="text-end">\
                <button class="btn btn-sm btn-danger reply_cancel_btn">Cancelar</button>\
                <button class="btn btn-sm btn-primary reply_add_btn">Responder</button>\
            </div>\
            </div>');
            $('.reply_msg').focus()
    });
    var totalCmt = 0;
      $(document).on('click', '.view_reply_btn', function(e){
        e.preventDefault();
        var thisClicked = $(this);
        var cmt_id = thisClicked.val();
        if(contador != cmt_id){
        contador = cmt_id;
        $.ajax({
            type: "POST",
            url: "../Comentarios/code.php",
            data: {
                'cmt_id': cmt_id,
                'view_comment_data': true
            },
            success: function (response){
                totalCmt = response.length;
                $('.reply_section').html('');
                if(response.length == 1){
                  $('#reply_btn'+cmt_id+'').html("Ocultar "+totalCmt+" respuesta")
                }
                else{
                  $('#reply_btn'+cmt_id+'').html("Ocultar "+totalCmt+" respuestas")
                }

                $.each(response, function (key, value){
                if(value.user['id'] == user_id){
                 thisClicked.closest('.reply_box').find('.reply_section')
                .append('<div class="sub_reply_box border-bottom p-2 mb-2 ml-4" id="sub_reply_box'+value.cmt['id']+'">\
                            <input type="hidden" class="get_username" value="'+value.user['name']+'">\
                            <h6 class="border-bottom d-inline">'+value.user['name']+' : '+value.cmt['created_at']+'</h6>\
                            <input type="hidden" class="get_sub_cmt" value="'+value.cmt['reply_msg']+'">\
                            <p class = "para" id = "sub_edit_cmt'+value.cmt['id']+'">'+value.cmt['reply_msg']+'</p>\
                            <div>\
                            <button value="'+value.cmt['id']+'" class="like mb-2" id="selectedLi'+value.cmt['id']+'"><i class="fa fa-thumbs-up fa-lg"></i><span id="like'+value.cmt['id']+'">0</span></button><button value="'+value.cmt['id']+'" class="dislike mb-2" id="selectedDis'+value.cmt['id']+'"><i class="fa fa-thumbs-down fa-lg"></i><span id="dislike'+value.cmt['id']+'">0</span></button>\
                            </div>\
                            <button value="'+value.cmt['id']+'" class="badge btn-warning text-dark sub_edit_btn"><i class="bi bi-pencil-square"></i></button>\
                            <button value="'+value.cmt['id']+'" class="badge btn-warning text-dark sub_delete_btn"><i class="bi bi-trash3-fill"></i></button>\
                            <button value="'+value.cmt['comment_id']+'" class="badge btn-warning text-dark sub_reply_btn"><i class="bi bi-reply-fill"></i></button>\
                            <div class="ml-4 sub_reply_section">\
                            </div>\
                        </div>');
            } 
            if(value.user['id'] != user_id){
              thisClicked.closest('.reply_box').find('.reply_section')
                .append('<div class="sub_reply_box border-bottom p-2 mb-2" id="sub_reply_box'+value.cmt['id']+'">\
                            <input type="hidden" class="get_username" value="'+value.user['name']+'">\
                            <h6 class="border-bottom d-inline">'+value.user['name']+' : '+value.cmt['created_at']+'</h6>\
                            <p class = "para">'+value.cmt['reply_msg']+'</p>\
                            <div>\
                            <button value="'+value.cmt['id']+'" class="like mb-2" id="selectedLi'+value.cmt['id']+'"><i class="fa fa-thumbs-up fa-lg"></i><span id="like'+value.cmt['id']+'">0</span></button><button value="'+value.cmt['id']+'" class="dislike mb-2" id="selectedDis'+value.cmt['id']+'"><i class="fa fa-thumbs-down fa-lg"></i><span id="dislike'+value.cmt['id']+'"">0</span></button>\
                            </div>\
                            <button value="'+value.cmt['comment_id']+'" class="badge btn-warning text-dark sub_reply_btn"><i class="bi bi-reply-fill"></i></button>\
                            <div class="ml-4 sub_reply_section">\
                            </div>\
                        </div>');
            }
            var cmt_id = value.cmt['id'];
                var data1 = {
                'cmt_id': cmt_id,
                'get_likes': true,
               };
               var data2 = {
                'cmt_id': cmt_id,
                'get_dislikes': true,
               };
               $.ajax({
                type: "POST",
                url: "../Comentarios/code.php",
                data: data1,
                success: function(response){
                  $('#like'+cmt_id+'').html("");
                  $('#like'+cmt_id+'').append(response);        
                }
               })
               $.ajax({
                type: "POST",
                url: "../Comentarios/code.php",
                data: data2,
                success: function(response){
                  $('#dislike'+cmt_id+'').html("");
                  $('#dislike'+cmt_id+'').append(response);         
                }
               })
               var data3 = {
                'cmt_id': cmt_id,
                'user_id': user_id,
                'selection_like': true,
               }
               $.ajax({
                type: "POST",
                url: "../Comentarios/code.php",
                data: data3,
                success: function(response){
                  if(response == 1){
                    $('#selectedLi'+cmt_id+'').addClass("selected");
                  }
                }
               })
               var data4 = {
                'cmt_id': cmt_id,
                'user_id': user_id,
                'selection_dislike': true,
               }
               $.ajax({
                type: "POST",
                url: "../Comentarios/code.php",
                data: data4,
                success: function(response){
                  if(response == 1){
                    $('#selectedDis'+cmt_id+'').addClass("selected");   
                  }
                }
               })
          });

            }
        });
      }
      else{
        $('.reply_section').html("");
        if(totalCmt == 1){
                  $('#reply_btn'+cmt_id+'').html("Ver "+totalCmt+" respuesta")
                }
                else{
                  $('#reply_btn'+cmt_id+'').html("Ver "+totalCmt+" respuestas")
                }
        contador = 0;
      }
    });

  $(document).on('click', '.like', function(e){
    
    e.preventDefault();
    var thisClicked = $(this);
    var cmt_id = thisClicked.val();
    var user_id = <?php echo $_SESSION['auth_user_id']; ?>;
    var status = "like";
    var dataLike = {
                'cmt_id': cmt_id,
                'user_id': user_id,
                'selection_like': true,
               }
               $.ajax({
                type: "POST",
                url: "../Comentarios/code.php",
                data: dataLike,
                success: function(response){
                  if(response == 1){
                    $.ajax({
                        type: "POST",
                        url: "../Comentarios/code.php",
                        data: {
                          'cmt_id': cmt_id,
                          'user_id': user_id,
                          'delete_like': true,
                        },
                        success: function(response){
                          var data1 = {
                      'cmt_id': cmt_id,
                      'get_likes': true,
                    };
                    var data2 = {
                      'cmt_id': cmt_id,
                      'get_dislikes': true,
                    };
                    $.ajax({
                      type: "POST",
                      url: "../Comentarios/code.php",
                      data: data1,
                      success: function(response){
                        $('#like'+cmt_id+'').html("");
                        $('#like'+cmt_id+'').append(response);    
                        $('#selectedLi'+cmt_id+'').removeClass("selected");     
                      }
                    })
                    $.ajax({
                      type: "POST",
                      url: "../Comentarios/code.php",
                      data: data2,
                      success: function(response){
                        $('#dislike'+cmt_id+'').html("");
                        $('#dislike'+cmt_id+'').append(response);    
                      }
                    })
                        }
                      })
                    }
                    else{
                      var dataAddLike = {
                        'cmt_id': cmt_id,
                        'user_id': user_id,
                        'status': status,
                        'add_like': true,
                      };
                        $.ajax({
                        type: "POST",
                        url: "../Comentarios/code.php",
                        data: dataAddLike,
                        success: function(response){
                          var data1 = {
                      'cmt_id': cmt_id,
                      'get_likes': true,
                    };
                    var data2 = {
                      'cmt_id': cmt_id,
                      'get_dislikes': true,
                    };
                    $.ajax({
                      type: "POST",
                      url: "../Comentarios/code.php",
                      data: data1,
                      success: function(response){
                        $('#like'+cmt_id+'').html("");
                        $('#like'+cmt_id+'').append(response);   
                        $('#selectedLi'+cmt_id+'').addClass("selected"); 
                        $('#selectedDis'+cmt_id+'').removeClass("selected");
                      }
                    })
                    $.ajax({
                      type: "POST",
                      url: "../Comentarios/code.php",
                      data: data2,
                      success: function(response){
                        $('#dislike'+cmt_id+'').html("");
                        $('#dislike'+cmt_id+'').append(response); 
                      }
                    })
                        }
                      })
                    }
                 }
               })
  })
  $(document).on('click', '.dislike', function(e){
    e.preventDefault();
    var thisClicked = $(this);
    var cmt_id = thisClicked.val();
    var user_id = <?php echo $_SESSION['auth_user_id']; ?>;
    var status = "dislike";
    var dataDislike = {
                'cmt_id': cmt_id,
                'user_id': user_id,
                'selection_dislike': true,
               }
               $.ajax({
                type: "POST",
                url: "../Comentarios/code.php",
                data: dataDislike,
                success: function(response){
                  if(response == 1){            
                    $.ajax({
                    type: "POST",
                    url: "../Comentarios/code.php",
                    data: {
                      'cmt_id': cmt_id,
                      'user_id': user_id,
                      'delete_dislike': true,
                    },
                    success: function(response){
                      var data1 = {
                      'cmt_id': cmt_id,
                      'get_likes': true,
                    };
                    var data2 = {
                      'cmt_id': cmt_id,
                      'get_dislikes': true,
                    };
                    $.ajax({
                      type: "POST",
                      url: "../Comentarios/code.php",
                      data: data1,
                      success: function(response){
                        $('#like'+cmt_id+'').html("");
                        $('#like'+cmt_id+'').append(response);     
                      }
                    })
                    $.ajax({
                      type: "POST",
                      url: "../Comentarios/code.php",
                      data: data2,
                      success: function(response){
                        $('#dislike'+cmt_id+'').html("");
                        $('#dislike'+cmt_id+'').append(response); 
                        $('#selectedDis'+cmt_id+'').removeClass("selected")
                      }
                    })
                    }
                  })
                  }
                  else{
                    var dataAddDislike = {
                      'cmt_id': cmt_id,
                      'user_id': user_id,
                      'status': status,
                      'add_dislike': true,
                    };
                    $.ajax({
                      type: "POST",
                      url: "../Comentarios/code.php",
                      data: dataAddDislike,
                      success: function(response){
                        var data1 = {
                      'cmt_id': cmt_id,
                      'get_likes': true,
                    };
                    var data2 = {
                      'cmt_id': cmt_id,
                      'get_dislikes': true,
                    };
                    $.ajax({
                      type: "POST",
                      url: "../Comentarios/code.php",
                      data: data1,
                      success: function(response){
                        $('#like'+cmt_id+'').html("");
                        $('#like'+cmt_id+'').append(response);         
                      }
                    })
                    $.ajax({
                      type: "POST",
                      url: "../Comentarios/code.php",
                      data: data2,
                      success: function(response){
                        $('#dislike'+cmt_id+'').html("");
                        $('#dislike'+cmt_id+'').append(response);    
                        $('#selectedDis'+cmt_id+'').addClass("selected");
                        $('#selectedLi'+cmt_id+'').removeClass("selected");     
                      }
                    })
                      }
                    })         
                  }
                }
               }) 
  })
  }
});
</script>
  <?php
  }
  ?>