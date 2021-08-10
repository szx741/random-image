<?php
error_reporting(E_ERROR);

/**
 * 遍历获取目录下的指定类型的文件
 * @param $path
 * @param array $files
 * @return array
 */
function getfiles($path, $allowFiles, &$files = array())
{
    if (!is_dir($path)) {
        return null;
    }

    if (substr($path, strlen($path) - 1) != '/') {
        $path .= '/';
    }

    $handle = opendir($path);
    while (false !== ($file = readdir($handle))) {
        if ($file != '.' && $file != '..') {
            $path2 = $path . $file;
            if (is_dir($path2)) {
                getfiles($path2, $allowFiles, $files);
            } else {
                if (preg_match("/\.(" . $allowFiles . ")$/i", $file)) {
                    $files[] = substr($path2, strlen($_SERVER['DOCUMENT_ROOT']));
                }
            }
        }
    }
    return $files;
}

function random_get_pic()
{
    //指定目录
    $base_Path = '/wp-content/random-image/picture/'; //默认主目录
    $category = 'a'; //默认分类目录
    //列出指定目录下的图片
    $allowFiles = array(".png", ".jpg", ".jpeg", ".gif", ".bmp", ".webp");
    $path = $base_Path . $category . '/';

    $allowFiles = substr(str_replace(".", "|", join("", $allowFiles)), 1);

    //获取文件列表
    $path = $_SERVER['DOCUMENT_ROOT'] . (substr($path, 0, 1) == "/" ? "" : "/") . $path;
    $files = getfiles($path, $allowFiles);
    if (!count(array($path))) {
        return "抱歉，没有找到匹配的文件！";
    }

    //获取指定范围的列表
    $len = count($files);
    for ($i = 0, $list = array(); $i < $len; $i++) {
        $list[] = $files[$i];
    }

    $rand = array_rand($list, 1);
    $img = $list[$rand];
    
    // 返回随机图片的URL
    return 'https://' . $_SERVER['HTTP_HOST'] . $img;
    die;

}
random_get_pic();
