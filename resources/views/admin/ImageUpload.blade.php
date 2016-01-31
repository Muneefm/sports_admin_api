@extends('admin.master')


@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"></h1>
                </div>
<div style="">




<div class="well">
                                <h4>Upload Image</h4>
                                <form  style="margin-top: 10px" action="{{url('up_image')}}" method="post" enctype="multipart/form-data">
                                    Select image to upload:
                                    <input style="margin-top: 10px" type="file" name="img" id="img">
                                    <input style="margin-top: 10px" type="submit" value="Upload Image" name="submit">
                                </form>

                            </div>


</div>


</div>
</div>



@endsection