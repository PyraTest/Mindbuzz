@extends('layouts.login')

    @section('content')

    


    <section class="flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
          <div class="col-md-4 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
              <div class="card-header border-0 pb-0">
                <div class="card-title text-center">
                  <img src="../../../app-assets/images/logo/logo-dark.png" alt="branding logo">
                </div>
                <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                  <span>Reset Your password.</span>
                </h6>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <form class="form-horizontal" action="{{route('admin.reset_password_final' , $data->token)}}" method="post" novalidate>
                    @csrf
                    <fieldset class="form-group position-relative has-icon-left">
                      <input type="email" class="form-control form-control-lg input-lg" disabled id="user-email" name="email" value="{{ $data->email }}"
                      placeholder="Your Email Address" required>
                      <div class="form-control-position">
                        <i class="ft-mail"></i>
                      </div>
                      @error('email')
                        <span class="text-danger">{{$message}}</span>
                      @enderror
                    </fieldset>
                    <fieldset class="form-group position-relative has-icon-left">
                      <input type="password" class="form-control form-control-lg input-lg" id="user-password" name="password"
                      placeholder="New Password" required>
                      <div class="form-control-position">
                        <i class="la la-key"></i>
                      </div>
                      @error('password')
                        <span class="text-danger">{{$message}}</span>
                      @enderror
                    </fieldset>
                    <fieldset class="form-group position-relative has-icon-left">
                      <input type="password" class="form-control form-control-lg input-lg" id="user-password_confirmation" name="password_confirmation"
                      placeholder="Repeated New Password" required>
                      <div class="form-control-position">
                        <i class="la la-key"></i>
                      </div>
                      @error('password_confirmation')
                        <span class="text-danger">{{$message}}</span>
                      @enderror
                    </fieldset>
                    <button type="submit" class="btn btn-outline-info btn-lg btn-block"><i class="ft-unlock"></i> Reset Password</button>
                  </form>
                </div>
              </div>
              <div class="card-footer border-0">
                <p class="float-sm-left text-center"><a href="{{ route('admin.login') }}" class="card-link">Login</a></p>
              </div>
            </div>
          </div>
        </div>
      </section>





    </section>

@stop
