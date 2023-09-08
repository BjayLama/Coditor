
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
                        <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-12 col-form-label text-center"><strong>{{ __('E-Mail') }}</strong></label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
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
