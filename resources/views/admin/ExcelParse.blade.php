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
                                <form  style="margin-top: 10px" action="{{url('parse_excel')}}" method="post" enctype="multipart/form-data">
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




                                    Select Excel to upload:
                                    <input style="margin-top: 10px" type="file" name="exl" id="exl">
                                    <input style="margin-top: 10px" type="submit" value="Upload Excel" name="submit">
                                </form>

                            </div>


</div>


</div>
</div>



@endsection