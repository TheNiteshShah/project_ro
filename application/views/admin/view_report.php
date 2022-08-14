<style>
  table,
  th,
  td {
    border: 1px solid black;
    border-collapse: collapse;
  }
</style>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      View Report
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><?=$heading?></h3>
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
              <div class="box-body table-responsive no-padding row">
                <table class="table " id="userTable">
                  <thead>
                    <tr>
                      <th rowspan="2">Income</th>
                      <th>Amount</th>
                      <th rowspan="2">Expenses</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Sell</td>
                      <td>₹<?=$total_sells?></td>
                      <td>Purchasing</td>
                      <td>₹<?=$total_purchasing?></td>
                    </tr>
                    <tr>
                      <td>Open Services</td>
                      <td>₹<?=$total_services?></td>
                      <td>Expense</td>
                      <td>₹<?=$total_transExp?></td>
                    </tr>
                    <tr>
                      <td>Income</td>
                      <td>₹<?=$total_transIncome?></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                    </tr>
                    <tr></tr>
                    <tr>
                      <td>Total Income</td>
                      <td>₹<?=$total_sells + $total_services + $total_transIncome?></td>
                      <td>Total Expense</td>
                      <td>₹<?=$total_purchasing + $total_transExp?></td>
                    </tr>
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
