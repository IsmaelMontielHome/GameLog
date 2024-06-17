
<?php
session_start();
include('../Comentarios/dbcon.php');

$postId = $_SESSION['postId'];

if(isset($_POST['delete_dislike'])){
    $cmt_id = mysqli_real_escape_string($con, $_POST['cmt_id']);
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);

    $get_likes = "DELETE FROM `ratings` WHERE cmt_id = $cmt_id AND user_id = $user_id AND `status` = 'dislike'";

    $get_likes_run = mysqli_query($con, $get_likes);
}

if(isset($_POST['delete_like'])){
    $cmt_id = mysqli_real_escape_string($con, $_POST['cmt_id']);
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);

    $get_likes = "DELETE FROM `ratings` WHERE cmt_id = $cmt_id AND user_id = $user_id AND `status` = 'like'";

    $get_likes_run = mysqli_query($con, $get_likes);
}

if(isset($_POST['selection_dislike'])){
    $cmt_id = mysqli_real_escape_string($con, $_POST['cmt_id']);
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);

    $get_dislikes = "SELECT * FROM `ratings` WHERE cmt_id = $cmt_id AND user_id = $user_id AND `status` = 'dislike'";

    $get_dislikes_run = mysqli_query($con, $get_dislikes);

    if(mysqli_num_rows($get_dislikes_run) > 0){
        echo 1;
    }
}


if(isset($_POST['selection_like'])){
    $cmt_id = mysqli_real_escape_string($con, $_POST['cmt_id']);
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);

    $get_dislikes = "SELECT * FROM `ratings` WHERE cmt_id = $cmt_id AND user_id = $user_id AND `status` = 'like'";

    $get_dislikes_run = mysqli_query($con, $get_dislikes);

    if(mysqli_num_rows($get_dislikes_run) > 0){
        echo 1;
        $_SESSION['contadorLi'] = 1;
    }
}

if(isset($_POST['get_dislikes'])){
    $cmt_id = mysqli_real_escape_string($con, $_POST['cmt_id']);
    $get_dislikes = "SELECT * FROM `ratings` WHERE cmt_id = $cmt_id AND `status` = 'dislike'";
    $get_dislikes_run = mysqli_query($con, $get_dislikes);
    echo mysqli_num_rows($get_dislikes_run);
}

if(isset($_POST['get_likes'])){
    $cmt_id = mysqli_real_escape_string($con, $_POST['cmt_id']);
    $get_likes = "SELECT * FROM `ratings` WHERE cmt_id = $cmt_id AND `status` = 'like'";
    $get_likes_run = mysqli_query($con, $get_likes);
    echo mysqli_num_rows($get_likes_run);
}

if(isset($_POST['add_like'])){
    $cmt_id = mysqli_real_escape_string($con, $_POST['cmt_id']);
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    $select_query = "SELECT * FROM ratings WHERE cmt_id=$cmt_id AND user_id=$user_id";
    $select_query_run = mysqli_query($con, $select_query);

    $get_likes = "SELECT * FROM `ratings` WHERE cmt_id = $cmt_id AND `status` = '$status'";
    $get_likes_run = mysqli_query($con, $get_likes);

    if(mysqli_num_rows($select_query_run) <= 0){
        $query = "INSERT INTO ratings (`cmt_id`, `user_id`, `status`) VALUES ('$cmt_id', '$user_id', '$status')";
        $query_run = mysqli_query($con, $query);    
        $_SESSION['contadorLi'] = 1;
    }
    if(mysqli_num_rows($select_query_run) > 0){
        foreach($select_query_run as $row){
            $current_status = $row['status'];
            if($current_status != $status){
                $query = "UPDATE ratings SET `status` = '$status' WHERE cmt_id=$cmt_id AND user_id = '$user_id'";
                $query_run = mysqli_query($con, $query);
                $_SESSION['contadorLi'] = 1;
            }
            else{
                echo mysqli_num_rows($get_likes_run);
            }
        }
    }
}

if(isset($_POST['add_dislike'])){
    $cmt_id = mysqli_real_escape_string($con, $_POST['cmt_id']);
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    $select_query = "SELECT * FROM ratings WHERE cmt_id=$cmt_id AND user_id=$user_id";
    $select_query_run = mysqli_query($con, $select_query);

    $get_dislikes = "SELECT * FROM `ratings` WHERE cmt_id = $cmt_id AND `status` = '$status'";
    $get_dislikes_run = mysqli_query($con, $get_dislikes);
    echo mysqli_num_rows($get_dislikes_run);

    if(mysqli_num_rows($select_query_run) <= 0){
        $query = "INSERT INTO ratings (`cmt_id`, `user_id`, `status`) VALUES ('$cmt_id', '$user_id', '$status')";
        $query_run = mysqli_query($con, $query);     
    }
    if(mysqli_num_rows($select_query_run) > 0){
        foreach($select_query_run as $row){
            $current_status = $row['status'];
            if($current_status != $status){
                $query = "UPDATE ratings SET `status` = '$status' WHERE cmt_id=$cmt_id AND user_id = '$user_id'";
                $query_run = mysqli_query($con, $query);
    }
}
}
}

if(isset($_POST['sub_edit_cmt'])){
    
    $cmt_id = mysqli_real_escape_string($con, $_POST['cmt_id']);
    $msg = mysqli_real_escape_string($con, $_POST['edit_msg']);

    $query = "UPDATE comment_replies SET reply_msg='$msg', created_at=CURRENT_TIMESTAMP WHERE id=$cmt_id";
    $query_run = mysqli_query($con, $query);
}

if(isset($_POST['edit_cmt'])){
    
    $cmt_id = mysqli_real_escape_string($con, $_POST['cmt_id']);
    $msg = mysqli_real_escape_string($con, $_POST['edit_msg']);

    $query = "UPDATE comments SET msg='$msg', created_at=CURRENT_TIMESTAMP WHERE id=$cmt_id";
    $query_run = mysqli_query($con, $query);

}

if(isset($_POST['sub_delete_cmt'])){
    $cmt_id = mysqli_real_escape_string($con, $_POST['cmt_id']);

    $viewQuery = "SELECT * FROM comment_replies WHERE comment_id='$cmt_id'";
    $viewQuery_run = mysqli_query($con, $viewQuery);

    $result_array = [];

    if(mysqli_num_rows($viewQuery_run) > 0 ){
        echo "hola";
        foreach($viewQuery_run as $row)
        {
            $user_id = $row['user_id'];
            $user_query = "SELECT * FROM usertable WHERE id='$user_id' LIMIT 1";
            $user_query_run = mysqli_query($con, $user_query);
            $user_result = mysqli_fetch_array($user_query_run);

            array_push($result_array, ['cmt'=>$row, 'user'=>$user_result]);

        }
        header('Content-type: application/json');
        echo json_encode($result_array);
    }

    $query = "DELETE FROM comment_replies WHERE id='$cmt_id'";
    $query_run = mysqli_query($con, $query);
    $queryDeleteReaction = "DELETE FROM ratings WHERE cmt_id = '$cmt_id'";
    $queryDeleteReactionRun = mysqli_query($con, $queryDeleteReaction);
}

if(isset($_POST['add_sub_replies'])){
    $cmt_id = mysqli_real_escape_string($con, $_POST['cmt_id']);
    $reply = mysqli_real_escape_string($con, $_POST['reply_msg']);

    if(!isset($_SESSION['auth_user_id'])){
       echo "No has Iniciado sesión";
    }
    else{
    $user_id = $_SESSION['auth_user_id'];

    $query = "INSERT INTO comment_replies (user_id, comment_id, reply_msg) VALUES ('$user_id', '$cmt_id', '$reply')";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        echo "Comentario Respondido";
    }
    else{
        echo "Algo Salió Mal!";
    }
    }
}

if(isset($_POST['delete_cmt'])){
    $cmt_id = mysqli_real_escape_string($con, $_POST['cmt_id']);
    $querySelectReplies = "SELECT * FROM comment_replies WHERE comment_id = '$cmt_id'";
    $querySelectRepliesRun = mysqli_query($con, $querySelectReplies);
    if(mysqli_num_rows($querySelectRepliesRun) > 0 ){
        foreach($querySelectRepliesRun as $row){
            $cmt_replies_id = $row['id'];
            $queryDeleteRepliesReaction = "DELETE FROM ratings WHERE cmt_id = '$cmt_replies_id'";
            $queryDeleteRepliesReactionRun = mysqli_query($con, $queryDeleteRepliesReaction);
        }
    }

    $deleteQuery = "DELETE FROM comments WHERE id='$cmt_id'";
    $deleteReplies = "DELETE FROM comment_replies WHERE comment_id='$cmt_id'";
    $queryDeleteReaction = "DELETE FROM ratings WHERE cmt_id = '$cmt_id'";
    $queryDeleteReactionRun = mysqli_query ($con, $queryDeleteReaction);
    $deleteQueryRun = mysqli_query($con, $deleteQuery);
    $deleteReplies = mysqli_query($con, $deleteReplies);
    

}

if(isset($_POST['get_reply_num'])){
    $cmt_id = mysqli_real_escape_string($con, $_POST['cmt_id']);

    $query = "SELECT * FROM comment_replies WHERE comment_id='$cmt_id'";
    $query_run = mysqli_query($con, $query);

    $result_array = [];

    if(mysqli_num_rows($query_run) > 0 ){
        foreach($query_run as $row)
        {
            $user_id = $row['user_id'];
            $user_query = "SELECT * FROM usertable WHERE id='$user_id' LIMIT 1";
            $user_query_run = mysqli_query($con, $user_query);
            $user_result = mysqli_fetch_array($user_query_run);

            array_push($result_array, ['cmt'=>$row, 'user'=>$user_result]);

        }
        header('Content-type: application/json');
        echo json_encode($result_array);
    }
    else{
        $_SESSION['status'] = "No hay respuestas por ver";
    }

}

if(isset($_POST['view_comment_data'])){
    $cmt_id = mysqli_real_escape_string($con, $_POST['cmt_id']);

    $query = "SELECT * FROM comment_replies WHERE comment_id='$cmt_id' ORDER BY id DESC";
    $query_run = mysqli_query($con, $query);

    $result_array = [];

    if(mysqli_num_rows($query_run) > 0 ){
        foreach($query_run as $row)
        {
            $user_id = $row['user_id'];
            $user_query = "SELECT * FROM usertable WHERE id='$user_id' LIMIT 1";
            $user_query_run = mysqli_query($con, $user_query);
            $user_result = mysqli_fetch_array($user_query_run);

            array_push($result_array, ['cmt'=>$row, 'user'=>$user_result]);

        }
        header('Content-type: application/json');
        echo json_encode($result_array);
    }
    else{
        $_SESSION['status'] = "No hay respuestas por ver";
    }

}

if(isset($_POST['add_reply'])){
    $cmt_id = mysqli_real_escape_string($con, $_POST['comment_id']);
    $reply = mysqli_real_escape_string($con, $_POST['reply_msg']);

    if(!isset($_SESSION['auth_user_id'])){
       echo "No has Iniciado sesión";
    }
    else{
    $user_id = $_SESSION['auth_user_id'];

    $query = "INSERT INTO comment_replies (user_id, comment_id, reply_msg) VALUES ('$user_id', '$cmt_id', '$reply')";
    $query_run = mysqli_query($con, $query);
    }
    $viewQuery = "SELECT * FROM comment_replies WHERE comment_id='$cmt_id' ORDER BY id DESC";
    $viewQuery_run = mysqli_query($con, $viewQuery);

    $result_array = [];

    if(mysqli_num_rows($viewQuery_run) > 0 ){
        foreach($viewQuery_run as $row)
        {
            $user_id = $row['user_id'];
            $user_query = "SELECT * FROM usertable WHERE id='$user_id' LIMIT 1";
            $user_query_run = mysqli_query($con, $user_query);
            $user_result = mysqli_fetch_array($user_query_run);

            array_push($result_array, ['cmt'=>$row, 'user'=>$user_result]);

        }
        header('Content-type: application/json');
        echo json_encode($result_array);
    }
    else{
        $_SESSION['status'] = "No hay respuestas por ver";
    }
}


if(isset($_POST['comment_load_data'])){
    $comments_query = "SELECT * FROM comments WHERE postId = $postId ORDER BY id DESC";
    $comments_query_run = mysqli_query($con, $comments_query);

    $array_result = [];

    if(mysqli_num_rows($comments_query_run) > 0 ){
        foreach($comments_query_run as $row)
        {
            $user_id = $row['user_id'];
            $user_query = "SELECT * FROM usertable WHERE id='$user_id' LIMIT 1";
            $user_query_run = mysqli_query($con, $user_query);
            $user_result = mysqli_fetch_array($user_query_run);

            array_push($array_result, ['cmt'=>$row, 'user'=>$user_result]);

        }
        header('Content-type: application/json');
        echo json_encode($array_result);
    }
    else{
        echo "Escribe un comentario";
    }

    
}

if(isset($_POST['add_comment'])){
    $msg = mysqli_real_escape_string($con, $_POST['msg']);

    if(!isset($_SESSION['auth_user_id'])){
        echo 0;
    }
    else{
        $user_id = $_SESSION['auth_user_id'];
        $comment_add_query = "INSERT INTO comments (user_id, postId, msg) VALUES ('$user_id', '$postId','$msg')";
        $comment_add_query_run = mysqli_query($con, $comment_add_query);
    
    }
    $comments_query = "SELECT * FROM comments WHERE postId = '$postId' ORDER BY id DESC";
    $comments_query_run = mysqli_query($con, $comments_query);

    $array_result = [];

    if(mysqli_num_rows($comments_query_run) > 0 ){
        foreach($comments_query_run as $row)
        {
            $user_id = $row['user_id'];
            $user_query = "SELECT * FROM usertable WHERE id='$user_id' LIMIT 1";
            $user_query_run = mysqli_query($con, $user_query);
            $user_result = mysqli_fetch_array($user_query_run);

            array_push($array_result, ['cmt'=>$row, 'user'=>$user_result]);

        }
        header('Content-type: application/json');
        echo json_encode($array_result);
    }

    
   
}
?>

