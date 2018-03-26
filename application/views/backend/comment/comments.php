<?php $this->load->view('backend/sections/header'); ?>
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
<style>
    .post-arti-comt {
    border-bottom: 1px solid #eee;
    margin: 30px 0;
    padding: 0 10px 20px;
}
.media-left, .media > .pull-left {
    padding-right: 10px;
}
input-group-addon, .input-group-btn {
    vertical-align: middle;
    white-space: nowrap;
    width: 1%;
}
.input-group .form-control, .input-group-addon, .input-group-btn {
    display: table-cell;
}
.media-body, .media-left, .media-right {
    display: table-cell;
    vertical-align: top;
}
a {
    color: #337ab7;
    text-decoration: none;
}
a {
    background-color: transparent;
}
.post-ari-img {
    border: 3px solid #cccccc;
    border-radius: 50%;
    height: 60px;
    position: relative;
    width: 60px;
}
.post-ari-img img {
    border-radius: 50%;
    height: 100%;
    width: 100%;
}
img {
    vertical-align: middle;
}
</style>
<aside class="right-side">
    <section class="content-header">
        <h1>
            comments
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box" >
                    <div class="media-body">
                                    <div class="input-group">
                                        <input type="text" value="" placeholder="comment here..." id="comment" name="comment" class="form-control">                                            
                                        <input type="hidden" value="217" name="user_id" id="user_id">
                                        <input type="hidden" value="213" name="post_article_id" id="post_article_id">
                                        <span class="input-group-btn">                                            
                                            <input type="submit" value="POST COMMENT" name="btn_comment" onclick="postComment();" class="btn btn-default">                                            
                                        </span>                                        
                                    </div>
                                    <div class="comment-pic">
                                        <input type="file" title="Upload Image" class="upit-imgse" id="comment_pic" onchange="readURL(this);" name="comment_pic">
                                    </div>
                                                                        <label class="error" for="comment"></label>
                                </div>
                    <div id="refresh">
                    <?php foreach($arr_comments as $com) { ?>
                    <div class="media">
                            <div class="media-left">
                                <a data-placement="left" title="Visit Page" href="<?php echo base_url(); ?>" class="more">
                                                    <?php $def_profile_img='avtar.png' ?>
                                    <div class="post-ari-img"><img onerror="src='<?php echo base_url(); ?>media/front/img/user-profile-pictures/<?php echo $def_profile_img;?> ?>'" alt="profile" src="<?php echo base_url(); ?>media/front/img/user-profile-pictures/<?php echo $com['profile_picture'] ?>"></div>
                                </a>
                            </div>
                            <div class="media-body">
                                <a data-placement="left" title="Visit Page" href="" class="more">
                                    <h4 class="media-heading"><?php echo $com['user_name']; ?> - <span class="sl-italic"><?php echo $com['comment_date']; ?></span> 
                                        <span class="pull-right"></span></h4>
                                </a>
                                <p><?php echo $com['comment'] ?></p>
                                <div class="replies-count">
                                    <a onclick="postReply('1')" class="show-reply-box" href="javascript:void(0);">Reply</a>
                                    <a href="javascript:void(0);"><i onclick="replies('1')" aria-hidden="true" class="fa fa-comment"></i>
                                    0									</a>
                                </div>
                                
                                <div style="display: none;" id="rep_d1">
                                </div>
                                                            </div>
                        </div>
                    <?php  } ?>
                </div>
                </div>
            </div>
        </div>
        </div>
<?php $this->load->view('backend/sections/footer'); ?>
<script type="text/javascript">
        function postComment() {
            var comment=$('#comment').val();
            var post_article_id=$('#post_article_id').val();
            var user_id=$('#user_id').val();
            var comment_pic=$('#comment_pic').val();
            $.ajax({
                url: "<?php echo base_url(); ?>post-comment", //The url where the server req would we made.                 async: false,
                type: "POST", //The type which you want to use: GET/POST1
                data: {
                    'comment':comment ,'article_id':post_article_id,'user_id':user_id,
                    'comment_pic':comment_pic
                }, //The variables which are going.
                dataType: "html", //Return data type (what we expect).
                success: function(response) {
//                    if (response == "success") {
                        $('#refresh').html(response);
//                    } else {
//                    }
                }
            });
        }
    </script>