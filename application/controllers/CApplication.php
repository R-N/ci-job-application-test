<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CApplication extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("MPosition");
        $this->load->model("MApplication");
    	$this->load->library('upload');
    }

    public function index(){
    	return $this->apply();
    }

	public function apply(){
		$positions = $this->MPosition->fetch_positions();
		$data = array(
			"positions" => $positions
		);
		$this->load->view("VApply.php", $data);
	}

	public function applications(){
		$applications = $this->MApplication->fetch_applications();
		$data = array(
			"applications" => $applications
		);
		$this->load->view("VApplications.php", $data);
	}

	public function submit_application(){
		try{
			$application = $_POST;
			$app_id = $this->MApplication->add_application($application);

            $config['upload_path']          = "./uploads/{$app_id}/";
            $config['allowed_types']        = 'pdf|PDF';
            $config['max_size']             = 1024;

            mkdir($config["upload_path"]);

		    $files = $_FILES;
		    $cpt = count($_FILES['file']['name']);
		    for($i=0; $i<$cpt; $i++){
		        $_FILES['file']['name']= $files['file']['name'][$i];
		        $_FILES['file']['type']= $files['file']['type'][$i];
		        $_FILES['file']['tmp_name']= $files['file']['tmp_name'][$i];
		        $_FILES['file']['error']= $files['file']['error'][$i];
		        $_FILES['file']['size']= $files['file']['size'][$i];

		        $this->upload->initialize($config);
		        $this->upload->do_upload('file');
		        $dataInfo[] = $this->upload->data();
		    }

		}catch(MyException $ex){
			respond_exception($this, $ex);
		}
	}

	public function delete_application($id){
		try{
			$this->MApplication->delete_application($id);

			respond_message($this, "Application deleted successfully", 200);

		}catch(MyException $ex){
			respond_exception($this, $ex);
		}
	}

	public function fetch_positions(){
		try{
			$positions = $this->MPosition->fetch_positions();

			respond_json($this, $positions);
		}catch(MyException $ex){
			respond_exception($this, $ex);
		}
	}

	public function check_email_position(){
		try{
			$email = $this->input->post("email");
			$position = $this->input->post("position");

			$this->MApplication->check_email_position($email, $position);

			respond_message($this, "Email and position can be used");

		}catch(MyException $ex){
			respond_exception($this, $ex);
		}
	}
}
