<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		cek();
		$this->load->model('User_model','user');
		$this->load->model('Menu_model','menu');
		$this->_email = $this->session->userdata('email');
		$this->_role_id = $this->session->userdata('role_id');
		$this->form_validation->set_error_delimiters('<p class="text-danger pl-2 pt-1 small">', '</p>');
	}

	public function index(){
		$data['title'] = 'Dashboard';
		$data['user'] = $this->user->getUserByEmail($this->_email);
		$data['menu'] = $this->menu->getMenu($this->_role_id);

		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('admin/index',$data);
		$this->load->view('templates/footer');
	}

	public function role(){
		$data['title'] = 'Role';
		$data['user'] = $this->user->getUserByEmail($this->_email);
		$data['menu'] = $this->menu->getMenu($this->_role_id);
		$data['userRole'] = $this->user->getUserRole();
		$this->form_validation->set_rules('role', 'Role', 'required|trim');
		if($this->form_validation->run() == false){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('admin/role',$data);
			$this->load->view('templates/footer');
		}else{
			$this->user->addUserRole();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">The user role has been added!!!</div>');
			redirect('admin/role');
		}
	}

	public function roleaccess($id){
		$data['title'] = 'Role';
		$data['user'] = $this->user->getUserByEmail($this->_email);
		$data['menu'] = $this->menu->getMenu($this->_role_id);
		$data['role'] = $this->user->getUserRoleById($id);
		$data['menuAll'] = $this->menu->getMenuAll();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('admin/roleAccess',$data);
		$this->load->view('templates/footer');
	}

	public function changeAccess(){
		$role_id = $this->input->post('roleId');
		$menu_id = $this->input->post('menuId');

		$result = check_access($role_id, $menu_id);
		if($result > 0){
			$this->menu->deleteUserAccessMenu($role_id, $menu_id);
		}else{
			$this->menu->addUserAccessMenu($role_id, $menu_id);
		}
	}

	public function delete($tipe = null, $id = null){
		if($tipe == null OR $id == null){
			redirect('404');
		}elseif ($tipe == 'role') {
			$this->user->deleteUserRole($id);
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">The user role has been deleted!!!</div>');
			redirect('admin/role');
		}else{
			redirect('404');
		}
	}

	public function edite($tipe = null, $id = null){
		$data['user'] = $this->user->getUserByEmail($this->_email);
		$data['menu'] = $this->menu->getMenu($this->_role_id);

		if($tipe == null OR $id == null){
			redirect('404');
		}elseif ($tipe == 'role') {
			$data['title'] = 'Role';
			$data['roleEdite'] = $this->user->getUserRoleById($id);
			$view = 'editeRole';
			$this->form_validation->set_rules('role', 'Role', 'required|trim');
		}else{
			redirect('404');
		}

		if($this->form_validation->run() == false){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('admin/'.$view,$data);
			$this->load->view('templates/footer');
		}else{
			if($view == 'editeRole'){
				 $this->user->updateUserRole();
				 redirect('admin/role');
			}
		}
		
	}
}