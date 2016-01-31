@extends('admin.master')


@section('content')


<?php

$yellowGroup = \Illuminate\Support\Facades\DB::table('yellowg')->get();

?>


    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1  style="color: #ffff00" class="page-header">Yagorians</h1>
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
                                            <th>Year</th>
                                            <th>Class</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $yellowGroup as $yellow )
                                        <tr class="odd gradeX">
                                            <td>{{$yellow->name}}</td>
                                            <td>{{$yellow->year}}</td>
                                            <td>{{$yellow->class}}</td>
                                           <td><a  href="{{url('/del_group?y_id='.$yellow->id)}}" onclick="return confirm('Do you really want to Delete this?');" class="btn btn-danger btn-sm">Delete </a></td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            <div class="well">
                                <h4>Enter members</h4>
                                <form method="POST" action="{{url('/add_yellow')}}">
                                <div style="width: 250px">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" placeholder="Name" name="name" required="true">
                                        </div>
                                        <div class="form-group">
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