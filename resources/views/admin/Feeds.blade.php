@extends('admin.master')


@section('content')



<?php

//$eventNameTable = \Illuminate\Support\Facades\DB::table('eventname')->where('code',$code)->first();
$feedsTable = \Illuminate\Support\Facades\DB::table('feeds')->get();
?>


    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1  style="" class="page-header">Feeds</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Main String</th>
                                            <th>Image</th>
                                            <th>Image Path</th>
                                            <th>ext</th>
                                             <th>author</th>
                                             <th>Sub String</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $feedsTable as $feed )
                                        <tr class="odd gradeX">
                                            <td>{{$feed->mainstring}}</td>

                                            <td>{{$feed->image}}</td>
                                            <td>{{$feed->imagepath}}</td>
                                            <td>{{$feed->ext}}</td>
                                           <td>{{$feed->author}}</td>
                                            <td>{{$feed->substring}}</td>

                                           <td><a  href="{{url('/del_feed?fd_id='.$feed->id)}}" onclick="return confirm('Do you really want to Delete this?');" class="btn btn-danger btn-sm">Delete </a></td>


                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            <div class="well">
                                <h4>Enter members</h4>
                                <form method="POST" action="{{url('/add_feed')}}" enctype="multipart/form-data">
                                <div style="width: 250px">
                                        <div class="form-group">
                                            <label>Main String</label>
                                            <input class="form-control" placeholder="Main String" name="mstring" required="true">
                                        </div>
                                        <div class="form-group">

                                            <label>By </label>
                                            <input class="form-control" placeholder="By " name="author" >

                                        <div style="margin-top: 20px" class="form-group">

                                            <label>Sub String</label>
                                            <input class="form-control" placeholder="Sub String " name="sstring" >
                                        </div>
                                        <div style="margin-top: 20px" class="form-group">
                                            <label> Select image to upload:</label>
                                             <input style="margin-top: 10px" type="file" name="img" id="img">
                                        </div>


                                        </div>
                            <input style="margin-top: 20px" type='submit' class="btn btn-primary btn-lg btn-block">

                                </div>
                                </form>

                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            </div>













@endsection