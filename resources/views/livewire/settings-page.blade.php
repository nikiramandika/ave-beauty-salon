<div>
  <style>
      .row-bordered {
          overflow: hidden;
      }

      .form-group {
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

      .account-settings-multiselect~.select2-container {
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
          border-color: rgba(24, 28, 33, 0.03) !important;
      }

      .settings {
          overflow: auto;
          /* Allow natural scrolling */
          scroll-behavior: auto;
          /* No smoothing */
          min-height: 70vh;
      }
  </style>

  <div class="container py-4">
      <div class="card overflow-hidden my-4">
          <div class="row no-gutters row-bordered row-border-light my-2 settings">
              <div class="col-md-3 pt-0 mt-2">
                  <div class="list-group list-group-flush account-settings-links">
                      <a class="list-group-item list-group-item-action" data-toggle="list"
                          href="#account-general">General</a>
                      <a class="list-group-item list-group-item-action" data-toggle="list"
                          href="#change-password">Change password</a>
                      <a class="list-group-item list-group-item-action" data-toggle="list"
                          href="#delete-account">Delete Account</a>
                  </div>
              </div>
              <div class="col-md-9 p-4">
                  <div class="tab-content">

                      <div class="tab-pane fade" id="account-general">
                          <!-- Show success/error message -->
                          <div class="card-body">
                            <livewire:account-settings />
                          </div>
                        </div>
                        
                        <!-- Change Password Tab -->
                        <div class="tab-pane fade" id="change-password">
                          <div class="card-body pb-2">
                            
                            <livewire:change-password />
                          </div>
                      </div>

                      <!-- Delete Account Tab -->
                      <div class="tab-pane fade" id="delete-account">
                          <div class="card-body pb-2">
                              <livewire:delete-account />
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>


  <script>
      $(document).ready(function() {
          // Cek apakah ada hash di URL (misalnya: #account-general, #change-password, #delete-account)
          var activeTab = window.location.hash || '#account-general'; // Default tab adalah General

          // Menambahkan kelas 'active' dan 'show' ke tab yang sesuai
          $(activeTab).addClass('show active'); // Menandai tab yang sesuai sebagai aktif
          $('a[href="' + activeTab + '"]').addClass('active'); // Menandai link tab yang sesuai sebagai aktif

          // Ketika tab diklik, perbarui URL hash untuk menandakan tab yang dipilih
          $('a[data-toggle="list"]').on('click', function(e) {
              var targetTab = $(this).attr('href');
              window.location.hash = targetTab; // Mengubah URL sesuai dengan tab yang dipilih
          });
      });
  </script>
</div>
