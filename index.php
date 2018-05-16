<?php
$data = [];
$name = $_POST['name'];
$data['html'] = "你输入的内容是：<span style='color:#f00;font_size:15px;'>" . $name . "靳小娟</span>";
echo json_encode($data, true);
?>