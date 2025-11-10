<?php 

/**
 * Index Page Controller
 * @category  Controller
 */
class UserprogressController extends BaseController{
	/**
     * Index Action 
     * @return View
     */
	function view( $rec_id = null , $value = null){
		$db = $this->GetModel();
		$db->where('phoneNumber' , $rec_id);
		$user = $db->getOne('story_users');
		if(!$user)
		{
			render_json( array("success"=>false));
		}
		else{
		$data = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', file_get_contents('php://input'));
		$processed_data = json_decode($data, true);

		if(!isset($processed_data['storyId']) || !isset($processed_data['episodeId'])|| !isset($processed_data['progress'])|| !isset($processed_data['lastReadAt']))
		{
			render_json( array("error"=>"Input data for user progress not complete"));
		}

		$storyId = isset($processed_data['storyId'])?$processed_data['storyId']:'';
		$episodeId = isset($processed_data['episodeId'])?$processed_data['episodeId']:'';
		$progress = isset($processed_data['progress'])?$processed_data['progress']:'';
		$lastReadAt = isset($processed_data['lastReadAt'])?$processed_data['lastReadAt']:'';
		$isCompleted = isset($processed_data['isCompleted'])?$processed_data['isCompleted']:'';

		$db->where('user_id' , $rec_id)->where('story_id' , $storyId)->where('episode_id' , $episodeId);
		$get_user_progress = $db->getOne('story_userprogress');
		$rec_userprogress = false;
		if($get_user_progress){
			$db->where('user_id' , $rec_id)->where('story_id' , $storyId)->where('episode_id' , $episodeId);
			$rec_userprogress = $db->update('story_userprogress',array("progress"=>$progress, "lastReadAt"=>$lastReadAt, "isCompleted"=>$isCompleted));
		}

		else{
		$rec_userprogress = $db->insert('story_userprogress',array("user_id"=>$rec_id, "story_id"=>$storyId, "episode_id"=>$episodeId, "progress"=>$progress
	, "lastReadAt"=>$lastReadAt, "isCompleted"=>$isCompleted));
		}

			if($rec_userprogress){
				$db->where('user_id' , $rec_id)->where('story_id' , $storyId)->where('episode_id' , $episodeId);
				$user_progress = $db->getOne('story_userprogress');
				render_json( array("success"=>true,"data"=>$user_progress) );
				}
			else{
				render_json( array("success"=>false) );
			}
				}
	}
	

}
