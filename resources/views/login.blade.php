<!-- Login box start -->
<form method="post" action="{{ route('login.store') }}">
    @csrf <!-- This directive is important for CSRF protection -->
        <div class="login-box">
          <div class="login-form">
            <a href="{{ route('login') }}" class="login-logo">
              <img src="{{asset('/assets/images/logo.png')}}" alt="Admin Templates" style="width:100% !important;"/>
            </a>
            <div class="login-welcome">
              Please login to your account.
            </div>
            @if(session('error'))
              <div class="alert alert-danger">
                {{ session('error') }}
              </div>
            @endif
            @if($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <div class="mb-3">
              <label class="form-label" for="uname">Email</label>
              <input type="text" id="uname" name="email" class="form-control">
            </div>
            <div class="mb-3">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="pwd">Password</label>
                <!-- <a href="forgot-password.html" id="pwd" name="password" class="btn-link ml-auto">Forgot password?</a> -->
              </div>
              <input type="password" name="password" class="form-control">
            </div>
            <div class="login-form-actions">
              <button type="submit" class="btn"> <span class="icon"> <i class="bi bi-arrow-right-circle"></i>
                </span>
                Login</button>
            </div>
          </div>
        </div>
    </form>
    <!-- Login box end -->
