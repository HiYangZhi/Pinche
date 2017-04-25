@extends('pinche::layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            顶部滚动栏
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($banner, ['route' => ['pinche.banners.update', $banner->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('pinche::banners.fields', ['new' => false])

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection


@section('scripts')
    <script type="text/javascript">
    //下面用于图片上传预览功能
    function setImagePreview(doc, preview, localImag) {
        var docObj=document.getElementById(doc);
        var imgObjPreview=document.getElementById(preview);
        if(docObj.files &&docObj.files[0])
        {
            //火狐下，直接设img属性
            imgObjPreview.style.display = 'block';
            imgObjPreview.style.width = '100%';
            //imgObjPreview.style.height = '50px';
            imgObjPreview.style.maxHeight = 'auto';
            //imgObjPreview.src = docObj.files[0].getAsDataURL();
            //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式
            imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
        }
        else
        {
            //IE下，使用滤镜
            docObj.select();
            var imgSrc = document.selection.createRange().text;
            var localImagId = document.getElementById(localImag);
            //必须设置初始大小
            localImagId.style.width = "100%";
            //localImagId.style.height = "50px";
            localImagId.style.maxHeight = "auto";
            //图片异常的捕捉，防止用户修改后缀来伪造图片
            try{
                localImagId.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
                localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
            }
            catch(e)
            {
                alert("您上传的图片格式不正确，请重新选择!");
                return false;
            }
            imgObjPreview.style.display = 'none';
            document.selection.empty();
        }
        return true;
    }
</script>
@stop