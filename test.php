<?php
//设置字符集utf-8
header('Content-Type: text/html; charset=utf-8');

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
                switch (strtoupper($childNode->nodeName)) {
                    case 'H1':
                    case 'H2':
                    case 'H3':
                    case 'H4':
                    case 'H5':
                    case 'H6':
                        $node = [
                            'type' => 'HEADING',
                            'nodes' => $this->convertNodes($childNode->childNodes,[], 1),
                            'headingData' => [
                                'level' => intval(substr($childNode->nodeName, 1)),
                                "textStyle"   => [
                                    "textAlignment" => "AUTO",
                                ],
                                "indentation" => 0,
                            ],
                        ];
                        break;

                    case 'UL':

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
                        }else{
                            if(isset($node[0])){
                                $node = $node[0];
                            }
                        }

                        break;

                    case 'P':
                    case 'DIV':
                    default:
                        if (empty($level)) {
                            $node = [
                                'type' => 'PARAGRAPH',
                                'nodes' => $this->convertNodes($childNode->childNodes,[], 1),
                                "paragraphData" => [
                                    "textStyle"   => [
                                        "textAlignment" => "AUTO",
                                    ],
                                    "indentation" => 0,
                                ]
                            ];
                        } elseif ($childNode->nodeType === XML_TEXT_NODE) {
                            $node = [
                                'type' => 'TEXT',
                                'nodes' => [],
                                'textData' => [
                                    'text' => $childNode->nodeValue,
                                    'decorations' => $decorations,
                                ],
                            ];
                        }
                }
            } else {
                if ($childNode->nodeType === XML_TEXT_NODE) {
                    if (preg_match('/\r\n/', $childNode->nodeValue)) {
                        $childNode->nodeValue = preg_replace_callback('/\r\n/', function ($matches) {
                            return ''; // 替换为空字符串
                        }, $childNode->nodeValue, 1); // 限制替换次数为1
                    } elseif (preg_match('/\n/', $childNode->nodeValue)) {
                        $childNode->nodeValue = preg_replace_callback('/\n/', function ($matches) {
                            return ''; // 替换为空字符串
                        }, $childNode->nodeValue, 1); // 限制替换次数为1
                    }
                    if (empty($level)) {
                        $node = [
                            'type' => 'PARAGRAPH',
                            'nodes' => [
                                'type' => 'TEXT',
                                'nodes' => [],
                                'textData' => [
                                    'text' => $childNode->nodeValue,
                                    'decorations' => $decorations,
                                ],
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
            case 'S':
            case 'DEL':
                $decorations[] = ['type' => 'SPOILER'];
                break;
        }

        return $decorations;
    }
}

// Example Usage:
$html = '<h1>这是一级标题</h1>
<h2>这是二级标题</h2>
<h3>这是三级标题</h3>
<h4>这是四级标题</h4>
<h5>这是五级标题</h5>
<h6>这是六级标题</h6>

<p>这是一个段落。</p>

<div>
    <p>这是一个块级元素。<span>hahahaha..</span></p>
</div>

<blockquote>
  标签块的定义，可以脱离文本块的限制，左右有缩进，标签有图形的区别 
</blockquote>

<a href="https://www.example.com" target="_blank">这是一个链接</a>

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

$html = '<h1>这是<b>一级</b>标题</h1>
<h2>这是<strong>二级</strong>标题</h2>
<h3>这是<s>三级</s>标题</h3>
<h4>这是<em>四级</em>标题</h4>
<h5>这是<u>五级</u>标题</h5>
<h6>这是<ins>六级</ins>标题</h6>

<p>这是<i>一个</i><del>段落</del>。</p>

<div><em><b><s>这是一个块级元素。</s></b></em></div>';
$converter = new HtmlToRichContentConverter();
$richContent = $converter->convertHtmlToRichContent($html);

echo $richContent;

die();

class HTMLtoDraftConverter
{
    public function convert($html)
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        libxml_clear_errors();

        $body = $dom->getElementsByTagName('body')->item(0);
        $contentState = $this->convertNode($body);

        return $contentState;
    }

    private function convertNode($node)
    {
        $contentState = [
            'blocks' => [],
            'entityMap' => [],
        ];

        foreach ($node->childNodes as $childNode) {
            print_r($childNode);
            if ($childNode->nodeType === XML_TEXT_NODE) {
                //var_dump($childNode->textContent);
                $block = [
                    'type' => 'unstyled',
                    'text' => $childNode->textContent,
                    'key' => uniqid(),
                    'depth' => 0,
                    'inlineStyleRanges' => [],
                    'entityRanges' => [],
                    'data' => [],
                ];

                $contentState['blocks'][] = $block;
            } elseif ($childNode->nodeType === XML_ELEMENT_NODE) {
                // $block = $this->convertNode($childNode);

                // if($childNode->nodeName === 'ul'){
                //    // print_r($block['blocks']);
                // }

                // if (!empty($block['blocks'][0]['text'])) {
                //     if ($childNode->nodeName === 'h1') {
                //         $block['type'] = 'header-one';
                //     } elseif ($childNode->nodeName === 'h2') {
                //         $block['type'] = 'header-two';
                //     } elseif ($childNode->nodeName === 'h3') {
                //         $block['type'] = 'header-three';
                //     } elseif ($childNode->nodeName === 'p') {
                //         $block['type'] = 'unstyled';
                //     } elseif ($childNode->nodeName === 'strong') {
                //         $inlineStyle = [
                //             'offset' => 0,
                //             'length' => strlen($block['blocks'][0]['text']),
                //             'style' => 'BOLD',
                //         ];
                //         $block['inlineStyleRanges'][] = $inlineStyle;
                //     }
                // } elseif ($childNode->nodeName === 'ul') {
                //     $listItems = $childNode->getElementsByTagName('li');
                //     foreach ($listItems as $listItem) {
                //         $listItemBlock = $this->convertNode($listItem);
                //         $listItemBlock['type'] = 'unordered-list-item';
                //         $contentState['blocks'][] = $listItemBlock;
                //     }
                //     continue; // Skip adding the <ul> block
                // }
                // $contentState['blocks'][] = $block;
            }
        }

        return $contentState;
    }
}

// Example Usage:
$html = '<h1>PHP</h1><h2>PHP的基本语法</h2>
<h3>变量和数据类型</h3><p><strong>变量</strong>是存储数据的容器，可以存储不同类型的数据。在PHP中，变量的命名规则是以$符号开头，后面跟着变量名。变量名可以包含字母、数字和下划线，但不能以数字开头。</p>
<p>PHP支持多种<strong>数据类型</strong>，包括整数、浮点数、字符串、布尔值和数组等。每种数据类型都有其特定的用途和操作方式。</p>
<p>以下是一些常见的PHP数据类型：</p>
<ul>
<li><strong>整数</strong>：用于表示没有小数部分的数字，可以是正数、负数或零。</li>
<li><strong>浮点数</strong>：用于表示带有小数部分的数字，也称为带有浮点数部分的实数。</li>
<li><strong>字符串</strong>：用于表示文本数据，可以包含字母、数字、符号和空格。</li>
<li><strong>布尔值</strong>：用于表示真或假的值，只有两个可能的取值：true和false。</li>
<li><strong>数组</strong>：用于存储多个值的有序集合，每个值都有一个唯一的键。</li>
</ul>
  
  <blockquote>
	<p>在PHP中，可以使用不同的函数来操作和转换不同的数据类型。</p>
  </blockquote>';
$converter = new HTMLtoDraftConverter();
$draftJsContent = $converter->convert($html);

// Output the result
echo json_encode($draftJsContent, JSON_UNESCAPED_UNICODE);


exit();
$html = '<h1>新手学习PHP基础语法</h1>

<p>PHP是一种广泛使用的服务器端脚本语言，特别适用于Web开发。它可以嵌入到HTML中，与HTML代码混合使用，可以动态生成HTML页面。学习PHP的基础语法对于想要进入Web开发领域的新手来说非常重要。</p>

<h3>要点总结</h3>

<ul><li>PHP是一种服务器端脚本语言</li>

<li>PHP可以嵌入到HTML中</li>

<li>PHP适用于Web开发</li>

<li>学习PHP基础语法对新手非常重要</li>

<li>PHP可以动态生成HTML页面</li></ul>

<h2>什么是PHP</h2>

<h3>PHP的起源</h3><p>PHP（<strong>Hypertext Preprocessor</strong>）是一种通用开源脚本语言，最初是为了创建动态网页而设计的。它的发展始于1994年，由<strong>Rasmus Lerdorf</strong>开发。PHP最初是一个简单的HTML表单处理脚本，但随着时间的推移，它逐渐发展成为一种功能强大且灵活的编程语言。</p>

<p>PHP的设计目标是使网页开发更简单、更快捷。它可以嵌入到HTML中，与HTML代码混合使用，从而实现动态网页的生成。PHP可以在服务器端执行，生成动态网页后再将结果发送给客户端浏览器。</p>

<p>PHP的语法借鉴了C、Java和Perl等编程语言，使得开发者可以很容易地学习和使用。它支持多种数据库，包括MySQL、Oracle和SQLite等，使得开发者可以方便地进行数据库操作。</p>

<p>虽然PHP的起源是为了创建动态网页，但它已经发展成为一种功能强大的编程语言，广泛应用于Web开发、命令行脚本和其他领域。</p>

 

 

<h3>PHP的特点</h3><p>PHP是一种<strong>开源</strong>的<strong>脚本语言</strong>，主要用于<strong>Web开发</strong>。它具有以下特点：</p>

<ul>

<li><strong>简单易学</strong>：PHP的语法简单，学习曲线较为平缓，适合初学者入门。</li>

<li><strong>灵活性</strong>：PHP可以与HTML混编，使得动态网页开发更加方便。</li>

<li><strong>跨平台</strong>：PHP可以在多个操作系统上运行，包括Windows、Linux和MacOS。</li>

<li><strong>强大的数据库支持</strong>：PHP支持多种数据库，如MySQL、Oracle和SQLite，方便进行数据存储和检索。</li>

<li><strong>庞大的开发社区</strong>：PHP拥有庞大的开发社区和丰富的资源库，可以快速解决问题和获取开发资源。</li>

</ul>

<blockquote>

<p>提示：在学习PHP时，建议多阅读官方文档和参考优秀的开源项目，以提高编程水平。</p>

</blockquote>';

// Function to convert HTML to Draft.js format
function convertToDraftJS($html)
{
    // Load HTML string into a DOMDocument
    $dom = new DOMDocument();
    $dom->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    // Initialize an empty array to store Content Blocks
    $contentBlocks = [];

    // Loop through each element in the DOM
    foreach ($dom->getElementsByTagName('*') as $element) {
        // Get the tag name
        $tagName = $element->tagName;

        // Check if it's a heading or paragraph
        if ($tagName === 'h1' || $tagName === 'h2' || $tagName === 'h3' || $tagName === 'p') {
            // Create a new Content Block for headings and paragraphs
            $contentBlock = [
                'type' => 'unstyled',
                'text' => $element->textContent,
                'depth' => ($tagName === 'h1' ? 0 : ($tagName === 'h2' ? 1 : 2)), // Adjust depth for headings
            ];

            // Add the Content Block to the array
            $contentBlocks[] = $contentBlock;
        }

        // Add more conditions for other HTML elements if needed
    }

    // Create Content State object with the array of Content Blocks
    $contentState = [
        'blocks' => $contentBlocks,
        'entityMap' => [],
    ];

    // Convert the Content State to JSON
    $draftJSData = json_encode($contentState);

    return $draftJSData;
}

// Convert HTML to Draft.js format
$draftJSData = convertToDraftJS($html);

// Output the result
echo $draftJSData;
