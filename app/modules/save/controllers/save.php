<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class save extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		$type = segment(2);
		$data = array(
			"result" => $this->model->getSave($type)
		);
		$this->template->title(l('Save management'));
		$this->template->build('index', $data);
	}
	
	public function ajax_save(){
		$data = array();
		switch (post("category")) {
			case 'post':
				switch (post('type')) {
					case 'link':
						if(post('link_url') == ""){
							ms(array(
								"st"    => "valid",
								"label" => "bg-red",
								"txt"   => l('Link is required')
							));
						}

						if (!filter_var(post('link_url'), FILTER_VALIDATE_URL) === true) {
						    ms(array(
								"st"    => "valid",
								"label" => "bg-red",
								"txt"   => l('Link is not a valid')
							));
						}

						$data = array(
							"category"    => "post",
							"type"        => post('type'),
							"url"         => post('link_url'),
							"image"       => post('link_picture'),
							"title"       => post('link_title'),
							"caption"     => post('link_caption'),
							"description" => post('link_description'),
							"message"     => post('message'),
						);
						break;
					case 'image':
						if(post('image_url') == ""){
							ms(array(
								"st"    => "valid",
								"label" => "bg-red",
								"txt"   => l('Image is required')
							));
						}

						$data = array(
							"category"  => "post",
							"type"      => post('type'),
							"image"     => post('image_url'),
							"message"   => post('message')
						);
						break;
					case 'video':
						if(post('video_url') == ""){
							ms(array(
								"st"    => "valid",
								"label" => "bg-red",
								"txt"   => l('Video is required')
							));
						}

						$data = array(
							"category"    => "post",
							"type"        => post('type'),
							"image"       => post('video_url'),
							"description" => post('video_description'),
							"message"     => post('message'),
						);
						break;
					case 'text':
						if(post('message') == ""){
							ms(array(
								"st"    => "valid",
								"label" => "bg-red",
								"txt"   => l('Message is required'),
							));
						}

						$data = array(
							"category"  => "post",
							"type"      => post('type'),
							"message"   => post('message'),
						);
						break;
				}
				break;
			
			case 'friend':
				switch (post('type')) {
					case 'link':
						if(post('link_url') == ""){
							ms(array(
								"st"    => "valid",
								"label" => "bg-red",
								"txt"   => l('Link is required')
							));
						}

						if (!filter_var(post('link_url'), FILTER_VALIDATE_URL) === true) {
						    ms(array(
								"st"    => "valid",
								"label" => "bg-red",
								"txt"   => l('Link is not a valid')
							));
						}

						$data = array(
							"category"    => "friend",
							"type"        => post('type'),
							"url"         => post('link_url'),
							"image"       => post('link_picture'),
							"title"       => post('link_title'),
							"caption"     => post('link_caption'),
							"description" => post('link_description'),
							"message"     => post('message'),
						);
						break;
					case 'image':
						if(post('image_url') == ""){
							ms(array(
								"st"    => "valid",
								"label" => "bg-red",
								"txt"   => l('Image is required')
							));
						}

						$data = array(
							"category"  => "friend",
							"type"      => post('type'),
							"image"     => post('image_url'),
							"message"   => post('message')
						);
						break;
					case 'video':
						if(post('video_url') == ""){
							ms(array(
								"st"    => "valid",
								"label" => "bg-red",
								"txt"   => l('Video is required')
							));
						}

						$data = array(
							"category"    => "friend",
							"type"        => post('type'),
							"image"       => post('video_url'),
							"description" => post('video_description'),
							"message"     => post('message'),
						);
						break;
					case 'text':
						if(post('message') == ""){
							ms(array(
								"st"    => "valid",
								"label" => "bg-red",
								"txt"   => l('Message is required'),
							));
						}

						$data = array(
							"category"  => "friend",
							"type"      => post('type'),
							"message"   => post('message'),
						);
						break;
				}
				break;

			case 'message':
				if(post('message') == ""){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Message is required')
					));
				}

				if (post('link') != "" && !filter_var(post('link'), FILTER_VALIDATE_URL) === true) {
				    ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Link is not a valid')
					));
				}

				$data = array(
					"category"    => "message",
					"type"        => "message",
					"url"         => post('link'),
					"message"     => post('message'),
				);
				break;

			case 'comment':
				if(post('message') == ""){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Message is required')
					));
				}

				if (post('link') != "" && !filter_var(post('link'), FILTER_VALIDATE_URL) === true) {
				    ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Link is not a valid')
					));
				}

				$data = array(
					"category"    => "comment",
					"type"        => "comment",
					"url"         => post('link'),
					"message"     => post('message'),
				);
				break;

			default:
				# code...
				break;
		}

		if(post('title') == ""){
			ms(array(
				"st"    => "title",
			));
		}else{
			$data["name"]    = filter_input_xss(post('title'));
			$data["uid"]     = (int)session("uid");
			$data["created"] = NOW;
			$this->db->insert(SAVE, $data);
			ms(array(
				"st"    => "success",
				"label" => "bg-light-green",
				"txt"   => l('Save successfully')
			));
		}
	}

	public function ajax_get_save(){
		$check = $this->model->get("*", SAVE, "id = '".post("value")."'".getDatabyUser());
		print_r(json_encode($check));
	}

	public function ajax_action_item(){
		$id = (int)post('id');
		$POST = $this->model->get('*', SAVE, "id = '{$id}'");
		if(!empty($POST)){
			switch (post("action")) {
				case 'delete':
					$this->db->delete(SAVE, "id = '{$id}'");
					break;
				
				case 'active':
					$this->db->update(SAVE, array("status" => 1), "id = '{$id}'");
					break;

				case 'disable':
					$this->db->update(SAVE, array("status" => 0), "id = '{$id}'");
					break;
			}
		}

		$json= array(
			'st' 	=> 'success',
			'txt' 	=> l('successfully')
		);

		print_r(json_encode($json));
	}

	public function ajax_action_multiple(){
		$ids =$this->input->post('id');
		if(!empty($ids)){
			foreach ($ids as $id) {
				$POST = $this->model->get('*', SAVE, "id = '{$id}'");
				if(!empty($POST)){
					switch (post("action")) {
						case 'delete':
							$this->db->delete(SAVE, "id = '{$id}'");
							break;
						case 'active':
							$this->db->update(SAVE, array("status" => 1), "id = '{$id}'");
							break;

						case 'disable':
							$this->db->update(SAVE, array("status" => 0), "id = '{$id}'");
							break;
					}
				}
			}
		}

		print_r(json_encode(array(
			'st' 	=> 'success',
			'txt' 	=> l('-successfully')
		)));
	}
}