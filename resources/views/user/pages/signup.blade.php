@extends('user.layouts.main')

@section('content')
<!-- Registration 3 - Bootstrap Brain Component -->
<section class="p-2 p-md-4 p-xl-4">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6 bsb-tpl-bg-platinum">
          <div class="d-flex flex-column h-100 p-3 p-md-4 p-xl-5">
            <img class="d-none d-md-block img-fluid rounded mx-auto my-4" loading="lazy" src="user/images/single-image-2.jpg" width="100%" height="100%" alt="ave">
          </div>
        </div>
        <div class="col-12 col-md-6 bsb-tpl-bg-lotion">
          <div class="p-3 p-md-4 p-xl-5">
            <div class="row">
              <div class="col-12">
                <div class="mb-4">
                  <h3 class="mb-2">Registration</h3>
                  <h3 class="fs-6 fw-normal text-secondary m-0">Enter your details to register</h3>
                </div>
              </div>
            </div>
            <form action="#!">
              <div class="row gy-3 gy-md-4 overflow-hidden">
                <div class="col-12">
                  <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" name="firstName" id="firstName" placeholder="First Name" required>
                </div>
                <div class="col-12">
                  <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" name="lastName" id="lastName" placeholder="Last Name" required>
                </div>
                <div class="col-12">
                  <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                </div>
                <div class="col-12">
                  <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                  <input type="password" class="form-control" name="password" id="password" value="" required>
                </div>
                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input mx-0" type="checkbox" value="" name="iAgree" id="iAgree" required>
                    <label class="form-check-label border-animation-left" for="iAgree">
                      I agree to the <a href="#!" class="item-anchor">terms and conditions</a>
                    </label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="d-grid">
                    <button class="btn bsb-btn-xl btn-primary" type="submit">Sign up</button>
                  </div>
                </div>
              </div>
            </form>
            <div class="row">
              <div class="col-12">
                <hr class="mt-5 mb-4 border-secondary-subtle">
                <p class="m-0 border-animation-left text-end">Already have an account? <a href="#!" class="text-decoration-none item-anchor">Sign in</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection