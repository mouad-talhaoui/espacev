@include('etudiant.includes.header_account')

    <div class="account-bg">
        <div class="card-box m-b-0">
            <div class="text-xs-center m-t-20">
                <a href="{{ route('etudiant.login') }}" class="logo">
                    <img src="{{ asset('assets/images/logo.png') }}" height="234" width="160" />
                </a>
            </div>
            <div class="m-t-30 m-b-20">
                <form class="form-horizontal m-t-20" method="POST" action="{{ route("etudiant.login") }}">
                    @csrf

                    @error('login')
                    <p class="text-danger text-xs-center">
                        {{ $message }}
                    </p>
                    @enderror
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <x-text-input id="login" class="form-control" type="email" name="login" :value="old('login')" placeholder="Email Institutionnel" required autofocus autocomplete="login" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <x-text-input id="password" class="form-control"
                            type="password"
                            name="password"
                            placeholder="Code apogee"
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
@include('etudiant.includes.footer_account')
