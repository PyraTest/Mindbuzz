@extends('layouts.login')

    @section('content')

    


    <section class="flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
          <div class="col-md-4 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
              <div class="card-header border-0 pb-0">
                <div class="card-title text-center">
                  <img src="{{asset('assets/front/images/steera.png')}}" alt="branding logo">
                </div>
                <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                  <span>We will send you a link to reset password.</span>
                </h6>
              </div>
              @include('dashboard.includes.alerts.errors')
              @include('dashboard.includes.alerts.success')
              <div class="card-content">
                <div class="card-body">
                  <form class="form-horizontal" method="POST" action="{{ route('admin.forgot_password_post') }}" >
                    @csrf
                    <fieldset class="form-group position-relative has-icon-left">
                      <input type="email" class="form-control form-control-lg input-lg" id="user-email"
                      placeholder="Your Email Address" name="email" required>
                      <div class="form-control-position">
                        <i class="ft-mail"></i>
                      </div>
                    </fieldset>
                    <button type="submit" class="btn btn-outline-info btn-lg btn-block"><i class="ft-unlock"></i> Recover Password</button>
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
