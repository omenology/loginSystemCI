<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model{

	public function getMenuAll(){
		return $this->db->get('user_menu')->result_array();
	}

	public function getMenu($role_id){
		$this->db->select('user_menu.*, user_role.role');
		$this->db->from('user_menu');
		$this->db->join('user_access_menu', 'user_menu.id = user_access_menu.menu_id');
		$this->db->join('user_role', 'user_access_menu.role_id = user_role.id');
		$this->db->where('user_access_menu.role_id', $role_id);
		return $this->db->get()->result_array();
	}

	public function getMenuById($id){
		return $this->db->get_where('user_menu',['id' => $id])->row_array();
	}

	public function addMenu(){
		$this->db->insert('user_menu',['menu' => $this->input->post('menu',true)]);
		$menu = $this->db->get('user_menu')->last_row('array');
		$this->db->insert('user_access_menu', ['role_id' => 3, 'menu_id' => $menu['id']]);
	}

	public function updateMenu(){
		$this->db->where('id',$this->input->post('id'));
		$this->db->update('user_menu',['menu' => $this->input->post('menu', true)]);
		return $this->db->affected_rows();
	}

	public function deleteMenu($id){
		$this->db->where('menu_id',$id);
		$this->db->delete('user_access_menu');
		$this->db->where('id', $id);
		$this->db->delete('user_menu');
		return $this->db->affected_rows();
	}

	public function getSubMenu(){
		$this->db->select('user_sub_menu.*, user_menu.menu');
		$this->db->from('user_sub_menu');
		$this->db->join('user_menu', 'user_sub_menu.menu_id = user_menu.id');
		return $this->db->get()->result_array();
	}

	public function getSubMenuById($id){
		return $this->db->get_where('user_sub_menu',['id' => $id])->row_array();	
	}

	public function addSubMenu(){
		$data = [
			'menu_id' => $this->input->post('menu_id', true),
			'title' => $this->input->post('submenu', true),
			'url' => $this->input->post('link', true),
			'icon' => $this->input->post('icon', true),
			'is_active' => $this->input->post('active', true)
		];
		$this->db->insert('user_sub_menu', $data);
		return $this->db->affected_rows();
	}

	public function updateSubMenu(){
		$data = [
			'menu_id' => $this->input->post('menu_id', true),
			'title'=> $this->input->post('submenu', true),
			'url' => $this->input->post('link', true),
			'icon' => $this->input->post('icon', true),
			'is_active' => $this->input->post('active')
		];
		$this->db->where('id',$this->input->post('id'));
		$this->db->update('user_sub_menu',$data);
		return $this->db->affected_rows();	
	}

	public function deleteSubMenu($id){
		$this->db->where('id', $id);
		$this->db->delete('user_sub_menu');
		return $this->db->affected_rows();
	}

	public function addUserAccessMenu($role_id, $menu_id){
		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$this->db->insert('user_access_menu', $data);
	}

	public function deleteUserAccessMenu($role_id, $menu_id){
		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$this->db->delete('user_access_menu', $data);
	}

}