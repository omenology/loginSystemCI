<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		cek();
		$this->load->model('User_model','user');
		$this->load->model('Menu_model','menu');
		$this->_email = $this->session->userdata('email');
		$this->_role_id = $this->session->userdata('role_id');
		$this->form_validation->set_error_delimiters('<p class="text-danger pt-1 m-0 small">', '</p>');
	}

	public function index(){
		$data['title'] = 'My Profile';
		$data['user'] = $this->user->getUserByEmail($this->_email);
		$data['menu'] = $this->menu->getMenu($this->_role_id);
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('user/index',$data);
		$this->load->view('templates/footer');
		
	}

	public function edite(){
		$this->load->helper('form');
		$data['title'] = 'Edite Profile';
		$data['user'] = $this->user->getUserByEmail($this->_email);
		$data['menu'] = $this->menu->getMenu($this->_role_id);

		$this->form_validation->set_error_delimiters('<p class="text-danger m-0 pt-1 small">', '</p>');
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        if($this->form_validation->run() == false){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('user/edite',$data);
			$this->load->view('templates/footer');
        }else{
        	$upload_img = $_FILES['image']['name'];
        	if($upload_img){
        		$config = [
					'upload_path' => FCPATH.'asset/img/profile',
					'allowed_types' => 'jpg|png',
					'max_size' => 2048
				];

				$this->load->library('upload', $config);
				if($this->upload->do_upload('image')){
					if($data['user']['image'] != 'default.jpg'){
						unlink(FCPATH.'asset/img/profile/'.$data['user']['image']);
					}
					$dataUser['image'] = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
					die();
				}
        	}

        	$dataUser['name'] =  $this->input->post('name');
        
        	$this->user->updateUserByEmail($this->_email, $dataUser);

        	redirect('user');
        }
	}

	public function editePassword(){
		$data['title'] = 'Edite Password';
		$data['user'] = $this->user->getUserByEmail($this->_email);
		$data['menu'] = $this->menu->getMenu($this->_role_id);
		
		$this->form_validation->set_rules('currentPassword', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('newPassword', 'New Password', 'required|trim|min_length[6]|matches[rePassword]');
		$this->form_validation->set_rules('rePassword', 'Re-type Password', 'required|trim|matches[newPassword]');
		if($this->form_validation->run() == false){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('user/editePassword',$data);
			$this->load->view('templates/footer');
		}else{
			$currentPassword = $this->input->post('currentPassword');
			$newPassword = $this->input->post('newPassword');
			if(!password_verify($currentPassword, $data['user']['password'])){
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password !!!</div>');
				redirect('user/editepassword');
			}elseif ($newPassword == $currentPassword) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">The new password can not be same !!!</div>');
				redirect('user/editepassword');
			}
		
			$dataUser['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
			$this->user->updateUserByEmail($this->_email, $dataUser);
			$this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">The password has been changed !!!</div>');
        	redirect('user');	
		}
	}

	public function error(){
		$data['title'] = '403';
		$this->load->view('templates/header',$data);
		$this->load->view('user/403');
		$this->load->view('templates/footer');
	}
}