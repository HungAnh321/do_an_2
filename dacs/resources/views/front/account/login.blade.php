@extends('front.layout.masters')
@section('title', 'Login')
@section('body1')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Login</h4>
                        <div class="breadcrumb__links">
                            <a href="./">Home</a>
                            <span>Login</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Form Section Begin -->

    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login-form">
                        <h2 style="text-align: center">Login</h2>
                        @if(session('notification'))
                            <div class="alert alert-warning" role="alert">
                                {{session('notification')}}
                            </div>
                        @endif
                        <form action="" method="post">
                            @csrf
                            <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input type="email" id="username" name="email">
                            </div>
                            <div class="checkout__input">
                                <p>Password<span>*</span></p>
                                <input type="password" id="password" name="password">
                            </div>
                            <div class="group-input gi-check">
                                <div class="gi-more">
                                    <label for="save-pass">
                                        Save Password
                                        <input type="checkbox" id="save-pass" name="remenber">
                                        <span class="checkmark"></span>
                                    </label>
                                    <a href="#" class="forget-pass">Forget your Password</a>
                                </div>
                            </div>
                            <button type="submit" class="site-btn login-btn">Sign In</button>
                        </form>
                        <div class="switch-login">
                            <a href="./account/register" class="or-login">Or Create An Account</a>
                        </div>
                    </div>
                </div>
                <div class="card-body card text-center">
                    <p class="card-text">@lang('main.acc.socialogin')</p>
                    <div >

                        <a class="btn" style="width: 15%" href="{{ url('/auth/redirect/google') }}"><img src="data:image/png;base64,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"></a>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
@endsection


