<?php

namespace App\Http\Controllers;

use App\Traits\Msg;
use Illuminate\Http\Request;
use zgldh\QiniuStorage\QiniuStorage;

class PublicController extends Controller
{
    use Msg;

    //图片上传处理
    public function uploadImg(Request $request)
    {

        //上传文件最大大小,单位M
        $maxSize = 10;
        //支持的上传图片类型
        $allowed_extensions = ["png", "jpg", "gif"];
        //返回信息json
        $data = ['code' => 200, 'msg' => '上传失败', 'data' => ''];
        $file = $request->file('file');

        //检查文件是否上传完成
        if ($file->isValid()) {
            //检测图片类型
            $ext = $file->getClientOriginalExtension();
            if (!in_array(strtolower($ext), $allowed_extensions)) {
                $data['msg'] = "请上传" . implode(",", $allowed_extensions) . "格式的图片";
                return response()->json($data);
            }
            //检测图片大小
            if ($file->getClientSize() > $maxSize * 1024 * 1024) {
                $data['msg'] = "图片大小限制" . $maxSize . "M";
                return response()->json($data);
            }
        } else {
            $data['msg'] = $file->getErrorMessage();
            return response()->json($data);
        }
        $newFile = date('Y-m-d') . "_" . time() . "_" . uniqid() . "." . $file->getClientOriginalExtension();
        $disk = QiniuStorage::disk('qiniu');
        $res = $disk->put($newFile, file_get_contents($file->getRealPath()));
        if ($res) {
            $data = [
                'code' => 0,
                'msg' => '上传成功',
                'data' => $newFile,
                'url' => $disk->downloadUrl($newFile)
            ];
        } else {
            $data['data'] = $file->getErrorMessage();
        }
        return response()->json($data);
    }

    public function uploadImg_parse(Request $request)
    {
        $str = substr($request->input('image'), 23);
        $base64 = preg_replace("/\s/", '+', $str);
        $img = base64_decode($base64);
        $disk = \Storage::disk('qiniu'); //使用七牛云上传
        $img_name = date('Y/m/d-H:i:s-') . uniqid() . '.png';
        $filename = $disk->put($img_name, $img);//上传
        if (!$filename) {
            $data = [
                'code' => 500,
                'msg' => '上传失败',
                'data' => ''
            ];
            return $response()->json($data);
        }
        $img_url = $disk->getDriver()->downloadUrl($img_name); //获取下载链接
        $data = [
            'code' => 200,
            'msg' => '上传成功',
            'data' => $img_url
        ];
        return response()->json($data);
    }


    public function uploadImg_cs(Request $request)
    {
        $dat = $request->all();//接收所有的
        $file = $request->file("photo");//接前台图片
        //$fil = $file->getClientOriginalName();
        $filepath = 'img/'.date("Y-m-d");
        $newFile = date('Y-m-d') . "_" . time() . "_" . uniqid() . "." . $file->getClientOriginalExtension();
        $result = $file->move($filepath, $newFile);//移动至框架图片文件夹
        /*$disk = QiniuStorage::disk('qiniu');
        $newFile = date('Y-m-d') . "_" . time() . "_" . uniqid() . "." . $file->getClientOriginalExtension();
        dd($file);
        $res = $disk->put($newFile, file_get_contents($file->getRealPath()));
        $img_url = $disk->getDriver()->downloadUrl($newFile); //获取下载链接*/
        if ($result){
            $data = [
                'code' => 200,
                'msg' => '上传成功',
                //'data' => 'http://'.$_SERVER["HTTP_HOST"].'/'.$filepath.'/'.$newFile
                'data' => '/'.$filepath.'/'.$newFile
            ];
            return response()->json($data);
        }else{
            $data = [
                'code' => 500,
                'msg' => '上传失败',
                'data' => ''
            ];
            return response()->json($data);
        }

    }


}
