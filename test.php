<?php
//设置字符集utf-8
header('Content-Type: text/html; charset=utf-8');
$time = time();//strtotime('tomorrow 00:00:00');
echo $time;
echo "\n";
date_default_timezone_set('Etc/GMT+8');
$time1 = time();//strtotime('tomorrow 00:00:00');
echo $time1;
exit();

function setTimeZone($timeZone = '', $isSet = false): string
{
    if (!empty($timeZone)) {
        //$timeZone设置大写
        $timeZone    = strtoupper($timeZone);
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

    $timeZone   = setTimeZone($timeZone, false);
    $toTimeZone = setTimeZone($toTimeZone, false);
    // 创建一个 DateTime 对象，并设置初始时区
    $date = new \DateTime($time, new \DateTimeZone($timeZone));

    // 设置目标时区为东八区
    $date->setTimezone(new \DateTimeZone($toTimeZone));

    // 按照指定格式返回时间
    return $date->format($format);
}

$dateTime = date('Y-m-d H:i:s');
$data = convertToEast8Time($dateTime,'GMT+8', 'GMT-8', 'd');
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
    '并非完整文章内容'
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
    $file     = fopen($fileName, "rb");
    $bin      = fread($file, 2); //只读2字节  
    fclose($file);
    $strInfo  = @unpack("C2chars", $bin); // C为无符号整数，网上搜到的都是c，为有符号整数，这样会产生负数判断不正常  
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
    for ($i = 0; $i < strlen($hex) - 1; $i += 2)
        $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
    return  $string;
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
// 	"nodes" => [
// 		[
// 			"type"          => "PARAGRAPH",
// 			"nodes"         => [
// 				[
// 					"type"     => 'TEXT',
// 					"nodes"    => [],
// 					"textData" => [
// 						'text'        => "1. Introduction",
// 						'decorations' => [
// 							['type' => "BOLD"],
// 							['type' => "ITALIC", "italicData" => true],
// 							['type' => "UNDERLINE", "underlineData" => true],
// 							['type' => "FONT_SIZE", "fontSizeData" => ["unit" => "PX", "value" => 18]],
// 						]
// 					],
// 				],
// 			],
// 			"paragraphData" => [
// 				"textStyle"   => [
// 					"textAlignment" => "AUTO",
// 					"lineHeight"    => "2"
// 				],
// 				"indentation" => 0,
// 			]
// 		],
// 		[
// 			"type"          => "PARAGRAPH",
// 			"nodes"         => [
// 				[
// 					"type"     => 'TEXT',
// 					"nodes"    => [],
// 					"textData" => [
// 						'text'        => "In recent years, the intersection of artificial intelligence (AI) and creative writing has sparked both excitement and concern. On one hand, AI offers a new frontier for storytelling, enabling writers to explore innovative narratives and styles. On the other hand, the rise of AI-generated content raises questions about the definition of creativity, authorship, and the future of human writing. This article will explore the evolution of AI in creative writing, its impact on the literary world, and the potential ethical considerations surrounding its use.",
// 						'decorations' => [
// 							['type' => "FONT_SIZE", "fontSizeData" => ["unit" => "PX", "value" => 14]],
// 						]
// 					],
// 				],
// 			],
// 			"paragraphData" => [
// 				"textStyle"   => [
// 					"textAlignment" => "AUTO",
// 					"lineHeight"    => "2"
// 				],
// 				"indentation" => 0,
// 			]
// 		],
// 		[
// 			"type"      => 'IMAGE',
// 			"nodes"     => [],
// 			"imageData" => [
// 				'containerData' => [
// 					"width"     => ['size' => "CONTENT"],
// 					"alignment" => "CENTER",
// 				],
// 				"image"         => [
// 					"src"    => ["private" => true, 'url' => "https://static.wixstatic.com/media/ec47b0_9b93fe181449455fa3f750b92295cb20~mv2.jpg"],
// 				],
// 			],
// 		],
// 		[
// 			"type"          => "PARAGRAPH",
// 			"nodes"         => [
// 				[
// 					"type"     => 'TEXT',
// 					"nodes"    => [],
// 					"textData" => [
// 						'text'        => "2. Early AI in Creative Writing",
// 						'decorations' => [
// 							['type' => "BOLD"],
// 							['type' => "ITALIC", "italicData" => true],
// 							['type' => "UNDERLINE", "underlineData" => true],
// 							['type' => "FONT_SIZE", "fontSizeData" => ["unit" => "PX", "value" => 18]],
// 						]
// 					],
// 				],
// 			],
// 			"paragraphData" => [
// 				"textStyle"   => [
// 					"textAlignment" => "AUTO",
// 					"lineHeight"    => "2"
// 				],
// 				"indentation" => 0,
// 			]
// 		],
// 		[
// 			"type"      => 'IMAGE',
// 			"nodes"     => [],
// 			"imageData" => [
// 				'containerData' => [
// 					"width"     => ['size' => "CONTENT"],
// 					"alignment" => "CENTER",
// 				],
// 				"image"         => [
// 					"src"    => ["private" => true, 'url' => "https://static.wixstatic.com/media/ec47b0_8345eef0b0a142e08a982d9affd8d08a~mv2.jpeg"],
// 				],
// 			],
// 		],
// 		[
// 			"type"          => "PARAGRAPH",
// 			"nodes"         => [
// 				[
// 					"type"     => 'TEXT',
// 					"nodes"    => [],
// 					"textData" => [
// 						'text'        => "The early days of AI in creative writing were marked by simple algorithms that generated poetry or short stories based on predefined rules and patterns. These \"generate-and-evaluate\" models, while crude, were a significant milestone in the intersection of AI and creative writing. They opened up a new avenue for storytelling, allowing for infinite iterations and experimentation.",
// 						'decorations' => [
// 							['type' => "FONT_SIZE", "fontSizeData" => ["unit" => "PX", "value" => 14]],
// 						]
// 					],
// 				],
// 			],
// 			"paragraphData" => [
// 				"textStyle"   => [
// 					"textAlignment" => "AUTO",
// 					"lineHeight"    => "2"
// 				],
// 				"indentation" => 0,
// 			]
// 		],
// 	]
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
                                'level'       => (int) substr($childNode->nodeName, 1),
                                "textStyle"   => [
                                    "textAlignment" => "AUTO",
                                ],
                                "indentation" => 0,
                            ],
                        ];
                        break;
                    case 'HR':
                        $node = [
                            'type'           => 'DIVIDER',
                            'nodes'          => [],
                            'dividerData' => [
                                'containerData' => [
                                    'width' => [
                                        'size' => 'CONTENT',
                                    ],
                                    'alignment' => 'CENTER',
                                    "spoiler" => [
                                        "enabled" => false
                                    ],
                                    "textWrap" => false
                                ],
                                'lineStyle' => 'SINGLE',
                                'width' => 'LARGE',
                                'alignment' => 'CENTER',
                            ]
                        ];
                        break;
                    case 'BLOCKQUOTE':
                        if ($childNode->getElementsByTagName('p')->length > 0 || $childNode->getElementsByTagName('div')->length > 0) {
                            $node = [
                                'type'           => 'BLOCKQUOTE',
                                'nodes'          => $this->convertNodes($childNode->childNodes, [], 1),
                                'blockquoteData' => [
                                    'indentation' => 0
                                ]
                            ];
                        } else {
                            $node = [
                                'type'           => 'BLOCKQUOTE',
                                'nodes'          => [
                                    [
                                        'type'          => 'PARAGRAPH',
                                        'nodes'         => $this->convertNodes($childNode->childNodes, [], 1),
                                        "paragraphData" => [
                                            "textStyle"   => [
                                                "textAlignment" => "AUTO",
                                            ],
                                            "indentation" => 0,
                                        ]
                                    ]
                                ],
                                'blockquoteData' => [
                                    'indentation' => 0
                                ]
                            ];
                        }
                        break;
                    case 'UL':
                        $node = [
                            'type' => 'BULLETED_LIST',
                            'nodes' => $this->convertNodes($childNode->childNodes, [], 1),
                            'bulletedListData' => [
                                'indentation' => 0
                            ]
                        ];
                        break;
                    case 'OL':
                        $node = [
                            'type' => 'ORDERED_LIST',
                            'nodes' => $this->convertNodes($childNode->childNodes, [], 1),
                            'orderedListData' => [
                                'indentation' => 0
                            ]
                        ];
                        break;
                    case 'LI':
                        $node = [
                            'type' => 'LIST_ITEM',
                            'nodes' => [
                                [
                                    'type'          => 'PARAGRAPH',
                                    'nodes'         => $this->convertNodes($childNode->childNodes, [], 1),
                                    "paragraphData" => [
                                        "textStyle"   => [
                                            "textAlignment" => "AUTO",
                                        ],
                                        "indentation" => 0,
                                    ]
                                ]
                            ]
                        ];
                        break;

                    case 'IMG':
                        $node = [
                            "type"      => 'IMAGE',
                            "nodes"     => $this->convertNodes($childNode->childNodes, [], 1),
                            "imageData" => [
                                'containerData' => [
                                    "width"     => ['size' => "CONTENT"],
                                    "alignment" => "CENTER",
                                    "textWrap" => true
                                ],
                                "image"         => [
                                    "src"    => [
                                        "private" => true,
                                        'url' => $childNode->getAttribute('src')
                                    ]
                                ],
                                'altText' => $childNode->getAttribute('alt')
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
                                    'textWrap' => true
                                ],
                                "dimensions"    => [
                                    "colsWidthRatio" =>  array_fill(0, $colsNum, 210),
                                    "rowsHeight"     => array_fill(0, $rowsNum, 47),
                                    "colsMinWidth"   => array_fill(0, $colsNum, 120),
                                ]
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
                                    'type'          => 'PARAGRAPH',
                                    'nodes'         => $this->convertNodes($childNode->childNodes, [], 1),
                                    "paragraphData" => [
                                        "textStyle"   => [
                                            "textAlignment" => "AUTO",
                                        ],
                                        "indentation" => 0,
                                    ]
                                ]
                            ],
                            'tableCellData' => [
                                'cellStyle' => [
                                    'verticalAlignment' => 'TOP'
                                ],
                                'borderColors' => [
                                    "left"   => "#CCCCCC",
                                    "right"  => "#CCCCCC",
                                    "top"    => "#CCCCCC",
                                    "bottom" => "#CCCCCC"
                                ]
                            ]
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
                                        "textAlignment" => "AUTO"
                                    ]
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
                                'type'          => 'PARAGRAPH',
                                'nodes'         => $node,
                                "paragraphData" => [
                                    "textStyle"   => [
                                        "textAlignment" => "AUTO",
                                    ],
                                    "indentation" => 0,
                                ]
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
                                "textStyle"   => [
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
                                    "textStyle"   => [
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
                            ]
                        ],
                        "paragraphData" => [
                            "textStyle"   => [
                                "textAlignment" => "AUTO",
                            ],
                            "indentation" => 0,
                        ]
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
                                'noreferrer' => true
                            ]
                        ],
                    ]
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
                //				case 'S':
                //				case 'DEL':
                //					$decorations[] = ['type' => 'SPOILER'];
                //					break;
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
