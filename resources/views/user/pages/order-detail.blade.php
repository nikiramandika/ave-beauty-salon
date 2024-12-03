@extends('user.layouts.main')

@section('content')
<div>
    <section class="p-2 p-md-4 p-xl-4">
        <div class="container pt-5">
          
      <!-- Main content -->
      <div class="row">
        <div class="col-lg-8 ">
          <!-- Details -->
          <div class="card mb-4 p-6">
            <div class="card-body p-4 mt-6">
                <div class="card-header p-0" style="background-color: transparent;">
                    <div class="d-flex justify-content-between">
                      <div>
                        <h4 class="mb-1">Order #no</h4>
                        <div class="d-flex align-items-center mb-2 fc-heading">
                          <small>Order Date: Octobesr 03,2023 at 6:31 pm</small>
                        </div>
                      </div>
                      <div><span class="fs-6 badge bg-warning rounded-pill p-2 px-3" style="color: white">On Process</span>
                      </div>
                    </div>
      
                  </div>
              <table class="table table-borderless mt-2">
                <tbody>



                  <tr>
                    <td class="ps-0">
                      <div class="d-flex mb-2">
                        <div class="flex-shrink-0">
                          <img src="https://www.bootdey.com/image/280x280/87CEFA/000000" alt="" width="35" class="img-fluid">
                        </div>
                        <div class="flex-lg-grow-1 ms-3">
                          <h6 class="small mb-0"><a href="#" class="text-reset">Wireless Headphones with Noise Cancellation Tru Bass Bluetooth HiFi</a></h6>
                          <span class="small">Color: Black</span>
                        </div>
                      </div>
                    </td>
                    <td>1</td>
                    <td class="text-end pe-0">$79.99</td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="2" class="ps-0">Subtotal</td>
                    <td class="text-end pe-0">$159,98</td>
                  </tr>
                  <tr class="fw-bold">
                    <td colspan="2" class="ps-0">TOTAL</td>
                    <td class="text-end p-0">$169,98</td>
                  </tr>
                </tfoot>
              </table>

              <div class="d-flex justify-content-end">
                <div>
                </div>
                <div>
                  <a href="#!" class="btn btn-primary mx-2">View Invoice</a>
                </div>
                <div>
                  <a href="#!" class="btn btn-primary">Download Invoice</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Payment -->
        </div>
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body p-4">
              <div class="d-flex justify-content-between">
                <h4 class="h5 fw-normal fc-heading">Payment Method  </h4>
                <div>
                  <span class="fs-6 badge bg-success rounded-pill py-2 px-3 ms-2 fs-roboto" style="color: white">Paid</span>
                </div>
              </div>
              
                  <p>Transfer</p>
                  <hr>
              <h3 class="h5 fc-heading">Shipping Information</h3>
              Delivery via Gojek/Grab
              <p class="m-0 ">Address: 
                1355 Market St, Suite 900
                San Francisco, CA 94103
            </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    </section>
</div>

@endsection