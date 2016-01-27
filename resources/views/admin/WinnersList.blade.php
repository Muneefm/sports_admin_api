@extends('admin.master')


@section('content')



<?php

//$eventNameTable = \Illuminate\Support\Facades\DB::table('eventname')->where('code',$code)->first();
$winnersListTable = \Illuminate\Support\Facades\DB::table('winners')->where('event',$eventNameTable->code)->get();
?>


    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1  style="" class="page-header">{{$eventNameTable->name}}</h1>
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
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Event</th>

                                            <th>Group</th>
                                            <th>Year</th>
                                            <th>Class</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $winnersListTable as $listItem )
                                        <tr class="odd gradeX">
                                            <td>{{$listItem->name}}</td>
                                            <td>{{$listItem->pos}}</td>
                                           <td>{{$listItem->event}}</td>

                                            <td>{{$listItem->group}}</td>
                                            <td>{{$listItem->year}}</td>
                                            <td>{{$listItem->class}}</td>


                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            <div class="well">
                                <h4>Enter members</h4>
                                <form method="POST" action="{{url('/add_winners?ev='.$eventNameTable->code)}}">
                                <div style="width: 250px">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" placeholder="Name" name="name" required="true">
                                        </div>
                                        <div class="form-group">
                                           <label>Position</label>
                                            <select name="pos" class="form-control" required="true">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select>



                                            <label>Group</label>
                                            <select name="group" class="form-control" required="true">
                                                <option>b</option>
                                                <option>g</option>
                                                <option>y</option>
                                                <option>r</option>
                                            </select>

                                            <label>Year</label>
                                            <select name="year" class="form-control" required="true">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>

                                        <div style="margin-top: 20px" class="form-group">
                                            <label>Class</label>
                                            <input class="form-control" placeholder="Class" name="class" required="true">
                                        </div>

                                        </div>
                            <button style="margin-top: 20px" type='submit'  class="btn btn-primary btn-lg btn-block">Add Member</button>

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