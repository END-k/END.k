<?php
require( dirname(dirname(dirname(dirname( __FILE__ )))) . '/wp-load.php' );
$res = array(
  'title' => '',
);

$id = @$_GET['id'] ? @$_GET['id'] : '';

$res['title'] = get_the_title($id);

echo json_encode($res);
?>