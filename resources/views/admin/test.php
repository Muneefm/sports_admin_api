<form method="POST" action="{{url('/add_feed)}}">
    <div style="width: 250px">
        <div class="form-group">
            <label>Main String</label>
            <input class="form-control" placeholder="MainString" name="mstring" required="true">
        </div>
        <div class="form-group">

            <label>By </label>
            <input class="form-control" placeholder="By" name="author" required="false">


            <label>Sub String</label>
            <input class="form-control" placeholder="SubString" name="substring" required="false">

            <div style="margin-top: 20px" class="form-group">
                <label> Select image to upload</label>
                <input style="margin-top: 10px" type="file" name="img" id="img">
            </div>


        </div>
        <button style="margin-top: 20px" type="submit" class="btn btn-primary btn-lg btn-block">Add Member</button>

    </div>
</form>