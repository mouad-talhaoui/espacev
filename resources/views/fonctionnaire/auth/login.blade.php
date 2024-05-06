@include('fonctionnaire.includes.header_account')

    <div class="account-bg">
        <div class="card-box m-b-0">
            <div class="text-xs-center m-t-20">
                <a href="{{ route('fonctionnaire.login') }}" class="logo">
                    <img src="{{ asset('assets/images/logo.png') }}" height="234" width="160" />
                </a>
            </div>
            <div class="m-t-30 m-b-20">
                <form class="form-horizontal m-t-20" method="POST" action="{{ route("fonctionnaire.login") }}">
                    @csrf
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <x-text-input id="email" class="form-control" type="text" name="email" :value="old('email')" placeholder="Email" required autofocus autocomplete="email" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <x-text-input id="password" class="form-control"
                            type="password"
                            name="password"
                            placeholder="Mot de passe"
                             autocomplete="current-password" />
                        </div>
                    </div>

                    <div class="form-group text-center m-t-30">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Connecter
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- end card-box-->
    </div>
    <!-- end wrapper page -->
@include('fonctionnaire.includes.footer_account')
