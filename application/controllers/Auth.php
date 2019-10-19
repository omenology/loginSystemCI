<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('User_model','user');
		$this->form_validation->set_error_delimiters('<p class="text-danger pl-2 pt-1 small">', '</p>');
	}
	public function index()
	{
		$data['title'] = 'Login';

		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run() == false){
			$this->load->view('templates/header',$data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		}else{
			$this->_login();
		} 
	}

	public function registration(){
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',[
			'is_unique' => 'This email has been registered!!!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|matches[rePassword]|min_length[6]');
		$this->form_validation->set_rules('rePassword', 'Password', 'required|trim|matches[password]');
		if($this->form_validation->run() == false){
			$data['title'] = 'registration';
			$this->load->view('templates/header',$data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		}else{
			$token = bin2hex(random_bytes(5));
			
			$data = [
				'name' => htmlspecialchars($this->input->post('name',true)),
				'email' => htmlspecialchars($this->input->post('email',true)),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
				'role_id' => 4,
				'is_active' => 0,
				'date_created' => time()
			];

			$dataToken = [
				'email' => htmlspecialchars($this->input->post('email',true)),
				'token' => $token,
				'date_created' => time()
			];

			$this->user->insertUser($data);
			$this->user->insertUserToken($dataToken);

			$this->_emailSend($token, 'verivy');
			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">This account has been created, please activated the email !!!</div>');

			redirect('auth');
		}
	}

	public function forget(){
		$data['title'] = 'Forget password';

		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_email_cek');
		$this->form_validation->set_message('email_cek', 'Email has not been registered');
		if($this->form_validation->run() == false){
			$this->load->view('templates/header',$data);
			$this->load->view('auth/forget');
			$this->load->view('templates/auth_footer');
		}else{
			$token = bin2hex(random_bytes(5));
			$dataToken = [
				'email' => htmlspecialchars($this->input->post('email',true)),
				'token' => $token,
				'date_created' => time()
			];
			$this->user->insertUserToken($dataToken);
			$this->_emailSend($token, 'forget');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Cek your email bruhh !!!</div>');
			redirect('auth');
		}	
	}

	public function resetPassword(){
		if(!$this->session->forgetPassword){
			redirect('auth');
		}
		$data['title'] = 'Forget password';

		$this->form_validation->set_rules('password', 'Password', 'required|trim|matches[rePassword]|min_length[6]');
		$this->form_validation->set_rules('rePassword', 'Password', 'required|trim|matches[password]');
		if($this->form_validation->run() == false){
			$this->load->view('templates/header',$data);
			$this->load->view('auth/resetPassword');
			$this->load->view('templates/auth_footer');
		}else{
			$email = $this->session->forgetEmail;
			$data = [
				'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT)
			];
			$this->user->updateUserByEmail($email,$data);
			session_destroy();
			redirect('auth');
		}
	}

	public function email_cek($str){
		$cek = $this->user->getUserByEmail($str);
		if($cek){
			return true;
		}else{
			return false;
		}
	}

	private function _emailSend($token, $type){
		$email = htmlspecialchars($this->input->post('email',true));
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'pake email mu dong',
			'smtp_pass' => 'juga password nya',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];

		$this->load->library('email',$config);  
		$this->email->initialize($config);
		
		$this->email->from('ikballukmanulhakim5@gmail.com', 'Mantap DONG');
		$this->email->to($email);
		if ($type == 'verivy') {
			$this->email->subject('verivy Email');
			$this->email->message('<a href="'.base_url().'auth/verivy/active?email='.$email.'&token='.$token.'">Click this link</a>');
		}elseif ($type == 'forget') {
			$this->email->subject('forget password');
			$this->email->message('<a href="'.base_url().'auth/verivy/lupa?email='.$email.'&token='.$token.'">Click this link for rest password</a>');
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error !!!</div>');
			redirect('auth/registration');
		}

		if($this->email->send()){
			return true;
		}else{
			echo $this->email->print_debugger();
			die;
		}
	}

	public function verivy($type){
		$email = $this->input->get('email');
		$token = $this->input->get('token');
		if($type == 'active'){
			$token = $this->user->getToken($email, $token);
			if($token > 0){
				$data['is_active'] = 1;
				$this->user->updateUserByEmail($email, $data);
				$this->user->deleteToken($email);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your email is active !!!</div>');
				redirect('auth');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong email !!!</div>');
				redirect('auth');
			}
		}elseif ($type == 'lupa') {
			$token = $this->user->getToken($email, $token);
			if($token > 0){
				$data['is_active'] = 1;
				$this->session->set_userdata([
					'forgetPassword' => true,
					'forgetEmail' => $email
				]);
				$this->user->deleteToken($email);
				redirect('auth/resetPassword');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong email !!!</div>');
				redirect('auth');
			}
		}else{
			redirect('404');
		}
	}

	private function _login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user = $this->user->getUserByEmail($email);
		if($user){
			if($user['is_active'] == 1){
				if(password_verify($password,$user['password'])){
					$this->session->set_userdata([
						'email' => $user['email'],
						'role_id' => $user['role_id']
					]);
					if($user['role_id'] == 1){
						redirect('admin');
					}
					redirect('user');
				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">wrong password !!!</div>');
					redirect('auth');	
				}
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated !!!</div>');
				redirect('auth');	
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been registered !!!</div>');
			redirect('auth');
		}
	}

	public function logout(){
		$this->session->unset_userdata('email', 'role_id');
		redirect('auth');
	} 
}