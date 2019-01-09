<?php



function archive()
{
    ?>
    <form action="UploadFile.php"  method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                    <input type="file" name="fileToUpload" id="fileToUpload"   class="form-control input-lg  ">
                </div>

                <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                    <input type="text" data-toggle="modal" data-target="#myModal"  id="companyCreator"   name="company" class="input-lg form-control" placeholder="نام شرکت">
                </div>
            </div>
            <br>


            <div class="row">
                <textarea name="about" class="input-lg form-control">توضیحات فایل</textarea>
            </div>
            <br>
            <br>
            <br>
            <input type="submit"  value="ارسال فایل" class="btn btn-success input-lg btn-block">
    </form></div>



    <div class="modal fade" id="myModal" role="dialog">

        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">جستوجوی نام شرکت</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>نام شرکت</label>
                        <input type="text" class="form-control" id="companyname">

                    </div>

                    <div class="form-group">
                        <button class="btn btn-success" id="searchcompany">جستوجو</button>
                    </div>

                    <div id="searchresult">

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                </div>
            </div>

        </div>
    </div>



    <br>
    <br>
    <br>


    <form action="ُCompanyArchive.php">
        <div class="col-lg-6 col-md-6 col-xs-9 col-sm-6">
            <input type="text" name="company" class="input-lg form-control ">

        </div>




        <div class="col-lg-6 col-md-6 col-xs-9 col-sm-6">
            <input type="submit" value="ویرایش" class="btn btn-primary input-lg form-control">

        </div>

    </form>

    <script>




        $("#searchcompany").click(function () {
            var comp = $("#companyname").val();
            if(comp.length > 0 ) {
                var page = 'companySearch';
                var name = $("#companyname").val();
                $.post("page.php", {page: page, name: name}, function (data) {
                    $("#searchresult").html(data);
                });
            }
            else
            {
                alert('لطفا مقداری از نام شرکت را وارد نمایید ');
            }
        });

    </script>
    <?php
}



?>