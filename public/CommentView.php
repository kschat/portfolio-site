<?php

class CommentView {
	private $id;
	private $panel;
	private $comments;
	
	public function __construct($page_id, $comments = array()) {
		$this->id = $page_id;
		$this->comments = $comments;
		$this->panel = $this->getPanel();
	}
	
	public function showPanel() {
		return $this->panel;
	}
	
	private function getPanel() {
		$commentView = '';
		
		foreach($this->comments as $comment) {
			$commentView .= '<li id="comment-'. $comment['comment_id'] .'" class="comment">'
					.	'<img class="comment-image" src="images/user_images/avatars/'. $comment['user_avatar'] .'" />'
					.	'<div class="comment-header">'
					.		'<span class="commenter">'
					.			'<a href="">'. $comment['user_firstname'] .'</a>'
					.		'</span>'
					.		''
					.		'<span class="comment-meta">'
					.			$comment['timestamp']
					.		'</span>'
					.	'</div>'
					.	'<div class="comment-body">'
					.		$comment['comment_text']
					.	'</div>'
					.	''
					.	'<div class="comment-reply">'
					.		'<a id="reply-comment-'. $comment['comment_id'] .'" href="#">Reply</a>'
					.	'</div>'
					.'</li>';
		}
		
		$panel = '<div class="comments">'
			.		'<h3>Comments</h3>'
			.		''
			.		'<ul class="commentlist">'
			.			$commentView
			.		'</ul>'
			.		''
			.		'<div class="respond">'
			.			'<h3>Leave a comment</h3>'
			.			'<form class="respond-form">'
			.				'<textarea class="respond-text"></textarea>'
			.				'<button type="submit" id="respond-submit" name="reply" value="Post Reply">Post Replay</button>'
			.			'</form>'
			.		'</div>'
			.	'</div>';
		
		return $panel;
	}
	
}