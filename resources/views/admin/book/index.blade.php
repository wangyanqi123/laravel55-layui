@extends('admin.base')

@section('content')



    <div class="layui-card">

        <div class="layui-card-header" style="height: 50px;line-height: 50px;">

            <h2 style="font-weight:600"><center>{{$data->title}}</center></h2>

            <i class="layui-icon layui-icon-tips" lay-tips="要支持的噢" lay-offset="5"></i>

        </div>

        <div class="layui-card-body layui-text layadmin-text" style="margin-left: 20px;">
            <p></p>
            {{--<p>一直以来，layui 秉承无偿开源的初心，虔诚致力于服务各层次前后端 Web 开发者，在商业横飞的当今时代，这一信念从未动摇。即便身单力薄，仍然重拾决心，埋头造轮，以尽可能地填补产品本身的缺口。</p>

            <p>在过去的一段的时间，我一直在寻求持久之道，已维持你眼前所见的一切。而 layuiAdmin 是我们尝试解决的手段之一。我相信真正有爱于 layui 生态的你，定然不会错过这一拥抱吧。</p>

            <p>子曰：君子不用防，小人防不住。请务必通过官网正规渠道，获得 <a href="http://www.layui.com/admin/" target="_blank">layuiAdmin</a>！</p>

            <p>—— 贤心（<a href="http://www.layui.com/" target="_blank">layui.com</a>）</p>--}}
            {!! $data->content!!}
        </div>
        <br/><br/><br/><br/><br/><br/>
    </div>

@endsection
