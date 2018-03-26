<div class="box" id="refresh">
                    <div class="media-body">
                                    <div class="input-group">
                                        <input type="text" value="" placeholder="comment here..." id="comment" name="comment" class="form-control">                                            
                                        <input type="hidden" value="217" name="user_id">
                                        <input type="hidden" value="213" name="post_article_id">
                                        <span class="input-group-btn">                                            
                                            <input type="submit" value="POST COMMENT" name="btn_comment" onclick="postComment();" class="btn btn-default">                                            
                                        </span>                                        
                                    </div>
                                    <div class="comment-pic">
                                        <input type="file" title="Upload Image" class="upit-imgse" id="commnet_pic" onchange="readURL(this);" name="commnet_pic">
                                    </div>
                                                                        <label class="error" for="comment"></label>
                                </div>
    <div id="ss">
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