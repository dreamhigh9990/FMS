@extends('layouts.auth')
@section('content')
    <?php
    $setting = \App\Models\Setting::pluck('value', 'name')->toArray();
    $auth_logo = isset($setting['auth_logo']) ? 'uploads/' . $setting['auth_logo'] : 'assets/media/logos/logo-light.png';
    $auth_page_heading = isset($setting['auth_page_heading']) ? $setting['auth_page_heading'] : 'wwww.webexert.com';
    $auth_image = isset($setting['auth_image']) ? 'uploads/' . $setting['auth_image'] : 'assets/media/svg/illustrations/login-visual-1.svg';
    $copy_right = isset($setting['copy_right']) ? $setting['copy_right'] : 'wwww.webexert.com';
    ?>

    <script type="text/javascript" src="https://alcdn.msauth.net/lib/1.4.0/js/msal.js"></script>
    <script type="text/javascript">
        if (typeof Msal === 'undefined') document.write(unescape(
            "%3Cscript src='https://alcdn.msftauth.net/lib/1.4.0/js/msal.js' type='text/javascript' %3E%3C/script%3E"
        ));
    </script>
    <script>
        const msalConfig = {
            auth: {
                clientId: 'ded49a29-f6a6-4052-9b60-82fde5915c19',
                redirectUri: window.location.href,
                authority:'https://login.microsoftonline.com/'+'f8cdef31-a31e-4b4a-93e4-5f571e91255a'
            }
        };

        console.log("BBBBBBB", msalConfig);
        const msalInstance = new Msal.UserAgentApplication(msalConfig);
        console.log("msalInstance", msalInstance);
        msalInstance.handleRedirectCallback((error, response) => {
            // handle redirect response or error
            console.log(error, response);
        });

        onClickMs = () => {

            var loginRequest = {
                scopes: ["user.read", "mail.send"] // optional Array<string>
            };

            try {
                msalInstance.loginPopup(loginRequest)
                    .then(response => {
                        console.log("RES:", response);
                    })
                    .catch(err => {
                        // handle error
                    });
            } catch (err) {
                console.log("login", err);
                // handle error
            }


            // const ssoRequest = {
            //     loginHint: "user@example.com"
            // };

            // msalInstance.ssoSilent(ssoRequest)
            //     .then(response => {
            //         // session silently established
            //     })
            //     .catch(error => {
            //         // handle error by invoking an interactive login method
            //         msalInstance.loginPopup(ssoRequest);
            //     });
        }
    </script>

    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
            <!--begin::Aside-->
            <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #F2C98A;">
                <!--begin::Aside Top-->
                <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                    <!--begin::Aside header-->
                    <a href="#" class="text-center mb-10">
                        <img src="{{ asset($auth_logo) }}" class="max-h-70px" alt="" />
                    </a>
                    <!--end::Aside header-->
                    <!--begin::Aside title-->
                    <h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #986923;">
                        <?php echo stripcslashes($auth_page_heading); ?></h3>
                    <!--end::Aside title-->
                </div>
                <!--end::Aside Top-->
                <!--begin::Aside Bottom-->
                <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
                    style="background-image: url({{ asset($auth_image) }})"></div>
                <!--end::Aside Bottom-->
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div
                class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
                <!--begin::Content body-->
                <div class="d-flex flex-column-fluid flex-center">
                    <!--begin::Signin-->
                    <div class="login-form login-signin">
                        <!--begin::Form-->
                        <form class="form" action="{{ route('login') }}" method="post" novalidate="novalidate">

                            @csrf

                            <!--begin::Title-->
                            <div class="pb-13 pt-lg-0 pt-5">
                                <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">
                                    Welcome to FMS Wardsgroup</h3>
                                {{-- <span class="text-muted font-weight-bold font-size-h4">New Here?
									<a href="javascript:;" id="kt_login_signup" class="text-primary font-weight-bolder">Create an Account</a></span> --}}
                                @if (Session::has('error'))
                                    <h5 style="color: red"><strong>{{ Session::get('error') }}</strong></h5>
                                @endif
                            </div>
                            <!--begin::Title-->
                            <!--begin::Form group-->
                            <div class="form-group">

                                <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                                <input
                                    class="@error('email') is-invalid @enderror form-control form-control-solid h-auto py-6 px-6 rounded-lg"
                                    type="email" name="email" value="{{ old('email') }}" autocomplete="off" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <!--end::Form group-->
                            <!--begin::Form group-->
                            <div class="form-group">
                                <div class="d-flex justify-content-between mt-n5">
                                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
                                </div>
                                <input
                                    class="form-control form-control-solid h-auto py-6 px-6 rounded-lg @error('password') is-invalid @enderror"
                                    required autocomplete="current-password" type="password" name="password" />
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                                @enderror
                            </div>
                            <!--end::Form group-->

                            <!--begin::Action-->
                            <div class="form-group">
                                <div class="d-flex justify-content-center mt-n5">
                                    <div class="ui segment"><button type="submit"
                                            class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Sign
                                            In</button></div>
                                </div>
                            </div>
                            <div class="pb-lg-0 pb-5">

                                {{-- <button type="button" class="btn btn-light-primary font-weight-bolder px-8 py-4 my-3 font-size-lg">
									<span class="svg-icon svg-icon-md">
										<!--begin::Svg Icon | path:assets/media/svg/social-icons/google.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
											<path d="M19.9895 10.1871C19.9895 9.36767 19.9214 8.76973 19.7742 8.14966H10.1992V11.848H15.8195C15.7062 12.7671 15.0943 14.1512 13.7346 15.0813L13.7155 15.2051L16.7429 17.4969L16.9527 17.5174C18.879 15.7789 19.9895 13.221 19.9895 10.1871Z" fill="#4285F4" />
											<path d="M10.1993 19.9313C12.9527 19.9313 15.2643 19.0454 16.9527 17.5174L13.7346 15.0813C12.8734 15.6682 11.7176 16.0779 10.1993 16.0779C7.50243 16.0779 5.21352 14.3395 4.39759 11.9366L4.27799 11.9466L1.13003 14.3273L1.08887 14.4391C2.76588 17.6945 6.21061 19.9313 10.1993 19.9313Z" fill="#34A853" />
											<path d="M4.39748 11.9366C4.18219 11.3166 4.05759 10.6521 4.05759 9.96565C4.05759 9.27909 4.18219 8.61473 4.38615 7.99466L4.38045 7.8626L1.19304 5.44366L1.08875 5.49214C0.397576 6.84305 0.000976562 8.36008 0.000976562 9.96565C0.000976562 11.5712 0.397576 13.0882 1.08875 14.4391L4.39748 11.9366Z" fill="#FBBC05" />
											<path d="M10.1993 3.85336C12.1142 3.85336 13.406 4.66168 14.1425 5.33717L17.0207 2.59107C15.253 0.985496 12.9527 0 10.1993 0C6.2106 0 2.76588 2.23672 1.08887 5.49214L4.38626 7.99466C5.21352 5.59183 7.50242 3.85336 10.1993 3.85336Z" fill="#EB4335" />
										</svg>
										<!--end::Svg Icon-->
									</span>Sign in with Google</button> --}}
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-center mt-n5" onClick="onClickMs()">
                                    <div class="ui segment"><svg xmlns="http://www.w3.org/2000/svg" width="215"
                                            height="41" class="my-button" style="cursor: pointer;">
                                            <path fill="#ffffff" d="M0 0h215v41H0z"></path>
                                            <path fill="#8c8c8c" d="M214 1v39H1V1h213m1-1H0v41h215V0z"></path>
                                            <path fill="#5e5e5e"
                                                d="M45.812 25.082v-1.794a2.77 2.77 0 0 0 .573.4 4.484 4.484 0 0 0 .706.3 5.486 5.486 0 0 0 .745.187 3.954 3.954 0 0 0 .687.065 2.928 2.928 0 0 0 1.634-.365 1.2 1.2 0 0 0 .537-1.062 1.167 1.167 0 0 0-.178-.649 1.939 1.939 0 0 0-.5-.5 5.412 5.412 0 0 0-.757-.435q-.435-.209-.932-.436-.533-.285-.994-.578a4.285 4.285 0 0 1-.8-.648 2.724 2.724 0 0 1-.533-.8 2.6 2.6 0 0 1-.194-1.047 2.416 2.416 0 0 1 .333-1.285 2.794 2.794 0 0 1 .877-.9 4.019 4.019 0 0 1 1.239-.528 5.906 5.906 0 0 1 1.418-.172 5.692 5.692 0 0 1 2.4.374v1.721a3.817 3.817 0 0 0-2.295-.645 4.093 4.093 0 0 0-.771.074 2.335 2.335 0 0 0-.687.241 1.5 1.5 0 0 0-.494.433 1.06 1.06 0 0 0-.189.637 1.221 1.221 0 0 0 .145.608 1.573 1.573 0 0 0 .428.468 4.321 4.321 0 0 0 .688.414c.27.134.584.28.939.436q.548.285 1.034.6a4.881 4.881 0 0 1 .856.7 3.075 3.075 0 0 1 .585.846 2.493 2.493 0 0 1 .215 1.058 2.625 2.625 0 0 1-.322 1.348 2.584 2.584 0 0 1-.866.892 3.786 3.786 0 0 1-1.254.5 6.959 6.959 0 0 1-1.5.155c-.176 0-.392-.014-.647-.04s-.518-.067-.786-.117a7.75 7.75 0 0 1-.76-.187 2.373 2.373 0 0 1-.58-.269zM55.109 16.426a1.021 1.021 0 0 1-.713-.272.891.891 0 0 1-.3-.688.917.917 0 0 1 .3-.7 1.009 1.009 0 0 1 .713-.278 1.041 1.041 0 0 1 .732.278.915.915 0 0 1 .3.7.9.9 0 0 1-.3.678 1.035 1.035 0 0 1-.732.282zm.841 9.074h-1.7V18h1.7zM64.979 24.9q0 4.131-4.146 4.131a6.166 6.166 0 0 1-2.551-.491v-1.554a4.712 4.712 0 0 0 2.332.7 2.341 2.341 0 0 0 2.668-2.628v-.818h-.029a2.938 2.938 0 0 1-4.733.436 4.046 4.046 0 0 1-.837-2.684 4.738 4.738 0 0 1 .9-3.04 2.988 2.988 0 0 1 2.471-1.128 2.38 2.38 0 0 1 2.2 1.216h.029V18h1.7zM63.3 22.064v-.973a1.91 1.91 0 0 0-.523-1.352 1.71 1.71 0 0 0-1.3-.559 1.789 1.789 0 0 0-1.51.714 3.223 3.223 0 0 0-.545 2 2.78 2.78 0 0 0 .523 1.769 1.675 1.675 0 0 0 1.385.662 1.8 1.8 0 0 0 1.426-.632 2.4 2.4 0 0 0 .544-1.629zM73.853 25.5h-1.7v-4.227q0-2.1-1.483-2.1a1.616 1.616 0 0 0-1.279.582 2.167 2.167 0 0 0-.505 1.469V25.5h-1.7V18h1.7v1.245h.029a2.669 2.669 0 0 1 2.428-1.421 2.257 2.257 0 0 1 1.863.795 3.57 3.57 0 0 1 .644 2.3zM80.892 16.426a1.017 1.017 0 0 1-.713-.272.889.889 0 0 1-.3-.688.915.915 0 0 1 .3-.7 1 1 0 0 1 .713-.278 1.038 1.038 0 0 1 .731.278.915.915 0 0 1 .3.7.9.9 0 0 1-.3.678 1.033 1.033 0 0 1-.731.282zm.84 9.074h-1.7V18h1.7zM90.614 25.5h-1.7v-4.227q0-2.1-1.483-2.1a1.62 1.62 0 0 0-1.28.582 2.167 2.167 0 0 0-.5 1.469V25.5h-1.7V18h1.7v1.245h.03a2.668 2.668 0 0 1 2.427-1.421 2.258 2.258 0 0 1 1.864.795 3.576 3.576 0 0 1 .643 2.3zM106.865 18l-2.208 7.5h-1.776l-1.36-5.083a3.291 3.291 0 0 1-.1-.659h-.029a3.018 3.018 0 0 1-.132.644l-1.477 5.1h-1.741l-2.2-7.5H97.6l1.36 5.405a3.308 3.308 0 0 1 .087.645h.053a3.384 3.384 0 0 1 .117-.659L100.725 18h1.593l1.345 5.428a3.832 3.832 0 0 1 .095.644h.052a3.3 3.3 0 0 1 .109-.644l1.33-5.428zM108.977 16.426a1.017 1.017 0 0 1-.713-.272.889.889 0 0 1-.3-.688.915.915 0 0 1 .3-.7 1 1 0 0 1 .713-.278 1.038 1.038 0 0 1 .731.278.915.915 0 0 1 .3.7.9.9 0 0 1-.3.678 1.033 1.033 0 0 1-.731.282zm.84 9.074h-1.7V18h1.7zM115.979 25.42a2.944 2.944 0 0 1-1.307.248q-2.18 0-2.179-2.094v-4.241h-1.25V18h1.25v-1.736l1.7-.483V18h1.79v1.333h-1.79v3.75a1.478 1.478 0 0 0 .242.952 1 1 0 0 0 .8.285 1.16 1.16 0 0 0 .745-.248zM124.094 25.5h-1.7v-4.1q0-2.226-1.483-2.226a1.555 1.555 0 0 0-1.258.644 2.573 2.573 0 0 0-.511 1.649V25.5h-1.7V14.4h1.7v4.849h.029a2.679 2.679 0 0 1 2.428-1.421q2.492 0 2.492 3.055zM141.719 25.5h-1.726v-6.8q0-.835.1-2.043h-.03a6.992 6.992 0 0 1-.285.988l-3.126 7.855h-1.2l-3.136-7.793a7.371 7.371 0 0 1-.277-1.047h-.029q.059.63.058 2.058V25.5h-1.608V15h2.449l2.756 7a10.415 10.415 0 0 1 .409 1.2h.036c.181-.551.327-.962.439-1.23l2.808-6.97h2.362zM144.964 16.426a1.019 1.019 0 0 1-.713-.272.892.892 0 0 1-.3-.688.918.918 0 0 1 .3-.7 1.007 1.007 0 0 1 .713-.278 1.038 1.038 0 0 1 .731.278.911.911 0 0 1 .3.7.9.9 0 0 1-.3.678 1.033 1.033 0 0 1-.731.282zm.841 9.074h-1.7V18h1.7zM153.378 25.156a4.185 4.185 0 0 1-2.127.52 3.6 3.6 0 0 1-2.69-1.044 3.7 3.7 0 0 1-1.024-2.706 4.074 4.074 0 0 1 1.1-2.978 3.93 3.93 0 0 1 2.942-1.124 4.281 4.281 0 0 1 1.806.36v1.582a2.73 2.73 0 0 0-1.667-.586 2.312 2.312 0 0 0-1.762.728 2.669 2.669 0 0 0-.687 1.908 2.54 2.54 0 0 0 .647 1.838 2.291 2.291 0 0 0 1.736.674 2.708 2.708 0 0 0 1.725-.652zM159.4 19.619a1.4 1.4 0 0 0-.884-.242 1.514 1.514 0 0 0-1.258.682 3.047 3.047 0 0 0-.5 1.852V25.5h-1.7V18h1.7v1.545h.029a2.6 2.6 0 0 1 .764-1.233 1.72 1.72 0 0 1 1.151-.444 1.425 1.425 0 0 1 .7.14zM163.788 25.676a3.71 3.71 0 0 1-2.767-1.051 3.8 3.8 0 0 1-1.035-2.787 3.7 3.7 0 0 1 3.985-4.014 3.581 3.581 0 0 1 2.733 1.033 3.994 3.994 0 0 1 .98 2.864 3.938 3.938 0 0 1-1.056 2.875 3.8 3.8 0 0 1-2.84 1.08zm.08-6.5a1.932 1.932 0 0 0-1.571.7 2.913 2.913 0 0 0-.578 1.919 2.744 2.744 0 0 0 .585 1.856 1.957 1.957 0 0 0 1.564.678 1.862 1.862 0 0 0 1.539-.666 2.95 2.95 0 0 0 .537-1.9 2.99 2.99 0 0 0-.537-1.911 1.851 1.851 0 0 0-1.539-.672zM168.94 25.266v-1.575a3.383 3.383 0 0 0 2.1.725q1.535 0 1.535-.908a.714.714 0 0 0-.132-.436 1.263 1.263 0 0 0-.354-.318 2.864 2.864 0 0 0-.526-.25c-.2-.072-.428-.155-.677-.248a7.074 7.074 0 0 1-.829-.389 2.526 2.526 0 0 1-.615-.465 1.758 1.758 0 0 1-.369-.59 2.168 2.168 0 0 1-.124-.769 1.775 1.775 0 0 1 .256-.955 2.224 2.224 0 0 1 .687-.7 3.294 3.294 0 0 1 .979-.425 4.49 4.49 0 0 1 1.129-.139 5.163 5.163 0 0 1 1.856.315v1.487a3.127 3.127 0 0 0-1.812-.542 2.323 2.323 0 0 0-.582.066 1.477 1.477 0 0 0-.442.183.893.893 0 0 0-.285.282.677.677 0 0 0-.1.363.779.779 0 0 0 .1.41.936.936 0 0 0 .3.3 2.675 2.675 0 0 0 .482.234q.282.105.648.23a9.5 9.5 0 0 1 .866.4 2.872 2.872 0 0 1 .654.465 1.789 1.789 0 0 1 .416.6 2.034 2.034 0 0 1 .147.81 1.855 1.855 0 0 1-.263 1 2.212 2.212 0 0 1-.7.7 3.28 3.28 0 0 1-1.013.413 5.2 5.2 0 0 1-1.209.136 5.1 5.1 0 0 1-2.123-.41zM179.183 25.676a3.711 3.711 0 0 1-2.768-1.051 3.8 3.8 0 0 1-1.034-2.787 3.7 3.7 0 0 1 3.984-4.014 3.585 3.585 0 0 1 2.734 1.033 3.993 3.993 0 0 1 .979 2.864 3.934 3.934 0 0 1-1.056 2.875 3.794 3.794 0 0 1-2.839 1.08zm.08-6.5a1.934 1.934 0 0 0-1.572.7 2.919 2.919 0 0 0-.578 1.919 2.749 2.749 0 0 0 .585 1.856 1.959 1.959 0 0 0 1.565.678 1.864 1.864 0 0 0 1.539-.666 2.956 2.956 0 0 0 .537-1.9 3 3 0 0 0-.537-1.911 1.852 1.852 0 0 0-1.539-.672zM188.787 15.781a1.523 1.523 0 0 0-.782-.2q-1.235 0-1.235 1.4V18h1.74v1.333h-1.733V25.5h-1.7v-6.167H183.8V18h1.279v-1.216a2.37 2.37 0 0 1 .775-1.871 2.817 2.817 0 0 1 1.937-.684 2.866 2.866 0 0 1 .994.138zM193.94 25.42a2.944 2.944 0 0 1-1.307.248q-2.179 0-2.179-2.094v-4.241H189.2V18h1.25v-1.736l1.7-.483V18h1.79v1.333h-1.79v3.75a1.472 1.472 0 0 0 .242.952 1 1 0 0 0 .8.285 1.162 1.162 0 0 0 .745-.248z">
                                            </path>
                                            <path fill="#f25022" d="M13 11h9v9h-9z"></path>
                                            <path fill="#00a4ef" d="M13 21h9v9h-9z"></path>
                                            <path fill="#7fba00" d="M23 11h9v9h-9z"></path>
                                            <path fill="#ffb900" d="M23 21h9v9h-9z"></path>
                                        </svg></div>
                                </div>
                            </div>
                            <!--end::Action-->
                            {{-- <div class="form-group row justify-content-center">
                                <label for="password-confirm" class="col-form-label text-md-right">Need an Account?</label>
                                &nbsp;&nbsp;
                                <a href="{{ url('/register') }}" class="col-form-label text-sm text-gray-700 underline">Sign Up</a>
                            </div> --}}
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Signin-->
                    <!--begin::Signup-->
                    {{-- <div class="login-form login-signup">
						<!--begin::Form-->
						<form class="form" novalidate="novalidate" id="kt_login_signup_form">
							<!--begin::Title-->
							<div class="pb-13 pt-lg-0 pt-5">
								<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Sign Up</h3>
								<p class="text-muted font-weight-bold font-size-h4">Enter your details to create your account</p>
							</div>
							<!--end::Title-->
							<!--begin::Form group-->
							<div class="form-group">
								<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="text" placeholder="Fullname" name="fullname" autocomplete="off" />
							</div>
							<!--end::Form group-->
							<!--begin::Form group-->
							<div class="form-group">
								<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="email" placeholder="Email" name="email" autocomplete="off" />
							</div>
							<!--end::Form group-->
							<!--begin::Form group-->
							<div class="form-group">
								<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="password" placeholder="Password" name="password" autocomplete="off" />
							</div>
							<!--end::Form group-->
							<!--begin::Form group-->
							<div class="form-group">
								<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="password" placeholder="Confirm password" name="cpassword" autocomplete="off" />
							</div>
							<!--end::Form group-->
							<!--begin::Form group-->
							<div class="form-group">
								<label class="checkbox mb-0">
									<input type="checkbox" name="agree" />
									<span></span>
									<div class="ml-2">I Agree the
										<a href="#">terms and conditions</a>.</div>
								</label>
							</div>
							<!--end::Form group-->
							<!--begin::Form group-->
							<div class="form-group d-flex flex-wrap pb-lg-0 pb-3">
								<button type="button" id="kt_login_signup_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
								<button type="button" id="kt_login_signup_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</button>
							</div>
							<!--end::Form group-->
						</form>
						<!--end::Form-->
					</div> --}}
                    <!--end::Signup-->
                    <!--begin::Forgot-->
                    {{-- <div class="login-form login-forgot">
						<!--begin::Form-->
						<form class="form" novalidate="novalidate" id="kt_login_forgot_form">
							<!--begin::Title-->
							<div class="pb-13 pt-lg-0 pt-5">
								<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Forgotten Password ?</h3>
								<p class="text-muted font-weight-bold font-size-h4">Enter your email to reset your password</p>
							</div>
							<!--end::Title-->
							<!--begin::Form group-->
							<div class="form-group">
								<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="email" placeholder="Email" name="email" autocomplete="off" />
							</div>
							<!--end::Form group-->
							<!--begin::Form group-->
							<div class="form-group d-flex flex-wrap pb-lg-0">
								<button type="button" id="kt_login_forgot_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
								<button type="button" id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</button>
							</div>
							<!--end::Form group-->
						</form>
						<!--end::Form-->
					</div> --}}
                    <!--end::Forgot-->
                </div>
                <!--end::Content body-->
                <!--begin::Content footer-->
                <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
                    <div class="text-dark-50 font-size-lg font-weight-bolder mr-10">
                        <span class="mr-1">{{ date('Y') }}©</span>
                        <a style="pointer-events: none; cursor: default;" href="#" target="_blank"
                            class="text-dark-75 text-hover-primary">{{ $copy_right }}</a>

                    </div>
                </div>
                <!--end::Content footer-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Login-->
    </div>
@endsection
