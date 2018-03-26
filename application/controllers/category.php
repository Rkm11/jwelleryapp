<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->model('common_model');
        /* checking admin is logged in or not */
    }

    public function category_master($fn_to_call, $param1 = "", $param2 = "") {
        $fn_to_call = str_replace("-", "_", $fn_to_call);
        if (method_exists("Category", $fn_to_call)) {
            if ($param1 != "" && $param2 != "") {
                $this->$fn_to_call($param1, $param2);
            } else if ($param1 != "") {
                $this->$fn_to_call($param1);
            } else {
                $this->$fn_to_call();
            }
        }
    }

    /* list category functionlity backend */

    public function listCategory() {
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }

        $arr_category_ids = $this->input->post('checkbox');

        if (!empty($arr_category_ids) && count($arr_category_ids) > 0) {
            foreach ($arr_category_ids as $id) {

                $this->category_model->deleteCategory($id);
            }
            $this->session->set_userdata("msg", "<span class='success'>Category deleted successfully!</span>");
        }

        /* call to delete function to delete the table row */
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
            if (in_array('13', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage user!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }

        $data['title'] = 'Manage Category';
        $condition_to_pass = array("lang_id" => '17');
        $data['arr_categary_list'] = $this->category_model->getAllCategories($condition_to_pass);
        $this->load->view('backend/category/list-category', $data);
    }

    /* edit category functionlity backend */

    public function editCategory($category_detail_id) {
        $category_detail_id = base64_decode($category_detail_id);
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
            exit();
        }
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
            if (in_array('13', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage user!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        if ($this->input->post('category_name') != '' && $this->input->post('category_description') != '') {
            $parent_category = $this->input->post('parent_category');
            $update_data1 = array(
                "parent_id" => $parent_category
            );

            $this->category_model->updateParentCategory($update_data1, $this->input->post('category_detail_id'));

            if ($_FILES['cat_image'] != '') {
                $files = $_FILES['cat_image'];
                $_FILES['cat_image']['name'] = $files['name'];
                $_FILES['cat_image']['type'] = $files['type'];
                $_FILES['cat_image']['tmp_name'] = $files['tmp_name'];
                $_FILES['cat_image']['error'] = $files['error'];
                $_FILES['cat_image']['size'] = $files['cat_image']['size'];

                if ($_FILES['cat_image']['name'] != '') {
                    $absolute_path = $data['absolute_path'];
                    $upload_path = $absolute_path . 'media/backend/img/';
                    $arr_file = $this->common_model->findExtension($_FILES['cat_image']['name']);
                    $file_name = time() . rand(1000, 9999) . '.' . $arr_file['ext'];
                    $source_img = $_FILES['cat_image']['tmp_name'];
                    $destination_img = $upload_path . $file_name;
                    $image = $this->common_model->compress_image($source_img, $destination_img, 80);
                    if ($image != '') {
                        $images[] = $file_name;
                    }
                }
            }
            if ($file_name != "") {
                $update_data = array(
                    "category_name" => $this->input->post('category_name'),
                    "category_img" => $file_name,
                    "category_description" => $this->input->post('category_description')
                );
            }else{
                $update_data = array(
                    "category_name" => $this->input->post('category_name'),
                    "category_description" => $this->input->post('category_description')
                );
            }
            $lang_id = 17;
            $this->category_model->update_category($update_data, $lang_id, $this->input->post('category_detail_id'));
            $this->session->set_userdata("msg", "<span class='success'> Category updated successfully!</span>");
            redirect(base_url() . "backend/categories/list");
            exit();
        }

        if ($data['user_account']['role_id'] != 1) {
            /* checking user has privilege to access the manage testimonial */
            $user_account = $this->session->userdata('user_account');
            /* getting user Privileges from the session array */
            $user_priviliges = ($user_account['user_privileges']);
            if (!in_array(3, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage business categories!</span>");
                redirect(base_url() . "backend/home");
            }
        }
        $condition_to_pass = array("lang_id" => '17');
        $data['arr_categary_list'] = $this->category_model->getAllCategoriesForSelect($condition_to_pass);
        $lang_id = 17;
        $data['arr_categary'] = $this->category_model->getAllCategoryInfoById($category_detail_id, $lang_id);
        $data['title'] = 'Edit Category';
        $this->load->view('backend/category/edit-category', $data);
    }

    /* add category functionlity backend */

    public function addCategory() {
        error_reporting(E_ALL);
        ini_set('display_errors', 'on');
        $data = $this->common_model->commonFunction();
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
            exit();
        }
        //checking for admin privilages
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('13', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage user!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        $user_account = $this->session->userdata('user_account');
        if ($this->input->post('category_name') != '' && $this->input->post('category_description') != '') {
            $category_name = $this->input->post('category_name');
            $category_description = $this->input->post('category_description');
            $lang_id = 17;            
            if (count($category_name) > 0) {
                $parent_id = $this->input->post('parent_category');
                $insert = array("category_id" => '', "parent_id" => $parent_id);
                $last_insert_id = $this->category_model->insertCategoryId($insert);
                if ($_FILES != '') {
                    
                    $files = $_FILES['cat_image'];
                    $_FILES['cat_image']['name'] = $files['name'];
                    $_FILES['cat_image']['type'] = $files['type'];
                    $_FILES['cat_image']['tmp_name'] = $files['tmp_name'];
                    $_FILES['cat_image']['error'] = $files['error'];
                    $_FILES['cat_image']['size'] = $files['cat_image']['size'];
                     
                    if ($_FILES['cat_image']['name'] != '') {
                        $absolute_path = $data['absolute_path'];
                        $upload_path = $absolute_path . 'media/backend/img/';
                        $arr_file = $this->common_model->findExtension($_FILES['cat_image']['name']);
                        $file_name = time() . rand(1000, 9999) . '.' . $arr_file['ext'];
                        $source_img = $_FILES['cat_image']['tmp_name'];
                        $destination_img = $upload_path . $file_name;
                        $image = $this->common_model->compress_image($source_img, $destination_img, 80);
                        if ($image != '') {
                            $images[] = $file_name;
                        }
                    }
                }
                $insert_data = array(
                    'category_name' => addslashes($category_name),
                    'category_description' => addslashes($category_description),
                    'category_id_fk' => $last_insert_id,
                    'category_img' => $file_name,
                    'created_date' => date('Y-m-d H:i:s'),
                    'created_by' => $data['user_account']['user_id'],
                    "lang_id" => $lang_id
                );
                $this->category_model->insertCategory($insert_data);
                $this->session->set_userdata("msg", "<span class='success'> Category added successfully!</span>");
                redirect(base_url() . "backend/categories/list");
                exit();
            }
        }
        $condition_to_pass = array("lang_id" => '17');
        $data['arr_categary_list'] = $this->category_model->getAllCategoriesForSelect($condition_to_pass);
        $data['title'] = 'Add Category';
        $this->load->view('backend/category/add-category', $data);
    }

    public function changeLanguage($category_detail_id) {
        $data = $this->common_model->commonFunction();
        $category_detail_id = base64_decode($category_detail_id);
        $data['category_detail_id'] = $category_detail_id;
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
            exit();
        }
        //checking for admin privilages
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('13', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage user!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }

        $data['arr_get_language'] = $this->category_model->getAllLanguages();
        //$data['arr_category_list'] = $this->category_model->getAllCategoryInfoById($category_detail_id);
        $user_account = $this->session->userdata('user_account');
        if ($this->input->post("lang_id") != '') {
            $condition_to_pass = array("lang_id" => $this->input->post("lang_id"));
            $data['arr_categary_list'] = $this->category_model->getAllCategoriesForSelect($condition_to_pass);

            if (count($data['arr_categary_list']) <= 0) {

                $arr_fields = array("category_id_fk" => $this->input->post("category_id"),
                    "lang_id" => $this->input->post("lang_id"),
                    "category_name" => $this->input->post("category_name"),
                    "category_description" => $this->input->post("category_description"),
                    "created_date" => date('Y-m-d H:i:s'),
                    "created_by" => $user_account['user_id']
                );

                $insert_data = $this->category_model->insertCategory($arr_fields);
                $this->session->set_userdata("msg", "<span class='success'> category added successfully!</span>");
                redirect(base_url() . "backend/categories/list");
            } else {

                $update_data = array("category_name" => $this->input->post("category_name"), "category_description" => $this->input->post("category_description"));
                $condition = array(
                    'category_id_fk' => $this->input->post('category_id'),
                    'lang_id' => $this->input->post("lang_id")
                );
                if ($this->input->post('category_id') != '' && $this->input->post('category_id') != 0)
                    $update = $this->common_model->updateRow('trans_category_details', $update_data, $condition);
                $this->session->set_userdata("msg", "<span class='success'> category updated successfully!</span>");
                redirect(base_url() . "backend/categories/list");
                exit();
            }
        }
        $data['category_id'] = ($category_detail_id);
        $data['title'] = 'change category name in diffrent language';
        $this->load->view('backend/category/change-language', $data);
    }

    public function getAllCategoryNames() {
        $data['arr_category_names'] = array();
        $data['arr_category_list'] = array();
        $lang_id = $this->input->post('lang_id');
        $category_id_fk = $this->input->post('category_id_fk');
        $table_to_pass = 'trans_category_details';
        $condition_to_pass = array("lang_id" => $lang_id, 'category_id_fk' => $category_id_fk);
        $data['arr_category_names'] = $this->category_model->getCategoryInformation($table_to_pass, $fields_to_pass = '', $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_category_list'] = $this->category_model->getAllCategories($condition_to_pass = '');

        if (count($data['arr_category_names']) > 0) {
            ?>

            <div class="form-group">
                <label for="User Name">Category Name<sup class="mandatory">*</sup></label>
                <input type="hidden" class="form-control" name="old_category_name" id="old_category_name" value="<?php
            if (isset($data['arr_category_names'])) {
                echo $data['arr_category_names'][0]['category_name'];
            }
            ?>">
                <input type="text" class="form-control"  name="category_name" id="category_name" value="<?php
                       if (isset($data['arr_category_names'])) {
                           echo $data['arr_category_names'][0]['category_name'];
                       }
                       ?>">

                <input type="hidden" name="category_detail_id" id="category_detail_id" value="<?php
            if (isset($data['arr_category_names'])) {
                echo $data['arr_category_names'][0]['category_detail_id'];
            }
                       ?>">
            </div>

            <div class="form-group">
                <label for="User Name">Category Description<sup class="mandatory">*</sup></label>
                <textarea  class="form-control"  name="category_description" id="category_description"><?php
            if (isset($data['arr_category_names'])) {
                echo $data['arr_category_names'][0]['category_description'];
            }
                       ?></textarea>
                <input type="hidden" name="category_detail_id" id="category_detail_id" value="<?php
                    if (isset($data['arr_category_names'])) {
                        echo $data['arr_category_names'][0]['category_detail_id'];
                    }
                    ?>">
            </div>


        <?php } else {
            ?>
            <div class="form-group">
                <label for="User Name">Category Name<sup class="mandatory">*</sup></label>

                <input type="text" class="form-control"  name="category_name" id="category_name" value="">
                <input type="hidden" class="form-control"  name="category_detail_id" id="category_detail_id" value=" ">
            </div>

            <div class="form-group">
                <label for="User Name">Category Description<sup class="mandatory">*</sup></label>

                <textarea  class="form-control"  name="category_description" id="category_description"></textarea>
                <input type="hidden" class="form-control"  name="category_detail_id" id="category_detail_id" value=" ">
            </div>

            <?php
        }
    }

    public function getSubCategory() {

        $parent_id = $this->input->post('cat_id');
        if ($parent_id != "") {
//        echo $parent_id;
            $condition_to_pass = array('parent_id' => $parent_id);

            $data['arr_category_list'] = $this->category_model->getAllCategories($condition_to_pass);
            ?>
            <select name="sub_cat" id="sub_cat" dir="ltr" class="form-control"  >
                <option value="">--Select--</option>
            <?php
            foreach ($data['arr_category_list'] as $key => $value) {
                echo '<option value="' . $value['category_id'] . '" ' . $str . '>' . $value['category_name'] . '</option>';
            }
            ?>
            </select>
                <?php
            }
        }

        public function checkCategoryName() {

            if ($this->input->post('type') == 'edit') {

                if (($this->input->post('category_name')) == ($this->input->post('old_category_name'))) {
                    echo "true";
                    exit;
                } else {
                    $arr_category_detail = $this->common_model->getRecords('trans_category_details', 'category_name', array("category_name" => mysql_real_escape_string($this->input->post('category_name'))));

                    if (count($arr_category_detail) == 0) {
                        echo "true";
                    } else {
                        echo "false";
                    }
                }
            } else {

                $arr_category_detail = $this->common_model->getRecords('trans_category_details', 'category_name', array("category_name" => mysql_real_escape_string($this->input->post('category_name'))));
                if (count($arr_category_detail) == 0) {
                    echo "true";
                } else {
                    echo "false";
                }
            }
        }

    }
    