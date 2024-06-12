<?php


// ToDo 即将着手编写的代码，说明需要完成的任务或实现的功能 #79CBDC（浅蓝色）
// fixme 需要修正的功能 #FFEE6F（黄色）
// xxx 需要改进的功能 #FFA07A（浅肉色）
// hack 变通办法（多指差强人意的解决方案）#32CD32（淡绿色）
// bug 代码存在已知的错误或 bug，需要修正 #FF6347（番茄红）
// issue 代码潜在逻辑问题，需要注意 #FF4500（橙红色）
// note 代码描述，与注释类似 #D3D3D3（浅灰色）
// mark 代码标记，用于标记某个需要特别关注的地方 #FFD700（金黄色）
// beenlee beenlee做的标记 #8A2BE2（蓝紫色）
// [ ] sdlskfsldkfj #ff0000（红色）
// [x] sdsdfksdlfk  #00ff00（绿色）


// 
$str = "/cgi-bin/corp/to_open_corpid?access_token=ACCESS_TOKEN";
$arr = parse_url($str,PHP_URL_PATH);
print_r($arr);
$aaa = [];
exit();


$data = [];
$name = $_POST['name'];
$data['html'] = "你输入的内容是：<span style='color:#f00;font_size:15px;'>" . $name . "靳小娟</span>";
echo json_encode($data, true);
