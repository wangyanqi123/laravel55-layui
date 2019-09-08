<?php
require_once __DIR__ . '/../autoload.php';
use Qiniu\Auth;
require_once 'Qiniu/Auth.php';
require_once 'Qiniu/Storage/UploadManager.php';
// 引入上传类
use Qiniu\Storage\UploadManager;
$accessKey = 'F_81SWGKVFcZiCU1iZC9mppV4q99plLXWo78kX_9';
$secretKey = 'ksas8GWkoq-w1Nw7c3kG378-WnY-CYYGFuH0bDvg';
// 初始化签权对象。
$auth = new Auth($accessKey, $secretKey);
$bucket = "空间名字";
$upToken = $auth->uploadToken($bucket);
// 初始化 UploadManager 对象并进行文件的上传。
$uploadMgr = new UploadManager();
$key = $_POST['name'];
$filePath = $_POST['image'];
list($ret, $err) = $uploadMgr->putFile($upToken, $key, $filePath);
if ($err !== null) {
    echo json_encode($err);
} else {
    echo json_encode($ret);
}
