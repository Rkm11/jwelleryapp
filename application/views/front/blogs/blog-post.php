<script src="<?php echo base_url(); ?>media/front/js/blog-post.js"></script>
<script>
    var SITE_PATH = '<?php echo base_url(); ?>';
    setInputP('<?php echo $post_id; ?>');
</script>
<div class="middle-section blog-detail-page">
    <div class="bucket-listing calendar-page">
        <div class="container">
            <?php
            if ($this->session->userdata('blog_comment')) {
                ?>
                <div class="msg_close alert alert-success">
                    <?php echo $this->session->userdata('blog_comment'); ?>
                    <button class="close" id="msg_close" name="msg_close" data-dismiss="alert" type="button">x</button>
                </div>
                <?php
            }
            $this->session->unset_userdata('blog_comment');
            ?>
            <h1 class="main-title"><span>Blog</span></h1>
            <div class="blog-section">
                <div class="col-lg-8 col-md-8 col-sm-7"> 
                    <div class="main-blog-section">
                        <?php
                        foreach ($blog_posts as $post) {
                            ?>
                            <div class="blog-box">
                                <h3><a href="javascript:void(0);"><?php echo $post["post_title"]; ?></a></h3>
                                <div class="blog-dtls-opt"> <span class="blog-date"><i class="fa fa-calendar-o"></i><?php echo date("F d, Y", strtotime($post["posted_on"])); ?></span> <span class="blog-admin"><i class="fa fa-pencil"></i> Admin</span> <span class="blog-admin"><i class="fa fa-comments"></i> <a href="javascript:void(0);"><?php echo $comment_count; ?> Comments</a></span> </div>
                                <div class="blog-img"> 
                                    <?php if ($post['blog_image'] != '') { ?>
                                        <img style="width:595px;" alt="" src="<?php echo base_url() ?>media/backend/img/blog_image/thumbs/<?php echo $post['blog_image'] ?>" />
                                    <?php } else { ?>
                                        <img style="width:595px;" src="<?php echo base_url(); ?>media/front/img/blog1.jpg"/> 
                                    <?php } ?>
                                </div>
                                <div class="blog-content">
                                    <p><?php echo stripslashes($post["post_content"]); ?></p>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="blog-comments">
                            <div class="blog-comments-ttl"><i class="fa fa-comments"></i> Comments</div>
                            <div class="comment-content">
                                <?php
                                if (count($post_comments) > 0) {
                                    foreach ($post_comments as $comment) {
                                        ?>
                                        <div class="media"> 
                                            <span class="pull-left">
                                                <?php if (isset($comment['profile_picture']) && $comment['profile_picture'] != '') { ?>
                                                    <!--<img src="<?php echo base_url(); ?>media/front/img/user-profile-pictures/thumb/<?php echo $comment['profile_picture']; ?>"/>-->
                                                <?php } else { ?>
                                                    <!--<img src="<?php echo base_url(); ?>media/front/img/blog_img.png">-->
                                                <?php } ?>
                                            </span>
                                            <div class="media-body">
                                                <p class="c-name"><?php
                                                    if (isset($post_id)) {
                                                        echo $comment["commented_by"];
                                                    }
                                                    ?> </p>
                                                <p><?php echo nl2br(stripslashes($comment["comment"])); ?></p>
                                                <small>- Posted on <?php echo date("d<\s\up>S</\s\up> F, Y", strtotime($comment["comment_on"])); ?></small> </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    echo 'Comments not found.';
                                }
                                ?>  
                            </div>
                        </div>
                        <div class="blog-comments">
                            <div class="blog-comments-ttl"><i class="fa fa-pencil"></i> Write your comments</div>
                            <form class="form-horizontal" name="frmComments" id="frmComments" method="post">
                                <div class="comment-content">
                                    <div class="wr-inner">
									 <div class="controls">
                                		<label>Posted By:<span class="mandatory">*</span></label>
                               			<div class="input_holder">
                                           <input name="posted_by" id="posted_by" type="text" class="form-control" placeholder="Enter your name here" value="<?php echo $user_session['first_name'] ? $user_session['first_name'] . ' ' . $user_session['last_name'] : '' ?>">
                                  	   </div>
                           		    </div>
									<div class="controls">
                                		<label>Comment<span class="mandatory">*</span></label>
                               			<div class="input_holder">
                                         <textarea class="form-control" name="inputComment" id="inputComment" class="form-control" placeholder="Write your comments here..."></textarea>
                                  	   </div>
                           		    </div>
                                       
                                       <div class="controls">
									   
										<div class="col-lg-11">
											&nbsp;
										</div>
										<div class="input_holder">
                                        <input type="hidden" id="user_id" name="user_id"  value="<?php echo $user_session['user_id'] ? $user_session['user_id'] : ''; ?>"/>
                                        <button id="btn_post_comment" class="btn btn-primary" name="btn_post_comment" class="btn signup-btn">Post your comments</button> 
                                        <img name="btn_loader" id="btn_loader" style="display: none;" src="<?php echo base_url() ?>media/front/img/loader.gif"/>
										</div>
										</div>
                                    </div>
                                </div>
                            </form>     
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-5">
                    <div class="search-blog">
                        <div class="heading-small">Search blog</div>
                        <form method="post" action="<?php echo base_url(); ?>blog" name="blogsearch" id="blogsearch">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control" placeholder="Search blog post" <?php echo $this->session->userdata('search'); ?>>
                                <span class="input-group-btn">
                                   <button type="submit" class="btn btn-success" id="btn_search" name="btn_search">GO</button>
                                </span>
                            </div>
                            <div class="error" for="search" style="display:none"> Please enter blog name.</div>
                        </form>
                    </div>
                    <div class="posted-blog-list">
                        <div class="heading-small">Recent Posts</div>
                        <?php
                        if (isset($latest_blogs)) {
                            foreach ($latest_blogs as $blogs) {
                                ?> 
                                <div class="media"> 
                                    <a href="<?php echo base_url() ?>blog/<?php echo $blogs['url'] ?>"> 
                                        <span class="pull-left">
                                            <?php if ($blogs['blog_image'] != '') { ?>
                                                <img alt="" src="<?php echo base_url() ?>media/backend/img/blog_image/recent-thumbs/<?php echo $blogs['blog_image'] ?>" />
                                            <?php } else { ?>
                                                <img src="<?php echo base_url(); ?>media/front/img/blog1.jpg"/> 
                                            <?php } ?>
                                        </span>
                                        <div class="media-body"><?php echo substr($blogs['post_short_description'], 0, 70); ?></div>
                                    </a> 
                                </div>
                                <?php
                            }
                        } else {
                            echo 'No recent blog found.';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .posted-blog-list img {
  height: auto;
  width: 80px;
}
</style>
    