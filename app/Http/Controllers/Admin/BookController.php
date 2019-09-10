<?php

namespace App\Http\Controllers\Admin;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Tools\MarkDowner;
class BookController extends Controller
{
    public function index($id)
    {
        $markdown = new MarkDowner; //实例化
        //示例
        /*$htmler = "<h5>Quick, to the Batpoles!</h5>";
        echo $markdowner = $markdown->convertHtmlToMarkdown($htmler); //html转换markdown
        echo $htmler = $markdown->convertMarkdownToHtml($markdowner); //markdown转换html*/
        $data = Article::find($id);
        $data['content'] = $markdown->convertMarkdownToHtml($data['content']);
        return view('admin.book.index',compact('data'));
    }
}
