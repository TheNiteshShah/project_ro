<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Add New Transaction
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>dcadmin/Transactions/view_transactions"><i class="fa fa-rotate-left"></i> View Transaction </a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">

        <div class="panel panel-default">
          <div class="panel-heading">
          </div>

          <? if (!empty($this->session->flashdata('smessage'))) {  ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <? echo $this->session->flashdata('smessage');
                            $this->session->unset_userdata('smessage'); ?>
          </div>
          <? }
                    if (!empty($this->session->flashdata('emessage'))) {  ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            <? echo $this->session->flashdata('emessage');
                            $this->session->unset_userdata('emessage');  ?>
          </div>
          <? }  ?>
          <div class="panel-body">
            <div class="col-lg-10">
              <form action=" <?php echo base_url()  ?>dcadmin/Transactions/add_transaction_data/<? echo base64_encode(1);  ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <tr>
                      <td> <strong>Type</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <select type="text" name="type" class="form-control" placeholder="" value="" required>
                          <option value="income">Income</option>
                          <option value="expense">Expense</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td> <strong>Amount</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="text" name="amount" class="form-control" placeholder="" value="" onkeypress="return isNumberKey(event)" required /> </td>
                    </tr>
                    <tr>
                      <td> <strong>Remarks</strong> </strong> </td>
                      <td> <input type="text" name="remarks" class="form-control" placeholder="" value="" /> </td>
                    </tr>
                    <tr>
                      <td> <strong>Date</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="date" name="date" class="form-control" placeholder="" value="" required /> </td>
                    </tr>

                    <tr>
                      <td colspan="2">
                        <input type="submit" class="btn btn-success" value="save">
                      </td>
                    </tr>
                  </table>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
    return true;
  }
</script>
<script type="text/javascript" src=" <?php echo base_url()  ?>assets/slider/ajaxupload.3.5.js"></script>
<link href=" <? echo base_url()  ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />
