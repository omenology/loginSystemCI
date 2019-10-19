<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{

	public function getUserByEmail($data){
		return $this->db->get_where('user',['email' => $data])->row_array();
	}

	public function insertUser($data){
		$this->db->insert('user',$data);
		return $this->db->affected_rows();
	}

	public function updateUserByEmail($email, $data){
		$this->db->set($data);
		$this->db->where('email', $email);
		$this->db->update('user');
	}

	public function getUserRole(){
		return $this->db->get('user_role')->result_array();
	}

	public function getUserRoleById($id){
		return $this->db->get_where('user_role', ['id' => $id])->row_array();
	}

	public function addUserRole(){
		$this->db->insert('user_role',['role' => $this->input->post('role',true)]);
		return $this->db->affected_rows();
	}

	public function deleteUserRole($id){
		$this->db->where('id', $id);
		$this->db->delete('user_role');
		return $this->db->affected_rows();
	}

	public function updateUserRole(){
		$this->db->where('id',$this->input->post('id'));
		$this->db->update('user_role',['role' => $this->input->post('role', true)]);
		return $this->db->affected_rows();
	}

	public function insertUserToken($data){
		$this->db->insert('user_token',$data);
		return $this->db->affected_rows();
	}

	public function getToken($email, $token){
		return $this->db->get_where('user_token',['email' => $email, 'token' => $token])->num_rows();	
	}	

	public function deleteToken($email){
		$this->db->where('email', $email);
		$this->db->delete('user_token');
	}
}