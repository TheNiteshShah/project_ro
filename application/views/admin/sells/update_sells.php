<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Update Sell
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>dcadmin/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url() ?>dcadmin/Sells/view_sells"><i class="fa fa-rotate-left"></i> View Sell </a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update Sell </h3>
                    </div>

                    <? if (!empty($this->session->flashdata('smessage'))) {  ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Alert!</h4>
                            <? echo $this->session->flashdata('smessage');
                            $this->session->unset_userdata('smessage');  ?>
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
                            <form action=" <?php echo base_url(); ?>dcadmin/Sells/add_sell_data/<? echo base64_encode(2); ?>/<?= $id; ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            <td> <strong>Customer</strong> <span style="color:red;">*</span></strong> </td>
                                            <td> <select class=" form-control" data-live-search="true" name="customer_id" required>
                                                    <? foreach ($customers_data->result() as $customer) { ?>
                                                        <option value="<?= $customer->id; ?>" <? if ($sell_data->customer_id == $customer->id) {  echo "selected"; } ?>><?= $customer->name ?></option>
                                                    <? } ?>
                                                </select></td>
                                        </tr>
                                        <tr>
                                            <td> <strong>Products</strong> <span style="color:red;">*</span></strong> </td>
                                            <td><select class="form-control" data-live-search="true" name="products_id">
                                                    <?php foreach ($products_data->result() as $pro) { ?>
                                                        <option value="<?= $pro->id; ?>" <?php if ($sell_data->products_id == $pro->id) { echo "selected"; } ?>> <?= $pro->name; ?> </option>
                                                    <?php } ?>
                                                </select></td>
                                        </tr>
                                        <tr>
                                            <td> <strong>Quantity</strong> <span style="color:red;">*</span></strong> </td>
                                            <td> <input type="text" name="qty" class="form-control" placeholder="" value="<?= $sell_data->qty ?>" required /> </td>
                                        </tr>
                                        <tr>
                                            <td> <strong>Installation Date</strong> <span style="color:red;">*</span></strong> </td>
                                            <td> <input type="date" name="inss_date" class="form-control" value="<?= $sell_data->inss_date ?>" required /> </td>
                                        </tr>
                                        <tr>
                                            <td> <strong>Shipping Address</strong> <span style="color:red;">*</span></strong> </td>
                                            <td> <input type="text" name="shipp_address" class="form-control" value="<?= $sell_data->shipp_address ?>" required /> </td>
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
