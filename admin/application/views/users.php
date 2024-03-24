<?php $this->load->view('common/header'); ?>

         
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-3 text-center">
                <h3>
                    Users List
                    <hr>
                </h3>
            </div>
        </div>
        <div class="row">


<!-- data table -->
<div class="col-12  p-2 data-table-shadow">
    <table id="example" class="display" style="width:100%">
        <thead class="bg-light">
            <tr>
                <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Serial number">S.no</th>
                <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="ID number">User Id</th>
                <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Date of Service">User Name</th>
                <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Procedure Code">Email</th>
                <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Modifier data">Phone no</th>
                <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Diagnosis Code">No of products</th>
                <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Charges">Date</th>
                <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Status">Status</th>
                <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete user">Delete user</th>
            </tr>

        </thead>
        <tbody id="databody1">
            <?php
                $sno = 1;
                foreach ($users as $r) { 
                $uid = $r['id'];
            ?>
            <tr>
                <td class="text-center">
                    <?=$sno++;?>
                </td>
                <td class="text-center">
                    <?=$r['id']?>
                </td>
                <td class="text-center">
                    <a class="text-primary" href="<?=base_url('user/items/'.$uid)?>">
                        <?=$r['username']?>
                    </a>
                </td>
                <td class="text-center">
                    <?=$r['email']?>
                </td>
                <td class="text-center">
                    <?=$r['phone']?>
                </td>
                <td class="text-center">
                    <?php
                        $uid = $r['id'];
                        echo $this->db->get_where('tbl_products', array('user_id'=>$uid, 'is_deleted'=>'0'))->num_rows();
                    ?>
                </td>
                <td class="text-center">
                    <?=date('m/d/Y', strtotime($r['created_at']));?>
                </td>
                <td class="text-center">
                    <?php if ($r['status']==0): ?>
                    <a href="<?=base_url('user/change_status/'.$uid.'/1')?>" class="btn btn-success pt-0 pb-0" title="Change status to deactive">
                        Active
                    </a>
                    <?php else: ?>
                    <a href="<?=base_url('user/change_status/'.$uid.'/0')?>" class="btn btn-danger pt-0 pb-0" title="Change status to active">
                        Deactive
                    </a>   
                    <?php endif ?>
                </td>
                <td class="text-center">
                    <a href="<?=base_url('user/delete/'.$uid)?>" onclick="return confirm('Are you sure to move this user to deleted?\nAfter moved, same user can be able to restore from deleted list..!')" class="btn btn-danger">
                        Delete
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<!-- data table -->

            </div>
        </div>

<?php $this->load->view('common/footer'); ?>