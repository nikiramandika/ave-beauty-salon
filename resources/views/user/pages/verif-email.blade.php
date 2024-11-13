@extends('user.layouts.main')

@section('content')
<section class="p-2 p-md-4 p-xl-4">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6 bsb-tpl-bg-lotion">
          <div class="p-3 p-md-4 p-xl-5">
            <div class="row">
              <div class="col-12">
                <div class="mb-4">
                  <h3 class="mb-2">Verify your email address.</h3>
                  <h3 class="fs-6 fw-normal m-0">Thanks for signing up! Before getting started, could you verify your email address clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</h3>
                </div>
              </div>
            </div>
            <form action="#!">
              <div class="row gy-3 gy-md-4 overflow-hidden  mt-1">
                <div class="col-12">
                  <div class="d-grid">
                    <button class="btn bsb-btn-xl btn-primary" type="submit">Resend Verification Email</button>
                  </div>
                </div>
              </div>
              <div class="row gy-3 gy-md-4 overflow-hidden mt-1">
                <div class="col-12">
                  <div class="d-grid border-animation-left">
                    <button class="btn bsb-btn-xl item-anchor" type="submit">Log out</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-12 col-md-6 bsb-tpl-bg-platinum">
            <div class="d-flex flex-column h-100 p-3 p-md-4 p-xl-5">
              <img class="d-none d-md-block img-fluid rounded mx-auto my-4" loading="lazy" src="user/images/single-image-2.jpg" width="100%" height="100%" alt="ave">
            </div>
          </div>
      </div>
    </div>
  </section>    
@endsection