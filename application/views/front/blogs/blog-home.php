<div class="middle-section blog-page">
    <div class="bucket-listing calendar-page">
        <div class="container">
            <h1 class="main-title"><span>Blog</span></h1>
            <div class="blog-section">
                <div class="col-lg-8 col-md-8 col-sm-7"> 
                    <div class="main-blog-section">
                        <?php
                        if (isset($blog_posts)) {
                            foreach ($blog_posts as $post) {
                                ?>
                                <div class="blog-box">
                                    <h3><a href="<?php echo base_url(); ?>blog/<?php echo $post["page_url"]; ?>"><?php echo $post["post_title"]; ?></a></h3>
                                    <div class="blog-dtls-opt"> <span class="blog-date"><i class="fa fa-calendar-o"></i><?php echo date("F d, Y", strtotime($post["posted_on"])); ?></span> <span class="blog-admin"><i class="fa fa-pencil"></i> Admin</span> <span class="blog-admin"><i class="fa fa-comments"></i> <a href="<?php echo base_url(); ?>blog/<?php echo $post["page_url"]; ?>"><?php echo $post["comment_count"] ?> Comments</a></span> </div>
                                    <div class="">
                                        <?php if ($post['blog_image'] != '') { ?>
                                            <img style="width:595px;" alt="" src="<?php echo base_url() ?>media/backend/img/blog_image/thumbs/<?php echo $post['blog_image'] ?>" />
                                        <?php } else { ?>
                                            <img style="width:595px;" src="<?php echo base_url(); ?>media/front/img/blog1.jpg"/> 
                                        <?php } ?>
                                    </div>
                                    <div class="blog-content">
                                        <p><?php echo stripslashes($post["post_short_description"]); ?></p>
                                        <a class="btn signup-btn" href="<?php echo base_url(); ?>blog/<?php echo $post["page_url"]; ?>">Read More</a> </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo 'No blog found.';
                        }
                        ?>
                        <?php if ($create_links != '') { ?>
                            <div class="text-center pagination-box">
                                <?php echo $create_links; ?>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-5">
                    <div class="search-blog">
                        <div class="heading-small">Search blog</div>
                        <form method="post" action="<?php echo base_url(); ?>blog" name="blogsearch" id="blogsearch">
                            <div class="input-group">
                                <input type="hidden" name="search_null" id="search_null" value="1">
                                <input type="search" name="search" class="form-control" placeholder="Search blog post" value="<?php echo $this->session->userdata('search'); ?>">
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
