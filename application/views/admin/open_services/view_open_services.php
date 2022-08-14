<div class="content-wrapper">
  <section class="content-header">
    <h1>
      View Open Services
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>dcadmin/Open_services/view_open_services"><i class="fa fa-rotate-left"></i> View Open Services </a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div style="display: flex;justify-content: space-between;">
          <a class="btn btn-info cticket" href="<?php echo base_url() ?>dcadmin/Open_services/add_open_service" role="button" style="margin-bottom:12px;"> Add Services</a>
          <div style="margin-top:0.6rem">
            <form action="<?= base_url() ?>dcadmin/Open_services/sort_datewise" method="post" enctype="multipart/form-data">
              <label>Sort By</label>
              <input type="date" name="from_date" required placeholder="From Date" id="from_date" class="form-control" value="" style="display: inline;width:auto">
              <input type="date" name="to_date" required placeholder="To Date" id="to_date" class="form-control" value="" style="display: inline;width:auto">
              <button type="submit" class="btn btn-info cticket">Submit</button>
            </form>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> <?= $heading ?></h3>
          </div>
          <div class="panel panel-default">

            <?php if (!empty($this->session->flashdata('smessage'))) { ?>
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i> Alert!</h4>
              <?php echo $this->session->flashdata('smessage');
                                $this->session->unset_userdata('smessage'); ?>
            </div>
            <?php }
                        if (!empty($this->session->flashdata('emessage'))) { ?>
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-ban"></i> Alert!</h4>
              <?php echo $this->session->flashdata('emessage');
                                $this->session->unset_userdata('emessage'); ?>
            </div>
            <?php } ?>


            <div class="panel-body">
              <div class="box-body table-responsive no-padding">
                <table class="table table-bordered table-hover table-striped" id="userTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Customer Name</th>
                      <th>Customer Phone</th>
                      <th>Address</th>
                      <th>Service Date</th>
                      <th>Parts</th>
                      <th>Amount</th>
                      <th>Remarks</th>
                      <th>Service Provider Name</th>
                      <th>Service Provider Phone</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                                        foreach ($services_data->result() as $data) {
                                          $parts = "";
                                          $total = 0;
                                          $sell_data = $this->db->get_where('tbl_sells', array('service_id =' => $data->id))->result();
                                          $a=1;
                                          foreach($sell_data as $sell) {
                                            $pro_data = $this->db->get_where('tbl_products', array('id =' => $sell->products_id))->result_array();
                                            if ($a==1) {
                                              $parts = $pro_data[0]['name'];
                                            }else{
                                              $parts = $parts .", ". $pro_data[0]['name'];
                                            }
                                          $total = $total + $pro_data[0]['mrp']*$sell->qty;
                                          $a++;}
                                           ?>
                    <tr>
                      <td><?php echo $i ?> </td>
                      <td><?php echo $data->cus_name ?></td>
                      <td><?php echo $data->cus_mobile ?></td>
                      <td><?php echo $data->address ?></td>
                      <td><?php echo $data->service_date ?></td>
                      <td><?php echo $parts ?></td>
                      <td>₹<?php echo $total ?></td>
                      <td><?php echo $data->remarks ?></td>
                      <td><?php echo $data->sprov_name ?></td>
                      <td><?php echo $data->sprov_mobile ?></td>
                      <td>
                        <?
                                                    $newdate = new DateTime($data->created);
                                                    echo $newdate->format('d/m/Y');
                                                    ?>
                      </td>
                      <td>
                        <div class="btn-group" id="btns<?php echo $i ?>">
                          <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              Action <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="<?php echo base_url() ?>dcadmin/Open_services/update_open_service/<?php echo base64_encode($data->id) ?>">Edit</a></li>
                              <li><a href="javascript:;" class="dCnf" mydata="<?php echo $i ?>">Delete</a></li>
                            </ul>
                          </div>
                        </div>

                        <div style="display:none" id="cnfbox<?php echo $i ?>">
                          <p> Are you sure delete this </p>
                          <a href="<?php echo base_url() ?>dcadmin/Open_services/delete_open_service/<?php echo base64_encode($data->id); ?>" class="btn btn-danger">Yes</a>
                          <a href="javasript:;" class="cans btn btn-default" mydatas="<?php echo $i ?>">No</a>
                        </div>
                      </td>
                    </tr>
                    <?php $i++;
                                        } ?>
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<style>
  label {
    margin: 5px;
  }
</style>
<script src="<?php echo base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    //------ UPCOMMING DATE DISABLE ------
    $(function() {
      var dtToday = new Date();
      var month = dtToday.getMonth() + 1;
      var day = dtToday.getDate();
      var year = dtToday.getFullYear();
      if (month < 10)
        month = '0' + month.toString();
      if (day < 10)
        day = '0' + day.toString();
      var maxDate = year + '-' + month + '-' + day;
      $('#from_date').attr('max', maxDate);
      $('#to_date').attr('max', maxDate);
    });


    $(document.body).on('click', '.dCnf', function() {
      var i = $(this).attr("mydata");
      console.log(i);

      $("#btns" + i).hide();
      $("#cnfbox" + i).show();

    });

    $(document.body).on('click', '.cans', function() {
      var i = $(this).attr("mydatas");
      console.log(i);

      $("#btns" + i).show();
      $("#cnfbox" + i).hide();
    })

  });
</script>
