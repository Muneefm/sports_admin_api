@extends('admin.master')


@section('content')


<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gallery</h1>
                </div>



<div class="container">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header"></h1>
            </div>
     <?php $imageTable = \Illuminate\Support\Facades\DB::table('images')->get(); ?>

            @foreach($imageTable as $image)
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#">
                    <img class="img-responsive" src="{{'uploads/'.$image->name}}" alt="">
                </a>
            </div>
            @endforeach
        </div>

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                </div>
            </div>
        </footer>

    </div>








                </div>
                </div>

@endsection