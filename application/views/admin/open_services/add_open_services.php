<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Add Open Service
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>dcadmin/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url() ?>dcadmin/Open_services/view_open_services"><i class="fa fa-rotate-left"></i> View Open Services </a></li>
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
                            <form action=" <?php echo base_url()  ?>dcadmin/Open_services/add_open_service_data/<? echo base64_encode(1);  ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <input type="hidden" name="count" value="1" id="count">
                                        <tr>
                                            <td> <strong>Customer Name</strong> <span style="color:red;">*</span></strong> </td>
                                            <td> <input type="text" name="cus_name" class="form-control" placeholder="" value="" required /> </td>
                                        </tr>
                                        <tr>
                                            <td> <strong>Customer Phone</strong> <span style="color:red;">*</span></strong> </td>
                                            <td> <input type="text" name="cus_mobile" class="form-control" placeholder="" value="" onkeypress="return isNumberKey(event)" maxlength="10" minlength="10" required /> </td>
                                        </tr>
                                        <tr>
                                            <td> <strong>Address</strong> <span style="color:red;">*</span></strong> </td>
                                            <td> <input type="text" name="address" class="form-control" placeholder="" value="" required /> </td>
                                        </tr>
                                        <tr>
                                            <td> <strong>Service Data</strong> <span style="color:red;">*</span></strong> </td>
                                            <td> <input type="text" name="service_date" class="form-control" placeholder="" value="" required /> </td>
                                        </tr>
                                        <tr>
                                            <td> <strong>Parts</strong> <span style="color:red;">*</span></strong> </td>
                                            <td id="main">
                                                <select class="form-control" data-live-search="true" name="part_id_1" required>
                                                    <? foreach ($products_data->result() as $product) { ?>
                                                        <option value="<?= $product->id; ?>"><?= $product->name ?></option>
                                                      <? } ?>
                                                </select>
                                                <span style="display:flex">
                                                    <input type="text" class="form-control" placeholder="Quantity" name='part_qty_1' style="width:60%" onkeypress="return isNumberKey(event)">
                                                    <button type="button" class="plus" style="margin-left:10px">+</button>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <strong>Remarks</strong> <span style="color:red;">*</span></strong> </td>
                                            <td> <input type="text" name="remarks" class="form-control" placeholder="" value="" required /> </td>
                                        </tr>
                                        <tr>
                                            <td> <strong>Service Provider Name</strong> <span style="color:red;">*</span></strong> </td>
                                            <td> <input type="text" name="sprov_name" class="form-control" placeholder="" value="" required /> </td>
                                        </tr>
                                        <tr>
                                            <td> <strong>Service Provider Phone</strong> <span style="color:red;">*</span></strong> </td>
                                            <td> <input type="text" name="sprov_mobile" class="form-control" placeholder="" value="" onkeypress="return isNumberKey(event)" maxlength="10" minlength="10" required /> </td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src=" <?php echo base_url()  ?>assets/slider/ajaxupload.3.5.js"></script>
<link href=" <? echo base_url()  ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />

<script>
    //-----------add datepicker ----------------------
    $(".plus").click(function() {
        var bla = parseInt($('#count').val());
        var c_up = bla + 1;
        $('#count').val(c_up);
        $("#main").append('<div style="margin-top:5px" id="div_' + c_up + '"><select class="form-control" data-live-search="true" name="part_id_' + c_up + '" required><? foreach ($products_data->result() as $product) { ?><option value="<?= $product->id; ?>"><?= $product->name ?></option><? } ?></select><span style="display:flex"><input type="text" class="form-control" placeholder="Quantity" name="part_qty_' + c_up + '" style="width:60%" onkeypress="return isNumberKey(event)"><button style="margin-left:3px" onclick="remove_it(' + c_up + ')">-</button></span></div>');
        $('select').selectpicker();

    });

    function remove_it(i) {
        $("#div_" + i).remove();
        var bla = parseInt($('#count').val());
        var i = bla - 1;
    };

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
<script type="text/javascript">
    $('select').selectpicker();
</script>
