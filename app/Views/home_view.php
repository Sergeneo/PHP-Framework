<?php
$this->view('header_view', [
	'title' => $data['title'],
	'description' => '',
	'header' => '',
]);
?>

<h1 style="padding: 50px; text-align: center;"><?= $data['text']; ?></h1>

<?php
$this->view('footer_view', [
	'footer' => '',
]);
?>