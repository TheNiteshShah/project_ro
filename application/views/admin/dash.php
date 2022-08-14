
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <!-- <li class="active">Dashboard</li> -->
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="<?=base_url()?>dcadmin/Customers/view_customers">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-user" aria-hidden="true"></i>
</i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Customers</span>
                  <span class="info-box-number"><?=$count_costomers?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="<?=base_url()?>dcadmin/Products/view_products">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-tags"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Products</span>
                  <span class="info-box-number"><?=$count_products?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="<?=base_url()?>dcadmin/Sells/view_sells">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Sells</span>
                  <span class="info-box-number">₹<?=$count_sells?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="<?=base_url()?>dcadmin/Open_services/view_open_services">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-wrench"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Open Services</span>
                  <span class="info-box-number"><?=$count_services?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </a>
            </div><!-- /.col -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-purple"><i class="fa fa-file"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">View Report</span>
                      <form action="<?= base_url() ?>dcadmin/Home/view_report" method="post" enctype="multipart/form-data">
                        <div style="margin-top:5px">
                          <input type="date" name="from_date" required placeholder="From Date"  class="form-control" value="" style="display: inline;width:auto">
                          <input type="date" name="to_date" required placeholder="To Date" class="form-control" value="" style="display: inline;width:auto">
                          <button type="submit" class="btn btn-info cticket">Submit</button>
                        </div>
                      </form>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <!-- <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Sales</span>
                  <span class="info-box-number">760</span> -->
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <!-- <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">New Members</span>
                  <span class="info-box-number">2,000</span> -->
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


    </div><!-- ./wrapper -->
