@extends('layouts.app')

@section('title') Create Post @endsection('title')

@section('page_header')
Create Post
@endsection

@section('content')
@if(Session::has('errors'))
<div class="alert alert-danger" role="alert">
    {{$errors->first()}}
  </div>
@endif

@if(Session::has('msg'))
<div class="alert alert-success" role="alert">
    {{Session::get('msg')}}
  </div>
@endif
<form action="{{route("post.store")}}" method="POST"> 
  
    <div class="form-group">
        <label>Title</label>
    <input class="form-control" type="text" name="title" value="{{old('title')}}">
    </div>
    @csrf
    <div class="form-group">
        <label>Category</label>
        <select class="form-control" type="select" name="category_id">
          <option selected></option>
          @foreach($categories as $category) 
        <option value="{{$category->id}}">{{$category->category_name}}</option>
          @endforeach
          <select>

    </div>

    <div class="form-group">
        <label>Upload Thumbnail Image</label>
        <div class="input-group">
          <span class="input-group-btn">
            <a stype="color:white" id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
              <i style="color:white" class="fa fa-picture-o"></i> Choose
            </a>
          </span>
          <input id="thumbnail" name="thumbnail" class="form-control" value="{{old("thumbnail")}}" type="text" name="filepath">
        </div>
        <img id="holder" style="margin-top:15px;max-height:100px;">
    </div>

    <div class="form-group">
    <textarea  rows="20" name="content">{!! old('content')!!}</textarea>
    </div>
    <input type="submit" value="create new post" class="btn btn-primary">
</form>

@endsection

@push('scripts')



<script src="{{asset("vendor/tinymce/tinymce.min.js")}}" referrerpolicy="origin"></script>

<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script> $('#lfm').filemanager('image');</script>
    <script>
    
  var editor_config = {
    path_absolute : "/",
    selector: "textarea",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>


@endpush