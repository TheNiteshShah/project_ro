<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Update Sell
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>dcadmin/Sells/view_sells"><i class="fa fa-rotate-left"></i> View Sell </a></li>
      <!-- <li class="active">View Categories</li> -->
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update Sell </h3>
          </div>

          <? if(!empty($this->session->flashdata('smessage'))){  ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <? echo $this->session->flashdata('smessage');
                             $this->session->unset_userdata('smessage');  ?>
          </div>
          <? }
                               if(!empty($this->session->flashdata('emessage'))){  ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            <? echo $this->session->flashdata('emessage');
                           $this->session->unset_userdata('emessage');  ?>
          </div>
          <? }  ?>


          <div class="panel-body">
            <div class="col-lg-10">
              <form action=" <?php echo base_url(); ?>dcadmin/Sells/add_sell_data/<? echo base64_encode(2); ?>/<?=$id;?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <tr>
                      <td> <strong>Customer</strong> <span style="color:red;">*</span></strong> </td>
                      <td>   <select class=" form-control"  data-live-search="true" name="customer_id" required>
                          <? foreach($customers_data->result() as $customer){?>
                          <option value="<?=$customer->id;?>" <?  if ($sell_data->customer_id == $customer->id) {echo "selected";}?>><?=$customer->name?></option>

                          <? } ?>
                        </select></td>
                    </tr>
                    <tr>
                      <td> <strong>Products</strong> <span style="color:red;">*</span></strong> </td>
                      <td><select class="selectpicker form-control" multiple data-live-search="true" name="products_id[]">
                        <?php foreach ($products_data->result() as $pro) {?>
                        <option value="<?=$pro->id;?>" <?php
                        $pro_ids=json_decode($sell_data->products_id);
                        foreach ($pro_ids as $pro_id) {
                        if ($pro_id == $pro->id) {
                        echo "selected";
                        }
                        } ?>>
                        <?=$pro->name;?>
                        </option>
                        <?php } ?>
                      </select></td>
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src=" <?php echo base_url()  ?>assets/slider/ajaxupload.3.5.js"></script>
<link href=" <? echo base_url()  ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />
<script type="text/javascript">
  $('select').selectpicker();
</script>
