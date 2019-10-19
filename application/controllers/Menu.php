<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	private $_email, $_role_id;
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
		$data['title'] = 'Menu Management';
		$data['user'] = $this->user->getUserByEmail($this->_email);
		$data['menu'] = $this->menu->getMenu($this->_role_id);
		//$data['role'] = $this->user->getRole();
		
		$this->form_validation->set_rules('menu', 'Menu', 'required|trim');
		if($this->form_validation->run() == false){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('menu/index',$data);
			$this->load->view('templates/footer');
		}else{
			$this->menu->addMenu();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">The menu has been added!!!</div>');
			redirect('menu');
		}
	}

	public function sub(){
		$data['title'] = 'Sub Menu';
		$data['user'] = $this->user->getUserByEmail($this->_email);
		$data['menu'] = $this->menu->getMenu($this->_role_id);
		$data['subMenu'] = $this->menu->getSubMenu();

		$this->form_validation->set_rules('submenu', 'Sub Menu', 'required|trim');
		$this->form_validation->set_rules('icon', 'Icon', 'required|trim');
		$this->form_validation->set_rules('link', 'Link', 'required|trim');
		if($this->form_validation->run() == false){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('menu/sub',$data);
			$this->load->view('templates/footer');
		}else{
			$this->menu->addSubMenu();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">The menu has been added!!!</div>');
			redirect('menu/sub');
		}
	}

	public function delete($tipe = null, $id = null){
		if($tipe == null OR $id == null){
				redirect('404');
		}elseif($tipe == 'menu'){
			$this->menu->deleteMenu($id);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">The menu has been deleted!!!</div>');
			redirect('menu');
		}elseif ($tipe == 'submenu') {
			$this->menu->deleteSubMenu($id);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">The menu has been deleted!!!</div>');
			redirect('menu/sub');
		}else{
			redirect('404');
		}
	}

	public function edite($tipe = null, $id = null){
		$data['user'] = $this->user->getUserByEmail($this->_email);
		$data['menu'] = $this->menu->getMenu($this->_role_id);

		if($tipe == null OR $id == null){
			redirect('404');
		}elseif($tipe == 'editemenu'){
			$data['title'] = 'Menu Management';
			$data['menuEdite'] = $this->menu->getMenuById($id);

			$view = 'editeMenu';

			$this->form_validation->set_rules('menu', 'Menu', 'required|trim');
		}elseif($tipe == 'editesubmenu'){
			$data['title'] = 'Sub Menu';
			$data['submenuEdite'] = $this->menu->getSubMenuById($id);

			$view = 'editeSubMenu';
			
			$this->form_validation->set_rules('submenu', 'Sub Menu', 'required|trim');
			$this->form_validation->set_rules('icon', 'Icon', 'required|trim');
			$this->form_validation->set_rules('link', 'Link', 'required|trim');
		}else{
			redirect('404');	
		}
		
		if($this->form_validation->run() == false){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('menu/'.$view,$data);
			$this->load->view('templates/footer');
		}else{
			if($view == 'editeMenu'){
				$this->menu->updateMenu();
				redirect('menu');
			}elseif($view == 'editeSubMenu'){
				$this->menu->updateSubMenu();
				redirect('menu/sub');
			}
		}
	}
}