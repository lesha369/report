<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model extends CI_Model {


	public function get_json($id){
		if (is_numeric($id)){

			$sql = $this->db->get_where('reports', ['id' => $id])->result();
			if (count($sql) > 0){
				if (file_exists(FCPATH.'upload/'.$sql[0]->json)){
					return file_get_contents(FCPATH.'upload/'.$sql[0]->json);
				}
				return false;

			}

		}
		else{
			return false;
		}
	}

	public function get_one_latest_report(){
		$this->db->order_by('date_upload', 'desc');
		$this->db->limit(1);
		$query = $this->db->get('reports')->result();
		if (count($query) > 0){
			if (file_exists(FCPATH.'upload/'.$query[0]->json)){
				return file_get_contents(FCPATH.'upload/'.$query[0]->json);
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}


	}

	public function get_json_latest(){
		$this->db->order_by('date_upload', 'desc');
		$query = $this->db->get('reports')->result();
		return $query;

	}

	public function add_json($file_name, $date){
		$this->db->insert('reports', ['date_upload' => $date, 'json' => $file_name]);
	}

	public function get_type_graph(){
		$type = $this->db->get('type_graph')->row_array();
		return $type['type'];

	}

	public function update_type_chart($type){
		$this->db->set('type', $type);
		$this->db->update('type_graph');
	}
}
