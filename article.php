<?php
function getThirdApi($url, $method, $headerArray, $data = '')
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

    switch ($method) {
        case 'PUT':
        case 'DELETE':
        case 'PATCH':
        case 'GET':
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method); //设置请求方式
            break;
        case 'POST':
            curl_setopt($curl, CURLOPT_POST, 1);
            break;
        default:
            break;

    }
    if (!empty($data)) {
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headerArray);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($curl, CURLOPT_COOKIE, $cookie);
    $output = curl_exec($curl);

    curl_close($curl);

    return json_decode($output, true);
}


function test($type)
{
    //Content-Type 配置项目
    $contentType = 'application/x-www-form-urlencoded';
    $cookie = 'BIDUPSID=A658DD7C93969775125C22960DA045CD; PSTM=1710306830; BAIDUID=FF4D1F844235F0D2EB72339BE4EF98AD:SL=0:NR=10:FG=1; MCITY=-%3A; BDUSS=ll6UDhqNjJCZ3IzWVplNH5IZ0stb0xtWUtoM1lONk9SS3dwUG1yYTdLOGpwfk5tSUFBQUFBJCQAAAAAAAAAAAEAAABKNFoNdGhpbmtlcnVuaW9uAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACMazGYjGsxmU; BDUSS_BFESS=ll6UDhqNjJCZ3IzWVplNH5IZ0stb0xtWUtoM1lONk9SS3dwUG1yYTdLOGpwfk5tSUFBQUFBJCQAAAAAAAAAAAEAAABKNFoNdGhpbmtlcnVuaW9uAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACMazGYjGsxmU; newlogin=1; H_WISE_SIDS=60271_60359_60598_60677_60695_60573_60725_60746; H_WISE_SIDS_BFESS=60271_60359_60598_60677_60695_60573_60725_60746; H_PS_PSSID=60271_60359_60598_60677_60695_60725_60746; BDORZ=FFFB88E999055A3F8A630C64834BD6D0; BAIDUID_BFESS=FF4D1F844235F0D2EB72339BE4EF98AD:SL=0:NR=10:FG=1; BDRCVFR[Zh1eoDf3ZW3]=mk3SLVN4HKm; delPer=0; PSINO=6; BA_HECTOR=a005842h8k248hak0ka12h00b3m7ve1jdsl5h1u; ZFY=p3UBAOhfehIwo:AGjDCqsFrn2:AO8yB1:AMKIO6NipuhLw:C; gray=1; canary=0; PHPSESSID=opcht2c0v8d1o71ofr2efmser1; Hm_lvt_f7b8c775c6c8b6a716a75df506fb72df=1725846712; HMACCOUNT=6541B19140C84DFF; __bid_n=191d47afe8898889209e9e; Hm_lpvt_f7b8c775c6c8b6a716a75df506fb72df=1725846763; devStoken=ad8448bbc18414b0f856a101187b986f0514ec5406ed8b836e4521a46b433689; bjhStoken=9e7c2d50b283d5c0629774c765e96bd30514ec5406ed8b836e4521a46b433689; ab_sr=1.0.1_MmRkZjBiY2M5NWRmOWI0NDJjOTVkYjM2ZWU4MzY3MDI1MDViNmQ4ODA4YjM5MWQ5NDlmNDUxOWYwYzZjYmZmZGE1MTIyYzU5YjgwYmRkNDNkNWNhYTY3ZDE3ZTU0ZTc1YmZlNWY5ZjI0ZWQ2NjIxZWEyY2RhZjFhMDljMDRiYjZjNzdhNzVjODU4ZDdkYTdkNGIzOWRjMzg1Y2MzYWU3M2E4N2UxMDdjZjdhNzViMDRlYjY4YTEyNGJlZThlY2I3; RT="z=1&dm=baidu.com&si=cf214342-9f50-4545-ad9d-9da0b70aeab0&ss=m0ufdhn0&sl=6&tt=50m&bcn=https%3A%2F%2Ffclog.baidu.com%2Flog%2Fweirwood%3Ftype%3Dperf&ld=8svj&nu=2sghjgm6&cl=8u33"';
    $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWlqaWFoYW8uYmFpZHUuY29tIiwiYXVkIjoiaHR0cDpcL1wvYmFpamlhaGFvLmJhaWR1LmNvbSIsImlhdCI6MTcyNTg1MTgyNiwibmJmIjoxNzI1ODA4NjMxLCJleHAiOjE3MjU4OTUwMzF9.9Z_wDzQ_ezvC6x6nI7oREBqnLS6iqme_CZOoG4kQN7M';
    $headerArray = ['Content-Type:' . $contentType, 'cookie:' . $cookie, 'token:' . $token];

    //百家号 保存草稿 发布文章  修改文章
    if ($type == 8) {
        $url = 'https://baijiahao.baidu.com/pcui/article/save?callback=bjhdraft'; //保存草稿
        //$url = 'https://baijiahao.baidu.com/pcui/article/publish?callback=bjhpublish'; //发布文章
        $dataA = [
            //article_id 依赖本接口字段
            //'article_id' => "1746372723799148157", //文章id
            'original_status' => "2", //2原创 0非原创
            'type' => "news", //news 图文
            'title' => "测试标题888888",
            'content' => '<p>测内容888888</p><p><img src="http://baijiahao.baidu.com/bjh/picproxy?param=iZoYn6y%2FcDdO8oFpULkJeMTx58xMPmxNv%2BFpiKFJ2f%2F2y0QyEKZUroZnhy%2B4FFukFmVXHwch2md%2FcLzFfKFCMQ4IIJX8Q5DMYX9d86LDcR%2B4uuocEsGrnEH3CoKPyH93dk1%2BBbmXnTLWcBfUFpp7rA%3D%3D"></p><p><br></p>',
            'abstract' => "测试摘要888888",
            'cover_layout' => 'one', //one 单独 three 三图
            //cover_images  _cover_images_map 依赖接口字段  --规则图片必须出现在content种
            'cover_images' => '[{"src":"http://baijiahao.baidu.com/bjh/picproxy?param=iZoYn6y%2FcDdO8oFpULkJeMTx58xMPmxNv%2BFpiKFJ2f%2F2y0QyEKZUroZnhy%2B4FFukFmVXHwch2md%2FcLzFfKFCMQ4IIJX8Q5DMYX9d86LDcR%2B4uuocEsGrnEH3CoKPyH93dk1%2BBbmXnTJ5x3I%2FJDfa8d2wkPoSdM0FZcDsElcUXrX9H%2BvFM%2FwPvA%3D%3D"}]',
            '_cover_images_map' => '[{"src":"http://baijiahao.baidu.com/bjh/picproxy?param=iZoYn6y%2FcDdO8oFpULkJeMTx58xMPmxNv%2BFpiKFJ2f%2F2y0QyEKZUroZnhy%2B4FFukFmVXHwch2md%2FcLzFfKFCMQ4IIJX8Q5DMYX9d86LDcR%2B4uuocEsGrnEH3CoKPyH93dk1%2BBbmXnTJ5x3I%2FJDfa8d2wkPoSdM0FZcDsElcUXrX9H%2BvFM%2FwPvA%3D%3D"}]',
            'source' => 'upload',
            //'online_modify' => '1', //已经发布的文章需要重新修改发布 此字段必须等于1   百家号已经发布的文章允许修改三次
            'cover_source' => 'upload',
        ];
        $data = http_build_query($dataA);
        $method = 'POST';
        $re = getThirdApi($url, $method, $headerArray, $data);
        //状态字段
        //$re['ret']['status'] = 'analyze';   analyze 待审核 publish 已经发布 withdraw 已经撤回
        //预览地址字段
        //$re['ret']['url'] = 'http://baijiahao.baidu.com/builder/preview/s?id=1746287625715309002';

        return $re;
    }

    //百家号上传图片
    if ($type == 9) {
        $contentType = 'multipart/form-data;';
        $headerArray = ['Content-Type:' . $contentType, 'cookie:' . $cookie, 'token:' . $token];
        $path = '/var/www/html/public/111.jpg';
        $url = 'https://baijiahao.baidu.com/pcui/picture/uploadproxy';
        $data = array(
            'type' => 'image',
            'app_id' => '1710318326697203', //依赖字段
            'is_waterlog' => '1',
            'save_material' => '1',
            'no_compress' => '0',
            'is_events' => '',
            'article_type' => 'news',
            'media' => new \CURLFILE($path),
        );
        $method = 'POST';
        $re = getThirdApi($url, $method, $headerArray, $data);
        /*{
        "errno": 0,
        "errmsg": "success",
        "ret": {
        "app_id": 1710318326697203,
        "bos_url":   "http://baijiahao.baidu.com/bjh/picproxy?param=iZoYn6y/cDdO8oFpULkJeMTx58xMPmxNv+FpiKFJ2f/2y0QyEKZUroZnhy+4FFukFmVXHwch2md/cLzFfKFCMRQWLt96qehLIXfw1MEIez9bTxmXfY6lqxxWfN+U9ce5FjeBANrQIa2fi6DqDlVSDg==",
        "https_url": "http://baijiahao.baidu.com/bjh/picproxy?param=iZoYn6y/cDdO8oFpULkJeMTx58xMPmxNv+FpiKFJ2f/2y0QyEKZUroZnhy+4FFukFmVXHwch2md/cLzFfKFCMRQWLt96qehLIXfw1MEIez9bTxmXfY6lqxxWfN+U9ce5FjeBANrQIa2fi6DqDlVSDg==",
        "org_url": "http://baijiahao.baidu.com/bjh/picproxy?param=iZoYn6y/cDdO8oFpULkJeMTx58xMPmxNv+FpiKFJ2f/2y0QyEKZUroZnhy+4FFukFmVXHwch2md/cLzFfKFCMRQWLt96qehLIXfw1MEIez9bTxmXfY6lqxxWfN+U9ce5FjeBANrQIa2fi6DqDlVSDg==",
        "mime": "image/png",
        "name": "999.png",
        "no_waterlog_bos_url": "http://baijiahao.baidu.com/bjh/picproxy?param=iZoYn6y/cDdO8oFpULkJeMTx58xMPmxNv+FpiKFJ2f/2y0QyEKZUroZnhy+4FFukFmVXHwch2md/cLzFfKFCMRQWLt96qehLIXfw1MEIez9bTxmXfY6lqxxWfN+U9ce5FjeBANrQIa2fi6DqDlVSDg==",
        "size": 4329,
        "type": "image"
        },
        "error_code": 0,
        "error_msg": "success"
        }*/
        return ['bos_url' => $re['ret']['bos_url']];
    }

    //百家号app_id字段接口
    if ($type == 10) {
        $headerArray = ['Content-Type:' . "application/json", 'cookie:' . $cookie, 'token:' . $token];
        $url = 'https://baijiahao.baidu.com/builder/app/appinfo';
        $method = 'GET';
        $re = getThirdApi($url, $method, $headerArray);
        return ['app_id' => $re['data']['user']['app_id']];
    }

    //根据文章标题更新文章状态
    if ($type == 11) {
        $headerArray = ['Content-Type:' . "application/json", 'cookie:' . $cookie, 'token:' . $token];
        $url = 'https://baijiahao.baidu.com/pcui/article/lists';
        $method = 'GET';
        $dataA = [
            'currentPage' => 1,
            'pageSize' => 10,
            'search' => '测试标题8888888',
        ];
        $url .= '?' . http_build_query($dataA);
        $re = getThirdApi($url, $method, $headerArray);
        return [array_column($re['data']['list'], 'status', 'article_id')];
    }

    //发布短内容
    if ($type == 12) {
        $headerArray = ['cookie:' . $cookie, 'token:' . $token];
        $url = 'https://baijiahao.baidu.com/pcui/pcpublisher/publishdynamic'; //发布文章
        $dataA = [
            'content' => '测试8',
            "images" => [
                [
                    "url" => "http://baijiahao.baidu.com/bjh/picproxy?param=iZoYn6y/cDdO8oFpULkJeMTx58xMPmxNv+FpiKFJ2f/2y0QyEKZUroZnhy+4FFukFmVXHwch2mfA7W11awlenW1DkkTQ1eHhConXPGanHk0aniqq3Bkw2sqHUS79te9PGM/2Wg3Qiyab6FVREXaO5LYrMJ1KUnek",
                ],
            ],
            //修改必传参数
            /*'online_modify'=> 1,//已经发布的文章需要重新修改发布 此字段必须等于1   百家号已经发布的文章允许修改三次
        'feed_id'=> '4515602112006902930',
        "jump_diff"=>1*/
        ];
        $data = array('params' => json_encode($dataA));
        $method = 'POST';
        $re = getThirdApi($url, $method, $headerArray, $data);
        //返回结果
        /*{
        "errno": 0,
        "errmsg": "success",
        "data": null,
        "request_id": "1971721427",
        "ret": null,
        "ie": "utf-8"
        }*/
        return $re;
    }

    //根据动态更新状态
    if ($type == 13) {
        $headerArray = ['Content-Type:' . "application/json", 'cookie:' . $cookie, 'token:' . $token];
        $url = 'https://baijiahao.baidu.com/pcui/pcpublisher/listdynamic';
        $method = 'GET';
        $dataA = [
            'currentPage' => 1,
            'pageSize' => 10,
            'search' => '',
        ];
        $url .= '?' . http_build_query($dataA);
        $re = getThirdApi($url, $method, $headerArray);
        /*
         * 保存没有id 通过列表数据 对比内容 更新 id 和 feed_id 以及 status
         *
         * list.id        动态标识 删除时用
         * list.feed_id   动态标识 修改或者删除时用
         * list.status    pre_publish：待发布审核中  publish：已发布  rejected：审核不通过  withdraw：已作废删除
         * {
        "data": {
        "list": [
        {
        "id": "16655389751834145",
        "third_id": "16655389751834145",
        "feed_id": "4815917181634856129",
        "type": "image_text",
        "publish_at": "2022-10-12 09:42:56",
        "content": "测试小儿",
        "cover_images": "[{\"src\":\"https:\\/\\/pic.rmb.bdstatic.com\\/bjh\\/events\\/8f8ef4e1b807cb90b06aa823a213998c9845.jpeg\",\"style\":\"static\"}]",
        "status": "rejected",
        "audit_msg": "存在内容违规或行为异常",
        "modify_info": {
        "is_can_modify": 1,
        "modify_reason": "",
        "newest_modify_audit_status": 5,
        "shadow_nid": "5261785072656014722",
        "is_modified": 1,
        "audit_refusal_reason": "存在内容违规或行为异常"
        },
        }
        ],
        "page": {
        "currentPage": 1,
        "pageSize": 1,
        "totalCount": 1,
        "totalPage": 1
        }
        },
        "errmsg": "success",
        "errno": 0
        }*/
        return $re;
    }

    //删除动态
    if ($type == 14) {
        $contentType = 'multipart/form-data;';
        $headerArray = ['Content-Type:' . $contentType, 'cookie:' . $cookie, 'token:' . $token];
        $url = 'https://baijiahao.baidu.com/pcui/pcpublisher/deletedynamic';
        $data = [
            'feed_id' => '4876012978251433797',
            "id" => '16655439422834713',
        ];
        $method = 'POST';
        $re = getThirdApi($url, $method, $headerArray, $data);
        //返回结果
        /*{
        "message": "ok",
        "code": 200,
        "data": {
        "errno": 0,
        "errmsg": "success",
        "data": {0
        "errno": "0",
        "feed_id": "4876012978251433797"
        },
        "request_id": "635921482",
        "ie": "utf-8"
        }
        }*/
        return $re;
    }

    //预上传视频
    if ($type == 15) {
        //$appId    = '1710318326697203';
        $appId = '1746284737509667';
        $fileName = '555.mp4';
        $path = '/var/www/html/public/' . $fileName;

        $contentType = 'application/x-www-form-urlencoded';
        $headerArray = ['Content-Type:' . $contentType, 'cookie:' . $cookie, 'token:' . $token];
        $imageHash = md5_file($path);
        $size = filesize($path);

        if (true) {

            //-- 上传视频步骤一  生成标识
            $url = 'https://baijiahao.baidu.com/builder/author/video/preuploadVideo?app_id=1710318326697203';
            $data = array(
                'app_id' => $appId, //依赖字段
                'md5' => $imageHash,
                'is_pay_column' => 0,
                'video_type' => 'tiny',
            );
            $method = 'POST';
            $re = getThirdApi($url, $method, $headerArray, $data);
            var_dump(['$re1' => $re]);
            $upload_key = $re['upload_key'];
            $mediaId = $re['mediaId'];

            /*    array(1) {
        ["$re1"]=>
        array(5) {
        ["error_code"]=>
        int(20000)
        ["error_msg"]=>
        string(22) "preuploadVideo success"
        ["upload_key"]=>
        string(32) "1609bf72f52ecc5029b624b4ee05e87b"
        ["mediaId"]=>
        string(32) "6XMSLvC762vN0wK1yhj7Kq/a5XKiMj+b"
        ["list"]=>
        NULL
        }
        }*/
        }

        if (true) {
            //-- 上传视频步骤二 上传内容
            $contentType = 'multipart/form-data;';
            $headerArray = ['Content-Type:' . $contentType, 'cookie:' . $cookie, 'token:' . $token];
            $url = 'https://rsbjh.baidu.com/builder/author/video/uploadVideo?app_id=1710318326697203';

            $chunkSize = 1024 * 1024 * 2;
            $chunks = ceil($size / $chunkSize);
            for ($i = 0; $i < $chunks; $i++) {
                $temPath = '/var/www/html/public/' . 'chunk_' . $i . '.mp4';
                file_put_contents($temPath, file_get_contents($path, false, null, $i * $chunkSize, $chunkSize));
                $data = [
                    'app_id' => $appId, //依赖字段
                    'md5' => $imageHash,
                    'id' => 'WU_FILE_0',
                    'name' => $fileName,
                    'type' => 'video/mp4',
                    'size' => $size,
                    'upload_key' => $upload_key,
                    'file' => new \CURLFILE($temPath),
                    'chunks' => $chunks,
                    'chunk' => $i,
                ];
                $method = 'POST';
                $re = getThirdApi($url, $method, $headerArray, $data);
                var_dump(['chunk_' . $i => $re]);
                /*array(1) {
            ["chunk_0"]=>
            array(3) {
            ["uploadId"]=>
            string(32) "3e45219795c6ae3daf7d03ef4cfcedf4"
            ["error_code"]=>
            int(20000)
            ["error_msg"]=>
            string(21) "1 part upload success"
            }
            }*/
            }

        }

        if (true) {
            $url = 'https://baijiahao.baidu.com/builder/author/video/compuploadVideo?app_id=1710318326697203';
            $dataA = array(
                'upload_key' => $upload_key, //依赖字段
                'chunks' => 1,
                'name' => $fileName,
                'size' => $size,
                'is_pay_column' => 0,
                'type' => 'video',
                'video_type' => 'tiny',
            );
            $data = http_build_query($dataA);
            $method = 'POST';
            $re = getThirdApi($url, $method, $headerArray, $data);
            var_dump(['$re2' => $re]);
            /*{
        "message": "ok",
        "code": 200,
        "data": {
        "name": "222.mp4",
        "app_id": 1710318326697203,
        "type": "video",
        "mime": "video",
        "size": "1830719",
        "bos_url": "{\"mediaId\":\"DnzSfSwrqSPH0JMbKFSdkj\\/A25KNj2s7\"}",
        "mediaId": "JhEfNIrUecZRn5L2nYKIokaa5khS+cWV",
        "error_code": 0,
        "height": 1280,
        "width": 720
        }
        }*/
        }

        //-- 上传视频步骤四 发布素材
        $contentType = 'application/x-www-form-urlencoded';
        $headerArray = ['Content-Type:' . $contentType, 'cookie:' . $cookie, 'token:' . $token];
        $url = 'https://baijiahao.baidu.com/pcui/article/publish?callback=bjhpublish';
        $dataA = [
            'type' => 'ugc_video',
            'video_duration' => 4,
            'title' => '测试案例666',
            'content' => '[{"title":"测试案例666测试案例666测试案例666","mediaId":"' . $mediaId . '"}]',
            'vertical_cover_images' => '[{"src":"http://baijiahao.baidu.com/bjh/picproxy?param=iZoYn6y%2FcDdO8oFpULkJeMTx58xMPmxNv%2BFpiKFJ2f%2F2y0QyEKZUroZnhy%2B4FFukFmVXHwch2mcwrT9EAjbAYIRXYwXe9VCFNCJyOU6%2BDHLmHdrrcNfXUdHkMXr3EWzJrn2MLiwkvl3Ro2QyMNIG1OFa7OAytZx3tkjI0%2BKMD2PUha8hUDlRBg%3D%3D"}]',
            'size' => $size,
            'cover_layout' => 'one',
            'width_in_pixel' => 540,
            'height_in_pixel' => 960,
            'cover_source' => 'upload',
            'auto_mount_goods' => 1,
            'loadComplete' => true,
            'fe_from' => 'BJH_CMS_PC',
            'cover_images' => '[{"src":"http://baijiahao.baidu.com/bjh/picproxy?param=iZoYn6y%2FcDdO8oFpULkJeMTx58xMPmxNv%2BFpiKFJ2f%2F2y0QyEKZUroZnhy%2B4FFukFmVXHwch2mc7o%2FYNE7MaPtQCIYHa%2Bz1lcS%2BS0396o7JqNy%2F36%2Bq2e3%2ByNB3dGMwOsNCk9TyQb6DR%2F3udpbywDA%3D%3D"}]',
            '_cover_images_map' => '[{"src":"http://baijiahao.baidu.com/bjh/picproxy?param=iZoYn6y%2FcDdO8oFpULkJeMTx58xMPmxNv%2BFpiKFJ2f%2F2y0QyEKZUroZnhy%2B4FFukFmVXHwch2mc7o%2FYNE7MaPtQCIYHa%2Bz1lcS%2BS0396o7JqNy%2F36%2Bq2e3%2ByNB3dGMwOsNCk9TyQb6DR%2F3udpbywDA%3D%3D"}]',
        ];
        $data = http_build_query($dataA);
        $method = 'POST';
        $re = getThirdApi($url, $method, $headerArray, $data);
        /*
         * {
        "message": "ok",
        "code": 200,
        "data": {
        "errno": 0,
        "errmsg": "success",
        "data": null,
        "request_id": "1530927094",
        "ret": {
        "errno": "0",
        "meta_id": "4636135227897512760",
        "is_transfer": "3",
        "media_type": "3",
        "user_type": "bjh",
        "nid": "4636135227897512760",
        "is_repeat": false,
        "dt_id": "4636135227897512760",
        "vid": "4636135227897512760",
        "cover_img": "https://pic.rmb.bdstatic.com/bjh/video/e9db255fb886e7a5c3cc39662a8cebac.jpeg",
        "video_url": "https://vdlt.bdstatic.com/vod-gechgi84v43uhfhp/mda-njcbaedqif8zr4kk.mp4",
        "duration": "4",
        "height_in_pixel": "1280",
        "width_in_pixel": "1280"
        },
        "ie": "utf-8"
        }
        }*/
        return $re;
    }

    //百家号数据
    if ($type == 16) {
        $url = 'https://baijiahao.baidu.com/author/eco/statistics/articleDailyListStatistic';
        $headerArray = ['Content-Type:' . "application/json", 'cookie:' . $cookie, 'token:' . $token];
        $method = 'GET';
        $dataA = [
            'article_id' => '2900283358538057732',
            'start_day' => '20221020',
            'end_day' => '20221020',
            'type' => 'small_video_v2',
        ];
        $url .= '?' . http_build_query($dataA);
        $re = getThirdApi($url, $method, $headerArray);
        return $re;
        /*{
    "errno": 0,
    "errmsg": "success",
    "data": {
    "list": [
    {
    "recommend_count": -1,推荐
    "comment_count": -1,评论
    "view_count": -1,浏览
    "complete_rate": -1,
    "likes_count": -1,点赞
    "collect_count": -1,收藏
    "share_count": -1,分享
    "fans_increase": -1,
    "fans_likes_count": -1,
    "fans_comment_count": -1,
    "fans_share_count": -1,
    "fans_view_count": -1,
    "search_show": -1,
    "event_day": "20221020"
    }
    ],
    "chart": [
    {
    "recommend_count": -1,
    "comment_count": -1,
    "view_count": -1,
    "complete_rate": -1,
    "likes_count": -1,
    "collect_count": -1,
    "share_count": -1,
    "fans_increase": -1,
    "fans_likes_count": -1,
    "fans_comment_count": -1,
    "fans_share_count": -1,
    "fans_view_count": -1,
    "search_show": -1,
    "event_day": "20221020"
    }
    ]
    }
    }*/
    }
}


$res = test(8);
print_r($res);
