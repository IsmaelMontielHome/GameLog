$(document).ready(function () {

$(document).on('click', '.sub_edit_btn', function(e)
{
    e.preventDefault();
    var thisClicked = $(this);
    var cmt_id = thisClicked.val();
    var msg = thisClicked.closest('.sub_reply_box').find('.get_sub_cmt').val()

    $('#sub_reply_form').html("")

    thisClicked.closest('.sub_reply_box').find('#sub_edit_cmt'+cmt_id+'').html("")

    thisClicked.closest('.sub_reply_box').find('#sub_edit_cmt'+cmt_id+'').append('<div id="edit_alert_error"></div><div id="sub_edit_form">\
                    <input type = "text" value = "'+msg+' " class = "sub_edit_msg form-control my-2" placeholder = "Edita el comentario....."\
                    </div>\
                    <div class = "text-end">\
                        <button class = "btn btn-sm btn-danger sub_edit_cancel_btn">Cancelar</button>\
                        <button class = "btn btn-sm btn-primary sub_edit_add_btn" value = "'+cmt_id+'"> Guardar</button>\
                    </div>')
    $('#edit_alert_error').html("Editando Comentario:")

    $('.edit_msg').focus()
    
})

$(document).on('click', '.sub_edit_add_btn', function(e)
{
    e.preventDefault();
    var thisClicked = $(this);
    var cmt_id = thisClicked.val();
    var edit_msg = thisClicked.closest('.sub_reply_box').find('.sub_edit_msg').val();

    if($.trim(edit_msg).length == 0)
       {
        error_msg = "Porfavor escribe un comentario:";
        $('#edit_alert_error').text(error_msg);
       }else{
        error_msg = "";
        $('#edit_alert_error').text(error_msg);
       }
       if(error_msg != '')
       {
            return false;
       }
       else
       {
            
    $.ajax({
        type: "POST",
        url: "../Comentarios/code.php",
        data: {
          'cmt_id': cmt_id,
          'edit_msg': edit_msg,
          'sub_edit_cmt': true
        },
        success: function(response){
        $("#sub_edit_cmt"+cmt_id+"").html(edit_msg);
        }
 
      })
    }   
})


$(document).on('click', '.sub_edit_cancel_btn', function(e){
    e.preventDefault();
    var thisClicked = $(this);
    var msg = thisClicked.closest('.sub_reply_box').find('.get_sub_cmt').val()
    thisClicked.closest('.sub_reply_box').find('#sub_edit_cmt').html(msg)
    

})

$(document).on('click', '.edit_btn', function(e)
{
    e.preventDefault();
    var thisClicked = $(this);
    var cmt_id = thisClicked.val();
    var msg = thisClicked.closest('.reply_box').find('.get_cmt').val()

    $('.reply_section').html("")

    $('#reply-form').html("")

    $('#alert_error').html("")

    thisClicked.closest('.reply_box').find('#edit_cmt'+cmt_id+'').html("")

    thisClicked.closest('.reply_box').find('#edit_cmt'+cmt_id+'').append('<div id="edit_alert_error"></div><div id="edit-form">\
                    <input type = "text" value = "'+msg+' " class = "edit_msg form-control my-2" placeholder = "Edita el comentario....."\
                    </div>\
                    <div class = "text-end">\
                        <button class = "btn btn-sm btn-danger edit_cancel_btn" value = "'+cmt_id+'">Cancelar</button>\
                        <button class = "btn btn-sm btn-primary edit_add_btn" value = "'+cmt_id+'"> Guardar</button>\
                    </div>')
    $('#edit_alert_error').html("Editando Comentario:")

    $('.edit_msg').focus()
    
})

$(document).on('click', '.edit_add_btn', function(e)
{
    e.preventDefault();
    var thisClicked = $(this);
    var cmt_id = thisClicked.val();
    var edit_msg = thisClicked.closest('.reply_box').find('.edit_msg').val();

    if($.trim(edit_msg).length == 0)
       {
        error_msg = "Porfavor escribe un comentario:";
        $('#alert_error').text(error_msg);
       }else{
        error_msg = "";
        $('#alert_error').text(error_msg);
       }
       if(error_msg != '')
       {
            return false;
       }
       else
       {
            
    $.ajax({
        type: "POST",
        url: "../Comentarios/code.php",
        data: {
          'cmt_id': cmt_id,
          'edit_msg': edit_msg,
          'edit_cmt': true
        },
        success: function(response){
            $('#edit_cmt'+cmt_id+'').html(edit_msg)
        }
 
      })
    }   
})

$(document).on('click', '.edit_cancel_btn', function(e){
    e.preventDefault();
    var thisClicked = $(this);
    var cmt_id = thisClicked.val();
    var msg = thisClicked.closest('.reply_box').find('.get_cmt').val();
    thisClicked.closest('.reply_box').find('#edit_cmt'+cmt_id+'').html(msg);
    

})

$(document).on('click', '.sub_delete_btn', function(e)
{
e.preventDefault();
var respuesta = confirm("Estas seguro que deseas eliminar el comentario?");
    
        if (respuesta === true){
            var thisClicked = $(this);
            var cmt_id = thisClicked.val();
            $('#sub_reply_box'+cmt_id+'').remove();
            
            $.ajax({
              type: "POST",
              url: "../Comentarios/code.php",
              data: {
                'cmt_id': cmt_id,
                'sub_delete_cmt': true
              },
              success: function(response){
                console.log(response)
                if(response.length == 1){
                    $('.view_reply_btn').html("Ocultar "+response.length+" respuesta");
                    }
                    else{
                    $('.view_reply_btn').html("Ocultar "+response.length+" respuestas");
                    }
              }
              
            })
        }
        else{
            return false;
        }
})

$(document).on('click', '.delete_btn', function(e)
{
e.preventDefault();
var respuesta = confirm("Estas seguro que deseas eliminar el comentario?");
    
        if (respuesta === true){
            var thisClicked = $(this);
            var cmt_id = thisClicked.val();
            $("#reply_box"+cmt_id+"").remove();
            $.ajax({
              type: "POST",
              url: "../Comentarios/code.php",
              data: {
                'cmt_id': cmt_id,
                'delete_cmt': true
              },
              success: function(response){
              }
              
            })
        }
        else{
            return false;
        }
})

    $(document).on('click', '.sub_reply_btn',function(e){
        e.preventDefault()

        var thisClicked = $(this)
        var cmt_id = (thisClicked.val())
        var username = thisClicked.closest('.sub_reply_box').find('.get_username').val()
        
        $('#edit_alert_error').html("");

        $('#sub_edit_form').html("");

        $('.sub_reply_section').html("");

        thisClicked.closest('.sub_reply_box').find('.sub_reply_section').append('<div id="alert_error"></div><div id = "sub_reply_form">\
                    <input type = "text" value = "@'+username+' " class = "sub_reply_msg form-control my-2" placeholder = "Tu Respuesta...."\
                    </div>\
                    <div class = "text-end">\
                        <button class = "btn btn-sm btn-danger text-dark sub_cancel_btn">Cancelar</button>\
                        <button class = "btn btn-sm btn-primary text-dark sub_reply_add_btn">Responder</button>\
                    </div>\
                    ')

        $('.sub_reply_msg').focus()
    });

    $(document).on('click', '.sub_cancel_btn', function(e){
        e.preventDefault()
        $('.sub_reply_section').html("");

    })

    $(document).on('click', '.sub_reply_add_btn',function(e){
        e.preventDefault()

        var thisClicked = $(this)
        var cmt_id = thisClicked.closest('.sub_reply_box').find('.sub_reply_btn').val()
        var reply = thisClicked.closest('.sub_reply_box').find('.sub_reply_msg').val()
        var msg = $('.sub_reply_msg').val();

        
       if($.trim(msg).length == 0)
       {
        error_msg = "Porfavor escribe un comentario:";
        $('#alert_error').text(error_msg);
       }else{
        error_msg = "";
        $('#alert_error').text(error_msg);
       }
       if(error_msg != '')
       {
            return false;
       }
       else
       {

        var data = {
            'cmt_id': cmt_id,
            'reply_msg': reply,
            'add_sub_replies': true
        }
        $.ajax({
            type: "POST",
            url: "../Comentarios/code.php",
            data: data,
            success: function(response) {
            }

        })
      }
    });

    $(document).on('click', '.reply_cancel_btn',function(){

        $('.reply_section').html(""); 

        

    });

    $(document).on('click', '.reply_add_btn',function(e){
        
       e.preventDefault();
       var thisClicked = $(this);
       var cmt_id = thisClicked.closest('.reply_box').find('.reply_btn').val();
       var reply = thisClicked.closest('.reply_box').find('.reply_msg').val();
       var msg = $('.reply_msg').val();

       if($.trim(msg).length == 0)
       {
        error_msg = "Porfavor escribe un comentario:";
        $('#alert_error').text(error_msg);
       }else{
        error_msg = "";
        $('#alert_error').text(error_msg);
       }
       if(error_msg != '')
       {
            return false;
       }
       else
       {

       var data = {
            'comment_id' : cmt_id,
            'reply_msg' : reply,
            'add reply' : true
       }

       $.ajax({
        type: "POST",
        url: "../Comentarios/code.php",
        data: data,
        success: function (response) {
            $('.sub_reply_box').remove();
            $('.reply_msg').val('');
            $('.view_reply_btn').html("");
            if(response.length == 1){
            $('.view_reply_btn').html("Ocultar "+response.length+" respuesta");
            }
            else{
            $('.view_reply_btn').html("Ocultar "+response.length+" respuestas");
            }
            $.each(response, function(key, value){
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
                    var cmt_id = value.cmt['id'];
                    var user_id = value.user['id'];
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
    });
    
    $('.add_comment_btn').click(function (e){
        
        e.preventDefault();
       var msg = $('.comment_textbox').val();
       if($.trim(msg).length == 0)
       {
        error_msg = "Porfavor escribe un comentario:";
        $('#error_status').text(error_msg);
       }else{
        error_msg = "";
        $('#error_status').text(error_msg);
       }
       if(error_msg != '')
       {
            return false;
       }
       else
       {
            var data = {
                'msg': msg,
                'add_comment': true,
            };
            $.ajax({
                type: "POST",
                url: "../Comentarios/code.php",
                data: data,
                success: function (response) {
                if(response == 0){
                error_msg = "Inicia Sesión para Comentar!";
                $('#error_status').text(error_msg);    
                }
                else{                
                    $('.comment-container').html(''); 
                    $('.comment_textbox').val('');
                    $.each(response, function(key, value){
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
                            <button value="'+value.cmt['id']+'" class="badge btn-danger view_reply_btn" id ="'+value.cmt['id']+'">No hay respuestas</button>\
                            </div>\
                            <div class="ml-4 reply_section">\
                            </div>\
                        </div>\
                        '); 
                        var cmt_id = value.cmt['id'];
                        var user_id = value.user['id'];
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
                    }) 
                    
                }
                }
            });


       }
    });
});