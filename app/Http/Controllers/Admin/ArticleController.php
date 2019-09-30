<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleMarkRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use YuanChao\Editor\EndaEditor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request->session()->all());
        //文章
        $categorys = Category::with('allChilds')->where('parent_id',0)->orderBy('sort','desc')->get();
        return view('admin.article.index',compact('categorys'));
    }

    public function data(Request $request)
    {

        $model = Article::query();
        if ($request->get('category_id')){
            $model = $model->where('category_id',$request->get('category_id'));
        }
        if ($request->get('title')){
            $model = $model->where('title','like','%'.$request->get('title').'%');
        }
        $res = $model->orderBy('created_at','desc')->with(['tags','category'])->paginate($request->get('limit',30))->toArray();
        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res['total'],
            'data'  => $res['data']
        ];
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //分类
        $categorys = Category::with('allChilds')->where('parent_id',0)->orderBy('sort','desc')->get();
        //标签
        $tags = Tag::get();
        return view('admin.article.create',compact('tags','categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->only(['category_id','title','keywords','description','content','thumb','click']);
        $article = Article::create($data);
        if ($article && !empty($request->get('tags')) ){
            $article->tags()->sync($request->get('tags'));
        }
        return redirect(route('admin.article'))->with(['status'=>'添加成功']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::with('tags')->findOrFail($id);
        if (!$article){
            return redirect(route('admin.article'))->withErrors(['status'=>'文章不存在']);
        }
        //分类
        $categorys = Category::with('allChilds')->where('parent_id',0)->orderBy('sort','desc')->get();
        //标签
        $tags = Tag::get();
        foreach ($tags as $tag){
            $tag->checked = $article->tags->contains($tag) ? 'checked' : '';
        }
        return view('admin.article.edit',compact('article','categorys','tags'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = Article::with('tags')->findOrFail($id);
        $data = $request->only(['category_id','title','keywords','description','content','thumb','click']);
        if ($article->update($data)){
            $article->tags()->sync($request->get('tags',[]));
            return redirect(route('admin.article'))->with(['status'=>'更新成功']);
        }
        return redirect(route('admin.article'))->withErrors(['status'=>'系统错误']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('ids');
        if (empty($ids)){
            return response()->json(['code'=>1,'msg'=>'请选择删除项']);
        }
        foreach (Article::whereIn('id',$ids)->get() as $model){
            //清除中间表数据
            $model->tags()->sync([]);
            //删除文章
            $model->delete();
        }
        return response()->json(['code'=>0,'msg'=>'删除成功']);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //分类
        $categorys = Category::with('allChilds')->where('parent_id',0)->orderBy('sort','desc')->get();
        //标签
        $tags = Tag::get();
        return view('admin.article.add',compact('tags','categorys'));
        ///return view('vendor.editor.create',compact('tags','categorys'));
    }

    public function upload()
    {
        $data = EndaEditor::uploadImgFile('uploads');
        return json_encode($data);
    }

    public function store_mark(ArticleMarkRequest $request)
    {
        $data = $request->only(['category_id','title','keywords','description','test-editormd-markdown-doc','thumb','click']);
        $data['content'] = $data['test-editormd-markdown-doc'];
        $data['abc'] = '123';
        $data['category_id'] = '1';
        $article = Article::create($data);
        //存入redis
        $id = $article->id;
        //Redis::set("article_".$id, json_encode($article));
        if ($article && !empty($request->get('tags')) ){
            $article->tags()->sync($request->get('tags'));
        }
        return redirect(route('admin.article'))->with(['status'=>'添加成功']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_mark(Request $request)
    {
        /*Redis::set('article_1', '1');
        Redis::set('article_2', '2');
        $values = Redis::get('article_3');
        dd($values);*/
        $id = $request['id'];
        $article = Article::with('tags')->findOrFail($id);
        if (!$article){
            return redirect(route('admin.article'))->withErrors(['status'=>'文章不存在']);
        }

        //寫入文件
        /*$filePath = "test.md";
        Storage::append($filePath,$article['content']);*/
        $path=base_path().'/public/test1.md';
        file_put_contents($path,$article['content']);//把字符串内容存储到web.php中。
        //分类
        $categorys = Category::with('allChilds')->where('parent_id',0)->orderBy('sort','desc')->get();
        //标签
        $tags = Tag::get();
        foreach ($tags as $tag){
            $tag->checked = $article->tags->contains($tag) ? 'checked' : '';
        }
        return view('admin.article.edit_mark',compact('article','categorys','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_mark(ArticleMarkRequest $request, $id)
    {
        $article = Article::with('tags')->findOrFail($id);
        $data = $request->only(['category_id','title','keywords','test-editormd-markdown-doc','description','content','thumb','click']);
        $data['content'] = $data['test-editormd-markdown-doc'];
        if ($article->update($data)){
            //文章存入redis
            ///Redis::set("article_".$id, json_encode($article));
            $article->tags()->sync($request->get('tags',[]));
            return redirect(route('admin.article'))->with(['status'=>'更新成功']);
        }
        return redirect(route('admin.article'))->withErrors(['status'=>'系统错误']);
    }

    public function ajax(Request $request)
    {
        $data = $request->only(['id','title','content']);
        $id = $request['id'];
        $article = Article::findOrFail($id);
        if ($article->update($data)){
            //文章存入redis
            //Redis::set("article_".$id, json_encode($article));
            $data = [
                'code' => 200,
                'msg' => '更新成功',
                'data' => ''
            ];
        }else{
            $data = [
                'code' => 500,
                'msg' => '更新失败',
                'data' => ''
            ];
        }
        return response()->json($data);
    }
}
