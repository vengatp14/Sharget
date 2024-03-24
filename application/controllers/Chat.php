<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->db->query("SET time_zone='+05:30'");
		$this->ret = 0;
		$this->common_model->auto_session();
		$this->output->delete_cache('chat');
		$this->load->model('Messagemodel','Messagemodel');
    }
    // $chat_user_id=''
    public function index(){
        $chat_user_id='';
		if(isset($_SESSION['chat_uniqueid'])){
			$data['data'] = $this->Messagemodel->ownerDetails();
			if(is_array($data['data'])&&count($data['data'])>0){
				$data['chat_user_id'] = $chat_user_id;
				$this->load->view('message/message',$data);
			}else{
				$this->common_model->showAlert(0, 'Chat could not initiate for this account...');
				redirect($_SERVER["HTTP_REFERER"]);
			}
		}else{
			$this->load->view('error/error');
		}
	}
	public function ownerDetails(){
		$res = $this->Messagemodel->ownerDetails();
		print_r(json_encode($res));
	}
	public function allUser(){
		$data['data'] = $this->Messagemodel->allUser();
		$data['last_msg'] = array();
		$this->load->helper('url');
		if(!is_array($data['data'])){
			echo "<p class='text-center'>No user available.</p>";
		}else{
			$count = count($data['data']);
			for($i = 0; $i < $count; $i++){
				$unique_id = $data['data'][$i]['unique_id'];
				$msg = $this->Messagemodel->getLastMessage($unique_id);
				for($j = 0; $j < count($msg); $j++){

					$time = explode(" ",$msg[0]['time']); //00:00:00.0000
					$time = explode(".", $time[1]);//00:00:00
					$time = explode(":",$time[0]);//00 00 00
					if((int)$time[0] == 12){
						$time = $time[0].":".$time[1]." PM";
					}
					elseif((int)$time[0] > 12){
						$time = ($time[0] - 12).":".$time[1]." PM";
					}else{
						$time = $time[0].":".$time[1]." AM";
					}

					array_push($data['last_msg'],array(
						'message' => $msg[0]['message'],
						'sender_id' => $msg[0]['sender_message_id'],
						'receiver_id' => $msg[0]['receiver_message_id'],
						'time' => $time //00:00
					));
				}
			}
			$this->load->view('message/sampleDataShow',$data);
		}
		
	}
	public function getIndividual(){
		$returnVal = $this->Messagemodel->getIndividual($_POST['data']);
		print_r(json_encode($returnVal,true));
	}
	public function logout(){
		$date = $_POST['date'];
		$this->load->helper('url');
		$this->Messagemodel->logoutUser('deactive',$date);
		unset(
			$_SESSION['chat_uniqueid'],
			$_SESSION['chat_username'],
			$_SESSION['chat_image'],
		);
		echo base_url();
	}
	public function setNoMessage(){
		$data['image'] = $_POST['image'];
		$data['name'] = $_POST['name'];
		$this->load->view('message/notmessageyet',$data);
	}
	public function sendMessage(){
		if(isset($_POST['data']) && isset($_SESSION['chat_uniqueid'])){
			$jsonDecode = json_decode($_POST['data'],true);
			$uniq = $_SESSION['chat_uniqueid'];
			$arr = array(
				'time' => $jsonDecode['datetime'],
				'sender_message_id' => $uniq,
				'receiver_message_id' => $jsonDecode['uniq'],
				'message' => $jsonDecode['message'],
				);
			print_r($arr);
			$this->newChatNotify($uniq, $jsonDecode['uniq']);
			$this->Messagemodel->sentMessage($arr);
		}
	}
	public function getMessage(){
		if(isset($_POST['data']) && isset($_SESSION['chat_uniqueid'])){
			$data['data'] = $this->Messagemodel->getmessage($_POST['data']);
			$data['image'] = $_POST['image'];
			$this->load->view('message/sampleMessageShow',$data);
		}
	}
	public function updateBio(){
		if($_POST){
			$this->Messagemodel->updateBio($_POST);
		}
	}
	public function blockUser(){
		if(isset($_POST['time']) && isset($_POST['uniq'])){
			$arr = array(
				'blocked_from' => $_SESSION['chat_uniqueid'],
				'blocked_to' => $_POST['uniq'],
				'time' => $_POST['time']
			);
			$this->Messagemodel->blockUser($arr);
			return 1;
		}
	}
	public function getBlockUserData(){
		if(isset($_POST['uniq'])){
			$res = $this->Messagemodel->getBlockUserData($_POST['uniq'],$_SESSION['chat_uniqueid']);
			print_r(json_encode($res));
		}
	}
	public function unBlockUser(){
		if(isset($_POST['uniq'])){
			$from = $_SESSION['chat_uniqueid'];
			$to = $_POST['uniq'];
			$this->Messagemodel->unBlockUser($from, $to);
		}
	}
	public function newChatNotify($userid, $username = ''){
		$updateNotify = array(
			'title' => 'New chat',
			'description' => 'New chat' . $username,
			'sent_to' => $userid,
			'sent_for' => 'chat',
			'type' => 'individual',
			'token' => time()
		);
		$this->db->update('tbl_notifications', $updateNotify);
	}
}
