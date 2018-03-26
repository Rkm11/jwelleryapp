
<?php 
$this->load->view('backend/sections/header'); ?>
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
<aside class="right-side">
    <section class="content-header">
        <h1>
            Update Carat Details						 
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>backend/carat/list"><i class="fa fa-fw fa-user"></i> Manage Carat</a></li>
            <li class="active">	Update Carat Details </li>

        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <form name="frm_edit_category"  enctype="multipart/form-data" id="frm_edit_category" action="<?php echo base_url(); ?>backend/carat/edit/<?php echo base64_encode($arr_carat[0]['carat_id']); ?>" method="POST">
                        <input type="hidden" value="<?php echo $arr_carat[0]['carat_id']; ?>" name="carat_id" id="carat_id">
                        <input type="hidden" value="<?php echo base_url(); ?>" id="base_url" name="base_url">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="User Name">Carat Name<sup class="mandatory">*</sup></label>
                                <input type="text" id="carat_name" name="carat_name" class="form-control" value="<?php echo $arr_carat[0]['carat_name']; ?>">
                                <input type="hidden" value="<?php echo $arr_carat[0]['carat_name']; ?>" id="old_carat_name" name="old_carat_name">   			 
                            </div>
                            <div class="form-group">
                                <label for="User Name">Wholeseller Price Price(per 1 gram)<sup class="mandatory">*</sup></label>
                                <input type="text" id="wholeseller_price" name="wholeseller_price" class="form-control" value="<?php echo $arr_carat[0]['wholeseller_price']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="User Name">Customer Price<sup class="mandatory">*</sup></label>
                                <input type="text" id="customer_price" name="customer_price" class="form-control" value="<?php echo $arr_carat[0]['customer_price']; ?>">
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
        <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/carat-manage/edit-carat.js"></script>