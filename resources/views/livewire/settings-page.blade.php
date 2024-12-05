
<head>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  
  
  <style>
    .row-bordered {
      overflow: hidden;
  }
  .form-group{
    margin-top: 1rem;
  }
  .account-settings-links .list-group-item {
      padding: 0.85rem 1.5rem;
      border-color: rgba(24, 28, 33, 0.03);
  }
  .account-settings-links .list-group-item.active {
      color: #4e5155;
      font-weight: bold;
      background: transparent;
  }
  .account-settings-multiselect ~ .select2-container {
      width: 100% !important;
  }
  .light-style .account-settings-links .list-group-item {
      padding: 0.85rem 1.5rem;
      border-color: rgba(24, 28, 33, 0.03) !important;
  }
  .light-style .account-settings-links .list-group-item.active {
      color: #4e5155 !important;
  }
  .material-style .account-settings-links .list-group-item {
      padding: 0.85rem 1.5rem;
      border-color: rgba(24, 28, 33, 0.03) !important;
  }
  .material-style .account-settings-links .list-group-item.active {
      color: #4e5155 !important;
  }
  .dark-style .account-settings-links .list-group-item {
      padding: 0.85rem 1.5rem;
      border-color: rgba(255, 255, 255, 0.03) !important;
  }
  .dark-style .account-settings-links .list-group-item.active {
      color: #fff !important;
  }
  .light-style .account-settings-links .list-group-item.active {
      color: #4E5155 !important;
  }
  .light-style .account-settings-links .list-group-item {
      padding: 0.85rem 1.5rem;
      border-color: rgba(24,28,33,0.03) !important;
  }
  .settings {
    overflow: auto; /* Allow natural scrolling */
    scroll-behavior: auto; /* No smoothing */
    min-height: 70vh;
}
  </style>

<div class="container py-4">

    <div class="card overflow-hidden my-4">
      <div class="row no-gutters row-bordered row-border-light my-2 settings">
        <div class="col-md-3 pt-0 mt-2">
          <div class="list-group list-group-flush account-settings-links">
            <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
            <a class="list-group-item list-group-item-action" data-toggle="list" href="#change-password">Change password</a>
            <a class="list-group-item list-group-item-action" data-toggle="list" href="#delete-account">Delete Account</a>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">
            <div class="tab-pane fade active show" id="account-general">
              <hr class="border-light m-0">

              <div class="card-body">
                <h4 class="mb-4">General Settings</h4>
                <div class="form-group">
                  <label class="form-label">First Name</label>
                  <input type="text" class="form-control mb-1" placeholder="First name">
                </div>
                <div class="form-group">
                  <label class="form-label">Last Name</label>
                  <input type="text" class="form-control" placeholder="Last name">
                </div>
                <div class="form-group">
                  <label class="form-label">E-mail</label>
                  <input type="text" class="form-control mb-1" placeholder="E-mail">
                  <div class="alert alert-warning mt-3">
                    Your email is not confirmed. Please check your inbox.<br>
                    <a href="javascript:void(0)">Resend confirmation</a>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Phone Number</label>
                  <input type="number" class="form-control" value="Company Ltd.">
                </div>

                <div class="text-right mt-4">
                  <button type="button" class="btn btn-primary">Save changes</button>&nbsp;
                  <button type="button" class="btn btn-default">Cancel</button>
                </div>
              </div>
              

            </div>
            <div class="tab-pane fade" id="change-password">
              <div class="card-body pb-2">
                <h4 class="mb-4">Change Password</h4>
                <div class="form-group">
                  <label class="form-label">Current password</label>
                  <input type="password" class="form-control" value="">
                </div>

                <div class="form-group">
                  <label class="form-label">New password</label>
                  <input type="password" class="form-control">
                </div>

                <div class="form-group">
                  <label class="form-label">Repeat new password</label>
                  <input type="password" class="form-control">
                </div>
                <div class="text-right mt-4 mb-2">
                  <button type="button" class="btn btn-primary">Save changes</button>&nbsp;
                </div>

              </div>
            </div>
            <div class="tab-pane fade" id="delete-account">
              <div class="card-body pb-2">
                <h4 class="mb-4">Delete Account</h4>
                <div class="form-group">
                  <label class="form-label">Current Pasword*</label>
                  <input type="password" class="form-control" value="" placeholder="">
                </div>
                <p>Enter your current password to confirm deletion of your account.</p>
                <div class="text-right mt-4 mb-2">
                  <button class="btn bsb-btn-xl btn-primary">Delete Account</button>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
