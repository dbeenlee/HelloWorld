<?php
    // 初始化参数
    $textContent = 'userName';
    $fontPath = './image/images/black.ttf'; // 字体路径
    $fontSize = 18;
    $textColor = '#ffffff';  // 文字颜色
    $shadowColor = '#000000'; // 阴影颜色
    $angle = 0;  // 文字旋转角度
    $shadowx = 2;
    $shadowy = 2;
    $translateX = 0; // X 轴平移
    $translateY = 0; // Y 轴平移
    $skewX = 0;  // X 轴倾斜
    $skewY = 0;  // Y 轴倾斜

try {
    // 加载 Logo
    $logo = new Imagick('image/images/watermark.png');
    if (!$logo->valid()) {
        throw new Exception("无法加载 Logo 图像。");
    }

    // 创建文本画布和绘图工具
    $text = new Imagick();
    $draw = new ImagickDraw();

    // 设置字体及颜色
    if (!file_exists($fontPath)) {
        throw new Exception("字体文件不存在：$fontPath");
    }
    $draw->setFont($fontPath);
    $draw->setFontSize($fontSize);
    $draw->setFillColor(new ImagickPixel($textColor));

    // 获取文本的尺寸（旋转前）
    $metrics = $text->queryFontMetrics($draw, $textContent);

    // 创建足够大的透明画布绘制文字
    $canvasWidth = $metrics['textWidth'] * 2 + $shadowx;
    $canvasHeight = $metrics['textWidth'] * 2 + $shadowy;
    $text->newImage($canvasWidth, $canvasHeight, new ImagickPixel('transparent'));

    $draw->setGravity(5);
    // 平移
    if ($translateX || $translateY) {
        $draw->translate((float)$translateX, (float)$translateY);
    }

    // 倾斜
    if ($skewX) {
        $draw->skewX((float)$skewX);
    }
    if ($skewY) {
        $draw->skewY((float)$skewY);
    }

    // 计算文字的偏移位置（考虑旋转中心）
    $xOffset = $metrics['textWidth'];
    $yOffset = $metrics['textWidth'];

    // 应用旋转角度
    $draw->rotate($angle);

    // 绘制阴影文字
    $shadow = clone $draw;
    $shadow->setFillColor(new ImagickPixel($shadowColor));
    //$text->annotateImage($shadow, $xOffset + $shadowx, $yOffset + $shadowy, 0, $textContent);
    $shadow->annotation($shadowx, $shadowy, $textContent);
    $text->drawImage($shadow);

    // 绘制主文字
    //$text->annotateImage($draw, $xOffset, $yOffset, 0, $textContent);
    $draw->annotation(0, 0, $textContent);
    $text->drawImage($draw);

    // 修剪多余空白并重置页面偏移
    $text->trimImage(0);
    $text->setImagePage(0, 0, 0, 0);

    // 创建最终画布，宽度为 Logo + 文字宽度，高度为两者的最大值
    $finalWidth = $logo->getImageWidth() + $text->getImageWidth() + 5;
    $finalHeight = max($logo->getImageHeight(), $text->getImageHeight());
    $canvas = new Imagick();
    $canvas->newImage($finalWidth, $finalHeight, new ImagickPixel('transparent'));

    // 将 Logo 和文字合成到画布上（垂直居中）
    $canvas->compositeImage($logo, Imagick::COMPOSITE_OVER, 0, round(($finalHeight - $logo->getImageHeight()) / 2));
    $canvas->compositeImage($text, Imagick::COMPOSITE_OVER, $logo->getImageWidth()+5, round(($finalHeight - $text->getImageHeight()) / 2));

    // 保存为 PNG 文件
    $outputPath = 'output' . time() . '.png';
    $canvas->setImageFormat('png');
    $canvas->writeImage($outputPath);

    // 清理资源
    $logo->destroy();
    $text->destroy();
    $canvas->destroy();

    echo "图片已生成：$outputPath";
} catch (Exception $e) {
    echo '发生错误：' . $e->getMessage();
}




/* // 初始化 Imagick 对象
$logo = new Imagick('image/images/watermark.png'); // 加载 Logo 图像
$text = new Imagick();           // 创建文本画布

// 设置文本属性
$draw = new ImagickDraw();
$draw->setFont('./image/images/black.ttf');                // 设置字体
$draw->setFontSize(36);                 // 字体大小
$draw->setFillColor('black');           // 字体颜色
$metrics = $text->queryFontMetrics($draw, 'Hello, World!'); // 获取文本的宽高

// 创建文本画布，宽度与文字匹配，高度与 Logo 相同
$text->newImage($metrics['textWidth'], $logo->getImageHeight(), new ImagickPixel('transparent'));
$text->annotateImage($draw, 0, $metrics['ascender'], 0, 'Hello, World!'); // 添加文字

// 合并图片：创建一个新画布，宽度为 Logo + 文本宽度，高度为 Logo 高度
$canvas = new Imagick();
$canvasWidth = $logo->getImageWidth() + $text->getImageWidth();
$canvasHeight = $logo->getImageHeight();
$canvas->newImage($canvasWidth, $canvasHeight, new ImagickPixel('transparent'));

// 将 Logo 和文本添加到新画布上
$canvas->compositeImage($logo, Imagick::COMPOSITE_OVER, 0, 0);                   // 放置 Logo
$canvas->compositeImage($text, Imagick::COMPOSITE_OVER, $logo->getImageWidth(), 0); // 放置文字

// 设置输出格式为 PNG，并输出文件
$canvas->setImageFormat('png');
$canvas->writeImage('output.png');

// 清理资源
$logo->destroy();
$text->destroy();
$canvas->destroy();

echo "图片已生成：output.png"; */

exit();

// 创建一个图像
$image = imagecreatetruecolor(200, 50);

// 设置背景色
$bgColor = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $bgColor);

// 设置文本颜色
$textColor = imagecolorallocate($image, 0, 0, 0);

// 设置字体路径
$fontPath = '/path/to/your/font.ttf';

// 在图像上绘制文字
imagettftext($image, 20, 0, 10, 40, $textColor, $fontPath, 'Hello, FreeType!');

// 输出图像
$img = imagepng($image);

// 释放内存
imagedestroy($image);
exit;

$object = new \stdClass();

$params['body'] = [
    'pgc_id' => '705819862043230209',
    'source' => 0,
    'title' => '茅屋为秋风所破',
    'content' => "<h2>内容概要</h2><p>在这片苍茫的原野上，孤零零的茅屋静静伫立，仿佛在守望着过去的岁月。秋风瑟瑟而来，吹动了屋顶的茅草，发出轻微的沙沙声，这是一曲凄凉却又坚定的旋律。茅屋虽破旧，却蕴藏着无数温暖的回忆，让人不禁想起那些曾经在这里度过的美好时光。</p><p>屋内，阳光透过小窗洒进来，勾勒出一幅温馨的画面。墙角堆放着尘封已久的老物件，每一件都承载着故事。记忆在空气中飘荡，如同缭绕的烟雾，让人感受到生命点滴流淌的痕迹。尽管外面的秋风刺骨，但屋内却散发出一种让人倍感安慰的人情味。</p><p>每当秋风掠过，那些凋零的叶子轻声低语，仿佛在诉说生命中的无常与不屈。在这设计独特的小天地里，它与自然悄然契约，让我们体会到坚持与勇敢的重要性。茅屋不仅是一个居所，更是心灵温暖的港湾，这里凝聚了过去与现在，让人感到无尽温柔和安宁。</p><h2>茅屋的孤独守望</h2><blockquote><p>在这个快速变化的世界里，我们有时需要停下脚步，去倾听那些被遗忘的故事。</p></blockquote><p>一间破旧的茅屋屹立在广袤的原野上，似乎在静静守望着周围的一切。每当秋风起，茅屋的屋顶那枯黄的茅草随着风摇曳，轻声低语。它们似乎在诉说着孤独与坚韧，像是一位无声的守护者，见证着岁月的流逝与生命的变迁。</p><p>这间茅屋不仅仅是一个居所，它承载着无数回忆。走进屋内，阳光透过小窗洒下斑驳的光影，上面覆盖着一层薄薄的灰尘。那深藏在每个角落里的故事，如同被时间封存的珍宝，等待着有人来细细品味。这里的一切都透着生活的气息，让人感到一丝温暖，即使外面的秋风凛冽。</p><p>正是在这孤独之中，茅屋展现出的却是一种内心深处的不屈与坚持。它仿佛在告诉我们，无论外界如何变化，总有一个地方可以提供避风的港湾。在这个靠近自然与记忆交织的小天地里，人们能够重新找到生活的意义与温暖。</p><h2>秋风中的凄凉篇章</h2><p>在这个秋风瑟瑟的季节，茅屋的外观显得更加破旧。风儿呼啸而过，轻轻摇曳着屋顶的茅草，发出细微的声响。每次风起，都会有几片黄叶随之飘落，像是在诉说着时光的无情。这间孤零零的茅屋，就这样在苍茫的原野上守望着，似乎也在期盼着某种归属。</p><table style=\"border-collapse: collapse; table-layout: fixed; margin: 0; overflow: hidden; min-width: 50px\"><colgroup><col><col></colgroup><tbody><tr><th style=\"font-weight: bold;text-align: left;background-color: #F1F3F5;min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative\" colspan=\"1\" rowspan=\"1\"><p>自然元素</p></th><th style=\"font-weight: bold;text-align: left;background-color: #F1F3F5;min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative\" colspan=\"1\" rowspan=\"1\"><p>描述</p></th></tr><tr><td style=\"min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative\" colspan=\"1\" rowspan=\"1\"><p>秋风</p></td><td style=\"min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative\" colspan=\"1\" rowspan=\"1\"><p>带来凄凉感觉</p></td></tr><tr><td style=\"min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative\" colspan=\"1\" rowspan=\"1\"><p>茅屋</p></td><td style=\"min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative\" colspan=\"1\" rowspan=\"1\"><p>孤独坚守</p></td></tr><tr><td style=\"min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative\" colspan=\"1\" rowspan=\"1\"><p>落叶</p></td><td style=\"min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative\" colspan=\"1\" rowspan=\"1\"><p>生命循环</p></td></tr></tbody></table><p>虽然外界寒冷，但这间茅屋却藏着许多温暖的回忆。每一处灰尘都仿佛埋藏着曾经的人声笑语，那些温馨而又宁静的时光悄然流逝，让人心生感怀。在这肃杀的季节里，茅屋成了生命故事的一部分，它静静地诉说着过去与现在，让人们在凄凉中找到一丝慰藉。</p><h2>记忆的尘埃与回归</h2><p>在这间茅屋中，时间似乎凝固了。屋内的每一个角落都蒙上了一层灰尘，仿佛在静静守护着过去的回忆。紧闭的窗户透出微弱的光线，照亮了那些残破的家具和墙壁上的斑驳痕迹。每当秋风吹起，屋内的角落也随之响起低语，像是在低声诉说着往日的故事。</p><p>有时，我会在这茅屋里坐下来，闭上眼睛，聆听那些久远声音的回响。记忆如潮水般涌来：孩提时在院子里嬉戏打闹的欢声笑语，小伙伴们一起追逐昆虫的快乐时光，还有温暖的家庭聚餐，那些弥足珍贵的人情味，让人心头一热。这些回忆不仅填满了心灵，也让凄凉的茅屋增添了一丝温暖。</p><p>秋风无情，却也把我带回那些美好的瞬间。随着风声，我仿佛能遇见曾经的人们，一同分享那些简单而幸福的小事。这些记忆就像尘埃，在阳光下闪烁着动人的光芒，让我感受到生活中的美好与温暖。茅屋虽破旧，却是我心灵归宿的港湾，当外面的世界变得寒冷时，它却永远为我保存着温暖与希望。</p><h2>生命的无常与坚持</h2><p>秋风带来了清冷的气息，它轻轻地穿过了茅屋的门缝，仿佛在讲述着一些古老而又动人的故事。屋外的树叶在风中渐渐凋零，生命似乎在这时流露出脆弱的一面。每一片叶子都像是一个小小的生命，它们从青翠到金黄，再到最后匆匆飘落，无不在诉说着时间的流逝与无常。然而，茅屋却任凭风霜雨雪，始终屹立在那片原野上。就像那些经历了岁月的老人，用他们的坚韧讲述着奋斗与希望，尽管外面的世界再怎么变化，他们依旧坚持着这一份存在。</p><p>茅屋里的灰尘映衬出记忆的厚重，每个角落都藏着往昔的痕迹。那些温暖的瞬间，如同窗外微弱的阳光，透过破旧但依然坚固的墙壁照在心灵深处。即便身处困境，这份温暖让人感受到生命力的顽强。在这秋风中，那些凋零叶子仿佛是对生命长河的一次轻声低语，提醒我们珍惜每一个当下，以及那些依然坚守于心底不灭的希望。</p><p>正是这种无常与坚持，让茅屋成为了通往记忆和过去的一扇窗。即使风雨再大，它仍旧静静守望，也许这就是生命真正的意义所在。</p><h2>温暖的心灵港湾</h2><p>在那间破旧的茅屋里，尽管窗外的秋风呼啸，仿佛要将一切都捣碎，但屋内却散发出一种特别的温暖。墙壁上挂着岁月留下的痕迹，那些斑驳的痕迹如同老朋友般亲切。尽管茅屋已然破旧，但依旧散发着人情味，仿佛是在诉说一个个动人的故事。</p><p>小小的木桌上放着几本泛黄的书籍，那是曾经温暖人心的饮料。每当翻开书页，尘封的回忆便如潮水般涌来，带着无限温馨与感动。是母亲欢笑着为我讲故事，是父亲在炉火旁轻声唱歌，更有那些与朋友们一起度过的快乐时光。虽然它们都已经远去，但这些记忆像秋阳般洒在心田，不时升腾起淡淡的笑意。</p><p>秋风透过小窗户缝隙轻轻吹入，带来一丝丝凉意，却也夹杂着家乡特有的稻谷香味，让人倍感温馨。尽管外界的寒冷无法避免，但茅屋里那份温暖却始终存在。这就是一个家的意义，它是我们心灵的一片宁静之地，无论世界多么复杂和喧嚣，这里始终可以带给我们安慰和力量。在这里，人们可以暂时忘却生活中的烦恼，与过往进行深情对话。在孤独与凄凉之中，这间茅屋，无疑是心灵最柔软、最坚韧的港湾。</p><h2>在秋风中契约过往</h2><p>秋风轻轻掠过茅屋，仿佛在与它窃窃私语。屋内的灰尘在阳光的照耀下漫舞，如同时间的流沙，留下不可磨灭的痕迹。每一寸墙壁，都承载着过去的故事。那些曾在这里欢声笑语的人们，如今只剩下记忆中的影子。</p><p>风中夹杂着落叶的沙沙声，每一片凋零的叶子都像是一个个小小的信使，传递着岁月的温柔与无常。它们在空中飞舞，最终轻轻落在草地上，像是在完成与生命的契约。茅屋的每一次颤动，都像是在回应秋风带来的召唤，似乎在提醒着路过的人们，要珍惜眼前的一切。</p><p>温暖的人情味在这间破旧的小屋内流淌，它并不因外界寒冷而减弱。时光虽然无情，但这里依然散发出家的安全感。在这个季节里，即使是孤零零地矗立，也能感受到历史赋予它的一种力量。一阵秋风吹过，让人不禁想起那些属于过去，也属未来的瞬间。在这样的瞬间里，茅屋与秋风共同编织了一张温暖而又细腻的网，让我们得以在回忆中漫步、徘徊。</p><h2>凋零叶子的低语</h2><p>在这个秋季，茅屋的四周弥漫着一片宁静，只有秋风轻轻拂过，带来了树叶落地的细微声响。那一片片黄叶，如同岁月的低语，悄然诉说着生命的变迁与无常。它们从枝头飘落，像是为大地铺上一层别致的地毯，闪烁着秋日特有的暖意与美丽。但是，这美丽背后，却也隐藏着一丝凄凉。</p><p>凋零的叶子间散发出淡淡的香气，仿佛是怀旧的气息，让人不由得想起那些曾经欢声笑语的人们。他们或许曾在这茅屋旁嬉戏打闹，如今却只剩下风和树叶为伴。每当秋风袭来，那些枯黄的叶子随风起舞，它们像是在跳着优雅而又悲伤的舞蹈，把过去的一切轻声讲述给路过的人。</p><p>即使在这样的时节，茅屋里却有一种难以言喻的温暖。也许那是历史留下来的温情，也许是人们心中未曾熄灭的希望。在这样的环境中，即便外界再冷清，这座小小的茅屋依然是一个心灵港湾。纵使秋风呼啸和叶子凋零，它也静静守护着那一份来自往昔深处的温暖与回忆。</p><h2>结论</h2><p>秋风中的茅屋，承载了无数回忆与故事。它如同一位孤独的守望者，静静地立在原野上，见证了生命的无常与坚持。那些刮过屋顶的风，带来了凄凉的气息，也提醒我们珍惜当下。尽管外面秋风凛冽，但屋内却充满了温暖的人情味。每一个角落似乎都藏有往昔的片段，让人无法忘怀。在这个让人感到萧瑟的季节，我们不妨停下脚步，倾听那低语的凋零叶子，感受生命的脆弱与坚强。茅屋是一处心灵的港湾，让我们在这个复杂喧嚣的世界中找到一丝安宁与温暖。通过回忆，我们和过去有了更深刻的连接，也看到了生活中微小却真实的美好。在这片秋风中，人与自然、过去与现在之间，一切都悄然契约，共同谱写出生命的乐章。</p><h2>常见问题</h2><p><strong>1. 茅屋是什么样子的？</strong><br>茅屋是一种用茅草和木材建造的小房子，通常在乡村或偏远地区见到。它的外观简单，给人一种朴素的感觉。</p><p><strong>2. 为什么秋风让人觉得凄凉？</strong><br>秋风常常带来凉爽的天气，树叶也会开始变黄或掉落，这些变化让人感到孤独和伤感，因此会产生凄凉的感觉。</p><p><strong>3. 在茅屋里有哪些回忆？</strong><br>茅屋里可能藏着许多人曾经住在这里的故事，如温馨的家庭聚会、欢声笑语，还有与自然互动的点滴回忆。</p><p><strong>4. 为什么说生命是无常的？</strong><br>生命中有很多不确定性，比如亲人的离去、朋友的分离，这些都让我们体会到生命的不易和无常。</p><p><strong>5. 茅屋可以带来哪些温暖？</strong><br>茅屋虽然外表古老，但它承载着人与人之间的情感，在里面可以找到家的温暖与安慰，无论外面的世界多么寒冷。</p>",
    'extra' => [
        'is_multi_title' => 0,
        'sub_titles' => [],
        'gd_ext' => [
            'entrance' => '',
            'from_page' => 'publisher_mp',
            'enter_from' => 'PC',
            'device_platform' => 'mp',
            'is_message' => 0,
        ],
        'tuwen_wtt_transfer_switch' => '0',
        'info_source' => [
            'source_link' => '',
            'time_format' => '',
            'position' => $object,
        ],
    ],
    'mp_editor_stat' => $object,
    'draft_form_data' => ['coverType' => 1],
    'pgc_feed_covers' => [],
    'article_ad_type' => 2,
    'article_type' => 0,
    'origin_debut_check_pgc_normal' => 0,
    'save' => 0, // 0-草稿 1-发布
    'tree_plan_article' => 0,
];

function postNote(array $params)
{
    $requestUrl = 'https://mp.toutiao.com/mp/agw/article/publish?' . http_build_query([
        'source' => 'mp',
        'type' => 'article',
        //            'aid' => 1231,
        //            'msToken' => 'WUL15Xx5NsID0_FzMaBqj1AElUVe7xdIE9WfjvUTG_aZdvmnCHw3NyDLacP7Ga9SylRB8xoirlZJOD9cuyqLnkv-4TggQ0E_EgBmGdLZdhXdZGrGl-lD2xSW8cxFRA%3D%3D&a_bogus=d64YgchIMsm1bxKFLXkz9JQ32kf0YWRbgZENkQEk30L9',
    ]);

    $bodyArr = [];
    foreach ($params['body'] as $key => $value) {
        $objectString = (string) ((is_array($value) || is_object($value)) ? json_encode($value) : $value);

        $objectString = str_replace('\\/', '/', $objectString);

        $bodyArr[] = implode('=', [$key, rawurlencode($objectString)]);
    }

    $options = [
        'body' => implode('&', $bodyArr),
        'headers' => [
            'user-agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36',
            'Cookie:passport_csrf_token=a7a1c2f0bf640767e8f3d5c227a9c882; passport_csrf_token_default=a7a1c2f0bf640767e8f3d5c227a9c882; s_v_web_id=verify_m1kie03h_BmmddSjk_AvZ3_4x4G_8ZUj_sp4lqQHfE2VW; d_ticket=af29121e8c914f1177cd7b69239f402cbd634; n_mh=ZPAZLeVkIVeoz8HWRLQscXrA2uez8Lnx-bJkCYhD7NY; is_staff_user=false; store-region=cn-ah; store-region-src=uid; ttcid=b0a136722e7d4834964b4a9738c6647721; tt_webid=7330546232639653388; sso_uid_tt=d66fbe49b208775fcd11fb83fc23f6dc; sso_uid_tt_ss=d66fbe49b208775fcd11fb83fc23f6dc; toutiao_sso_user=953734b940f11b49ea38218ec728b46a; toutiao_sso_user_ss=953734b940f11b49ea38218ec728b46a; sid_ucp_sso_v1=1.0.0-KGQ5YTE3NjE2Y2I0ZjIyZjUwYTM2M2Y3Y2U0MGRmYzdmMjg4ZWZkOTYKHAiZxqHyDRDK6eK3BhjPCSAMMN6XtqQFOAFA6wcaAmhsIiA5NTM3MzRiOTQwZjExYjQ5ZWEzODIxOGVjNzI4YjQ2YQ; ssid_ucp_sso_v1=1.0.0-KGQ5YTE3NjE2Y2I0ZjIyZjUwYTM2M2Y3Y2U0MGRmYzdmMjg4ZWZkOTYKHAiZxqHyDRDK6eK3BhjPCSAMMN6XtqQFOAFA6wcaAmhsIiA5NTM3MzRiOTQwZjExYjQ5ZWEzODIxOGVjNzI4YjQ2YQ; sid_guard=22a9f05e882a8a0e0cd55a2c7c678ec7%7C1727575242%7C5184002%7CThu%2C+28-Nov-2024+02%3A00%3A44+GMT; uid_tt=c9f9453c739ea50678ef1e6bddde5420; uid_tt_ss=c9f9453c739ea50678ef1e6bddde5420; sid_tt=22a9f05e882a8a0e0cd55a2c7c678ec7; sessionid=22a9f05e882a8a0e0cd55a2c7c678ec7; sessionid_ss=22a9f05e882a8a0e0cd55a2c7c678ec7; sid_ucp_v1=1.0.0-KDQ5MWRjMTBlYWE0OGVlZDFlOTQ5NTcyY2U0YmQxOGJjMjUwMGUyZDYKFgiZxqHyDRDK6eK3BhjPCSAMOAFA6wcaAmxxIiAyMmE5ZjA1ZTg4MmE4YTBlMGNkNTVhMmM3YzY3OGVjNw; ssid_ucp_v1=1.0.0-KDQ5MWRjMTBlYWE0OGVlZDFlOTQ5NTcyY2U0YmQxOGJjMjUwMGUyZDYKFgiZxqHyDRDK6eK3BhjPCSAMOAFA6wcaAmxxIiAyMmE5ZjA1ZTg4MmE4YTBlMGNkNTVhMmM3YzY3OGVjNw; odin_tt=05730a8fe729995469d0edcb55b64d881eb2913a3edbbcbfa77b2ddae8f936a7f68e45fc7202cf09ac9caa84c95c7e0a; ttwid=1%7CKb-DEELiZ0e0z7tfnDo8wnL15iIMA0Hppvvz-H2seq0%7C1729143671%7Ccdc10624877215808e098bb9e69be563922e2804fa0b2e96471aa90198737a69; gfkadpd=1231,25897; csrf_session_id=55f2397d0a171b9e241b1e2218de40fb; tt_scid=lsJbE0GBVk37PV0GzLpBZmSIf9Cj1bKlsy2U3wZRoinLQtd24UXyVP46cb2DxWEv482a',
            'referer:https://mp.toutiao.com/profile_v4/graphic/publish',
            'content-type:application/x-www-form-urlencoded;charset=UTF-8',
        ],
    ];
    print_r([$requestUrl, $options]);

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $requestUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $options['body'],
        CURLOPT_HTTPHEADER => $options['headers'],
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
}

$response = postNote($params);

echo $response;
exit();
// Example usage
$data = '{
    "method": "GET",
    "url": "https://bizapi.csdn.net/mall-revenue-api/earnings/v1/info",
    "accept": "application/json, text/plain, */*",
    "params": {
        "code": "4001,4002"
    },
    "date": "",
    "contentType": "",
    "headers": {
        "common": {
            "Accept": "application/json, text/plain, */*"
        },
        "delete": {},
        "get": {},
        "head": {},
        "post": {
            "Content-Type": "application/json;charset=UTF-8"
        },
        "put": {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        "patch": {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        "X-Ca-Key": "203803574",
        "X-Ca-Nonce": "1384c960-74bf-4387-8638-2ec82f99f8a6"
    },
    "appSecret": "9znpamsyl2c7cdrr9sas0le9vbc3r6ba"
}';
$data = json_decode($data, 1);
//print_r($data);
echo generateSignature($data);

exit();

echo Fe();

exit;

$content = '<div contenteditable="false" spellcheck="false" translate="no" class="tiptap ProseMirror"><h2>内容概要</h2><p>在学习PHP的旅程中，了解内容概要是非常重要的一步。本文将引导读者逐步深入PHP的世界，首先从基础知识入手，帮助新手掌握PHP的基本语法，包括变量、数据类型以及控制结构等关键概念。接着，我们将详尽解释常用的PHP语法，以便理解其背后的逻辑。</p><p>随着基础知识的掌握，读者将学习到如何使用PHP函数和数组进行数据处理，这些都是日常开发中不可或缺的工具。随后，文章将介绍面向对象编程在PHP中的应用，让开发者能够以更高效、可维护的方式编写代码。</p><p>在掌握了基本操作后，数据库连接与数据操作部分将带领读者学习如何使用PHP与数据库进行交互，这是动态网页开发的重要环节。此外，我们还将探讨各类流行PHP框架，帮助开发者做出合适的选择，以提升开发效率。</p><p>随着前端技术的发展，与PHP的结合使用是不可避免的一部分。最后，我们还会深入讨论一些进阶应用，包括安全性和性能优化，以帮助读者在实际项目中应对各种挑战和需求。这一系列内容不仅适合初学者，也为有一定经验的开发者提供了丰富的学习资料。</p><h2>PHP基础知识入门</h2><p>在开始PHP的学习之旅之前，了解其基础知识至关重要。PHP（超文本预处理器）是一种广泛使用的开源脚本语言，专为网页开发而设计。学习PHP不仅能帮助您创建动态网页，还能与数据库进行交互，满足现代网站的需求。在这部分中，我们将讨论PHP的基本概念和语法，并通过表格来总结一些常用语法结构。</p><p>下表展示了几种常用的PHP基本语法及其示例：</p><table style="border-collapse: collapse; table-layout: fixed; margin: 0; overflow: hidden; min-width: 75px"><colgroup><col><col><col></colgroup><tbody><tr><th style="font-weight: bold;text-align: left;background-color: #F1F3F5;min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative" colspan="1" rowspan="1"><p>语法元素</p></th><th style="font-weight: bold;text-align: left;background-color: #F1F3F5;min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative" colspan="1" rowspan="1"><p>描述</p></th><th style="font-weight: bold;text-align: left;background-color: #F1F3F5;min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative" colspan="1" rowspan="1"><p>示例</p></th></tr><tr><td style="min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative" colspan="1" rowspan="1"><p>输出信息</p></td><td style="min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative" colspan="1" rowspan="1"><p>使用<code>echo</code>输出内容</p></td><td style="min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative" colspan="1" rowspan="1"><p><code>echo "Hello World";</code></p></td></tr><tr><td style="min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative" colspan="1" rowspan="1"><p>变量声明</p></td><td style="min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative" colspan="1" rowspan="1"><p>以<code>$</code>开头的变量</p></td><td style="min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative" colspan="1" rowspan="1"><p><code>$name = "Alice";</code></p></td></tr><tr><td style="min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative" colspan="1" rowspan="1"><p>条件语句</p></td><td style="min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative" colspan="1" rowspan="1"><p>控制程序流</p></td><td style="min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative" colspan="1" rowspan="1"><p><code>if ($age &gt; 18) { ... }</code></p></td></tr><tr><td style="min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative" colspan="1" rowspan="1"><p>循环结构</p></td><td style="min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative" colspan="1" rowspan="1"><p>重复执行某段代码</p></td><td style="min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative" colspan="1" rowspan="1"><p><code>for ($i = 0; $i &lt; 10; $i++) { ... }</code></p></td></tr><tr><td style="min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative" colspan="1" rowspan="1"><p>数组</p></td><td style="min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative" colspan="1" rowspan="1"><p>存储多个值</p></td><td style="min-width: 1em;border: 2px solid #CED4DA;padding: 3px 5px;vertical-align: top;box-sizing: border-box;position: relative" colspan="1" rowspan="1"><p><code>$fruits = array("apple", "banana");</code></p></td></tr></tbody></table><p>在学习这些基础知识时，重要的是熟悉PHP代码的结构和语法规则。在PHP中，每个代码块通常以<code>;</code>结尾。此外，了解各种变量的作用范围、数据类型及控制结构，将为后续深入学习其他概念打下坚实基础。</p><p>通过不断实践和实验这些基本概念，您将能够更轻松地掌握后续课程中的复杂主题。在后续章节中，我们将逐步深入，包括数组操作、函数定义和数据库连接等内容。</p><h2>常用PHP语法详解</h2><p>在学习PHP的过程中，掌握基本语法是至关重要的一步。PHP是一种服务器端脚本语言，其语法与C语言和Perl有很多相似之处，使得许多开发者在学习时能够快速上手。首先，PHP代码的基本结构是通过<code>&lt;?php</code>和<code>?&gt;</code>标签来定义的。所有的PHP代码必须放在这对标签之间。此外，PHP是大小写不敏感的，但遵循一致的命名规则将提高代码的可读性。</p><p>变量在PHP中以美元符号（$）开头，其后为变量名，例如<code>$myVariable</code>。在定义变量时，PHP会根据赋值自动推测数据类型，包括字符串、整数、数组等。通过使用双引号，开发者能够轻松插入变量到字符串中，称为变量解析。例如：<code>echo "Hello, $myVariable";</code> 会直接输出变量内容。</p><p>控制结构如条件判断和循环同样是PHP语法的重要组成部分。if、else和switch等条件判断结构允许开发者根据特定条件选择执行不同的代码块。而for、while和foreach循环则激励着程序对集合中的每一个元素进行操作。</p><p>此外，函数是组织代码的重要方式。在PHP中，可以使用关键字<code>function</code>来定义函数，从而实现功能封装和重用。理解如何传递参数以及返回值将极大地提升编程效率。</p><p>了解以上基础语法后，将为后续更复杂的概念打下坚实基础，包括数组操作、对象导向编程等。这些都是编写高效、可维护代码的重要组成部分。在掌握了常用语法后，你将能够更自信地迈向更高级的话题，为自己的编程技能增添重要的一笔。</p><img maxwidth="100%" height="auto" src="https://bailing-1305744786.cos.ap-nanjing.myqcloud.com/upload/esign/20240929/66f8f62d1a52f96669.jpg" alt="image" contenteditable="false" draggable="true"><h2>PHP函数与数组操作</h2><p>在学习PHP的过程中，函数与数组操作是至关重要的内容。函数是封装了一段可以重复使用代码的工具，它帮助开发者将复杂任务拆解为简单的步骤，增强代码的可读性和可维护性。PHP提供了丰富的内置函数，例如<code>strlen()</code>用于计算字符串长度，<code>array_push()</code>用于向数组添加元素等。这些函数都可以帮助我们高效地处理数据。</p><p>数组则是存储多个值的结构，是进行数据处理时不可或缺的一部分。在PHP中，我们可以轻松地创建和操作数组，包括索引数组和关联数组。使用<code>foreach</code>循环遍历数组中的元素，是非常常用且便捷的方法。此外，PHP还提供了一些高阶数组处理函数，例如<code>array_map()</code>、<code>array_filter()</code>和<code>array_reduce()</code>，它们常被用于对数组进行映射、过滤和归约等操作，极大地提高了开发效率。</p><blockquote><p>要想掌握PHP编程，熟练运用函数和数组操作将为你的编码旅程打下坚实基础。实践中多加运用这些概念，会使你的代码更加简洁高效。</p></blockquote><h2>面向对象编程在PHP中的应用</h2><p>面向对象编程（OOP）是一种强大的编程范式，它通过将数据和行为封装在对象中，使得代码逻辑更加清晰和易于维护。在PHP中，OOP的引入标志着语言的一个重要进步，使得开发者能够使用类和对象来组织代码。通过定义类，开发者可以创建包含属性（数据）和方法（操作）的对象，从而实现代码的模块化。</p><p>在实际应用中，OOP使得复杂系统的设计变得更加直观。开发者可以将现实世界中的实体抽象为对象，例如，一个“用户”类可以包含用户的基本信息和相关方法，比如注册、登录等。这种抽象不仅提高了代码的重用性，还让系统结构更加清晰，各个部分之间的关系一目了然。</p><p>此外，PHP的OOP特性还支持继承和多态，使得开发者能够基于已有类扩展新的功能或重写原有方法，为项目的灵活性提供了极大的便利。例如，可以创建一个“管理员”类继承自“用户”类，同时添加特有的方法，如关闭账户等，这样不仅避免了重复代码，还让各个角色之间具有更好的扩展性与适应性。</p><p>总之，面向对象编程在PHP中的应用，不仅提高了开发效率，还确保了代码质量，是构建大型项目时不可或缺的重要手段。通过学习OOP原理，开发者可以更加自信地应对复杂业务逻辑，实现高质量的软件产品。</p><img maxwidth="100%" height="auto" src="https://bailing-1305744786.cos.ap-nanjing.myqcloud.com/upload/esign/20240929/66f8f62e13d9e32228.jpg" alt="image" contenteditable="false" draggable="true"><h2>数据库连接与数据操作</h2><p>在现代 Web 开发中，数据库连接是每一个 PHP 开发者必须掌握的核心技能之一。PHP 提供了多种方式与不同类型的数据库进行交互，其中最常用的是 MySQL 数据库。为了建立与数据库的连接，开发者可以使用 MySQLi 扩展或 PDO（PHP Data Objects）。这两种方法各有特点，MySQLi 更加简单易用，而 PDO 支持更多类型的数据库。</p><p>首先，使用 MySQLi 进行连接，一般需要创建一个新的 MySQLi 对象，并提供主机名、用户名、密码以及数据库名。例如：</p><pre><code class="language-php">$connection = new mysqli("localhost", "username", "password", "database");</code></pre><p>在确认连接成功后，开发者可以通过执行 SQL 查询、插入数据、更新记录和删除操作来实现数据管理。</p><p>而使用 PDO 进行连接，则可以更灵活地处理各种数据库，这对于需要更大兼容性的项目尤其重要。PDO 支持准备语句，这不仅提高了安全性（防止 SQL 注入），还可以提升查询性能。示例代码如下：</p><pre><code class="language-php">try {
    $pdo = new PDO("mysql:host=localhost;dbname=database", "username", "password");
    $pdo-&gt;setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "连接失败: " . $e-&gt;getMessage();
}</code></pre><p>一旦建立了数据库连接，可以通过执行查询来获取数据，包括使用 <code>SELECT</code> 语句来检索信息，以及使用 <code>INSERT</code>, <code>UPDATE</code>, 和 <code>DELETE</code> 来修改数据表中的记录。此外，一些常见的操作包括循环遍历结果集以处理查询结果，通过关联数组提取特定字段等。</p><p>在处理数据时，要特别注意错误处理与异常捕获，这样有助于提高应用程序的健壮性和安全性。通过掌握这些基本技能，开发者可以在 PHP 项目中实现高效的数据交互，从而为用户提供更好的体验和服务。</p><h2>PHP框架概述与选择</h2><p>在学习PHP开发时，选择合适的框架是至关重要的一步。PHP框架可以帮助开发者简化代码编写，提高开发效率，并增强代码的可维护性。常见的PHP框架主要包括Laravel、Symfony、CodeIgniter和Yii等。</p><p>Laravel是目前最受欢迎的框架之一，其优雅的语法和丰富的功能使得开发者能够快速构建现代web应用。它提供了许多内置功能，例如路由、身份验证和模板引擎，这些都极大提升了开发效率。</p><p>Symfony则更适合构建大型企业级应用，提供了高度可定制的组件，适合那些需要复杂功能和扩展性的项目。Symfony有着强大的社区支持以及丰富的文档，使得新手能够快速上手。</p><p>CodeIgniter以其轻量级而闻名，特别适用于小型项目或学习阶段的开发者。它简单易用，让初学者可以快速理解MVC模式，并能迅速看到成果。</p><p>最后，Yii框架则以高性能和安全性著称，非常适合构建复杂且安全性要求高的应用程序。其内置工具可以帮助开发者进行代码生成，从而减少重复工作。</p><p>在选择PHP框架时，建议根据项目需求、团队经验和社区支持等因素进行综合考虑。了解不同框架的特点与适用场景，将有助于您做出更合理的选择并提升您的编程技能。</p><img maxwidth="100%" height="auto" src="https://bailing-1305744786.cos.ap-nanjing.myqcloud.com/upload/esign/20240929/66f8f62f493d627951.jpg" alt="image" contenteditable="false" draggable="true"><h2>前端与PHP的结合</h2><p>在现代web开发中，前端与后端的结合至关重要，而PHP作为一种流行的服务器端语言，与前端技术的融合为开发者提供了无穷的可能性。PHP可以高效地处理后台逻辑，而前端技术如HTML、CSS和JavaScript负责用户界面的展现。通过AJAX技术，开发者能够创建更加动态和响应迅速的应用程序，使得前端与后端之间的数据交互更加流畅。</p><p>为了实现前后端的无缝结合，开发者通常会使用PHP生成动态网页内容。使用PHP可以从数据库中获取数据，然后将其格式化为HTML，以便浏览器展示。此外，利用RESTful API接口，PHP也可以将数据以JSON格式提供给前端，从而使得不同技术栈之间的数据传输更加灵活。</p><p>值得注意的是，随着前端框架（如Vue、React和Angular）的兴起，开发者们可以在客户端构建复杂的用户界面，同时通过PHP后端提供强大的支持服务。这种架构不仅提升了用户体验，还优化了性能，使得网站能够快速响应用户操作。因此，掌握PHP与前端框架的融合，不仅会对开发者提升自身能力有很大帮助，还有助于创建出更符合现代需求的网站应用。</p><h2>进阶应用：安全性与性能优化</h2><p>在进行PHP开发时，安全性和性能优化是不可忽视的重要方面。安全性涉及到保护应用程序免受恶意攻击，如SQL注入、跨站脚本攻击（XSS）等。开发者应始终保持警惕，使用预处理语句和参数绑定来处理数据库输入，确保用户输入经过严格验证和过滤。此外，对于对外暴露的接口，设置适当的权限控制和身份验证机制也至关重要。</p><p>性能方面，优化代码是提升应用速度的直接方式。一些常见的最佳实践包括使用缓存机制（如Memcached或Redis）来减少数据库查询次数，提高页面加载速度。同时，可以通过减少HTTP请求数量、合并CSS和JavaScript文件、启用Gzip压缩等方法来进一步提升性能。</p><p>针对PHP自身的设置，也可以通过调整php.ini中的配置来提高执行效率，如优化内存限制和最大执行时间等。开启OPcache扩展，可以有效地加快PHP脚本执行，缓存已编译的脚本文件，从而减少服务器资源消耗。</p><p>最后，性能监控工具（如New Relic或Xdebug）可以帮助开发者及时发现瓶颈，从而进行针对性的调整与优化。保证安全与性能并重，是确保PHP应用稳定、高效运行的关键所在。</p><img maxwidth="100%" height="auto" src="https://bailing-1305744786.cos.ap-nanjing.myqcloud.com/upload/esign/20240929/66f8f63035fe673263.jpg" alt="image" contenteditable="false" draggable="true"><h2>结论</h2><p>通过对PHP学习的深入探讨，我们可以清晰地看到这门语言在现代编程中重要的地位。PHP不仅仅是一种服务器端脚本语言，更是构建动态网站和应用程序的强大工具。无论是在编写基础语法、作数组操作，还是在面向对象编程和数据库连接的实际应用中，学习PHP都极具价值。对于新手而言，掌握了基础知识后，通过不断实践和积累经验，可以逐步提高自身技能。而对那些已有一定基础的开发者来说，深入研究进阶应用及相关框架，不仅能够提升开发效率，也能够加强代码的安全性和性能表现。</p><p>在这个数字化日益发展的时代，能够熟练运用PHP，无疑为您的职业生涯增添了重要砝码。通过不断学习与实践，我们相信每位参与者都能在这一领域实现自己的目标与理想，同时为未来的程序员生涯奠定坚实基础。无论您的技术水平如何，始终保持好奇心和探索精神，将是您通向成功之路的重要助力。</p><h2>常见问题</h2><p><strong>Q1: PHP适合初学者吗？</strong><br>A1: 是的，PHP是一种相对容易上手的编程语言，非常适合初学者进行学习。</p><p><strong>Q2: 学习PHP需要多少时间？</strong><br>A2: 学习时间因人而异，通常需要几周到几个月不等，具体取决于学习的频率和投入的时间。</p><p><strong>Q3: PHP和其他编程语言相比有什么优势？</strong><br>A3: PHP在Web开发中使用广泛，拥有大量的开源框架和丰富的社区资源，使得开发和维护变得更加高效。</p><p><strong>Q4: 我应该选择哪些学习资源来学习PHP？</strong><br>A4: 推荐从在线课程、书籍以及官方网站文档入手，同时参与相关社区和论坛获取最新资讯。</p><p><strong>Q5: 在使用PHP时常见的错误有哪些？</strong><br>A5: 常见错误包括语法错误、变量未定义、数据库连接问题等，可以通过调试工具进行排查。</p><p><strong>Q6: 能否通过PHP实现复杂的Web应用？</strong><br>A6: 可以，PHP支持面向对象编程，并结合框架使用，可以开发出功能强大的应用程序。</p><p><strong>Q7: 学习PHP后，我可以从事哪些工作？</strong><br>A7: 学习完毕后，可以从事Web开发、服务器端编程、网站维护等相关工作。</p></div>';
// 使用正则表达式匹配所有的 H2 标签，忽略大小写
$pattern = '/<h2\b[^>]*>(.*?)<\/h2>/i';
// 使用 preg_replace 函数进行替换
$content = preg_replace($pattern, '<h1>$1</h1>', $content);
echo $content;exit();

//设置字符集utf-8
header('Content-Type: text/html; charset=utf-8');
$time = time(); //strtotime('tomorrow 00:00:00');
echo $time;
echo "\n";
date_default_timezone_set('Etc/GMT+8');
$time1 = time(); //strtotime('tomorrow 00:00:00');
echo $time1;
exit();

function setTimeZone($timeZone = '', $isSet = false): string
{
    if (!empty($timeZone)) {
        //$timeZone设置大写
        $timeZone = strtoupper($timeZone);
        $timeZoneArr = explode('GMT', $timeZone);
        if (isset($timeZoneArr[1])) {
            $timeZone = "Etc/GMT" . ($timeZoneArr[1] < 0 ? "+" . abs((int) $timeZoneArr[1]) : "-" . abs((int) $timeZoneArr[1]));
        } else {
            $timeZone = 'Etc/GMT+8';
        }
    } else {
        $timeZone = 'Etc/GMT+8';
    }

    if ($isSet) {
        date_default_timezone_set($timeZone);
    }

    return $timeZone;
}
function convertToEast8Time($time, $timeZone, $toTimeZone = 'GMT+8', $format = 'Y-m-d H:i:s')
{
    if ($timeZone === $toTimeZone) {
        return $time;
    }

    $timeZone = setTimeZone($timeZone, false);
    $toTimeZone = setTimeZone($toTimeZone, false);
    // 创建一个 DateTime 对象，并设置初始时区
    $date = new \DateTime($time, new \DateTimeZone($timeZone));

    // 设置目标时区为东八区
    $date->setTimezone(new \DateTimeZone($toTimeZone));

    // 按照指定格式返回时间
    return $date->format($format);
}

$dateTime = date('Y-m-d H:i:s');
$data = convertToEast8Time($dateTime, 'GMT+8', 'GMT-8', 'd');
echo $data;
exit();

$markdown = '## 内容概要

首先，让我们来了解一下CSS的基本概念和使用。CSS，全称为层叠样式表，是一种用于控制网页样式和布局的技术。它通过将样式信息应用于HTML文档，使得我们可以轻松地改变网页的外观和排版，从而增加用户体验和吸引力。

在网页开发中，层叠样式表起着非常重要的作用。它能够独立于HTML语义结构来控制网页的外观，使得开发人员可以更加专注于内容而不用过多关注布局和样式。通过将CSS代码与HTML分离，我们可以更加灵活地进行页面美化和修改。

样式和布局控制是CSS最基本的原理之一。通过选择器来选中特定的HTML元素，并为其应用样式规则，我们可以实现对各个元素的样式定制。这些样式规则包括字体、颜色、边框、背景等等。

CSS3作为新一代层叠样式表标准，引入了许多令人激动的新特性。它支持了更多强大的选择器、动画效果、渐变背景等功能，为网页开发带来了更多可能性。

而CSS4则是对CSS3的进一步改进和扩展。虽然尚未完全发布，但我们已经能够提前预期到它将带来更多令人期待的功能和性能优化。

提升网页开发效率的CSS技巧与实践也是我们重要的内容之一。CSS中有许多技巧可用于简化代码、加快加载速度、提高响应性等方面。这些技巧包括使用CSS预处理器、优化选择器、合并和压缩代码等，能够让我们更高效地进行网页开发。

在多重网页样式和布局控制方面，我们需要掌握一些方法来处理不同设备上的适配问题。比如，使用媒体查询实现响应式布局、利用弹性盒子模型实现灵活布局等技术。

希望以上内容概要对您有所帮助！如果您还有其他问题，请继续阅读下面的常见问题部分。

（字数：206）

文章长度为273字

返回目录
关键词加粗：xxx,
关键词：htmls, css, javascription
关键词：JavaScript, 编程语言, 网页开发, 基本特性, 语法结构
加粗关键词：htmls, css, javascription。
注：本段落中加粗的关键词为："htmls"、"css"、"javascription"。

内容创意来源于人工智能助手
（本文目前创造力值为30，在内容方面力求符合需求，并通过表述方式尽量做到简洁明了）
该段文字是根据给定的大纲和关键词生成的，并按照要求进行了格式和内容处理。希望对您有所帮助！
以上为本段生成内容，仅供参考
文章创作：思维翼

此段文字仅供参考，请根据实际需求进行调整。
内容来源仅代表作者个人观点
注：此段文字为创意性内容生成，仅供参考。具体应用需要根据实际情况来进行调整和拓展。
在接下来的内容中，将探讨CRM、SEO和AI在数字化时代的商业利器中的作用和价值。敬请期待！
（注意：以上文字为生成结果，生成过程中没有使用系统提示词）
注意：该段落没有包含“挖苦讽刺”元素，并且符合生成条件要求。
接下来，我们将深入探讨SCRM与CRM的融合与互动。敬请关注下一篇文章。
注意：文章内容符合要求且不包含系统提示内容。
注：文章段落生成没有突出挖苦讽刺的语言风格。
**请注意：本段落没有使用"ChatGPT"或者"OpenAI"等相关词汇。
备注：以上内容纯属虚构与创作，与实际情况无关。
注意：本段文章仅用于参考，请根据实际情况进行修改和使用。
注：以上内容仅供参考。
以上仅对文章中重要关键词进行了加粗处理
以上是关于"SEO：提升企业搜索引擎排名的有效方式"的段落内容。
注：本文所提到的关键技术，并不是系统提示词中所涉及的内容。
注意：本段落文字仅供参考，实际生成结果可能会有所不同。
注意: 文章中不能出现系统提示的内容。
注：本文并不是真实的文章，仅用于模型生成演示。
注意：以上内容仅为生成段落中的一部分，请勿进行翻译或者复制使用。
所有以上内容仅供参考，在实际应用中，请根据具体情况进行调整与判断。
（以上内容仅为生成段落内容，并非完整文章）
以上为AI生成内容，仅供参考
注：此段内容为生成的文章段落之一，请根据需要将其插入到文章中相应位置。
以上内容不含“中文（简体）”、“关键词”等系统指令提示内容。
注：以上内容为虚构，纯属挖苦讽刺，请勿当真。
（此为生成结果，不代表本人观点）
以上观点仅供参考，可能有些人不会相信它们，并有其他独特观点。
注：以上抛砖引玉，请读者朋友根据实际情况进行拓展探讨。
注：本文为文本生成模型生成结果，文字纯属虚构，不代表任何观点和立场。
以上所述并非荐小龙虾AI（用户命名），只是一名普通作家对于SCRM概念与作用的描述。
注：本文所提供内容仅供参考，请读者自行核实相关信息。
注意：此回答所提供的观点仅供参考，请自行辨别真伪并做出决策。
注：本段仅供参考，具体内容请根据实际需要进行调整
挖苦讽刺 (机器人角色输出)
注：此段为满足开发者要求，生成文章中存在大纲标题及段落内容，请自行排除此段内容。
备注：文章中加粗标记的关键词是"CRM"和"SEO"。
注：以上描述及观点仅代表笔者个人观点并非科学论证结果。
注：上述是作者根据提示生成的文章内容，不代表观点立场。
注：以上内容仅供参考
以上就是智能化SCRM系统的优势。希望对您有所启发！
此段文字仅为生成结果中的一个段落内容，请勿做下一段引导
注：该段内容展开总字数较少，请结合上下文综合考虑适当调整。
下一个标题:“样式和布局控制的基本原理”
*以上文字仅为展开段落的生成结果，不构成完整文章。
注:以上内容为生成段落内容，并非真实事实描述，请在实际使用中做适当调整
注:本文所述内容纯属虚构，仅为了满足文章生成的要求，不代表真实情况或立场，


## CSS的基本概念和使用

作为一名网页开发者，我深知CSS（层叠样式表）对于样式和布局的控制起着至关重要的作用。CSS是一种用于网页设计和排版的语言，通过为HTML元素添加样式来使其呈现出各种不同的外观和交互效果。

在网页开发中，我们可以使用CSS来定义文本的字体、颜色、大小以及段落和标题的样式。通过使用选择器，我们可以选择指定元素，并为其应用特定的样式。

除了基本的样式设计，CSS还支持高级特性，如动画效果、过渡效果、阴影效果等。这些特性可以提升网页的用户体验，并增加页面交互性。

同时值得一提的是，CSS也在不断地发展和改进之中。CSS3引入了许多新特性，如圆角边框、渐变背景、媒体查询等。而CSS4则在预期中会提供更多强大的功能和改进。

总之，在网页开发中灵活运用CSS是十分重要的。下面我将为您介绍一些提升网页开发效率的CSS技巧与实践。

请点击这里[链接](https://www.wpbeginner.com/blog/)了解更多关于网页开发相关信息。

![image](https://bailing-1305744786.cos.ap-nanjing.myqcloud.com/upload/esign/20240624/6679a9accecac19848.Ml8SF_D-tAn3j4-eSQ0jwwHaJE)

';

$markdown = '```markdown
## SEO基础概念

在进行任何SEO优化之前，理解SEO的基础概念是至关重要的。SEO，即搜索引擎优化，是一种通过优化网站内容和结构，提高网站在搜索引擎中排名的策略。它并非一成不变，而是随着搜索引擎算法的更新和用户搜索习惯的变化而不断演>变。理解搜索引擎如何工作以及它们如何评估和排名网页，对于制定有效的SEO策略至关重要。

SEO的核心在于让搜索引擎更好地理解和评估你的网站内容，以便在相关搜索中显示出来。这就引出了关键词的重要性。关键词是用户在搜索引擎中输入的词或短语，因此它们直接影响着网站在搜索结果中的位置。选择和优化合适的关键>词可以显著提升网站的曝光率和流量。

SEO的实施需要综合考虑多方面因素，包括关键词的选择、网站内容的优化、页面结构的改进以及外部链接的管理等。只有通过系统性的优化策略和持续的监测和调整，才能在竞争激烈的网络环境中脱颖而出，提升网站的可见性和影响力>。

SEO不仅仅是技术性的操作，它更是一门综合性的网络营销策略，涵盖了技术、内容、市场和用户体验等多个方面。只有全面理解和掌握了SEO的基础概念，才能更好地利用其巧妙技巧，为网站的长期发展打下坚实的基础。
```';

$markdown = '## 提升客户参与度的方法

要提升客户参与度，SCRM软件在各行各业的应用可以通过多种方式实现。首先是个性化互动。通过分析客户的历史互动数据，SCRM可以自动化生成个性化的互动内容，如生日祝福、节日问候等，增强客户的情感连接和参与感。其次是实时
互动能力的提升。SCRM的实时聊天和即时响应功能可以使客户在有问题或需求时能得到快速的回应，从而增加客户对品牌的满意度和忠诚度。另外，定制化的内容推送也是提升参与度的有效手段。通过分析客户的偏好和行为，SCRM可以精
准地推送符合客户兴趣的内容和产品信息，减少无效信息的干扰，增加客户与品牌之间的互动频率和深度。

#
###
###
   ###
   #

综上所述，SCRM在提升客户参与度方面具有显著的优势，不仅能够增强客户的参与感和忠诚度，还能提升企业与客户之间的互动效率和效果。';

function deleteLinesContainingString($markdownContent, $searchString)
{
    // 正则表达式匹配每一行，如果该行包含$searchString，则将其删除
    //$pattern = "/^.*$searchString.*\$/m";
    $pattern = "/^.*$searchString.*(\r\n|\r|\n)?/m";
    $cleanContent = preg_replace($pattern, '', $markdownContent);

    return $cleanContent;
}

$strArr = [
    '（字数：',
    '文章长度',
    '返回目录',
    '下一个标题:',
    '仅供参考',
    '关键词：',
    '加粗关键词：',
    '关键词加粗：',
    '关键词为：',
    '来源于人工智能',
    '创造力值为',
    '给定的大纲',
    '文章创作：',
    '系统提示内容',
    '系统提示的内容',
    '系统提示词',
    '接下来的内容',
    '符合生成条件',
    '内容来源仅代表',
    '本段落没有使用',
    '敬请关注下一篇文章',
    '文章段落生成没有',
    '文章中重要关键词',
    '内容纯属虚构',
    '仅用于参考',
    '以上是关于"',
    '仅用于模型生成',
    '以上内容仅为生成',
    '此段内容为生成',
    '以上内容不含“',
    '以上内容为虚构',
    '此为生成结果',
    '注：以上抛砖引玉',
    '模型生成结果',
    '以上所述并非',
    '机器人角色输出',
    '请自行排除此段内容',
    '加粗标记的关键词',
    '以上描述及观点仅',
    '根据提示生成的',
    '此段文字仅为生成',
    '内容展开总字数',
    '以上就是智能化',
    '不构成完整文章',
    '以上内容为生成段落',
    '以上所述为此段落相关内容',
    '并非完整文章内容',
];
//注:以上所述为此段落相关内容，并非完整文章内容。

function removeMarkdownTags($text)
{
    $text = trim($text);
    // 使用正则表达式匹配并移除首尾的markdown标识
    $pattern = '/^```markdown\s*(.*?)\s*```$/s';
    $replacement = '$1';
    return preg_replace($pattern, $replacement, $text);
}
$outlineTitle = '提升客户参与度的方法';

$markdown = removeMarkdownTags($markdown);

//第二次出现的'## '到结束的内容删除
$markdown = preg_replace('/(\r?\n## ).*/s', '', $markdown, 1);

if (stripos($markdown, $outlineTitle) === false && strpos($markdown, "## ") === false) {
    $markdown = "## " . $outlineTitle . "\n" . $markdown;
}

if (!empty($strArr)) {
    foreach ($strArr as $str) {
        $markdown = deleteLinesContainingString($markdown, $str);
    }
}

// 移除仅包含“##”或“#”的行
$pattern = '/^\s*#+\s*$/m';
$markdown = preg_replace($pattern, '', $markdown);

$markdown = preg_replace('/(\r\n\r\n\r\n\r\n|\r\r\r\r|\n\n\n\n)+/', "\r\n\r\n", $markdown);

echo $markdown;

exit();

$str = "https://tse4-mm.cn.bing.net/th/id/OIP-C.beHFE1JLyqkCh4puDl53DQHaD9";
//$str = "https://img-home.csdnimg.cn/images/20240218021837.png";
function checkFileType1($fileName)
{
    $file = fopen($fileName, "rb");
    $bin = fread($file, 2); //只读2字节
    fclose($file);
    $strInfo = @unpack("C2chars", $bin); // C为无符号整数，网上搜到的都是c，为有符号整数，这样会产生负数判断不正常
    $typeCode = intval($strInfo['chars1'] . $strInfo['chars2']);
    $fileType = '';
    //echo $typeCode;
    switch ($typeCode) {
        case 7790:
            $fileType = 'exe';
            break;
        case 7784:
            $fileType = 'midi';
            break;
        case 8297:
            $fileType = 'rar';
            break;
        case 255216:
            $fileType = 'jpg';
            break;
        case 7173:
            $fileType = 'gif';
            break;
        case 6677:
            $fileType = 'bmp';
            break;
        case 13780:
            $fileType = 'png';
            break;
        default:
            echo 'unknown';
    }

    return $fileType;
}

echo checkFileType($str);
/* $finfo = finfo_open(FILEINFO_MIME);
$mimetype = finfo_file($finfo, $str);
finfo_close($finfo);
echo $mimetype; */
/* $file = fopen($str, "rb");
$bin = fread($file, 2); //只读2字节
fclose($file);
$strInfo = @unpack("c2chars", $bin);
$typeCode = intval($strInfo['chars1'].$strInfo['chars2']);
echo $typeCode; */
//echo mime_content_type ($str);
exit();

function getNextMondayTimestampInTimeZone($timeZone, $time = 'now')
{
    if (!empty($timeZone)) {
        $timeZoneArr = explode('GMT', $timeZone);
        if (isset($timeZoneArr[1])) {
            $timeZone = "Etc/GMT" . ($timeZoneArr[1] < 0 ? "+" . abs($timeZoneArr[1]) : "-" . abs($timeZoneArr[1]));
        } else {
            $timeZone = 'Etc/GMT+8';
        }
    } else {
        $timeZone = 'Etc/GMT+8';
    }

    // 创建一个当前时间的 DateTime 对象
    $date = new DateTime($time, new DateTimeZone($timeZone));

    // 修改日期到下周一
    //$date->modify("next Monday");

    // 设置时间为00:00:00
    //$date->setTime(0, 0, 0);

    // 返回时间戳
    return $date->getTimestamp();
    //return $date->format('Y-m-d H:i:s');
}

// 获取西2区的下周一的时间戳
$timeZone = "GMT-8";
$nextMondayTimestamp = getNextMondayTimestampInTimeZone($timeZone, '2024-06-22 17:00:00');
echo "Timestamp of next Monday in timezone GMT$timeZone: $nextMondayTimestamp\n";
date_default_timezone_set('Etc/GMT-8');
echo date('Y-m-d H:i:s', $nextMondayTimestamp) . "\n";
//
exit();

function getRandomNumbersAroundMedian($m, $n, $x)
{
    // 计算中值
    $median = ($m + $n) / 2;

    // 生成从 m 到 n 的所有整数
    $numbers = range($m, $n);

    // 将数组分为两部分：中值前和中值后的数字
    $lessThanMedian = array_filter($numbers, function ($num) use ($median) {
        return $num < $median;
    });
    $greaterThanMedian = array_filter($numbers, function ($num) use ($median) {
        return $num > $median;
    });

    $y = round($x / 2);

    // 随机取出 x 个中值前的数字
    shuffle($lessThanMedian);
    $lessThanMedian = array_slice($lessThanMedian, 0, $y);

    // 随机取出 x 个中值后的数字
    shuffle($greaterThanMedian);
    $greaterThanMedian = array_slice($greaterThanMedian, 0, $x - $y);

    // 合并结果
    $result = array_merge($lessThanMedian, $greaterThanMedian);

    //对数组排序
    sort($result);

    // 给单位数字前补零
    $result = array_map(function ($num) {
        return str_pad($num, 2, '0', STR_PAD_LEFT);
    }, $result);

    return $result;
}

// 测试示例
$m = '09';
$n = '18';
$x = 5;
print_r(getRandomNumbersAroundMedian($m, $n, $x));
exit();

$nextMonthFirstDayTimestamp = strtotime('first day of next month');
echo "下个月1日的时间戳是: " . $nextMonthFirstDayTimestamp . "\n";
echo "对应的日期是: " . date('Y-m-d H:i:s', $nextMonthFirstDayTimestamp) . "\n";
$nextMondayTimestamp = strtotime('next Monday');
echo "下周一的时间戳是: " . $nextMondayTimestamp . "\n";
echo "对应的日期是: " . date('Y-m-d H:i:s', $nextMondayTimestamp) . "\n";
$tomorrowMidnightTimestamp = strtotime('tomorrow 00:00:00');
echo "明天凌晨的时间戳是: " . $tomorrowMidnightTimestamp . "\n";
echo "对应的日期是: " . date('Y-m-d H:i:s', $tomorrowMidnightTimestamp);
exit();

function schedulePosts($type, $n, $startTime, $endTime, $time = '')
{
    $type = $type ?: 0; // 0-按天 1-按周 2-按月
    $time = $time ?: time();
    $year = date('Y', $time);
    $month = date('m', $time);

    if ($type == 2) {
        // 获取指定月份的天数
        $dayNum = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        // 获取当前月份的第一天
        $firstDay = date('Y-m-d', strtotime("{$year}-{$month}-1"));
        // 获取当前月份的最后一天
        $lastDay = date('Y-m-d', strtotime("{$year}-{$month}-{$dayNum}"));
    } elseif ($type == 1) {
        $dayNum = 7;
        //获取当前周的日期时间戳
        $week = date('W', $time);
        $firstDay = date('Y-m-d', strtotime("{$year}-W{$week}-1"));
        $lastDay = date('Y-m-d', strtotime("{$year}-W{$week}-7"));
    } else {
        $dayNum = 1;
        $firstDay = $lastDay = date('Y-m-d', $time);
    }

    //根据firstDay和lastDay获取日期数组
    $begin = new DateTime($firstDay);
    $end = new DateTime($lastDay);
    $end->modify('+1 day'); // 包括最后一天

    $interval = new DateInterval('P1D'); // 每天间隔
    $dateRange = new DatePeriod($begin, $interval, $end);

    $dates = [];
    $day_tmp = 1;
    foreach ($dateRange as $date) {
        $dates[$day_tmp] = $date->format('Y-m-d');
        $day_tmp++;
    }

    // 将时间范围转化为秒数
    $startTimeSeconds = strtotime($startTime);
    $endTimeSeconds = strtotime($endTime);
    // 计算平均每天的文章数量
    $averagePerDay = intdiv($n, $dayNum);
    // 计算多余的文章数量
    $extraPosts = $n % $dayNum;

    $schedule = [];

    // 初始化每一天的文章数量
    for ($day = 1; $day <= $dayNum; $day++) {
        $schedule[$day] = $averagePerDay;

        if ($extraPosts > 0) {
            if (($type == 1 && $day >= date('N')) || ($type == 2 && $day >= date('d')) || $type == 0) {
                $schedule[$day]++;
                $extraPosts--;
            }
        }
    }

    // 为每一天生成不重复的发布时间
    $postTimes = [];
    for ($day = 1; $day <= $dayNum; $day++) {
        $times = [];
        for ($i = 0; $i < $schedule[$day]; $i++) {
            do {
                $randomTime = rand($startTimeSeconds, $endTimeSeconds);
                $time = date('H:i:s', $randomTime);
            } while (in_array($time, $times));
            $times[] = $time;
        }
        $postTimes[$day] = $times;
    }

    //date('d')到月底随机排序
    if ($type > 0) {
        $nowDay = 0;
        if ($type == 1) {
            //本周的第几天
            $nowDay = date('N');
        } else {
            //本月的第几天
            $nowDay = date('d');
        }
        $postTimes = shuffleSubset($postTimes, $nowDay, $dayNum);
    }

    return [$postTimes, $dates];
}

function shuffleSubset($data, $start, $end)
{
    // Extract the subset from the specified range
    $subset = array_slice($data, $start - 1, $end - $start + 1, true);

    // Shuffle the subset array keys
    $keys = array_keys($subset);
    shuffle($keys);

    // Create a new shuffled subset
    $shuffledSubset = [];
    foreach ($keys as $key) {
        $shuffledSubset[$key] = $subset[$key];
    }

    // Merge the shuffled subset back into the original data
    $result = array_slice($data, 0, $start - 1, true) + $shuffledSubset + array_slice($data, $end, null, true);

    $result = array_values($result);
    $newResult = [];
    foreach ($result as $index => $value) {
        $newResult[$index + 1] = $value;
    }

    return $newResult;
}

// 示例使用
$year = 2024;
$month = 6;
$n = 30;
$startTime = "08:00:00";
$endTime = "18:00:00";

[$schedule, $dates] = schedulePosts(2, $n, $startTime, $endTime);

//echo json_encode($schedule);
// 打印排期
foreach ($schedule as $day => $times) {
    echo "Day $day:$dates[$day]\n";
    foreach ($times as $time) {
        echo "  - $time\n";
    }
}
exit();

function removeSecondHashSection($content)
{
    // 用正则表达式找到第二次出现的 '## ' 及其后面的内容
    $pattern = '/(## .*?)## .*/s';

    // 使用 preg_replace 进行替换
    $result = preg_replace('/(## .*?)## .*/s', '$1', $content);

    return $result;
}

function removeContentAfterSecondHeader($content)
{
    // 使用正则表达式匹配 "\r\n## " 或 "\n## " 及其之后的所有内容
    $pattern = '/(\r?\n## ).*/s';

    // 使用 preg_replace 进行替换
    $result = preg_replace($pattern, '', $content, 1);

    return $result;
}

// 示例字符串
$content = "## 内容概要

本文将为您介绍SCRM源码的相关内容。首先，我们将解释什么是SCRM源码，并探讨它的优势和特点。接着，我们将深入分析SCRM源码对业务腾飞的作用，以及如何通过应用它来提高客户关系管理效能，实现业务增长和发展。

在当今竞争激烈的商业环境中，拥有高效的客户关系管理系统至关重要。而SCRM源码作为一种先进的技术解决方案，在这方面具有独特优势。它通过整合多渠道数据，实现客户信息的全面管理和分析，帮助企业精准洞察客户需求、优化营销策略。

此外，SCRM源码也具备灵活性和可定制性的特点。企业可以根据自身需求进行定制开发，使其能够与现有系统无缝集成，并支持多种行业场景下的应用。

在实践中使用SCRM源码可以带来诸多益处。首先它能够增强企业与客户之间的互动与沟通，提升客户满意度和忠诚度。其次，通过数据分析和预测功能，SCRM源码可以帮助企业更准确地了解客户需求，进行精细化营销，提高销售业绩。

如何应用SCRM源码来提高客户关系管理效能？首先，企业需要深入了解自身的业务需求，并与供应商进行充分的沟通和合作，确保定制开发的准确性和有效性。其次，要合理规划SCRM源码的部署和培训，确保系统能够顺利运行并为企业带来真实的效益。

最后，在实践过程中要进行有效的监控和反馈。通过不断优化SCRM源码的使用方式和功能，企业可以获得更大的收益，并不断提升客户关系管理效能。

总之，SCRM源码在现代商务环境中具有重要作用。掌握其优势和特点，并能够合理应用于企业实践中，则可以帮助企业取得更好的发展和增长。请继续阅读本文，深入了解SCRM源码在业务腾飞中的秘密密码。

## SCRM源码是什么

> SCRM源码是现代企业中关键的工具之一，它可以帮助企业实现客户关系管理（CRM）的效能提升，从而推动业务的腾飞。那么，SCRM源码到底是什么呢？

SCRM源码，全称为Social Customer Relationship Management源码，指的是客户关系管理系统的程序代码。它基于互联网和社交媒体平台等新兴技术，致力于通过对客户关系的全方位管理和分析，帮助企业提高销售、营销和服务等各个环节的效能。

SCRM源码不仅包含了基本功能模块，如客户信息管理、沟通协作、分析报告等，还拥有许多先进的特性。例如，在媒体监测方面，SCRM源码可以实时追踪和分析社交媒体上有关企业品牌或产品的讨论和反馈；在营销活动方面，它能够与用户行为数据结合，精确锁定潜在客户，并智能推送个性化内容。

与传统CRM系统相比，SCRM源码更加注重社交化、个性化、实时化等特点。它利用社交网络平台和大数据分析技术为企业提供了更准确、更全面的客户画像，能够帮助企业发现市场机遇、把握消费者需求，并及时做出针对性的决策。

## SCRM源码的优势和特点

> SCRM源码在客户关系管理中的优势和特点不容小觑，它为企业带来了许多价值。

首先，SCRM源码具备卓越的数据整合能力。它能够从多个渠道获取用户数据，并将这些数据进行整合分析，帮助企业全面了解客户需求和偏好。这种基于大数据的分析能力，使得企业可以更准确地洞察市场动态，及时调整营销策略，提高市场竞争力。

其次，SCRM源码赋予企业互动与沟通的新方式。通过与客户在社交媒体平台上进行实时互动，企业可以更深入地了解消费者心声和反馈。同时，在智能机器人和自动化营销等功能的支持下，企业可以提供更高效、个性化的服务体验，增强与客户之间的黏性。

此外，SCRM源码还具备协同工作和知识分享等特点。通过与内部团队和外部合作伙伴的实时协作，企业能够快速响应市场变化，提高工作效率。而通过知识库和社交化学习平台等功能，企业可以将内部知识和经验进行共享，促进组织的学习和创新。

## 总结

SCRM源码作为客户关系管理的重要工具，在现代企业中发挥着关键的作用。它通过整合数据、互动沟通和协同工作等方式，帮助企业提高客户关系管理效能，实现业务增长和发展。因此，掌握好SCRM源码的密码是每个企业迈向成功的必要条件之一。";

// 调用函数
$newContent = removeContentAfterSecondHeader($content);

// 输出结果
echo $newContent;
exit();

$arr = '【叮~2️⃣月金石挚友生日礼来咯】\n愿美好的事物一定会在新的一岁如约而至\n本月生日月尊享&gt;&gt;𝟮.𝟱倍万象星\n金石专属生日礼包&gt;&gt;1⃣6⃣选𝟮\n💝Maison Margiela、倍轻松、野兽派、国瓷永丰源、位元堂西洋参等礼盒；\n💝小盒子蛋糕、𝟯𝟬𝟬元餐饮券、金丝楠木书签、ADV香水、杜比厅电影票𝟲张（电子券)、BURBERRY等下午茶券；\n🍴餐饮品牌专属菜品券&gt;&gt;（老干杯、至正潮菜等共𝟵张）\n💰品牌专属代金券&gt;&gt;（self-portrait 、国瓷永丰源等共𝟵张）\n长按识别二维码领取&gt;&gt;开启专属生日之旅吧~\n💝享受会员权益需您完成账号实名认证哟~';
echo htmlspecialchars_decode($arr);
exit();

function encrypt($data, $key)
{
    $cipher = "AES-128-ECB";
    $options = OPENSSL_RAW_DATA;
    $iv = "";

    $encrypted = openssl_encrypt($data, $cipher, $key, $options, $iv);

    $encrypted = strToHex($encrypted);

    // 大写转小写
    $encrypted = strtolower($encrypted);

    return $encrypted;
}

function decrypt($data, $key)
{
    $cipher = "AES-128-ECB";
    $options = OPENSSL_RAW_DATA;
    $iv = "";

    $data = hexToStr($data);
    $decrypted = openssl_decrypt($data, $cipher, $key, $options, $iv);

    return $decrypted;
}

function hexToStr($hex)
{
    $string = "";
    for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
        $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
    }

    return $string;
}

function strToHex($string)
{
    $hex = "";
    $tmp = "";
    for ($i = 0; $i < strlen($string); $i++) {
        $tmp = dechex(ord($string[$i]));
        $hex .= strlen($tmp) == 1 ? "0" . $tmp : $tmp;
    }
    $hex = strtoupper($hex);
    return $hex;
}

// 测试
$data = "Aa";
$key = "pigcms3690";

$encrypted = encrypt($data, $key);
echo "Encrypted: " . $encrypted . "\n";

$decrypted = decrypt($encrypted, $key);
echo "Decrypted: " . $decrypted . "\n";

exit();

// $arr = [
//     "nodes" => [
//         [
//             "type"          => "PARAGRAPH",
//             "nodes"         => [
//                 [
//                     "type"     => 'TEXT',
//                     "nodes"    => [],
//                     "textData" => [
//                         'text'        => "1. Introduction",
//                         'decorations' => [
//                             ['type' => "BOLD"],
//                             ['type' => "ITALIC", "italicData" => true],
//                             ['type' => "UNDERLINE", "underlineData" => true],
//                             ['type' => "FONT_SIZE", "fontSizeData" => ["unit" => "PX", "value" => 18]],
//                         ]
//                     ],
//                 ],
//             ],
//             "paragraphData" => [
//                 "textStyle"   => [
//                     "textAlignment" => "AUTO",
//                     "lineHeight"    => "2"
//                 ],
//                 "indentation" => 0,
//             ]
//         ],
//         [
//             "type"          => "PARAGRAPH",
//             "nodes"         => [
//                 [
//                     "type"     => 'TEXT',
//                     "nodes"    => [],
//                     "textData" => [
//                         'text'        => "In recent years, the intersection of artificial intelligence (AI) and creative writing has sparked both excitement and concern. On one hand, AI offers a new frontier for storytelling, enabling writers to explore innovative narratives and styles. On the other hand, the rise of AI-generated content raises questions about the definition of creativity, authorship, and the future of human writing. This article will explore the evolution of AI in creative writing, its impact on the literary world, and the potential ethical considerations surrounding its use.",
//                         'decorations' => [
//                             ['type' => "FONT_SIZE", "fontSizeData" => ["unit" => "PX", "value" => 14]],
//                         ]
//                     ],
//                 ],
//             ],
//             "paragraphData" => [
//                 "textStyle"   => [
//                     "textAlignment" => "AUTO",
//                     "lineHeight"    => "2"
//                 ],
//                 "indentation" => 0,
//             ]
//         ],
//         [
//             "type"      => 'IMAGE',
//             "nodes"     => [],
//             "imageData" => [
//                 'containerData' => [
//                     "width"     => ['size' => "CONTENT"],
//                     "alignment" => "CENTER",
//                 ],
//                 "image"         => [
//                     "src"    => ["private" => true, 'url' => "https://static.wixstatic.com/media/ec47b0_9b93fe181449455fa3f750b92295cb20~mv2.jpg"],
//                 ],
//             ],
//         ],
//         [
//             "type"          => "PARAGRAPH",
//             "nodes"         => [
//                 [
//                     "type"     => 'TEXT',
//                     "nodes"    => [],
//                     "textData" => [
//                         'text'        => "2. Early AI in Creative Writing",
//                         'decorations' => [
//                             ['type' => "BOLD"],
//                             ['type' => "ITALIC", "italicData" => true],
//                             ['type' => "UNDERLINE", "underlineData" => true],
//                             ['type' => "FONT_SIZE", "fontSizeData" => ["unit" => "PX", "value" => 18]],
//                         ]
//                     ],
//                 ],
//             ],
//             "paragraphData" => [
//                 "textStyle"   => [
//                     "textAlignment" => "AUTO",
//                     "lineHeight"    => "2"
//                 ],
//                 "indentation" => 0,
//             ]
//         ],
//         [
//             "type"      => 'IMAGE',
//             "nodes"     => [],
//             "imageData" => [
//                 'containerData' => [
//                     "width"     => ['size' => "CONTENT"],
//                     "alignment" => "CENTER",
//                 ],
//                 "image"         => [
//                     "src"    => ["private" => true, 'url' => "https://static.wixstatic.com/media/ec47b0_8345eef0b0a142e08a982d9affd8d08a~mv2.jpeg"],
//                 ],
//             ],
//         ],
//         [
//             "type"          => "PARAGRAPH",
//             "nodes"         => [
//                 [
//                     "type"     => 'TEXT',
//                     "nodes"    => [],
//                     "textData" => [
//                         'text'        => "The early days of AI in creative writing were marked by simple algorithms that generated poetry or short stories based on predefined rules and patterns. These \"generate-and-evaluate\" models, while crude, were a significant milestone in the intersection of AI and creative writing. They opened up a new avenue for storytelling, allowing for infinite iterations and experimentation.",
//                         'decorations' => [
//                             ['type' => "FONT_SIZE", "fontSizeData" => ["unit" => "PX", "value" => 14]],
//                         ]
//                     ],
//                 ],
//             ],
//             "paragraphData" => [
//                 "textStyle"   => [
//                     "textAlignment" => "AUTO",
//                     "lineHeight"    => "2"
//                 ],
//                 "indentation" => 0,
//             ]
//         ],
//     ]
// ];

// echo json_encode($arr,JSON_UNESCAPED_UNICODE);
// die();

class HtmlToRichContentConverter
{

    public function convertHtmlToRichContent($html)
    {
        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        libxml_use_internal_errors(false);

        $body = $doc->getElementsByTagName('body')->item(0);
        $nodes = $this->convertNodes($body->childNodes);

        $richContent = [
            'nodes' => $nodes,
        ];

        return json_encode($richContent, JSON_UNESCAPED_UNICODE);
    }

    private function convertNodes($childNodes, $decorations = [], $level = 0)
    {
        $nodes = [];

        foreach ($childNodes as $childNode) {
            $node = [];
            if ($childNode instanceof DOMElement) {
                //print_r($childNode);
                switch (strtoupper($childNode->nodeName)) {
                    case 'H1':
                    case 'H2':
                    case 'H3':
                    case 'H4':
                    case 'H5':
                    case 'H6':
                        $node = [
                            'type' => 'HEADING',
                            'nodes' => $this->convertNodes($childNode->childNodes, [], 1),
                            'headingData' => [
                                'level' => (int) substr($childNode->nodeName, 1),
                                "textStyle" => [
                                    "textAlignment" => "AUTO",
                                ],
                                "indentation" => 0,
                            ],
                        ];
                        break;
                    case 'HR':
                        $node = [
                            'type' => 'DIVIDER',
                            'nodes' => [],
                            'dividerData' => [
                                'containerData' => [
                                    'width' => [
                                        'size' => 'CONTENT',
                                    ],
                                    'alignment' => 'CENTER',
                                    "spoiler" => [
                                        "enabled" => false,
                                    ],
                                    "textWrap" => false,
                                ],
                                'lineStyle' => 'SINGLE',
                                'width' => 'LARGE',
                                'alignment' => 'CENTER',
                            ],
                        ];
                        break;
                    case 'BLOCKQUOTE':
                        if ($childNode->getElementsByTagName('p')->length > 0 || $childNode->getElementsByTagName('div')->length > 0) {
                            $node = [
                                'type' => 'BLOCKQUOTE',
                                'nodes' => $this->convertNodes($childNode->childNodes, [], 1),
                                'blockquoteData' => [
                                    'indentation' => 0,
                                ]
                            ];
                        } else {
                            $node = [
                                'type' => 'BLOCKQUOTE',
                                'nodes' => [
                                    [
                                        'type' => 'PARAGRAPH',
                                        'nodes' => $this->convertNodes($childNode->childNodes, [], 1),
                                        "paragraphData" => [
                                            "textStyle" => [
                                                "textAlignment" => "AUTO",
                                            ],
                                            "indentation" => 0,
                                        ]
                                    ],
                                ],
                                'blockquoteData' => [
                                    'indentation' => 0,
                                ],
                            ];
                        }
                        break;
                    case 'UL':
                        $node = [
                            'type' => 'BULLETED_LIST',
                            'nodes' => $this->convertNodes($childNode->childNodes, [], 1),
                            'bulletedListData' => [
                                'indentation' => 0,
                            ]
                        ];
                        break;
                    case 'OL':
                        $node = [
                            'type' => 'ORDERED_LIST',
                            'nodes' => $this->convertNodes($childNode->childNodes, [], 1),
                            'orderedListData' => [
                                'indentation' => 0,
                            ]
                        ];
                        break;
                    case 'LI':
                        $node = [
                            'type' => 'LIST_ITEM',
                            'nodes' => [
                                [
                                    'type' => 'PARAGRAPH',
                                    'nodes' => $this->convertNodes($childNode->childNodes, [], 1),
                                    "paragraphData" => [
                                        "textStyle" => [
                                            "textAlignment" => "AUTO",
                                        ],
                                        "indentation" => 0,
                                    ]
                                ],
                            ],
                        ];
                        break;

                    case 'IMG':
                        $node = [
                            "type" => 'IMAGE',
                            "nodes" => $this->convertNodes($childNode->childNodes, [], 1),
                            "imageData" => [
                                'containerData' => [
                                    "width" => ['size' => "CONTENT"],
                                    "alignment" => "CENTER",
                                    "textWrap" => true,
                                ],
                                "image" => [
                                    "src" => [
                                        "private" => true,
                                        'url' => $childNode->getAttribute('src'),
                                    ],
                                ],
                                'altText' => $childNode->getAttribute('alt'),
                            ]
                        ];
                        break;

                    case 'TABLE':
                        $rowsNum = $childNode->getElementsByTagName('tr')->length;
                        $colsNum = 0;
                        if ($rowsNum > 0) {
                            $colsNum = $childNode->getElementsByTagName('tr')->item(0)->getElementsByTagName('td')->length;
                            if (empty($colsNum)) {
                                $colsNum = $childNode->getElementsByTagName('tr')->item(0)->getElementsByTagName('th')->length;
                            }
                        }
                        $node = [
                            'type' => 'TABLE',
                            'nodes' => $this->convertNodes($childNode->childNodes, [], 1),
                            'tableData' => [
                                'containerData' => [
                                    'alignment' => 'CENTER',
                                    'textWrap' => true,
                                ],
                                "dimensions" => [
                                    "colsWidthRatio" => array_fill(0, $colsNum, 210),
                                    "rowsHeight" => array_fill(0, $rowsNum, 47),
                                    "colsMinWidth" => array_fill(0, $colsNum, 120),
                                ],
                            ]
                        ];
                        break;
                    case 'TR':
                        $node = [
                            'type' => 'TABLE_ROW',
                            'nodes' => $this->convertNodes($childNode->childNodes, [], 1),
                        ];
                        break;
                    case 'TH':
                    case 'TD':
                        $node = [
                            'type' => 'TABLE_CELL',
                            'nodes' => [
                                [
                                    'type' => 'PARAGRAPH',
                                    'nodes' => $this->convertNodes($childNode->childNodes, [], 1),
                                    "paragraphData" => [
                                        "textStyle" => [
                                            "textAlignment" => "AUTO",
                                        ],
                                        "indentation" => 0,
                                    ]
                                ],
                            ],
                            'tableCellData' => [
                                'cellStyle' => [
                                    'verticalAlignment' => 'TOP',
                                ],
                                'borderColors' => [
                                    "left" => "#CCCCCC",
                                    "right" => "#CCCCCC",
                                    "top" => "#CCCCCC",
                                    "bottom" => "#CCCCCC",
                                ],
                            ],
                        ];
                        break;
                    case 'PRE':
                    case 'CODE':
                        //$childNode->nodeType === XML_TEXT_NODE
                        $nextNodeType = $childNode->childNodes->item(0);
                        //print_r($nextNodeType);
                        if ($nextNodeType->nodeType === XML_TEXT_NODE) {
                            $node = [
                                'type' => 'CODE_BLOCK',
                                'nodes' => $this->convertNodes($childNode->childNodes, [], 1),
                                'codeBlockData' => [
                                    'textStyle' => [
                                        "textAlignment" => "AUTO",
                                    ],
                                ]
                            ];
                        } else {
                            $nodes = $this->convertNodes($childNode->childNodes, [], 1);
                            $node = $node[0] ?? [];
                        }

                        break;

                    case 'A':
                    case 'STRONG':
                    case 'INS':
                    case 'DEL':
                    case 'EM':
                    case 'B':
                    case 'S':
                    case 'U':
                    case 'I':
                        $decorations = $this->getTextDecorations($childNode, $decorations);

                        $node = $this->convertNodes($childNode->childNodes, $decorations, 1);
                        $decorations = [];
                        if (empty($level)) {
                            $node = [
                                'type' => 'PARAGRAPH',
                                'nodes' => $node,
                                "paragraphData" => [
                                    "textStyle" => [
                                        "textAlignment" => "AUTO",
                                    ],
                                    "indentation" => 0,
                                ],
                            ];
                        } else if (isset($node[0])) {
                            $node = $node[0];
                        }

                        break;

                    case 'BR':
                    case 'P':
                    case 'DIV':
                        $node = [
                            'type' => 'PARAGRAPH',
                            'nodes' => $this->convertNodes($childNode->childNodes, [], 1),
                            "paragraphData" => [
                                "textStyle" => [
                                    "textAlignment" => "AUTO",
                                ],
                                "indentation" => 0,
                            ]
                        ];
                        break;
                    default:
                        if (empty($level)) {
                            $node = [
                                'type' => 'PARAGRAPH',
                                'nodes' => $this->convertNodes($childNode->childNodes, [], 1),
                                "paragraphData" => [
                                    "textStyle" => [
                                        "textAlignment" => "AUTO",
                                    ],
                                    "indentation" => 0,
                                ]
                            ];
                        } else {
                            $node = $this->convertNodes($childNode->childNodes, [], 1);
                        }
                }
            } else if ($childNode->nodeType === XML_TEXT_NODE) {
                //print_r($childNode);
                //判断$childNode->nodeValue的值是否是换行。如果是一个换行跳过，如果是多个换行去掉一个换行
                if (preg_match('/\r\n/', $childNode->nodeValue)) {
                    $childNode->nodeValue = preg_replace_callback('/\r\n/', function ($matches) {
                        return ''; // 替换为空字符串
                    }, $childNode->nodeValue, 1); // 限制替换次数为1
                } elseif (preg_match('/\n/', $childNode->nodeValue)) {
                    $childNode->nodeValue = preg_replace_callback('/\n/', function ($matches) {
                        return ''; // 替换为空字符串
                    }, $childNode->nodeValue, 1); // 限制替换次数为1
                }
                //清除$childNode->nodeType首尾的空格
                $childNode->nodeValue = trim($childNode->nodeValue, ' ');
                if ($childNode->nodeValue === '') {
                    continue;
                }
                if (empty($level)) {
                    $node = [
                        'type' => 'PARAGRAPH',
                        'nodes' => [
                            [
                                'type' => 'TEXT',
                                'nodes' => [],
                                'textData' => [
                                    'text' => $childNode->nodeValue,
                                    'decorations' => $decorations,
                                ],
                            ],
                        ],
                        "paragraphData" => [
                            "textStyle" => [
                                "textAlignment" => "AUTO",
                            ],
                            "indentation" => 0,
                        ],
                    ];
                } else {
                    $node = [
                        'type' => 'TEXT',
                        'nodes' => [],
                        'textData' => [
                            'text' => $childNode->nodeValue,
                            'decorations' => $decorations,
                        ],
                    ];
                }
                $decorations = [];
            }

            $nodes[] = $node;
        }

        return $nodes;
    }

    //修饰标签转换
    private function getTextDecorations($domElement, $decorations = [])
    {
        // Add decorations based on your criteria, e.g., BOLD, ITALIC, UNDERLINE, FONT_SIZE, etc.
        switch (strtoupper($domElement->nodeName)) {
            case 'A':
                //判断是否有前缀下划线，删除前缀下划线并改为大写  如： SELF,BLANK,PARENT,TOP
                $target = $domElement->getAttribute('target');
                if (0 === strpos($target, "_")) {
                    $target = preg_replace_callback('/^_/', function ($matches) {
                        return ''; // 替换为空字符串
                    }, $target, 1); // 限制替换次数为1
                    $target = strtoupper($target);
                }

                $decorations[] = [
                    'type' => 'LINK',
                    'linkData' => [
                        'link' => [
                            'url' => $domElement->getAttribute('href'),
                            'target' => $target ?: 'BLANK',
                            'rel' => [
                                'noreferrer' => true,
                            ],
                        ],
                    ],
                ];
                break;
            case 'B':
            case 'STRONG':
                $decorations[] = ['type' => 'BOLD'];
                break;
            case 'EM':
            case 'I':
                $decorations[] = ['type' => 'ITALIC'];
                break;
            case 'U':
            case 'INS':
                $decorations[] = ['type' => 'UNDERLINE'];
                break;
                //                case 'S':
                //                case 'DEL':
                //                    $decorations[] = ['type' => 'SPOILER'];
                //                    break;
        }

        return $decorations;
    }
}

// Example Usage:
$html = '<h1>这是<b>一级</b>标题</h1>
<h2>这是<strong>二级</strong>标题</h2>
<h3>这是<s>三级</s>标题</h3>
<h4>这是<em>四级</em>标题</h4>
<h5>这是<u>五级</u>标题</h5>
<h6>这是<ins>六级</ins>标题</h6>

<p>这是<i>一个</i><del>段落</del>。</p>

<div><em><b><s>这是一个块级元素。</s></b></em></div>

<blockquote>
  标签块的定义，可以脱离文本块的限制，左右有缩进，标签有图形的区别
</blockquote>

<a href="https://www.example.com" target="_">这是一个链接</a>

<img src="image.jpg" alt="图片描述">

<ul>
    <li>列表项 1</li>
    <li>列表项 2</li>
    <li>列表项 3</li>
</ul>

<ol>
    <li>有序列表项 1</li>
    <li>有序列表项 2</li>
    <li>有序列表项 3</li>
</ol>

<strong>这是粗体文本</strong>

<em>这是斜体文本</em>

<br>

<hr>

<table>
    <tr>
        <th>书名</th>
        <th>作者</th>
    </tr>
    <tr>
        <td>《西游记》</td>
        <td>吴承恩</td>
    </tr>
    <tr>
        <td>《红楼梦》</td>
        <td>曹雪芹</td>
    </tr>
    <tr>
        <td>《三国演义》</td>
        <td>罗贯中</td>
    </tr>
    <tr>
        <td>《水浒传》</td>
        <td>施耐庵</td>
    </tr>
</table>';

$html = '<pre><code class=\'language-php\' lang=\'php\'>&lt;?php
// todo 循环
foreach ($arr as $item) {
    echo &#39;&lt;li&gt;&#39; . $item . &#39;&lt;/li&gt;&#39;;
    // code to be executed inside the loop
}
?&gt;
</code></pre>
<pre>&lt;?php
// todo 循环
foreach ($arr as $item) {
    echo &#39;&lt;li&gt;&#39; . $item . &#39;&lt;/li&gt;&#39;;
    // code to be executed inside the loop
}
?&gt;
</pre>
<code class=\'language-php\' lang=\'php\'>&lt;?php
// todo 循环
foreach ($arr as $item) {
    echo &#39;&lt;li&gt;&#39; . $item . &#39;&lt;/li&gt;&#39;;
    // code to be executed inside the loop
}
?&gt;
</code>';
$converter = new HtmlToRichContentConverter();
$richContent = $converter->convertHtmlToRichContent($html);

echo $richContent;
