<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coditor | Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/assets/custom.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/responsive_custom.css')}}">
</head>

<body>
    



   
  <section>
        <div class="container-fluid">
            <div class="row align-items-xl-center align-items-stretch login-sector">
                <div class="col-md-6 nopadding">
                    <div class="login-left">
                        <div class="login-bg bg-overlay">
                            <div class="logo-after">
                                <div class="icon-img">
                                    <img src="{{ asset('frontend/assets/images/icon/graduation-hat.png') }}" alt="">
                                </div>
                                <div class="login__title text-capitalize">
                                    Coditor | Easy learning
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 nopadding">
                    <div class="inner-padding register-form">
                        <div class="col-lg-8 offset-lg-2">
                            <form id="login-form" name="login-form" class="nobottommargin" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="heading">
                                    <h2 class="heading__title lh-1 mb-50 ">LOG-IN</h2>
                                </div><!-- /.heading -->
                                <p>
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero vitae, expedita ex
                                    repellat odit cum dolor dolorum, modi saepe dolorem temporibus velit omnis
                                    dignissimos pariatur.
                                </p>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="password" id="new-password" name="new-password" value=""
                                        class="form-control" placeholder="New Password" required/>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input type="password" id="new-password" name="conform-password" value=""
                                    class="form-control" placeholder="Conform Password" required/>
                                </div>
                                <div class="mb-20">
                                    <button type="submit" class="btn btn__bordered btn__secondary btn__hover3" id="password-change"
                                    name="password-change" value="login">Save Changes</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  <script src="{{ asset('backend/plugins/jquery/jquery.min.js')}}"></script>
  <script>
  $(document).ready(function(){
    $("#user-logout").click(function (e) {
        e.preventDefault();
        $("#logout-form").submit();
    });
  });
</script>










    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>


</body>



</html>