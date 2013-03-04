<script type="text/javascript">
	$('.project-image-link').colorbox({maxWidth: '90%', maxHeight: '90%'});
</script>

<?php
include_once BASE_PATH . DS . 'public' . DS . 'databaseConnect.php';
include_once CLASS_PATH . DS . 'template.class.php';
$projects = array();

foreach ($dbh->getProjects() as $project) {
	$projects[$project['project_id']] = new Template('project.view.php', 'project', array(
		'id' 			=> $project['project_id'],
		'title' 		=> $project['project_title'],
		'description'	=> $project['project_description'],
		'image'			=> $project['project_image'])
	);

	$projects[$project['project_id']]->render();
}