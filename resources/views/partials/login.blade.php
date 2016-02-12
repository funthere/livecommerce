            <div class="row">
                @include('partials.error')
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login ke Akun Anda</h2>
                        {!! Form::open(['url' => 'auth/login']) !!}
                            <input type="email" name="email" placeholder="Email Address" />
                            <input type="password" name="password" placeholder="Password" />
                            <span>
                                <input type="checkbox" name="remember" class="checkbox"> 
                                Ingat Saya
                                <a href="/reset/email" class="pull-right">Lupa Password</a>
                            </span>
                            <button type="submit" class="btn btn-default">Login</button>
                        {!! Form::close() !!}
                    </div><!--/login form-->
                </div>
                <div class="col-sm-2">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Daftar Baru</h2>
                        {!! Form::open(['url' => 'auth/register']) !!}
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap"/>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"/>
                            <input type="password" name="password" placeholder="Password"/>
                            <input type="password" name="password_confirmation" placeholder="Ulangi Password"/>
                            <p>
                                Dengan melakukan registrasi berarti Anda setuju  dengan peraturan kami
                            </p>
                            <button type="submit" class="btn btn-default">Daftar</button>
                        {!! Form::close() !!}
                    </div><!--/sign up form-->
                </div>
            </div>