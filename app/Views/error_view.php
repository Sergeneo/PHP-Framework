<?php
$this->view('header_view', [
	'title' => $data['text'] .' | '. $data['title'],
]);
?>

<div style="padding: 50px; text-align: center;">
	<h2><?= $data['text']; ?></h2>
	<a href="/">Back to Homepage</a>
</div>

<?php
$this->view('footer_view');
?>