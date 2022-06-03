<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");

class Jq_upload extends CI_Controller {
    
    public $user_id;
    public $u_code;
    public $images_path;
    public $images_path_unit;
    protected $path_img_upload_folder;
    protected $path_img_thumb_upload_folder;
    protected $path_url_img_upload_folder;
    protected $path_url_img_thumb_upload_folder;
    protected $delete_img_url;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('m_news');
        $this->load->library('custom_upload');
        $this->images_path = $this->config->item('root_upload').$this->config->item('images_path_news');
        $this->images_path_unit = $this->config->item('root_upload').$this->config->item('images_path_unit');
        
        $data_session  = $this->session->all_userdata();
        $this->user_id = $data_session['ua_userid'];
        $this->u_code = (isset($data_session['u_code']) and $data_session['u_code']) ? $data_session['u_code'] : '01';
        
        
        if(isset($_REQUEST['type']) and $_REQUEST['type'] == 'news') {
            //Set relative Path with CI Constant
            $this->setPath_img_upload_folder($this->images_path);
            $this->setPath_img_thumb_upload_folder($this->images_path);
            //Delete img url
            $this->setDelete_img_url(base_url().'jq_upload/deleteImage/');
            //Set url img with Base_url()
            $this->setPath_url_img_upload_folder(base_url().$this->images_path);
            $this->setPath_url_img_thumb_upload_folder(base_url().$this->images_path);
        } else {
            //Set relative Path with CI Constant
            $this->setPath_img_upload_folder($this->images_path_unit);
            $this->setPath_img_thumb_upload_folder($this->images_path_unit);
            //Delete img url
            $this->setDelete_img_url(base_url().'jq_upload/deleteImage/');
            //Set url img with Base_url()
            $this->setPath_url_img_upload_folder(base_url().$this->images_path_unit);
            $this->setPath_url_img_thumb_upload_folder(base_url().$this->images_path_unit);
        }
    }
    
    public function upload_img($id = '') {
        $result = $this->m_news->getDetail('news', array('n_newsid' => $id));
        $data['result_data'] = $result;

        if (empty($id) or !$result)
            echo json_encode(array(array('error' => "Don't have post_id.")));
        
        /*-------------------- check type upload --------------------*/
        if(isset($_POST['type']) and $_POST['type'] == 'news') {
            $uploadpath = $this->images_path.$id.'/';
        } else {
            $uploadpath = $this->images_path_unit.$this->u_code.'/';
        }
        /*-------------------- check type upload --------------------*/
        
        if (!file_exists($uploadpath)) {
            mkdir($uploadpath, 0775);
        }
        //Set relative Path with CI Constant
        $this->setPath_img_upload_folder($uploadpath);
        $this->setPath_img_thumb_upload_folder($uploadpath);
        //Delete img url
        $this->setDelete_img_url(base_url().'jq_upload/deleteImage/');
        //Set url img with Base_url()
        $this->setPath_url_img_upload_folder(base_url().$uploadpath);
        $this->setPath_url_img_thumb_upload_folder(base_url().$uploadpath);
        
        $name = $_FILES['userfile']['name'];
        $name = strtr($name, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

        // remplacer les caracteres autres que lettres, chiffres et point par _

        $name = preg_replace('/([^.a-z0-9]+)/i', '_', $name);

        $uni_name = uniqid();

        //Your upload directory, see CI user guide
        $config['upload_path'] = $this->getPath_img_upload_folder();
        $config['allowed_types'] = 'gif|jpg|png|JPG|GIF|PNG';
        $config['max_size'] = '1000';
        $config['file_name'] = $uni_name;
        
        //Load the upload library
        $this->load->library('upload', $config);

        if ($this->do_upload()) {
            $data = $this->upload->data();
            //$this->debug($data); exit;
            $new_name = $uni_name . $data['file_ext'];
            $new_thumb_name = $uni_name . '_thumb';

            //$new_thumb_name = $this->custom_upload->uploadImageResize($this->getPath_img_upload_folder() . $new_name, $this->getPath_img_thumb_upload_folder(), 200, 162, $new_thumb_name);
            
            /*-------------------- check type upload --------------------*/
            if(isset($_POST['type']) and $_POST['type'] == 'news') {
                //Insert data
                $insert['n_newsid'] = $id;
                $insert['ni_path'] = $new_name;
                $insert['ni_createdby'] = $this->user_id;
                $insert['ni_updatedby'] = $this->user_id;
                $insert_id = $this->m_news->add('news_imageattach', $insert);
                $delete_url = $this->getDelete_img_url() . $insert_id . '?type=' . $_POST['type'];
            } else {
                $insert['u_code'] = $this->u_code;
                $insert['ui_path'] = $new_name;
                $insert['ni_createddate'] = date('Y-m-d H:i:s');
                $insert['ni_createdby'] = $this->user_id;
                $insert['ni_updateddate'] = date('Y-m-d H:i:s');
                $insert['ni_updatedby'] = $this->user_id;
                $insert_id = $this->m_news->add('unit_imageattach', $insert);
                $delete_url = $this->getDelete_img_url() . $insert_id . '?type=' . $_POST['type'];
            }
            /*-------------------- check type upload --------------------*/

            //Get info
            $info = new stdClass();
            $info->name = $new_name;
            $info->size = $data['file_size'];
            $info->type = $data['file_type'];
            $info->url = $this->getPath_img_upload_folder() . $new_name;
            //$info->thumbnail_url = $this->getPath_img_thumb_upload_folder() . $new_thumb_name; //I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$name
            $info->delete_url = $delete_url;
            $info->delete_type = 'DELETE';

            //Return JSON data
            if (IS_AJAX) { //this is why we put this in the constants to pass only json data
                echo json_encode(array($info));
                //this has to be the only the only data returned or you will get an error.
                //if you don't give this a json array it will give you a Empty file upload result error
                //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
            } else { // so that this will still work if javascript is not enabled
                $file_data['upload_data'] = $this->upload->data();
                echo json_encode(array($info));
            }
        } else {

            // the display_errors() function wraps error messages in <p> by default and these html chars don't parse in
            // default view on the forum so either set them to blank, or decide how you want them to display.  null is passed.
            $error = array('error' => $this->upload->display_errors('', ''));

            echo json_encode(array($error));
        }
    }

    //Function for the upload : return true/false
    public function do_upload() {

        if (!$this->upload->do_upload()) {
            return false;
        } else {
            //$data = array('upload_data' => $this->upload->data());
            return true;
        }
    }

    public function deleteImage($id) {
        //Get the name in the url
        ////$file = $this->uri->segment(3);
        
        /*-------------------- check type upload --------------------*/
        if(isset($_REQUEST['type']) and $_REQUEST['type'] == 'news') {
            $data = $this->m_news->getDetail('news_imageattach', array('ni_imageattachid' => $id));

            list($name, $ext) = explode('.', $data['ni_path']);
            $thumb = $name.'_thumb.'.$ext;
            $folder_path = $data['n_newsid'] . '/' . $data['ni_path'];
            $success = unlink($this->getPath_img_upload_folder() . $folder_path);
            //$success_th = unlink($this->getPath_img_upload_folder() . $data['n_newsid'] . '/' . $thumb);

            $this->m_news->delete('news_imageattach', array('ni_imageattachid' => $id));

            //info to see if it is doing what it is supposed to
            $info = new stdClass();
            $info->sucess = $success;
            $info->path = $this->getPath_url_img_upload_folder() . $folder_path;
            $info->file = is_file($this->getPath_img_upload_folder() . $folder_path);
        } else {
            $data = $this->m_news->getDetail('unit_imageattach', array('ui_imageattachid' => $id));

            list($name, $ext) = explode('.', $data['ui_path']);
            $thumb = $name.'_thumb.'.$ext;
            $folder_path = $data['u_code'] . '/' . $data['ui_path'];
            $success = unlink($this->getPath_img_upload_folder() . $folder_path);
            //$success_th = unlink($this->getPath_img_upload_folder() . $data['u_code'] . '/' . $thumb);

            $this->m_news->delete('unit_imageattach', array('ui_imageattachid' => $id));

            //info to see if it is doing what it is supposed to
            $info = new stdClass();
            $info->sucess = $success;
            $info->path = $this->getPath_url_img_upload_folder() . $folder_path;
            $info->file = is_file($this->getPath_img_upload_folder() . $folder_path);
        }
        /*-------------------- check type upload --------------------*/
        
        if (IS_AJAX) { //I don't think it matters if this is set but good for error checking in the console/firebug
            echo json_encode(array($info));
        } else { //here you will need to decide what you want to show for a successful delete
            //var_dump($file);
            echo $data['ni_path'];
        }
    }

    public function get_files() {
        $this->get_scan_files();
    }

    public function get_scan_files() {

        $file_name = isset($_REQUEST['file']) ? basename(stripslashes($_REQUEST['file'])) : null;
        if ($file_name) {
            $info = $this->get_file_object($file_name);
        } else {
            $info = $this->get_file_objects();
        }
        header('Content-type: application/json');
        echo json_encode($info);
    }

    protected function get_file_object($file_name) {
        $file_path = $this->getPath_img_upload_folder() . $file_name;
        if (is_file($file_path) && $file_name[0] !== '.') {

            $file = new stdClass();
            $file->name = $file_name;
            $file->size = filesize($file_path);
            $file->url = $this->getPath_url_img_upload_folder() . rawurlencode($file->name);
            $file->thumbnail_url = $this->getPath_url_img_thumb_upload_folder() . rawurlencode($file->name);
            //File name in the url to delete
            $file->delete_url = $this->getDelete_img_url() . rawurlencode($file->name);
            $file->delete_type = 'DELETE';

            return $file;
        }
        return null;
    }

    protected function get_file_objects() {
        return array_values(array_filter(array_map(array($this, 'get_file_object'), scandir($this->getPath_img_upload_folder()))));
    }

    public function getPath_img_upload_folder() {
        return $this->path_img_upload_folder;
    }

    public function setPath_img_upload_folder($path_img_upload_folder) {
        $this->path_img_upload_folder = $path_img_upload_folder;
    }

    public function getPath_img_thumb_upload_folder() {
        return $this->path_img_thumb_upload_folder;
    }

    public function setPath_img_thumb_upload_folder($path_img_thumb_upload_folder) {
        $this->path_img_thumb_upload_folder = $path_img_thumb_upload_folder;
    }

    public function getPath_url_img_upload_folder() {
        return $this->path_url_img_upload_folder;
    }

    public function setPath_url_img_upload_folder($path_url_img_upload_folder) {
        $this->path_url_img_upload_folder = $path_url_img_upload_folder;
    }

    public function getPath_url_img_thumb_upload_folder() {
        return $this->path_url_img_thumb_upload_folder;
    }

    public function setPath_url_img_thumb_upload_folder($path_url_img_thumb_upload_folder) {
        $this->path_url_img_thumb_upload_folder = $path_url_img_thumb_upload_folder;
    }

    public function getDelete_img_url() {
        return $this->delete_img_url;
    }

    public function setDelete_img_url($delete_img_url) {
        $this->delete_img_url = $delete_img_url;
    }
    
}
