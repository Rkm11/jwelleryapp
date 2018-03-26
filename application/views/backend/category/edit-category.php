
<?php 
$this->load->view('backend/sections/header'); ?>
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
<aside class="right-side">
    <section class="content-header">
        <h1>
            Update Category						 
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>backend/categories/list"><i class="fa fa-fw fa-user"></i> Manage Categories</a></li>
            <li class="active">	Update Category </li>

        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <form name="frm_edit_category"  enctype="multipart/form-data" id="frm_edit_category" action="<?php echo base_url(); ?>backend/category/edit-category/<?php echo base64_encode($arr_categary[0]['category_detail_id']); ?>" method="POST">
                        <input type="hidden" value="<?php echo $arr_categary[0]['category_detail_id']; ?>" name="category_detail_id" id="category_detail_id">
                        <input type="hidden" value="<?php echo base_url(); ?>" id="base_url" name="base_url">
                        <input type="hidden" value="<?php echo $arr_categary[0]['category_id']; ?>" name="category_id" id="category_id">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="User Name">Category Name<sup class="mandatory">*</sup></label>
                                <input type="text" id="category_name" name="category_name" class="form-control" value="<?php echo $arr_categary[0]['category_name']; ?>">
                                <input type="hidden" value="<?php echo $arr_categary[0]['category_name']; ?>" id="old_category_name" name="old_category_name">   			 </div>
                            <div class="form-group">
                                <label for="country">Parent Category :</label>
                                <select class="form-control" name="parent_category" id="parent_category">
                                   <option value="0">No Parent</option>
                                         <?php foreach($arr_categary_list as $category){if($category['parent_id']==0){?>
                                                <option <?php if($arr_categary[0]['parent_id'] == $category['category_id'] ){?> selected="selected" <?php }?> value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="form-group" >
                                <label for=" End Date "> Image</label>
                                <input  dir="ltr" id="cat_image" name="cat_image" type="file">
                                <img height="200px" width="200px" src="<?php echo base_url()?>media/backend/img/<?php echo ($arr_categary[0]['category_img'])?$arr_categary[0]['category_img']:'no_image.png'; ?>">
                            </div>
                            <div class="form-group">
                                <label for="User Name">Category Description<sup class="mandatory">*</sup></label>
                                <textarea type="text" id="category_description" name="category_description" class="form-control" ><?php echo $arr_categary[0]['category_description']; ?></textarea>
                            </div>


                            <div class="box-footer">
                                <button type="submit" name="btnUpdate" class="btn btn-primary" value="Save changes">Save Changes</button>
                            </div>
                    
                </div>
                <!--[sortable body]--> 
                </form>
            </div>
        </div>
        <!--[sortable table end]--> 
        <!--[include footer]-->
        </div><!--/#content.span10-->
        </div><!--/fluid-row-->
        <?php $this->load->view('backend/sections/footer.php'); ?>  
        <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/category-manage/edit-category.js"></script>