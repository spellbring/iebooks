<!-- content panel -->
    <div class="main-panel">

    <!-- top header -->
    <?php $this->load->view($_NavBar); ?>
    <!-- /top header -->

      <!-- main area -->
      <div class="main-content">
        <div class="row mb25">
          <div class="col-md-12">
            <div class="panel">
              <div class="panel-heading border">
                Bar chart
              </div>
              <div class="panel-body">
                <div class="canvas-holder">
                  <canvas id="bar-area"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mb25">
          <div class="col-md-12">
            <div class="panel">
              <div class="panel-heading border">
                Line chart
              </div>
              <div class="panel-body">
                <div class="canvas-holder">
                  <canvas id="line-area"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6 mb25">
            <div class="panel">
              <div class="panel-heading border">
                Area chart
              </div>
              <div class="panel-body">
                <div class="canvas-holder">
                  <canvas id="plot-area"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 mb25">
            <div class="panel">
              <div class="panel-heading border">
                Radar chart
              </div>
              <div class="panel-body">
                <div class="canvas-holder">
                  <canvas id="radar"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 mb25">
            <div class="panel">
              <div class="panel-heading border">
                Donut chart
              </div>
              <div class="panel-body">
                <div class="canvas-holder">
                  <canvas id="donut-area"></canvas>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 mb25">
            <div class="panel">
              <div class="panel-heading border">
                Polar chart
              </div>
              <div class="panel-body">
                <div class="canvas-holder">
                  <canvas id="pie-area"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /main area -->
    </div>
    <!-- /content panel -->
