<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Update Reminder
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>dcadmin/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url() ?>dcadmin/Reminders/view_reminders"><i class="fa fa-rotate-left"></i> View Reminders </a></li>
            <!-- <li class="active">View Categories</li> -->
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update Reminder </h3>
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
                            <form action=" <?php echo base_url(); ?>dcadmin/Reminders/add_reminder_data/<? echo base64_encode(2); ?>/<?= $id; ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            <td> <strong>Customer Name</strong> <span style="color:red;">*</span></strong> </td>
                                            <td> <input type="text" name="cname" class="form-control" placeholder="" value="<?= $reminder_data->cname ?>" required /> </td>
                                        </tr>
                                        <tr>
                                            <td> <strong>Customer Phone</strong> <span style="color:red;">*</span></strong> </td>
                                            <td> <input type="text" name="cphone" class="form-control" placeholder="" value="<?= $reminder_data->cphone ?>" onkeypress="return isNumberKey(event)" maxlength="10" minlength="10" required /> </td>
                                        </tr>
                                        <tr>
                                            <td> <strong>Remarks</strong> <span style="color:red;">*</span></strong> </td>
                                            <td> <input type="text" name="remarks" class="form-control" placeholder="" value="<?= $reminder_data->remarks ?>" required /> </td>
                                        </tr>
                                        <tr>
                                            <td> <strong>Date</strong> <span style="color:red;">*</span></strong> </td>
                                            <td> <input type="date" id="date" name="date" class="form-control" placeholder="" value="<?= $reminder_data->date ?>" required /> </td>
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
</div>h

<script type="text/javascript" src=" <?php echo base_url()  ?>assets/slider/ajaxupload.3.5.js"></script>
<link href=" <? echo base_url()  ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />
<script>
    //------ PREVIOUS DATE DISABLE ------
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
        $('#date').attr('min', maxDate);
    });
    //------- NUMBER VALIDATION ------
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
