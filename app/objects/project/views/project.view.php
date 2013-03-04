<div id="project-<?php echo $this->id; ?>" class="page-panel">
	<div class="page-panel-header">
		<h2><?php echo $this->title; ?></h2>
	</div>
	
	<div class="project content">
		<p>
			<a class="project-image-link" href="images/<?php echo $this->image; ?>">
				<img class="project-image profile-image" src="images/<?php echo $this->image; ?>" />
			</a>

			<?php echo $this->description; ?>
		</p>
	</div>
</div>