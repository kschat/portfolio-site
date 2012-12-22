<?php
include_once 'databaseConnect.php';

$filter = '%';
$selected = 'all';

if(isset($_GET['show-unread']) && !empty($_GET['show-unread'])) {
	$filter = 0;
	$selected = 'unread';
}
elseif(isset($_GET['show-read']) && !empty($_GET['show-read'])) {
	$filter = 1;
	$selected = 'read';
}

if(isset($_GET['delete']) && !empty($_GET['delete'])) {
	if(isset($_GET['message-id']) && !empty($_GET['message-id'])) {
		$dbh->deleteMessage($_GET['message-id']);
	}
}
elseif(isset($_GET['read']) && !empty($_GET['read'])) {
	if(isset($_GET['message-id']) && !empty($_GET['message-id'])) {
		$dbh->markMessage($_GET['message-id'], 1);
	}
}

?>
<div class="page-panel">
	<div class="content" style="text-align: center;">
		<form method="get" action="">
			<input type="submit" <?php echo $selected == 'all'? 'class="selected-toggle-button"' :'';?> name="show-all" value="Show all messages" />
			<input type="submit" <?php echo $selected == 'unread'? 'class="selected-toggle-button"' :'';?> name="show-unread" value="Show unread messages" />
			<input type="submit" <?php echo $selected == 'read'? 'class="selected-toggle-button"' :'';?> name="show-read" value="Show read messages" />
		</form>
	</div>
</div>

<?php
foreach($dbh->getMessages($filter) as $key => $message) { ?>
	<div class="page-panel">
		<div class="page-panel-header">
			<h2>From: <?php echo $message['sender_name']; ?></h2>
		</div>
		<div class="content">
			<h2>Email: <?php echo $message['sender_email']; ?></h2>
			<p>
				<?php echo $message['message']; ?>
			</p>

			<form method="get" action="" style="float: right;">
				<input type="hidden" name="message-id" value="<?php echo $message['message_id']; ?>" />
				<input type="submit" name="read" value="Mark as read" />
				<input type="submit" name="delete" value="Delete" />
			</form>
		</div>
	</div>
	<?php
}