<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Add New Services
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>dcadmin/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url() ?>dcadmin/Sells/view_sells"><i class="fa fa-rotate-left"></i> View Services </a></li>
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
                            <form action=" <?php echo base_url() ?>dcadmin/Services/add_service_data/<? echo base64_encode(1);  ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <input type="hidden" name="sell_id" value="<?= $id ?>">
                                        <input type="hidden" name="count" value="1" id="count">
                                        <tr>
                                            <td> <strong>Services</strong> <span style="color:red;">*</span></strong> </td>
                                            <td id="main">
                                                <input type="text" class="form-control" name='service_1' placeholder="Service Name">
                                                <input type="date" class="form-control" name='service_date_1'>
                                                <button type="button" class="plus">+</button>
                                            </td>
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

<script>
    //-----------add datepicker ----------------------
    $(".plus").click(function() {
        var bla = parseInt($('#count').val());
        var c_up = bla + 1;
        $('#count').val(c_up);
        $("#main").append('<div style="margin-top:5px" id="div_' + c_up + '"><input type="text" name="service_' + c_up + '" placeholder="Service Name" ><input style="margin-left:3px" type="date" name="service_date_' + c_up + '"><button style="margin-left:3px" onclick="remove_it(' + c_up + ')">-</button></div>');
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
