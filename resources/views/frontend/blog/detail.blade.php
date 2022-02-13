@extends('frontend.layout')
@section('title','Anasayfa Başlığı')
@section('content')

<div class="container">


    <h1 class="mt-4 mb-3">{{$blog->blog_title}}</h1>

    <div class="row mt-2">

        <!-- Post Content Column -->
        <div class="col-lg-8">

            <!-- Preview Image -->
            <img style="display: block; margin: auto;" class="img-fluid rounded" src="/images/blogs/{{$blog->blog_file}}" alt="">

            <hr>

            <!-- Date/Time -->
            <p>Yayınlanma Tarihi :<small>{{$blog->created_at->format('d-m-Y')}}  </small> Düzenlenme Tarihi :<small>{{$blog->updated_at->format('d-m-Y')}}</small></p>

            <hr>

            <!-- Post Content -->
            <p class="lead">{!! $blog->blog_content !!}</p>

            <hr>
            <br>

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
            <!-- Side Widget -->
            <div class="card my-4">
                <h5 class="card-header">Son Eklenen Bloglar</h5>
                <div class="card-body">

                    <ul class="list-group">
                        @foreach($blogList as $list)
                        <a href="{{route('blog.Detail',$list->blog_slug)}}"> <li class="list-group-item">{{$list->blog_title}}</li> </a>  
                        @endforeach                   
                    </ul>

                </div>
            </div>

        </div>

    </div>
    <!-- /.row -->

</div>

@endsection
@section('css') @endsection
@section('js') @endsection