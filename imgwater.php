<?php
$_G = [
    'setting' => [
        'imagelib' => 1, //图片处理库类型:0-GD，1-ImageMagick
        'imageimpath' => '',
        'attachdir' => 'D:/webSite/HelloWorld',//本地附件保存位置:服务器路径，属性 777，必须为 web 可访问到的目录，结尾不加 "/"，相对目录务必以 "./" 开头
        'thumbquality' => 100,//缩略图质量: 设置图片附件缩略图的质量参数，范围为 0～100 的整数，数值越大结果图片效果越好，但尺寸也越大
        'watermarkstatus' => 9,
        'watermarkminwidth' => 0,
        'watermarkminheight' => 0,
        'watermarktype' => "text",
        'watermarktext' => [
            "text" => "61626364656667",
            "fontpath" => "D:\webSite\HelloWorld\image/PilsenPlakat.ttf",
            "size" => "26",
            "angle" => "0",
            "color" => "#ffddcc",
            "shadowx" => "10",
            "shadowy" => "10",
            "shadowcolor" => "#ff0000",
            "translatex" => "15",
            "translatey" => "15",
            "skewx" => "5",
            "skewy" => "5",
        ],
        'watermarktrans' => 50,
        'watermarkquality' => 90,
    ],
];

function dunserialize($data)
{
    if (($ret = unserialize($data)) === false) {
        $ret = unserialize(stripslashes($data));
    }
    return $ret;
}

function getimgthumbname($fileStr, $extend = '.thumb.jpg', $holdOldExt = true)
{
    if (empty($fileStr)) {
        return '';
    }
    if (!$holdOldExt) {
        $fileStr = substr($fileStr, 0, strrpos($fileStr, '.'));
    }
    $extend = strstr($extend, '.') ? $extend : '.' . $extend;
    return $fileStr . $extend;
}

function dmkdir($dir, $mode = 0777, $makeindex = true)
{
    if (!is_dir($dir)) {
        dmkdir(dirname($dir), $mode, $makeindex);
        @mkdir($dir, $mode);
        if (!empty($makeindex)) {
            @touch($dir . '/index.html');@chmod($dir . '/index.html', 0777);
        }
    }
    return true;
}
class image
{
    public $source = '';
    public $target = '';
    public $imginfo = [];
    public $imagecreatefromfunc = '';
    public $imagefunc = '';
    public $tmpfile = '';
    public $libmethod = 0;
    public $param = [];
    public $errorcode = 0;

    public $extension = [];

    public function __construct()
    {
        global $_G;

        $this->extension['gd'] = extension_loaded('gd');
        $this->extension['imagick'] = extension_loaded('imagick');
        //var_dump($this->extension['imagick']);

        $this->param = array(
            'imagelib' => $_G['setting']['imagelib'],
            'imageimpath' => $_G['setting']['imageimpath'],
            'thumbquality' => $_G['setting']['thumbquality'],
            'watermarkstatus' => $_G['setting']['watermarkstatus'],
            'watermarkminwidth' => $_G['setting']['watermarkminwidth'],
            'watermarkminheight' => $_G['setting']['watermarkminheight'],
            'watermarktype' => $_G['setting']['watermarktype'],
            'watermarktext' => $_G['setting']['watermarktext'],
            'watermarktrans' => $_G['setting']['watermarktrans'],
            'watermarkquality' => $_G['setting']['watermarkquality'],
        );
    }

    public function Thumb($source, $target, $thumbwidth, $thumbheight, $thumbtype = 1, $nosuffix = 0)
    {
        $return = $this->init('thumb', $source, $target, $nosuffix);
        if ($return <= 0) {
            return $this->returncode($return);
        }

        if ($this->imginfo['animated']) {
            return $this->returncode(0);
        }
        $this->param['thumbwidth'] = intval($thumbwidth);
        if (!$thumbheight || $thumbheight > $this->imginfo['height']) {
            $thumbheight = $thumbwidth > $this->imginfo['width'] ? $this->imginfo['height'] : $this->imginfo['height'] * ($thumbwidth / $this->imginfo['width']);
        }
        $this->param['thumbheight'] = intval($thumbheight);
        $this->param['thumbtype'] = $thumbtype;
        if ($thumbwidth < 100 && $thumbheight < 100) {
            $this->param['thumbquality'] = 100;
        }

        $return = !$this->libmethod ? $this->Thumb_GD() : $this->Thumb_IM();
        $return = !$nosuffix ? $return : 0;

        return $this->sleep($return);
    }

    public function Cropper($source, $target, $dstwidth, $dstheight, $srcx = 0, $srcy = 0, $srcwidth = 0, $srcheight = 0)
    {

        $return = $this->init('thumb', $source, $target, 1);
        if ($return <= 0) {
            return $this->returncode($return);
        }
        if ($dstwidth < 0 || $dstheight < 0) {
            return $this->returncode(false);
        }
        $this->param['dstwidth'] = intval($dstwidth);
        $this->param['dstheight'] = intval($dstheight);
        $this->param['srcx'] = intval($srcx);
        $this->param['srcy'] = intval($srcy);
        $this->param['srcwidth'] = intval($srcwidth ? $srcwidth : $dstwidth);
        $this->param['srcheight'] = intval($srcheight ? $srcheight : $dstheight);

        $return = !$this->libmethod ? $this->Cropper_GD() : $this->Cropper_IM();
    }

    public function Watermark($source, $target = '')
    {
        $return = $this->init('watermask', $source, $target);
        // print_r($return);
        if ($return <= 0) {
            return $this->returncode($return);
        }

        if (!$this->param['watermarkstatus'] || ($this->param['watermarkminwidth'] && $this->imginfo['width'] <= $this->param['watermarkminwidth'] && $this->param['watermarkminheight'] && $this->imginfo['height'] <= $this->param['watermarkminheight'])) {
            return $this->returncode(0);
        }
        $this->param['watermarkfile'] = './image/' . ($this->param['watermarktype'] == 'png' ? 'watermark.png' : 'watermark.gif');
        // print_r($this->param);
        if (!is_readable($this->param['watermarkfile']) || ($this->param['watermarktype'] == 'text' && (!file_exists($this->param['watermarktext']['fontpath']) || !is_file($this->param['watermarktext']['fontpath'])))) {
            var_dump([
                !is_readable($this->param['watermarkfile']),
                ($this->param['watermarktype'] == 'text' && (!file_exists($this->param['watermarktext']['fontpath']) || !is_file($this->param['watermarktext']['fontpath']))),
            ]);
            return $this->returncode(-3);
        }

        // print_r($this->libmethod);
        $return = !$this->libmethod ? $this->Watermark_GD() : $this->Watermark_IM();

        return $this->sleep($return);
    }

    public function error()
    {
        return $this->errorcode;
    }

    public function init($method, $source, $target, $nosuffix = 0)
    {
        global $_G;

        $this->errorcode = 0;
        if (empty($source)) {
            return -2;
        }
        $parse = parse_url($source);
        if (isset($parse['host'])) {
            if (empty($target)) {
                return -2;
            }
            $data = file_get_contents($source); //dfsockopen($source);
            $this->tmpfile = $source = tempnam($_G['setting']['attachdir'] . './temp/', 'tmpimg_');
            if (!$data || $source === false) {
                return -2;
            }
            file_put_contents($source, $data);
        }
        if ($method == 'thumb') {
            $target = empty($target) ? (!$nosuffix ? getimgthumbname($source) : $source) : $_G['setting']['attachdir'] . './' . $target;
        } elseif ($method == 'watermask') {
            $target = empty($target) ? $source : $_G['setting']['attachdir'] . './' . $target;
        }
        $targetpath = dirname($target);
        dmkdir($targetpath);

        clearstatcache();
        if (!is_readable($source) || !is_writable($targetpath)) {
            return -2;
        }

        $imginfo = @getimagesize($source);
        if ($imginfo === false) {
            return -1;
        }

        $this->source = $source;
        $this->target = $target;
        $this->imginfo['width'] = $imginfo[0];
        $this->imginfo['height'] = $imginfo[1];
        $this->imginfo['mime'] = $imginfo['mime'];
        $this->imginfo['size'] = @filesize($source);
        $this->libmethod = $this->param['imagelib'];
        if (!$this->param['imagelib'] && $this->extension['gd']) {
            $this->libmethod = 0;
        } elseif ($this->param['imagelib'] && $this->extension['imagick']) {
            $this->libmethod = 1;
        } else {
            return -4;
        }

        if (!$this->libmethod) {
            switch ($this->imginfo['mime']) {
                case 'image/jpeg':
                    $this->imagecreatefromfunc = function_exists('imagecreatefromjpeg') ? 'imagecreatefromjpeg' : '';
                    $this->imagefunc = function_exists('imagejpeg') ? 'imagejpeg' : '';
                    break;
                case 'image/gif':
                    $this->imagecreatefromfunc = function_exists('imagecreatefromgif') ? 'imagecreatefromgif' : '';
                    $this->imagefunc = function_exists('imagegif') ? 'imagegif' : '';
                    break;
                case 'image/png':
                    $this->imagecreatefromfunc = function_exists('imagecreatefrompng') ? 'imagecreatefrompng' : '';
                    $this->imagefunc = function_exists('imagepng') ? 'imagepng' : '';
                    break;
                case 'image/webp':
                    $this->imagecreatefromfunc = function_exists('imagecreatefromwebp') ? 'imagecreatefromwebp' : '';
                    $this->imagefunc = function_exists('imagewebp') ? 'imagewebp' : '';
                    break;
            }
        } else {
            $this->imagecreatefromfunc = $this->imagefunc = true;
        }

        if (!$this->libmethod && $this->imginfo['mime'] == 'image/gif') {
            if (!$this->imagecreatefromfunc) {
                return -4;
            }
            if (!($fp = @fopen($source, 'rb'))) {
                return -2;
            }
            $content = fread($fp, $this->imginfo['size']);
            fclose($fp);
            $this->imginfo['animated'] = strpos($content, 'NETSCAPE2.0') === false ? 0 : 1;
        } elseif (!$this->libmethod && $this->imginfo['mime'] == 'image/webp') {
            if (!$this->imagecreatefromfunc) {
                return -4;
            }
            if (!($fp = @fopen($source, 'rb'))) {
                return -2;
            }
            $content = fread($fp, 40);
            fclose($fp);
            if (stripos($content, 'WEBPVP8X') !== false || stripos($content, 'ANIM') !== false) {
                $this->imginfo['animated'] = 1;
            } else {
                $this->imginfo['animated'] = 0;
            }
        } else {
            $this->imginfo['animated'] = 0;
        }

        return $this->imagecreatefromfunc ? 1 : -4;
    }

    public function sleep($return)
    {
        if ($this->tmpfile) {
            @unlink($this->tmpfile);
        }
        $this->imginfo['size'] = @filesize($this->target);
        return $this->returncode($return);
    }

    public function returncode($return)
    {
        if ($return > 0 && file_exists($this->target)) {
            return true;
        } else {
            if ($this->tmpfile) {
                @unlink($this->tmpfile);
            }
            $this->errorcode = $return;
            return false;
        }
    }

    public function sizevalue($method)
    {
        $x = $y = $w = $h = 0;
        if ($method > 0) {
            $imgratio = $this->imginfo['width'] / $this->imginfo['height'];
            $thumbratio = $this->param['thumbwidth'] / $this->param['thumbheight'];
            if ($imgratio >= 1 && $imgratio >= $thumbratio || $imgratio < 1 && $imgratio > $thumbratio) {
                $h = $this->imginfo['height'];
                $w = $h * $thumbratio;
                $x = ($this->imginfo['width'] - $thumbratio * $this->imginfo['height']) / 2;
            } elseif ($imgratio >= 1 && $imgratio <= $thumbratio || $imgratio < 1 && $imgratio <= $thumbratio) {
                $w = $this->imginfo['width'];
                $h = $w / $thumbratio;
            }
        } else {
            $x_ratio = $this->param['thumbwidth'] / $this->imginfo['width'];
            $y_ratio = $this->param['thumbheight'] / $this->imginfo['height'];
            if (($x_ratio * $this->imginfo['height']) < $this->param['thumbheight']) {
                $h = ceil($x_ratio * $this->imginfo['height']);
                $w = $this->param['thumbwidth'];
            } else {
                $w = ceil($y_ratio * $this->imginfo['width']);
                $h = $this->param['thumbheight'];
            }
        }
        return array($x, $y, $w, $h);
    }

    public function loadsource()
    {
        $imagecreatefromfunc = &$this->imagecreatefromfunc;
        $im = @$imagecreatefromfunc($this->source);
        if (!$im) {
            if (!function_exists('imagecreatefromstring')) {
                return -4;
            }
            $fp = @fopen($this->source, 'rb');
            $contents = @fread($fp, filesize($this->source));
            fclose($fp);
            $im = @imagecreatefromstring($contents);
            if ($im == false) {
                return -1;
            }
        }
        return $im;
    }

    public function Thumb_GD()
    {
        if (!function_exists('imagecreatetruecolor') || !function_exists('imagecopyresampled') || !function_exists('imagejpeg') || !function_exists('imagecopymerge')) {
            return -4;
        }

        $imagefunc = &$this->imagefunc;
        $attach_photo = $this->loadsource();
        if ($attach_photo < 0) {
            return $attach_photo;
        }
        if ($this->imginfo['mime'] != 'image/png') {
            $copy_photo = imagecreatetruecolor($this->imginfo['width'], $this->imginfo['height']);
            imagecopy($copy_photo, $attach_photo, 0, 0, 0, 0, $this->imginfo['width'], $this->imginfo['height']);
            $attach_photo = $copy_photo;
        }

        $thumb_photo = null;
        switch ($this->param['thumbtype']) {
            case 'fixnone':
            case 1:
                if ($this->imginfo['width'] >= $this->param['thumbwidth'] || $this->imginfo['height'] >= $this->param['thumbheight']) {
                    $thumb = [];
                    list(, , $thumb['width'], $thumb['height']) = $this->sizevalue(0);
                    $cx = $this->imginfo['width'];
                    $cy = $this->imginfo['height'];
                    $thumb_photo = imagecreatetruecolor($thumb['width'], $thumb['height']);
                    if ($this->imginfo['mime'] == 'image/png') {
                        imagealphablending($thumb_photo, false);
                        imagesavealpha($thumb_photo, true);
                    }
                    imagecopyresampled($thumb_photo, $attach_photo, 0, 0, 0, 0, $thumb['width'], $thumb['height'], $cx, $cy);
                }
                break;
            case 'fixwr':
            case 2:
                if (!($this->imginfo['width'] <= $this->param['thumbwidth'] || $this->imginfo['height'] <= $this->param['thumbheight'])) {
                    list($startx, $starty, $cutw, $cuth) = $this->sizevalue(1);
                    $dst_photo = imagecreatetruecolor($cutw, $cuth);
                    imagecopymerge($dst_photo, $attach_photo, 0, 0, $startx, $starty, $cutw, $cuth, 100);
                    $thumb_photo = imagecreatetruecolor($this->param['thumbwidth'], $this->param['thumbheight']);
                    if ($this->imginfo['mime'] == 'image/png') {
                        imagealphablending($thumb_photo, false);
                        imagesavealpha($thumb_photo, true);
                    }
                    imagecopyresampled($thumb_photo, $dst_photo, 0, 0, 0, 0, $this->param['thumbwidth'], $this->param['thumbheight'], $cutw, $cuth);
                } else {
                    $thumb_photo = imagecreatetruecolor($this->param['thumbwidth'], $this->param['thumbheight']);
                    if ($this->imginfo['mime'] == 'image/png') {
                        imagealphablending($thumb_photo, false);
                        imagesavealpha($thumb_photo, true);
                    }
                    $bgcolor = imagecolorallocate($thumb_photo, 255, 255, 255);
                    imagefill($thumb_photo, 0, 0, $bgcolor);
                    $startx = ($this->param['thumbwidth'] - $this->imginfo['width']) / 2;
                    $starty = ($this->param['thumbheight'] - $this->imginfo['height']) / 2;
                    imagecopymerge($thumb_photo, $attach_photo, $startx, $starty, 0, 0, $this->imginfo['width'], $this->imginfo['height'], 100);
                }
                break;
        }
        clearstatcache();
        if ($thumb_photo) {
            if ($this->imginfo['mime'] == 'image/jpeg') {
                @$imagefunc($thumb_photo, $this->target, $this->param['thumbquality']);
            } else {
                @$imagefunc($thumb_photo, $this->target);
            }
            return 1;
        } else {
            return 0;
        }
    }

    public function Thumb_IM()
    {
        if ($this->imginfo['mime'] == 'image/gif') {
            return 1;
        }
        switch ($this->param['thumbtype']) {
            case 'fixnone':
            case 1:
                if ($this->imginfo['width'] >= $this->param['thumbwidth'] || $this->imginfo['height'] >= $this->param['thumbheight']) {
                    $im = new Imagick();
                    $im->readImage(realpath($this->source));
                    $im->setImageCompressionQuality($this->param['thumbquality']);
                    $im->thumbnailImage($this->param['thumbwidth'], $this->param['thumbheight'], true);
                    if (!$im->writeImage($this->target)) {
                        $im->destroy();
                        return -3;
                    }
                    $im->destroy();
                }
                break;
            case 'fixwr':
            case 2:
                if (!($this->imginfo['width'] <= $this->param['thumbwidth'] || $this->imginfo['height'] <= $this->param['thumbheight'])) {
                    list($startx, $starty, $cutw, $cuth) = $this->sizevalue(1);
                    $im = new Imagick();
                    $im->readImage(realpath($this->source));
                    $im->setImageCompressionQuality($this->param['thumbquality']);
                    $im->cropImage($cutw, $cuth, $startx, $starty);
                    if (!$im->writeImage($this->target)) {
                        $im->destroy();
                        return -3;
                    }

                    $im->readImage(realpath($this->target));
                    $im->setImageCompressionQuality($this->param['thumbquality']);
                    $im->thumbnailImage($this->param['thumbwidth'], $this->param['thumbheight']);
                    $im->resizeImage($this->param['thumbwidth'], $this->param['thumbheight'], imagick::FILTER_LANCZOS, 1, true);
                    $im->setGravity(imagick::GRAVITY_CENTER);
                    $im->extentImage($this->param['thumbwidth'], $this->param['thumbheight'], 0, 0);

                    if (!$im->writeImage($this->target)) {
                        $im->destroy();
                        return -3;
                    }
                    $im->destroy();
                } else {
                    $startx = -($this->param['thumbwidth'] - $this->imginfo['width']) / 2;
                    $starty = -($this->param['thumbheight'] - $this->imginfo['height']) / 2;

                    $im = new Imagick();
                    $im->readImage(realpath($this->source));
                    $im->setImageCompressionQuality($this->param['thumbquality']);
                    $im->cropImage($this->param['thumbwidth'], $this->param['thumbheight'], $startx, $starty);
                    if (!$im->writeImage($this->target)) {
                        $im->destroy();
                        return -3;
                    }

                    $im->readImage(realpath($this->target));
                    $im->setImageCompressionQuality($this->param['thumbquality']);
                    $im->thumbnailImage($this->param['thumbwidth'], $this->param['thumbheight']);
                    $im->setGravity(imagick::GRAVITY_CENTER);
                    $im->extentImage($this->param['thumbwidth'], $this->param['thumbheight'], 0, 0);
                    if (!$im->writeImage($this->target)) {
                        $im->destroy();
                        return -3;
                    }
                    $im->destroy();
                }
                break;
        }
        return 1;
    }

    public function Cropper_GD()
    {
        $image = $this->loadsource();
        if ($image < 0) {
            return $image;
        }
        $newimage = imagecreatetruecolor($this->param['dstwidth'], $this->param['dstheight']);
        imagecopyresampled($newimage, $image, 0, 0, $this->param['srcx'], $this->param['srcy'], $this->param['dstwidth'], $this->param['dstheight'], $this->param['srcwidth'], $this->param['srcheight']);
        ImageJpeg($newimage, $this->target, 100);
        imagedestroy($newimage);
        imagedestroy($image);
        return true;
    }
    public function Cropper_IM()
    {
        $im = new Imagick();
        $im->readImage(realpath($this->source));
        $im->cropImage($this->param['srcwidth'], $this->param['srcheight'], $this->param['srcx'], $this->param['srcy']);
        $im->thumbnailImage($this->param['dstwidth'], $this->param['dstheight']);

        $result = $im->writeImage($this->target);
        $im->destroy();
        if (!$result) {
            return -3;
        }
    }

    public function Watermark_GD()
    {
        if (!function_exists('imagecreatetruecolor')) {
            return -4;
        }

        $imagefunc = &$this->imagefunc;

        if ($this->param['watermarktype'] != 'text') {
            if (!function_exists('imagecopy') || !function_exists('imagecreatefrompng') || !function_exists('imagecreatefromgif') || !function_exists('imagealphablending') || !function_exists('imagecopymerge')) {
                return -4;
            }
            $watermarkinfo = @getimagesize($this->param['watermarkfile']);
            if ($watermarkinfo === false) {
                return -3;
            }
            $watermark_logo = $this->param['watermarktype'] == 'png' ? @imageCreateFromPNG($this->param['watermarkfile']) : @imageCreateFromGIF($this->param['watermarkfile']);
            if (!$watermark_logo) {
                return 0;
            }
            list($logo_w, $logo_h) = $watermarkinfo;
        } else {
            if (!function_exists('imagettfbbox') || !function_exists('imagettftext') || !function_exists('imagecolorallocate')) {
                return -4;
            }
            if (!class_exists('Chinese')) {
                include "Chinese.php";
            }

            $watermarktextcvt = pack("H*", $this->param['watermarktext']['text']);
            $box = imagettfbbox(floatval($this->param['watermarktext']['size']), floatval($this->param['watermarktext']['angle']), $this->param['watermarktext']['fontpath'], $watermarktextcvt);
            $logo_h = max($box[1], $box[3]) - min($box[5], $box[7]);
            $logo_w = max($box[2], $box[4]) - min($box[0], $box[6]);
            $ax = min($box[0], $box[6]) * -1;
            $ay = min($box[5], $box[7]) * -1;
        }
        $wmwidth = $this->imginfo['width'] - $logo_w;
        $wmheight = $this->imginfo['height'] - $logo_h;

        if ($wmwidth > 10 && $wmheight > 10 && !$this->imginfo['animated']) {
            switch ($this->param['watermarkstatus']) {
                case 1:
                    $x = 5;
                    $y = 5;
                    break;
                case 2:
                    $x = ($this->imginfo['width'] - $logo_w) / 2;
                    $y = 5;
                    break;
                case 3:
                    $x = $this->imginfo['width'] - $logo_w - 5;
                    $y = 5;
                    break;
                case 4:
                    $x = 5;
                    $y = ($this->imginfo['height'] - $logo_h) / 2;
                    break;
                case 5:
                    $x = ($this->imginfo['width'] - $logo_w) / 2;
                    $y = ($this->imginfo['height'] - $logo_h) / 2;
                    break;
                case 6:
                    $x = $this->imginfo['width'] - $logo_w;
                    $y = ($this->imginfo['height'] - $logo_h) / 2;
                    break;
                case 7:
                    $x = 5;
                    $y = $this->imginfo['height'] - $logo_h - 5;
                    break;
                case 8:
                    $x = ($this->imginfo['width'] - $logo_w) / 2;
                    $y = $this->imginfo['height'] - $logo_h - 5;
                    break;
                case 9:
                    $x = $this->imginfo['width'] - $logo_w - 5;
                    $y = $this->imginfo['height'] - $logo_h - 5;
                    break;
            }
            if ($this->imginfo['mime'] != 'image/png') {
                $color_photo = imagecreatetruecolor($this->imginfo['width'], $this->imginfo['height']);
            }
            $dst_photo = $this->loadsource();
            if ($dst_photo < 0) {
                return $dst_photo;
            }
            imagealphablending($dst_photo, true);
            imagesavealpha($dst_photo, true);
            if ($this->imginfo['mime'] != 'image/png') {
                imageCopy($color_photo, $dst_photo, 0, 0, 0, 0, $this->imginfo['width'], $this->imginfo['height']);
                $dst_photo = $color_photo;
            }
            if ($this->param['watermarktype'] == 'png') {
                imageCopy($dst_photo, $watermark_logo, $x, $y, 0, 0, $logo_w, $logo_h);
            } elseif ($this->param['watermarktype'] == 'text') {
                if (($this->param['watermarktext']['shadowx'] || $this->param['watermarktext']['shadowy']) && $this->param['watermarktext']['shadowcolor']) {
                    $shadowcolorrgb = explode(',', $this->param['watermarktext']['shadowcolor']);
                    $shadowcolor = imagecolorallocate($dst_photo, intval($shadowcolorrgb[0]), intval($shadowcolorrgb[1]), intval($shadowcolorrgb[2]));
                    imagettftext($dst_photo, floatval($this->param['watermarktext']['size']), $this->param['watermarktext']['angle'], $x + $ax + $this->param['watermarktext']['shadowx'], $y + $ay + $this->param['watermarktext']['shadowy'], $shadowcolor, $this->param['watermarktext']['fontpath'], $watermarktextcvt);
                }

                $colorrgb = explode(',', $this->param['watermarktext']['color']);
                $color = imagecolorallocate($dst_photo, intval($colorrgb[0]), intval($colorrgb[1]), intval($colorrgb[2]));
                imagettftext($dst_photo, floatval($this->param['watermarktext']['size']), $this->param['watermarktext']['angle'], $x + $ax, $y + $ay, $color, $this->param['watermarktext']['fontpath'], $watermarktextcvt);
            } else {
                imageAlphaBlending($watermark_logo, true);
                imageCopyMerge($dst_photo, $watermark_logo, $x, $y, 0, 0, $logo_w, $logo_h, $this->param['watermarktrans']);
            }

            clearstatcache();
            if ($this->imginfo['mime'] == 'image/jpeg') {
                @$imagefunc($dst_photo, $this->target, $this->param['watermarkquality']);
            } else {
                @$imagefunc($dst_photo, $this->target);
            }
        }
        return 1;
    }

    public function Watermark_IM()
    {
        switch ($this->param['watermarkstatus']) {
            case 1:
                $gravity = imagick::GRAVITY_NORTHWEST;
                break;
            case 2:
                $gravity = imagick::GRAVITY_NORTH;
                break;
            case 3:
                $gravity = imagick::GRAVITY_NORTHEAST;
                break;
            case 4:
                $gravity = imagick::GRAVITY_WEST;
                break;
            case 5:
                $gravity = imagick::GRAVITY_CENTER;
                break;
            case 6:
                $gravity = imagick::GRAVITY_EAST;
                break;
            case 7:
                $gravity = imagick::GRAVITY_SOUTHWEST;
                break;
            case 8:
                $gravity = imagick::GRAVITY_SOUTH;
                break;
            case 9:
                $gravity = imagick::GRAVITY_SOUTHEAST;
                break;
        }

        if ($this->param['watermarktype'] != 'text') {
            $watermark = new Imagick(realpath($this->param['watermarkfile']));
            if ($this->param['watermarktype'] != 'png' && $this->param['watermarktrans'] != '100') {
                $watermark->setImageOpacity($this->param['watermarktrans']);
            }
            if ($this->imginfo['mime'] == 'image/gif') {
                return 0;
            }

            $canvas = new Imagick(realpath($this->source));
            $canvas->setImageCompressionQuality($this->param['watermarkquality']);

            $dw = new ImagickDraw();
            $dw->setGravity($gravity);
            $dw->composite($watermark->getImageCompose(), 0, 0, 0, 0, $watermark);
            $canvas->drawImage($dw);

            $result = $canvas->writeImage($this->target);
            $watermark->destroy();
            $canvas->destroy();
            $dw->destroy();

            if (!$result) {
                return -3;
            }
        } else {
            $watermarktextcvt = escapeshellcmd(pack("H*", $this->param['watermarktext']['text']));
            $angle = $this->param['watermarktext']['angle'];
            $translate = $this->param['watermarktext']['translatex'] || $this->param['watermarktext']['translatey'] ? ' translate ' . intval($this->param['watermarktext']['translatex']) . ',' . intval($this->param['watermarktext']['translatey']) : '';
            $skewX = $this->param['watermarktext']['skewx'] ? ' skewX ' . intval($this->param['watermarktext']['skewx']) : '';
            $skewY = $this->param['watermarktext']['skewy'] ? ' skewY ' . intval($this->param['watermarktext']['skewy']) : '';

            $canvas = new Imagick(realpath($this->source));
            $canvas->setImageCompressionQuality($this->param['watermarkquality']);

            $dw = new ImagickDraw();
            $dw->setFont($this->param['watermarktext']['fontpath']);
            $dw->setFontSize($this->param['watermarktext']['size']);

            if (($this->param['watermarktext']['shadowx'] || $this->param['watermarktext']['shadowy']) && $this->param['watermarktext']['shadowcolor']) {
                $dw->setFillColor(new ImagickPixel($this->param['watermarktext']['shadowcolor']));
                $dw->setGravity($gravity);
                if ($translate) {
                    $dw->translate($this->param['watermarktext']['translatex'], $this->param['watermarktext']['translatey']);
                }
                if ($skewX) {
                    $dw->skewX($this->param['watermarktext']['skewx']);
                }
                if ($skewY) {
                    $dw->skewY($this->param['watermarktext']['skewy']);
                }
                $dw->annotation($this->param['watermarktext']['shadowx'], $this->param['watermarktext']['shadowy'], escapeshellcmd(pack("H*", $this->param['watermarktext']['text'])));
                $canvas->drawImage($dw);

            }

            $dw->setFillColor(new ImagickPixel($this->param['watermarktext']['color']));
            $dw->setGravity($gravity);
            if ($translate) {
                $dw->translate($this->param['watermarktext']['translatex'], $this->param['watermarktext']['translatey']);
            }
            if ($skewX) {
                $dw->skewX($this->param['watermarktext']['skewx']);
            }
            if ($skewY) {
                $dw->skewY($this->param['watermarktext']['skewy']);
            }
            $dw->rotate($angle);
            $dw->annotation(0, 0, escapeshellcmd(pack("H*", $this->param['watermarktext']['text'])));

            $canvas->drawImage($dw);

            $result = $canvas->writeImage($this->target);
            $canvas->destroy();
            $dw->destroy();
            if (!$result) {
                return -3;
            }
        }
        return 1;
    }

    public function IM_filter($str)
    {
        return escapeshellarg(str_replace(' ', '', $str));
    }

}

$image = new image;
if (!($r = $image->Watermark('./image/banner04.jpg', './image/temp/watermark_temp3.jpg'))) {
    $r = $image->error();
}
