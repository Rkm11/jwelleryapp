<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('category_model');
        $this->load->model('product_model');
    }

    #function to list all the Products
    // to clean array

    public function cleanArray($array) {
        if (is_array($array)) {
            foreach ($array as $key => $sub_array) {
                $result = self::cleanArray($sub_array);
                if ($result === false) {
                    unset($array[$key]);
                } else {
                    $array[$key] = $result;
                }
            }
        }
        if (empty($array)) {
            return false;
        }
        return $array;
    }

    public function listProductBackend() {
//        error_reporting(E_ALL);
//        ini_set('display_errors', 'on');
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        $data = $this->common_model->commonFunction();
        $global = $data['global'];
        $arr_privileges = array();
        /*         * getting all privileges ** */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('15', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage product!</span>");
                redirect(base_url
                        () . "backend/home");
                exit();
            }
        }
        if (count($_POST)) {
            if (isset($_POST['btn_delete_all'])) {
                $arr_product_ids = $this->input->post('checkbox');
                if (count($arr_product_ids) > 0) {
#deleting the user selected
                    $this->common_model->deleteRows($arr_product_ids, "mst_products", "product_id");
                    $this->session->set_userdata("msg", "<span class='success'>Product deleted successfully!</span>");
                    redirect(base_url() . 'backend/products');
                }
            }
        }
        $products = $this->product_model->getAllProducts();
        $data['arr_product_open'] = $products;
        $data['title'] = "Manage Products";
        $this->load->view("backend/product/list-products", $data);
    }

    public function checkName() {

        if ($this->input->post('type') == 'edit') {

            if (($this->input->post('carat_name')) == ($this->input->post('carat_name'))) {
                echo "true";
                exit;
            } else {
                $arr_carat_detail = $this->common_model->getRecords('mst_carat', 'carat_name', array("carat_name" => mysql_real_escape_string($this->input->post('carat_name'))));

                if (count($arr_carat_detail) == 0) {
                    echo "true";
                } else {
                    echo "false";
                }
            }
        } else {

            $arr_carat_detail = $this->common_model->getRecords('mst_carat', 'carat_name', array("carat_name" => mysql_real_escape_string($this->input->post('carat_name'))));
            if (count($arr_carat_detail) == 0) {
                echo "true";
            } else {
                echo "false";
            }
        }
    }

    public function listCarat() {
//        error_reporting(E_ALL);
//        ini_set('display_errors', 'on');
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        $data = $this->common_model->commonFunction();
        $global = $data['global'];
        $arr_privileges = array();
        /*         * getting all privileges ** */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('15', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage product!</span>");
                redirect(base_url
                        () . "backend/home");
                exit();
            }
        }
        if (count($_POST)) {
            if (isset($_POST['btn_delete_all'])) {
                $arr_product_ids = $this->input->post('checkbox');
                if (count($arr_product_ids) > 0) {
#deleting the user selected
                    $this->common_model->deleteRows($arr_product_ids, "mst_carat", "carat_id");
                    $this->session->set_userdata("msg", "<span class='success'>Carat details deleted successfully!</span>");
                    redirect(base_url() . 'backend/carat/list');
                }
            }
        }
        $arr_carat = $this->common_model->getRecords('mst_carat', '', '');
        $data['arr_carat'] = $arr_carat;
        $data['title'] = "Manage Cart Details";
        $this->load->view("backend/carat/list", $data);
    }

    public function editCarat($carat_id) {
//        error_reporting(E_ALL);
//        ini_set('display_errors', 'on');
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        $data = $this->common_model->commonFunction();
        $global = $data['global'];
        $carat_id = base64_decode($carat_id);
//        echo $carat_id;die;
        $arr_privileges = array();
        /*         * getting all privileges ** */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('15', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage product!</span>");
                redirect(base_url
                        () . "backend/home");
                exit();
            }
        }
        if ($this->input->post('carat_name') != "") {
            $arr_to_insert = array(
                'carat_name' => $this->input->post('carat_name'),
                'customer_price' => $this->input->post('customer_price'),
                'wholeseller_price' => $this->input->post('wholeseller_price')
            );
            $condition=array('carat_id'=>$carat_id);
            $this->common_model->updateRow('mst_carat',$arr_to_insert,$condition );
                                $this->session->set_userdata("msg", "<span class='success'>Carat details updated successfully!</span>");
                    redirect(base_url() . 'backend/carat/list');
        }
        $arr_carat = $this->common_model->getRecords('mst_carat', '',$condition=array('carat_id'=>$carat_id) );
        $data['arr_carat'] = $arr_carat;
        $data['title'] = "Update Cart Details";
        $this->load->view("backend/carat/edit", $data);
    }

    public function addCarat() {
//        error_reporting(E_ALL);
//        ini_set('display_errors', 'on');
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        $data = $this->common_model->commonFunction();
        $global = $data['global'];
        $arr_privileges = array();
        /*         * getting all privileges ** */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('15', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage product!</span>");
                redirect(base_url
                        () . "backend/home");
                exit();
            }
        }
        if ($this->input->post('carat_name') != "") {
            $arr_to_insert = array(
                'carat_name' => $this->input->post('carat_name'),
                'customer_price' => $this->input->post('customer_price'),
                'wholeseller_price' => $this->input->post('wholeseller_price')
            );
            $this->common_model->insertRow($arr_to_insert, 'mst_carat');
                                $this->session->set_userdata("msg", "<span class='success'>Carat details added successfully!</span>");
                    redirect(base_url() . 'backend/carat/list');
        }

        $arr_carat = $this->common_model->getRecords('mst_carat', '', '');
        $data['arr_carat'] = $arr_carat;
        $data['title'] = "Add Cart Details";
        $this->load->view("backend/carat/add", $data);
    }

    function addProduct() {
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }

        //Getting Common data
        $data = $this->common_model->commonFunction();

        //checking for admin privilages
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('14', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage user!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }

        if ($this->input->post('product_name') != '') {
            $product_store = $this->input->post('store_id');
            $img = count($_FILES["product_img"]["name"]);
            $files = $_FILES['product_img'];
//                echo "<pre>";print_r($files);die;
//                                    echo $files;
            if ($img <= 6 && $img > 0) {

                for ($i = 0; $i < $img; $i++) {

                    $_FILES['product_img']['name'] = $files['name'][$i];
                    $_FILES['product_img']['type'] = $files['type'][$i];
                    $_FILES['product_img']['tmp_name'] = $files['tmp_name'][$i];
                    $_FILES['product_img']['error'] = $files['error'][$i];
                    $_FILES['product_img']['size'] = $files['product_img']['size'][$i];

                    if ($_FILES['product_img']['name'] != '') {
                        $absolute_path = $data['absolute_path'];
                        $upload_path = $absolute_path . 'media/front/img/product-img/';
                        $arr_file = $this->common_model->findExtension($_FILES['product_img']['name']);
                        $product_image = time() . rand(1000, 9999) . '.' . $arr_file['ext'];
                        $source_img = $_FILES['product_img']['tmp_name'];
                        $destination_img = $upload_path . $product_image;
                        $image = $this->common_model->compress_image($source_img, $destination_img, 80);
                        if ($image != '') {
                            $images[] = $product_image;
                        }

                        /* create thumbs */
                        $image_path = $absolute_path . 'media/front/img/product-img/';
                        $image_main = $image;
                        $thumbs_image = $image_path . "/thumb/" . $product_image;

                        $str_console = "convert " . $image_main . " -geometry x157 " . $thumbs_image;
                        exec($str_console);

                        $folder_name = $image_path . "/thumb-new/";
                        @mkdir($folder_name, 0777, true);
                        if (is_dir($folder_name)) {
                            $thumbs_image2 = $image_path . "/thumb-new/" . $product_image;
                            $str_console2 = "convert " . $image_main . " -resize 550X350^ " . $thumbs_image2;
                            exec($str_console2);
                        }
                    }
                }
//                            echo "<pre>";print_r($image);die;
//                            echo "ss";die;
//                            if (isset($images) && count($images)) {
//                                foreach ($images as $key => $file) {
//                                    if ($file != '') {
//                                        $folder_size = $folder_size + filesize($image_path . '/' . $file);
//                                    }
//                                }
//                            }
//                                    if (isset($images) && count($images) > 0) {
//                                        foreach ($images as $key => $file) {
//                                            $upload_dir = 'media/front/img/product-img/' ;
//                                            $upload_thumb = 'media/front/img/product-img' . '/thumb/';
//                                            $thumb_img = $upload_thumb . $file;
//                                            $old_image = $upload_dir . $file;
////                                            unlink($thumb_img);
////                                            unlink($old_image);
//                                        }
//                                    }
//                            die;
            } else {
                $this->session->set_userdata('msg_error', 'You can able to upload only 6 images.');
                redirect(base_url() . 'backend/product/add-product');
            }

            $product_name = addslashes($this->input->post('product_name'));
            $product_code = addslashes($this->input->post('p_code'));
            $store_id = addslashes($this->input->post('store_id'));
            $product_cat = $this->input->post('parent_cat');
            $product_sub_cat = $this->input->post('sub_cat');
            $size = $this->input->post('size');
            $product_desc = addslashes($this->input->post('product_desc'));
            $product_qnt = addslashes($this->input->post('size'));
            $discount = $this->input->post('discount');
            $product_price = round($this->input->post('product_price'), 3);
            $product_price_w = round($this->input->post('product_price_w'), 3);
            $product_qnt = $this->input->post('product_qnt');
            $p_height = $this->input->post('p_height');
            $p_weight = $this->input->post('p_weight');
            $p_width = $this->input->post('p_width');
            $d_weight = $this->input->post('d_weight');
            $tot_diamonds = $this->input->post('tot_diamonds');
            $metal_type = $this->input->post('metal_type');
            $metal_weight = $this->input->post('metal_weight');
            if ($product_qnt > 0) {
                $product_status = '0';
            } else {
                $product_status = '1';
            }
//                    echo "<pre>";print_r($_POST);die;
            $arr_to_insert = array(
                'product_name' => $product_name,
                'orignal_amount' => $product_price,
                'p_code' => $product_code,
                'orignal_amount_w' => $product_price_w,
                'category_id' => $product_cat,
                'product_description' => $product_desc,
                'quantity' => $product_qnt,
                'created_at' => date("Y-m-d H:i:s"),
                'product_status' => $product_status,
                'size' => $size,
                'product_status' => '1',
                'p_height' => $p_height,
                'p_weight' => $p_weight,
                'p_width' => $p_width,
                'd_weight' => $d_weight,
                'tot_diamonds' => $tot_diamonds,
                'metal_type' => $metal_type,
                'metal_weight' => $metal_weight,
            );

            $insert_id = $this->common_model->insertRow($arr_to_insert, 'mst_products');
            if ($insert_id != '') {
                if (isset($images) && count($images) > 0) {
                    foreach ($images as $product_images) {
                        $arr_insert = array('product_id_fk' => $insert_id,
                            'image_name' => $product_images
                        );
                        $this->common_model->insertRow($arr_insert, 'trans_product_images');
                    }
                }
                $this->session->set_userdata('msg_success', 'Your product added successfully!');
                redirect(base_url() . 'backend/products');
            } else {
                $this->session->set_userdata('msg_error', 'Sorry!! Error to add the product');
                redirect(base_url() . 'backend/product/add-product');
            }
        }
        $data['arr_stores'] = $this->common_model->getRecords('mst_store', '');
        $all_category = $this->category_model->getAllCategories(array('parent_id' => 0));

        foreach ($all_category as $key => $parent) {
            $all_category[$key]['sub_category'] = $this->category_model->getAllCategories(array('parent_id' => $parent['category_id']));
        }
        $data['all_category'] = $all_category;
        $data['title'] = "Add Product";
        $this->load->view('backend/product/add-product', $data);
    }

    public function changeProductStatus() {
        if ($this->input->post('product_id') != "") {
            $arr_to_update = array("product_status" => $this->input->post('product_status'));
            /* condition to update record for the article status */
            $condition_array = array('product_id' => intval($this->input->post('product_id')));
            $this->common_model->updateRow('mst_products', $arr_to_update, $condition_array);
            $this->session->set_userdata('msg', "<span class='success'>Status updated successfully.</span>");
            echo json_encode(array("error" => "0", "error_message" => "Status updated successfully."));
        } else {
            /* if something going wrong providing error message.  */
            echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
        }
    }

    public function viewProductBackend($product_id) {
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('msg', "<span class='error'>Please login to proceed further.");
            redirect('backend/login');
        }
        $data = $this->common_model->commonFunction();
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('15', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage product!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        $product_id = base64_decode($product_id);
        $data['product_detail'] = $this->product_model->getProductDetail($product_id);
        $data['product_image'] = $this->common_model->getRecords('trans_product_images', '', array('product_id_fk' => $product_id));
        $data['title'] = "View Products";
        $this->load->view("backend/product/view-product", $data);
    }

    /*
     * get file name and extension array
     *
     */

    function findExtension($filename) {
        $filename = strtolower($filename);
        $exts = explode(".", $filename);
        $file_name = '';
        for ($i = 0; $i <= count($exts) - 2; $i++) {
            $file_name .=$exts[$i];
        }
        $n = count($exts) - 1;
        $exts = $exts[$n];
        $arr_return = array(
            'file_name' => $file_name,
            'ext' => $exts
        );
        return $arr_return;
    }

    /*
     * END findExtension
     *
     */

    public function editProductBackend($product_id = '') {
//        error_reporting(E_ALL);
//        ini_set('display_errors', 'on');
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('msg_error', 'Please login to proceed further.');
            redirect('signin');
        }
        $data = $this->common_model->commonFunction();
        $user_id = $data['user_account'] ['user_id'];

        $product_id = base64_decode($product_id);
        if ($product_id != '') {
            $products = $this->product_model->getProuctDetilsById($product_id);
            if ($products[0]['product_id'] != '') {
                foreach ($products as $key => $user_product) {
                    $products[$key]['images'] = $this->common_model->getRecords('trans_product_images', 'product_img_id,image_name', array('product_id_fk' => $user_product['product_id']));
                }
                if ($user_id != '') {
                    if ($this->input->post('product_name') != '') {
                        $product_store = $this->input->post('store_id');
                        $store_details = $this->common_model->getRecords('mst_store', '', array('store_id' => $product_store), '', '', 0);
                        $img = count($_FILES['product_img']['name']);
                        $files = $_FILES;
//                        echo "<pre>";
//                                                print_r($files);die;
                        if ($img <= 6) {

                            $upload_flag = true;

                            if ($upload_flag) {
                                for ($i = 0; $i < $img; $i++) {
                                    $_FILES['product_image']['name'] = $files['product_img']['name'][$i];
                                    $_FILES['product_image']['type'] = $files['product_img']['type'][$i];
                                    $_FILES ['product_image']['tmp_name'] = $files['product_img']['tmp_name'][$i];
                                    $_FILES['product_image']['error'] = $files['product_img']['error'][$i];
                                    $_FILES['product_image']['size'] = $files['product_img']['size'][$i];
                                    if ($_FILES['product_image']['name'] != '') {
                                        $absolute_path = $data['absolute_path'];
                                        $upload_path = $absolute_path . 'media/front/img/product-img/';
                                        $arr_file = $this->common_model->findExtension($_FILES['product_image'] ['name']);
                                        $product_image = time() . rand(1000, 9999) . '.' . $arr_file['ext'];
                                        $source_img = $_FILES['product_image']['tmp_name'];
                                        $destination_img = $upload_path . $product_image;
//                                        echo $destination_img;die;
                                        $image = $this->common_model->compress_image($source_img, $destination_img, 80);
                                        if ($image != '') {
                                            $images[] = $product_image;
                                         }
                                        /* create thumbs */
                                        $image_path = $absolute_path . 'media/front/img/product-img/' ;
                                        $image_main = $image;
                                        $thumbs_image = $image_path . "/thumb/" . $product_image;
                                        $str_console = "convert " . $image_main . " -geometry x157 " . $thumbs_image;
                                        exec($str_console);

                                        $folder_name = $image_path . "/thumb-new/";
                                        @mkdir($folder_name, 0777, true);
                                        if (is_dir($folder_name)) {
                                            $thumbs_image2 = $image_path . "/thumb-new/" . $product_image;
                                            $str_console2 = "convert " . $image_main . " -resize 550X350^ " . $thumbs_image2;
                                            exec($str_console2);
                                        }
                                    }
                                }

                                if (isset($images) && count($images)) {
                                    foreach ($images as $key => $file) {
                                        if ($file != '') {
                                            $folder_size = $folder_size + filesize($image_path . '/' . $file);
                                        }
                                    }
                                }


//                                if (isset($images) && count($images) > 0) {
//                                    foreach ($images as $key => $file) {
//                                        $upload_dir = 'media/front/img/product-img/' . '/';
//                                        $upload_thumb = 'media/front/img/product-img/' . '/thumb';
//                                        $upload_new_thumb = 'media/front/img/product-img/' . '/thumb-new';
//                                        $new_thumb_img = $upload_new_thumb . $file;
//                                        $thumb_img = $upload_thumb . $file;
//                                        $old_image = $upload_dir . $file;
//                                        unlink($new_thumb_img);
//                                        unlink($thumb_img);
//                                        unlink($old_image);
//                                    }
//                                }
                            }
                        } else {
                            $this->session->set_userdata('msg_error', 'You can able to upload only 6 images.');
                            redirect(base_url() . 'backend/products');
                        }
                        $product_name = addslashes($this->input->post('product_name'));
                        $product_code = addslashes($this->input->post('p_code'));
//                        $product_store = $this->input->post('store_id_fk');
                        $product_cat = $this->input->post('parent_cat');
//                        $product_sub_cat = $this->input->post('sub_cat');
                        $product_price = round($this->input->post('product_price'), 3);
                        $product_price_w = round($this->input->post('product_price_w'), 3);
                        $product_desc = addslashes($this->input->post('product_desc'));
                        $product_qnt = $this->input->post('product_qnt');
                        $p_height = $this->input->post('p_height');
                        $p_weight = $this->input->post('p_weight');
                        $p_width = $this->input->post('p_width');
                        $d_weight = $this->input->post('d_weight');
                        $tot_diamonds = $this->input->post('tot_diamonds');
                        $metal_type = $this->input->post('metal_type');
                        $metal_weight = $this->input->post('metal_weight');
                        if ($products[0]['product_status'] != '2') {
                            if ($product_qnt <= 0) {
                                $product_status = '0';
                            } else {
                                $product_status = '1';
                            }
                        } else {
                            $product_status = $products[0]['product_status'];
                        }

                        if ($this->input->post('color') != '') {
                            $arr_clr = array();
                            $arr_clr = $this->input->post('color');
                            $product_clr = implode(',', $arr_clr);
                        } else {
                            $product_clr = '';
                        }

                        if ($this->input->post('size') != '') {
                            $product_size = $this->input->post('size');
                        } else {
                            $product_size = '';
                        }
                        $arr_to_update = array(
                            'product_name' => $product_name,
                            'orignal_amount' => $product_price,
                            'p_code' => $product_code,
                            'orignal_amount_w' => $product_price_w,
                            'best_selling' => $this->input->post('best_selling'),
                            'sub_category_id' => $product_sub_cat,
//                            'store_id_fk' => $product_store,
                            'product_description' => $product_desc,
                            'quantity' => $product_qnt,
                            'product_status' => $product_status,
                            'updated_at' => date("Y-m-d  H:i:s"),
                            'product_color' => $product_clr,
                            'size' => $product_size,
                            'p_height' => $p_height,
                            'p_weight' => $p_weight,
                            'p_width' => $p_width,
                            'd_weight' => $d_weight,
                            'tot_diamonds' => $tot_diamonds,
                            'metal_type' => $metal_type,
                            'metal_weight' => $metal_weight
                        );
//                        echo "ss";die;
                        $this->common_model->updateRow('mst_products', $arr_to_update, array('product_id' => $product_id));
                        if (isset($images) && count($images) > 0) {
                            $store_details = $this->common_model->getRecords('mst_store', '', array('store_id' => $products[0]['store_id_fk']));
                            $product_images = $this->common_model->getRecords('trans_product_images', '', array('product_id_fk' => $product_id));

//                            if (isset($product_images) && count($product_images) > 0) {
//                                foreach ($product_images as $key => $value) {
//                                    $this->common_model->commonFunctionToDeleteSingleRecord('trans_product_image', 'img_id', $value['img_id']);
//                                    $upload_dir = 'media/front/img/product-img/'  . '/';
//                                    $upload_thumb = 'media/front/img/product-img/'  . '/thumb/';
//                                    $thumb_img = $upload_thumb . $value['img_name'];
//                                    $old_image = $upload_dir . $value['img_name'];
//
//                                    unlink($thumb_img);
//                                    unlink($old_image);
//                                }
//                            }
                            foreach ($images as $product_images) {
                                $arr_insert = array('product_id_fk' => $product_id,
                                    'image_name' => $product_images
                                );
                                $this->common_model->insertRow($arr_insert, 'trans_product_images');
                            }
                        }

                        $this->session->set_userdata('msg_success', 'Your product updated successfully!');
                        redirect(base_url() . 'backend/products');
                    }
                }
            } else {
                $this->session->set_userdata('msg_error', 'Sorry, This product is not available.');
                redirect(base_url() . 'backend/products');
            }
        }
        $data['product_information'] = $this->common_model->getRecords('mst_products', '', array('product_id' => $product_id));
        $data['product_images'] = $this->common_model->getRecords('trans_product_images', '', array('product_id_fk' => $product_id));
        $data['product'] = $products[0];
        $data['storefronts'] = $this->common_model->getRecords('mst_store', '');
        $all_category = $this->category_model->getAllCategories(array('parent_id' => 0));
        foreach ($all_category as $key => $parent) {
            $all_category[$key]['sub_category'] = $this->category_model->getAllCategories(array('parent_id' => $parent['category_id']));
        }
        $data['all_category'] = $all_category;
        $data['sub_category'] = $this->category_model->getAllCategories(array('parent_id' => $products[0]['category_id']));
        $data['all_categories'] = $all_category;
        $data['title'] = "Edit Products";
        $this->load->view("backend/product/edit-product", $data);
    }
    
    public function deleteImage(){
//        error_reporting(E_ALL);
//        ini_set('display_errors', 'on');
        $image_id=  $this->input->post('product_id');
//        echo "sss";die;
//        $image_id=array()
        $this->common_model->deleteRows(array($image_id), "trans_product_images", "product_img_id");
    }

    public function ListOrderProductsBackend() {
//        error_reporting(E_ALL);
//        ini_set('display_errors','on');
//        echo "<pre>";print_r();die('s');
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('msg', "<span class='error'>Please login to proceed further.");
            redirect('backend/login');
        }
        /* Getting Common data */
        $data = $this->common_model->commonFunction();
        /* checking user has privilige for the Manage Admin */
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('26', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage logistic TNT!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }

//        foreach ($data['arr_order'] as $key => $order) {
//            if (($order['product_order_status'] == 5) || ($order['product_order_status'] == 6)) {
//                $return_cancel_details = $this->common_model->getRecords('trans_product_cancel_return', '', array('product_ordet_id_fk' => $order['product_order_id']));
//                $data['arr_order'][$key]['return_cancel_details'] = $return_cancel_details[0];
//            }
//        }
        $data['type'] = $status;
        $data['title'] = "Manage Order";
        $this->load->view('backend/order/product-list', $data);
    }

    public function inquiryList() {

        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('msg', "<span class='error'>Please login to proceed further.");
            redirect('backend/login');
        }
        /* Getting Common data */
        $data = $this->common_model->commonFunction();
        /* checking user has privilige for the Manage Admin */
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('26', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage logistic TNT!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        if (count($_POST)) {
//            echo  "<pre>";print_r($_POST);die;
//            echo "sss";die;
            if (isset($_POST['btn_delete_all'])) {
                $arr_product_ids = $this->input->post('checkbox');
                if (count($arr_product_ids) > 0) {
#deleting the user selected
                    $this->common_model->deleteRows($arr_product_ids, "mst_enquiry", "enquiry_id");
                    $this->session->set_userdata("msg", "<span class='success'>Enquiry deleted successfully!</span>");
                    redirect(base_url() . 'backend/inquiries/list');
                }
            }
        }
        $data['arr_inquiry'] = $this->common_model->getRecords('mst_enquiry', '', '');
        $data['title'] = "Manage Inquiry";
        $this->load->view('backend/inquiry/list', $data);
    }

    public function inquiryView($id) {

        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('msg', "<span class='error'>Please login to proceed further.");
            redirect('backend/login');
        }
        /* Getting Common data */
        $data = $this->common_model->commonFunction();
        /* checking user has privilige for the Manage Admin */
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('26', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage logistic TNT!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        $data['arr_inquiry'] = $this->common_model->getRecords('mst_enquiry', '', array('enquiry_id' => $id));
        $data['title'] = "View Details";
        $this->load->view('backend/inquiry/view', $data);
    }

}

/* End of file advertise.php */
/* Location: ./application/controllers/advertise.php */