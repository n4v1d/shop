<?php




function UserArchiveGet()
{
$user = new user();

$user->GetUserDataCount();
}



function changePass()
    {
    ?>
    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
        <label>رمز قدیم</label>
        <input type="text" class="input-lg form-control" id="oldpass">
    </div>



    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
        <label>رمز جدید</label>
        <input type="text" class="input-lg form-control" id="newpass">
    </div>




    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
        <label>ثبت</label>
        <button class="input-lg form-control btn btn-success" id="save">تعویض رمز</button>
    </div>


    <script>
        $("#save").click(function() {
            var newpass = $("#newpass").val();
            var oldpass = $("#oldpass").val();
            var page = 'ChangePassSave';

            $.post('page.php',{page:page , newpass:newpass , oldpass:oldpass},function(data) {
                alert(data);
            });

        });
    </script>

<?php
}


function ChangePassSave()
{
    $userName = $_SESSION['UserName'];
    $userid = $_SESSION['UserId'];

    $newPass = $_POST['newpass'];
    $oldPass = $_POST['oldpass'];

    if($newPass == $oldPass)
    {
        echo 'رمز جدید و قدیم با هم برابر هستند ';
        exit();
    }

    $user = new user();

    if($user->CheckUserPassword($userName,$oldPass) == 1)
    {
        if($user->UpdataPassWordData($newPass,$userid) == 1)
        {
            echo 'رمز با موفقیت تغییر یافت';
        }
        else
        {
            echo 'خطا در تعویض رمز عبور';
        }

    }
    else
    {
        echo 'رمز قدیم صحیح نیست';
    }
}


?>