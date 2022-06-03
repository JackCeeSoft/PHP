<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");

class Jq_upload_organization extends Base_e_army  {
    
    public $images_path;
    protected $path_img_upload_folder;
    protected $path_img_thumb_upload_folder;
    protected $path_url_img_upload_folder;
    protected $path_url_img_thumb_upload_folder;
    protected $delete_img_url;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('m_db');
        $this->load->library('custom_upload');
        $this->images_path = $this->config->item('root_upload').$this->config->item('images_path_organization_gallery');
        //Set relative Path with CI Constant
        $this->setPath_img_upload_folder($this->images_path);
        $this->setPath_img_thumb_upload_folder($this->images_path);
        //Delete img url
        $this->setDelete_img_url(base_url().'jq_upload_organization/deleteImage/');
        //Set url img with Base_url()
        $this->setPath_url_img_upload_folder(base_url().$this->images_path);
        $this->setPath_url_img_thumb_upload_folder(base_url().$this->images_path);
    }
    
    public function upload_img($id = '') {
        
        $sesstion = $this->getSesstion();
        $result = $this->m_db->getDetail('organization', array('o_organizationid' => $id));
        $data['result_data'] = $result;

        if (empty($id) or !$result)
            echo json_encode(array(array('error' => "Don't have post_id.")));
        
        $this->images_path = $this->images_path.$id.'/';
        //Set relative Path with CI Constant
        $this->setPath_img_upload_folder($this->images_path);
        $this->setPath_img_thumb_upload_folder($this->images_path);
        //Delete img url
        $this->setDelete_img_url(base_url().'jq_upload_organization/deleteImage/');
        //Set url img with Base_url()
        $this->setPath_url_img_upload_folder(base_url().$this->images_path);
        $this->setPath_url_img_thumb_upload_folder(base_url().$this->images_path);
        
        

        if (!file_exists($this->images_path)) {
            mkdir($this->images_path, 0775);
        }

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
            $organization_name = $uni_name . $data['file_ext'];
            $organization_thumb_name = $uni_name . '_thumb';

            //$new_thumb_name = $this->custom_upload->uploadImageResize($this->getPath_img_upload_folder() . $new_name, $this->getPath_img_thumb_upload_folder(), 200, 162, $new_thumb_name);
            
            //Insert data
            $insert['o_organizationid'] = $id;
            $insert['oi_path'] = $organization_name;
            $insert['oi_createdby'] = $sesstion['user_id'];
            $insert['oi_updatedby'] = $sesstion['user_id'];
            $insert_id = $this->m_db->add('organization_imageattach', $insert);

            //Get info
            $info = new stdClass();
            $info->name = $organization_name;
            $info->size = $data['file_size'];
            $info->type = $data['file_type'];
            $info->url = $this->getPath_img_upload_folder() . $organization_name;
            //$info->thumbnail_url = $this->getPath_img_thumb_upload_folder() . $new_thumb_name; //I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$name
            $info->delete_url = $this->getDelete_img_url() . $insert_id;
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
        $data = $this->m_db->getDetail('organization_imageattach', array('oi_imageattachid' => $id));

        list($name, $ext) = explode('.', $data['pi_path']);
        $thumb = $name.'_thumb.'.$ext;
        $success = unlink($this->getPath_img_upload_folder() . $data['o_organizationid'] . '/' . $data['oi_path']);
        //$success_th = unlink($this->getPath_img_upload_folder() . $data['n_newsid'] . '/' . $thumb);

        $this->m_db->delete('organization_imageattach', array('oi_imageattachid' => $id));

        //info to see if it is doing what it is supposed to
        $info = new stdClass();
        $info->sucess = $success;
        $info->path = $this->getPath_url_img_upload_folder() . $data['o_organizationid'] . '/' . $data['oi_path'];
        $info->file = is_file($this->getPath_img_upload_folder() . $data['o_organizationid'] . '/' . $data['oi_path']);
        if (IS_AJAX) { //I don't think it matters if this is set but good for error checking in the console/firebug
            echo json_encode(array($info));
        } else { //here you will need to decide what you want to show for a successful delete
            //var_dump($file);
            echo $data['oi_path'];
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
