<?php
//设置字符集utf-8
header('Content-Type: text/html; charset=utf-8');

$arr = '【叮~2️⃣月金石挚友生日礼来咯】\n愿美好的事物一定会在新的一岁如约而至\n本月生日月尊享&gt;&gt;𝟮.𝟱倍万象星\n金石专属生日礼包&gt;&gt;1⃣6⃣选𝟮\n💝Maison Margiela、倍轻松、野兽派、国瓷永丰源、位元堂西洋参等礼盒；\n💝小盒子蛋糕、𝟯𝟬𝟬元餐饮券、金丝楠木书签、ADV香水、杜比厅电影票𝟲张（电子券)、BURBERRY等下午茶券；\n🍴餐饮品牌专属菜品券&gt;&gt;（老干杯、至正潮菜等共𝟵张）\n💰品牌专属代金券&gt;&gt;（self-portrait 、国瓷永丰源等共𝟵张）\n长按识别二维码领取&gt;&gt;开启专属生日之旅吧~\n💝享受会员权益需您完成账号实名认证哟~';
echo htmlspecialchars_decode($arr);
exit();


function encrypt($data, $key) {
    $cipher = "AES-128-ECB";
    $options = OPENSSL_RAW_DATA;
    $iv = "";

    $encrypted = openssl_encrypt($data, $cipher, $key, $options, $iv);

    $encrypted = strToHex($encrypted);

    // 大写转小写
    $encrypted = strtolower($encrypted);

    return $encrypted;
}

function decrypt($data, $key) {
    $cipher = "AES-128-ECB";
    $options = OPENSSL_RAW_DATA;
    $iv = "";
    
    $data = hexToStr($data);
    $decrypted = openssl_decrypt($data, $cipher, $key, $options, $iv);

    return $decrypted;
}

function hexToStr($hex)
{
    $string="";
    for($i=0;$i<strlen($hex)-1;$i+=2)
        $string.=chr(hexdec($hex[$i].$hex[$i+1]));
    return  $string;
}

function strToHex($string)
{
    $hex="";
    $tmp="";
    for($i=0;$i<strlen($string);$i++)
    {
        $tmp = dechex(ord($string[$i]));
        $hex.= strlen($tmp) == 1 ? "0".$tmp : $tmp;
    }
    $hex=strtoupper($hex);
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
                        if($nextNodeType->nodeType === XML_TEXT_NODE){
                            $node = [
                                'type' => 'CODE_BLOCK',
                                'nodes' => $this->convertNodes($childNode->childNodes, [], 1),
                                'codeBlockData' => [
                                    'textStyle' => [
                                        "textAlignment"=> "AUTO"
                                    ]
                                ]
                            ];
                        }else{
                            $nodes = $this->convertNodes($childNode->childNodes, [], 1);
                            $node = $node[0]??[];
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
