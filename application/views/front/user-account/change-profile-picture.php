<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>media/front/css/imgareaselect-animated.css" />
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/front/js/jquery.img-area-select.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/front/js/crop-image.js"></script>
<style type="text/css">
    .img_upload{
        background-color: #61B3DE;
        border: 0 none;
        border-radius: 10px 10px 10px 10px;
        color: white;
        cursor: pointer;
        font-style: italic;
        font-weight: bold;
        padding: 6px 15px 5px;
        font-size:15px;
    }

    .img_upload:hover{
        text-decoration:none !important;
        color:#FFFFFF !important;
    }
    img#uploadPreview{
        border: 0;        
        border-radius: 3px;
        -webkit-box-shadow: 0px 2px 7px 0px rgba(0, 0, 0, .27);
        box-shadow: 0px 2px 7px 0px rgba(0, 0, 0, .27);
        margin-bottom: 30px;
        overflow: hidden;
        width:80%;
        height:80%;
    }

    .bcak a{
        background-color: #61B3DE;
        border: 0 none;
        border-radius: 10px 10px 10px 10px;
        color: white;
        cursor: pointer;
        font-style: italic;
        font-weight: bold;
        padding: 6px 15px 5px;
        text-decoration: none;
    }
    .bcak a:hover{
        background-color: #43AC6A;
    }
</style>
<script type="text/javascript">
    function performClick(node) {
        var evt = document.createEvent("MouseEvents");
        evt.initEvent("click", true, false);
        node.dispatchEvent(evt);
    }
</script>
<div class="container">
    <div class="bs-docs-section">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12">
                    <h1 id="buttons"><?php echo ucfirst($arr_user_data['user_name']); ?>'s Profile Picture</h1>
                </div>
            </div>
        </div>
    </div>    
    <section> 
        <div class="row">
            <div class="col-lg-12">
                <div class="well">
                    <!-- image preview area-->
                    <img  id="front_image_tag_id" style="display:none;" width="150"/>
                    <img id="previous_images1" src="<?php echo $profile_img_path; ?>" border="0" width="150" style="margin:5px;" >
                    <p id="hint">Drag-drop your mouse on uploaded image to select image area for crop</p>
                    
                    <form name="frm_profile_picture" id="frm_profile_picture" method="post" action="<?php echo base_url(); ?>profile/change-profile-picture" enctype="multipart/form-data">
                        <input type="hidden" name="old_profile_picture" id="old_profile_picture" value="<?php echo $arr_user_data['profile_picture']; ?>">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $arr_user_data['user_id']; ?>">
                        <!-- hidden inputs -->
                        <input type="hidden" id="x" name="x" />
                        <input type="hidden" id="y" name="y" />
                        <input type="hidden" id="w" name="w" />
                        <input type="hidden" id="h" name="h" />   
                        <div class="form-group">

                            <!--<a href="javascript:void(0);" class="img_upload" class="ajax" onclick="performClick(document.getElementById('upload_profile_picture'));">Browse file</a>-->
<!--                            <input type="file" style="display: none;" id="upload_profile_picture" name="upload_profile_picture"  />
                            <input class="img_upload" type="button" value="Browse" onclick="performClick(document.getElementById('upload_profile_picture'));">-->
                            
                             <input  type="file" id="upload_profile_picture" name="upload_profile_picture" onchange="readURL(this);">
                            <input class="img_upload" type="submit" value="Upload" id="btn_upload" name="btn_upload">
                            <a href="<?php echo base_url(); ?>profile" title="Cancel Upload" class="img_upload" />Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
    </section>
    <br>
</div>
        <script type="text/javascript">
    function readURL(input) {

        if (input.files && input.files[0] && input.files[0].type=='image/jpeg' || input.files[0].type=='image/png' || input.files[0].type=='image/gif' || input.files[0].type=='image/jpg') {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#front_image_tag_id').attr('src', e.target.result);
                $("#previous_images1").css("display", "none");
                $("#front_image_tag_id").css("display", "block");
            }

            reader.readAsDataURL(input.files[0]);
        }else{
            alert("Please upload .png, .jpeg or .gif images only.");
            $("#upload_profile_picture").replaceWith($("#upload_profile_picture").val('').clone(true));
            return false;
        }
    }
</script>