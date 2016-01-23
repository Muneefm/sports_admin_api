@extends('admin.master')


@section('content')

<?php echo "test" ?>

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Score board</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $blue ?></div>
                                    <div>Blizardians</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                        <form id="score-form" class="form-horizontal" action="{{url('/home')}}" method="POST" role="form">

                                 <div style="margin-bottom: 25px" class="input-group">
                                 <input id="blue_score" type="text" class="form-control" name="blue" value="" placeholder="Blue Score">
                                </div>
                                 <div style="margin-top:5px" class="form-group">
                                    <div class="">
                                      <button type="submit" id="btn-login"   class="btn btn-success">update  </button>

                                    </div>
                                </div>
                            </form>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $green ?></div>
                                    <div>Gravitans</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                                    <form id="score-form" class="form-horizontal" action="{{url('/home')}}" method="POST" role="form">

                            <div style="margin-bottom: 25px" class="input-group">
                                 <input id="green_score" type="text" class="form-control" name="green" value="" placeholder="Green Score">
                                </div>
                                 <div style="margin-top:5px" class="form-group">
                                    <div class="">
                                      <button type="submit" id="btn-login"   class="btn btn-success">update  </button>

                                    </div>
                                </div>
                                </form>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $yellow ?></div>
                                    <div>Yagorians</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                                    <form id="score-form" class="form-horizontal" action="{{url('/home')}}" method="POST" role="form">

                       <div style="margin-bottom: 25px" class="input-group">
                                 <input id="yellow_score" type="text" class="form-control" name="yellow" value="" placeholder="Yellow Score">
                                </div>
                                 <div style="margin-top:5px" class="form-group">
                                    <div class="">
                                      <button type="submit" id="btn-login"   class="btn btn-success">update  </button>

                                    </div>
                                </div>

                                </form>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $red ?></div>
                                    <div>Racovians</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                                    <form id="score-form" class="form-horizontal" action="{{url('/home')}}" method="POST" role="form">

                            <div style="margin-bottom: 25px" class="input-group">
                                 <input id="red_score" type="text" class="form-control" name="red" value="" placeholder="Red Score">
                                </div>
                                 <div style="margin-top:5px" class="form-group">
                                    <div class="">
                                      <button type="submit" id="btn-login"   class="btn btn-success">update  </button>

                                    </div>
                                </div>
                                </form>
                            </div>
                        </a>
                    </div>
                </div>
            </div>






            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->





@endsection