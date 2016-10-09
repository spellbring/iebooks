<!-- content panel -->
    <div class="main-panel">

       <?php $this->load->view($_NavBar); ?>

      <!-- main area -->
      <div class="main-content">
        <div class="row">
          <div class="col-sm-12">
            <div class="panel">
              <div class="panel-heading border">
                Line Chart
              </div>
              <div class="panel-body">
                <div id="line-chart" class="chart"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="panel">
              <div class="panel-heading border">
                Grouped Bar Chart
              </div>
              <div class="panel-body">
                <div class="bar-chart chart"></div>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="panel">
              <div class="panel-heading border">
                Pie Chart
              </div>
              <div class="panel-body">
                <div class="flot-pie chart-sm"></div>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="panel">
              <div class="panel-heading border">
                Realtime Chart
              </div>
              <div class="panel-body">
                <div class="realtime chart-sm"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /main area -->
    </div>
    <!-- /content panel -->