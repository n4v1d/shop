<?php


function chart()
{
    ?>

    <script>

        $("#searchPname").click(function () {
            var comp = $("#pname").val();
            if(comp.length > 0 ) {
                var page = 'productSearch';
                var name = $("#pname").val();
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
    <div class="modal fade" id="myModal" role="dialog">

        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">جستوجوی محصول</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>نام محصول</label>
                        <input type="text" class="form-control" id="pname">

                    </div>

                    <div class="form-group">
                        <button class="btn btn-success" id="searchPname">جستوجو</button>
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






    <form action="chart.php" method="post">

        <div class="container-fluid">
            <div class="form-group">
                <input type="text" class="input-lg form-control" id="id"  data-toggle="modal" data-target="#myModal"   name="id" placeholder="نام کالا">

            </div>
            <div class="form-group col-lg-6 col-lg-offset-3 ">
                <input type="submit" class="btn  btn-info   form-control" value="مشاهده گزارش" id="send"></input>
            </div>
            <div id="results">

            </div>

        </div>
    </form>

    <?php

}

?>