<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {


	public function index()
	{

		//получаем json данные
		$json = $this->model->get_one_latest_report();
		$data['reports_latest'] = $this->model->get_json_latest();
		if ($json){
			$data['json'] = $json;
			$data['obj_json'] = json_decode($json);
			$data['columns_json'] = json_encode($data['obj_json']->Columns);
			$data['rows_json'] = json_encode($data['obj_json']->Rows);
			//тип графика
			$data['type'] = $this->model->get_type_graph();
			$this->load->view('main/main_view', $data);
		}
		else {
			$data['error'] = '<div class="alert alert-danger">report receiving error</div>';

			$this->load->view('main/err', $data);
		}

	}
	public function add_report()
	{


		$this->load->helper(array('form', 'url'));

		$config['upload_path']          = FCPATH.'upload/';
		$config['allowed_types']        = 'json|text/plain';
		$config['max_size']             = 10000;

		$this->load->library('upload', $config);


		$data['reports_latest'] = $this->model->get_json_latest();


		if ( ! $this->upload->do_upload('userfile'))
		{
			$data['error'] = $this->upload->display_errors();

			$this->load->view('main/add_report_view', $data);
		}
		else
		{
			$data['upload_data'] = $this->upload->data();
			$this->model->add_json($this->upload->data()['file_name'], time());
			$data['reports_latest'] = $this->model->get_json_latest();

			$this->load->view('upload_success', $data);
		}


	}

	public function show(){
		if ($this->uri->segment(3)){
			$id = $this->security->xss_clean(trim($this->uri->segment(3)));
			if (is_numeric($id)){
				//получаем json данные
				$json = $this->model->get_json($id);
				if ($json){
					$data['json'] = $json;
					$data['obj_json'] = json_decode($json);
					$data['columns_json'] = json_encode($data['obj_json']->Columns);
					$data['rows_json'] = json_encode($data['obj_json']->Rows);
					//тип графика
					$data['type'] = $this->model->get_type_graph();

					//получаем список последних загрузок
					$data['reports_latest'] = $this->model->get_json_latest();
					$this->load->view('main/main_view', $data);
				}
				else{
					$data['error'] = '<div class="alert alert-danger">report receiving error</div>';
					$data['reports_latest'] = $this->model->get_json_latest();
					$this->load->view('main/err', $data);
				}
			}
		}
	}

	public function update_type_chart(){
		if ($this->input->post('type')){
			$type = $this->security->xss_clean($this->input->post('type'));
			$this->model->update_type_chart($type);
			echo 'saved';

		}
	}

}
