<?php

class ProjectView {
	private $id;
	private $panel;
	private $title;
	private $description;
	private $image;
	private $commentSection;
	
	public function __construct($id, $title, $description, $image, $commentView = array()) {
		$this->id = $id;
		$this->title = $title;
		$this->description = $description;
		$this->image = $image;
		$this->commentSection = new CommentView($this->id, $commentView);
		$this->panel = $this->getPanel();
	}
	
	private function getPanel() {
		$panel = '<div id="'. $this->id .'" class="page-panel">'
			.	'<div class="page-panel-header">'
			.		'<h2>'. $this->title .'</h2>'
			.	'</div>'
			.	''
			.	'<div class="project content">'
			.		'<p>'
			.			'<img class="project-image" src="images/' . $this->image .'" />'
			.			$this->description
			.			'<br /><br />'
			.			'<a class="project-read-more" href="#">Read more...</a>'
			.		'</p>'
			.		'<div class="more-info">'
			.			'<table>'
			.				'<tr>'
			.					'<td>Lines of code:</td>'
			.					'<td>1,600</td>'
			.				'</tr>'
			.			'</table>'
			.			$this->commentSection->showPanel()
			.		'</div>'
			.	'</div>'
			. '</div>';
		
		return $panel;
	}
	
	public function showPanel() {
		echo $this->panel;
	}
}