
<?php include('includes/header.php'); ?>
<style>
    .para{
        color:white;
    }
    h6{
        color:white;
    }
</style>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

            <div class="card">
                <div class="card-body ">
                    <div class="main-comment">

                        <div id="error_status"></div>
                        <textarea class="comment_textbox form-control mb-1" rows="2" placeholder="Escribe lo que piensas"></textarea>
                        <button type="button" class="btn btn-primary add_comment_btn">Comentar</button>
                        
                        <hr>

                        <div class="comment-container">
                       
                        </div>
                    </div>
                
                </div>
            </div>

            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>