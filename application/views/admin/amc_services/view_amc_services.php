<div class="content-wrapper">
    <section class="content-header">
        <h1>
            View AMC Services
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>dcadmin/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url() ?>dcadmin/Amc_services/view_amc_services"><i class="fa fa-rotate-left"></i> View AMC Services </a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-info cticket" href="<?php echo base_url() ?>dcadmin/Amc_services/add_amc_service" role="button" style="margin-bottom:12px;"> Add AMC Service</a>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>View AMC Services</h3>
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
                                            <th>Cutomer Name</th>
                                            <th>Cutomer Phone</th>
                                            <th>Service Charge</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($amc_services_data->result() as $data) { ?>
                                            <tr>
                                                <td><?php echo $i ?> </td>
                                                <td><?php echo $data->cname ?></td>
                                                <td><?php echo $data->cphone ?></td>
                                                <td>₹<?= $data->scharge ?></td>
                                                <td>
                                                    <?
                                                    $newdate = new DateTime($data->from_date);
                                                    echo $newdate->format('d/m/Y');   #d-m-Y  // March 10, 2001, 5:16 pm
                                                    ?>
                                                </td>
                                                <td>
                                                    <?
                                                    $newdate = new DateTime($data->to_date);
                                                    echo $newdate->format('d/m/Y');   #d-m-Y  // March 10, 2001, 5:16 pm
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group" id="btns<?php echo $i ?>">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                Action <span class="caret"></span></button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li><a href="<?php echo base_url() ?>dcadmin/Amc_services/update_amc_service/<?php echo
                                                                                                                                                base64_encode($data->id) ?>">Edit</a></li>
                                                                <li><a href="<?php echo base_url() ?>dcadmin/Amc_services/view_amc_details/<?php echo
                                                                                                                                            base64_encode($data->id) ?>">View Details</a></li>
                                                                <li><a href="javascript:;" class="dCnf" mydata="<?php echo $i ?>">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div style="display:none" id="cnfbox<?php echo $i ?>">
                                                        <p> Are you sure delete this </p>
                                                        <a href="<?php echo base_url() ?>dcadmin/Amc_services/delete_amc_service/<?php echo base64_encode($data->id); ?>" class="btn btn-danger">Yes</a>
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
