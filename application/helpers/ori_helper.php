<?php 

function cek(){
	$ci = get_instance();
	if(!$ci->session->userdata('email')){
		redirect('auth');
	}
	if($ci->session->userdata('role_id') == 2){
		$user = $ci->db->get_where('menu', ['user_role' => 2])->result_array();
		foreach ($user as $u) {
			$menu[] = strtolower($u['menu']);
		}
		if(!in_array($ci->uri->segment(1),$menu)){
			redirect('user/error');
		}
	}
}

function check_access($role_id, $menu_id){
	$ci = get_instance();
	$ci->db->where(['role_id' => $role_id, 'menu_id' => $menu_id]);
	return $ci->db->get('user_access_menu')->num_rows();
}