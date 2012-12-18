<?php 

class DatabaseHandler {
	private $handle;
	
	public function __construct($database, $host, $user, $password){
		try {
			$this->handle = new PDO("mysql:host=$host;dbname=$database;", $user, $password);
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function executeQuery($query, array $parameters = array(), $fetch_type = PDO::FETCH_ASSOC) {
		$result = array();
		
		$sth = $this->handle->prepare($query);
		
		if($sth->execute($parameters)) {
			while($row = $sth->fetch($fetch_type)) {
				array_push($result, $row);
			}
		}
		
		return $result;
	}

	public function executeUpdate($query, array $parameters = array(), $fetch_type = PDO::FETCH_ASSOC) {
		$result = array();
		
		$sth = $this->handle->prepare($query);
		
		return $sth->execute($parameters);
	}
	
	public function getProjects() {
		$result = array();
		
		$sql = 'SELECT project.project_id, project.project_title, project.project_description, project.project_image
				FROM project;';
				
		$sth = $this->handle->prepare($sql);
		
		if($sth->execute()) {
			while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
				array_push($result, $row);
			}
		}
		
		return $result;
	}
	
	public function getBoth() {
		$result = array();
		
		$sql = 'SELECT project.project_id, project.project_title, project.project_description, project.project_image, comment.comment_text
				FROM comment JOIN project
					ON project.project_id = comment.project_id;';
				
		$sth = $this->handle->prepare($sql);
		
		if($sth->execute()) {
			while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
				array_push($result, $row);
			}
		}
		
		return $result;
	}
	
	public function getComments($page_id = 0) {
		$result = array();
		
		$sql = 'SELECT comment.user_id, user.user_firstname, user.user_avatar, comment.comment_id, comment.comment_text, comment.timestamp
				FROM comment JOIN user
				WHERE comment.project_id = ? AND comment.user_id = user.user_id;';
				
		$sth = $this->handle->prepare($sql);
		
		if($sth->execute(array($page_id))) {
			while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
				array_push($result, $row);
			}
		}
		
		return $result;
	}
	
	public function addComment($page_id = 0, $user_id = 0, $comment = '') {
		$sql = 'INSERT INTO comment(comment.comment_id, comment.user_id, comment.project_id, comment.comment_text)
				VALUES (?, ?, ?, ?);';
		
		$sth = $this->$handle->prepare($sql);
		
		return $sth->execute(array(null, $user_id, $page_id, $comment));
	}

	public function sendMessage($name, $email, $message) {
		$sql = "INSERT INTO message (message.message_id, message.sender_name, message.sender_email, message.message)
				VALUES ('', ?, ?, ?);";

		return $this->executeUpdate($sql, array($name, $email, $message));
	}
}