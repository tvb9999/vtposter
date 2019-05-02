<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cron extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function post(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);


	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where('category', 'post')
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}
			}
		}

    echo l('Successfully');
	}

	public function post_friend(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);


	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where('category', 'friend')
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}
			}
		}

    echo l('Successfully');
	}

	public function join(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);


	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where('category', 'join')
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}
			}
		}
    echo l('Successfully');
	}

	public function add_friend(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);


	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where('category', 'add')
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}
			}
		}
    echo l('Successfully');
	}

	public function unfriends(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);


	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where('category', 'unfriends')
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}
			}
		}
    echo l('Successfully');
	}

	public function invite_to_groups(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);


	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where('category', 'invite_to_groups')
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}
			}
		}

    echo l('Successfully');
	}

	public function invite_to_pages(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);


	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where('category', 'invite_to_pages')
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}
			}
		}
    echo l('Successfully');
	}

	public function accept_friend_request(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);


	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where('category', 'accept_friend_request')
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}
			}
		}

    echo l('Successfully');
	}

	public function comment(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);


	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where("( category = 'comment' OR category = 'bulk_comment')")
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}
			}
		}

    	echo l('Successfully');
	}

	public function like(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);


	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where("( category = 'like' OR category = 'bulk_like')")
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}
			}
		}

    echo l('Successfully');
	}

	public function repost_pages(){
		$spintax = new Spintax();
		ini_set('max_execution_time', 300000);


	 	$result = $this->db
	    ->select('*')
	    ->from(FACEBOOK_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where('category', 'repost_pages')
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $deplay;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", FACEBOOK_ACCOUNTS, "id = '".$row->account_id."'");
				if(!empty($account)){
					$row->access_token = $account->access_token;
					$row->username = $account->username;
					$row->password = $account->password;
					$row->cookies = $account->cookies;
					$row->fid = $account->fid;

					$response = (object)Fb_Post((object)$row);
					$arr_update = array(
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}
					if($response->txt!="Unknow error"){
						$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
					}
					
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Facebook account not exist')
					);
					$this->db->update(FACEBOOK_SCHEDULES ,$arr_update , "id = {$row->id}");
				}
			}
		}

    echo l('Successfully');
	}
}
