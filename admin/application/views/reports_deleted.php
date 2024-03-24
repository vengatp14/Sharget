<?php $this->load->view('common/header'); ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12 mb-3 text-center">
        <h3>
            Deleted Users & Posts
        </h3>
        <a href="#example" class="btn btn-sm btn-primary mt-1">
        	Users By Reported
        </a>
        <a href="#example1" class="btn btn-sm btn-primary mt-1">
        	Products By Reported
        </a>
        <a href="#example2" class="btn btn-sm btn-primary mt-1">
        	Deleted Users
        </a>
        <a href="#example3" class="btn btn-sm btn-primary mt-1">
        	Products Deleted
        </a>
        <hr>
    </div>
  </div>
	<div class="row">

	<!-- deleted reports -->
	<!-- data table -->
	<div class="col-12">
	    <h5 class="text-center">Deleted Users by Reported</h5>
	    <hr>
	</div>
	<div class="col-12 card p-3 data-table-shadow">
	    <table id="example" class="display text-center" style="width:100%">
	        <thead class="bg-light">
	            <tr>
	                <th>S.no</th>
	                <th>User ID</th>
	                <th>Username</th>
	                <th>Email</th>
	                <th>Phone no</th>
	                <th>Reported by</th>
	                <th>Reported date</th>
	                <th>Action</th>
	            </tr>
	        </thead>
	        <tbody>
	        <?php
	        	$sno = 1;
	        	if(count($users) > 0){
	        	foreach ($users as $ur) {
	        ?>
	            <tr>
	                <td>
	                	<?=$sno++;?>
	                </td>
	                <td>
	                	<?php echo $ur->id; ?>
	                </td>
	                <td>
	                	<?php echo $ur->username; ?>
	                </td>
	                <td>
	                	<?php echo $ur->email; ?>
	                </td>
	                <td>
	                	<?php echo $ur->phone; ?>
	                </td>
	                <td>
	                	<?php
	                		$reported_by = explode(',', $ur->reported_by);
	                		for ($r=0; $r < count($reported_by); $r++) {
	                			echo ($r+1)." - ".$reported_by[$r];
	                		}
	                	?>
	                </td>
	                <td>
	                	<?php
	                		$reported_at = explode(',', $ur->reported_at);
	                		for ($r=0; $r < count($reported_at); $r++) {
	                			echo ($r+1)." - ".date('m/d/Y', strtotime($reported_at[$r]));
	                		}
	                	?>
	                </td>
	                <td>
	                	<a href="<?=base_url('report/restore_user/'.$ur->id)?>" class="btn btn-success text-white" title="Delete reports and restore this user"  onclick="return confirm('This user\'s reports will be removed and restored also shown to every users..!')">
	                		Restore
	                	</a>
	                	<a href="<?=base_url('report/remove_user/'.$ur->id)?>" onclick="return confirm('Are you sure to delete this user forever?\nAfter delete this account can not be recover back but same user can able to register again..!')" class="btn btn-danger text-white" title="Delete forever">
	                		Delete
	                	</a>
	                </td>
	            </tr>
	        <?php } } ?>
	        </tbody>
	    </table>
	</div>
	<div class="col-12">
		<hr>
	    <h5 class="text-center mt-3 ">Deleted Products by Reported </h5>
	    <hr>
	</div>

	<div class="col-12 card p-3 data-table-shadow">
	    <table id="example1" class="display text-center" style="width:100%">
	        <thead class="bg-light">
	            <tr>
	                <th>S.no</th>
	                <th>Product ID</th>
	                <th>Product name</th>
	                <th>Posted by</th>
	                <th>Posted date</th>
	                <th>Reported by</th>
	                <th>Reported date</th>
	                <th class="text-center">Action</th>
	            </tr>
	        </thead>
	        <tbody>
	        <?php
	        	$sno = 1;
	        	if(count($products) > 0){
	        	foreach ($products as $pr) {
	        ?>
	            <tr>
	                <td>
	                	<?=$sno++;?>
	                </td>
	                <td>
	                	<?php echo $pr->product_id; ?>
	                </td>
	                <td>
	                	<?php echo $pr->product_name; ?>
	                </td>
	                <td>
	                	<?php echo $pr->uploaded_by; ?>
	                </td>
	                <td>
	                	<?php echo date('m/d/Y', strtotime($pr->created_at)); ?>
	                </td>
	                <td>
	                	<?php
	                		$reported_by = explode(',', $pr->reported_by);
	                		for ($r=0; $r < count($reported_by); $r++) {
	                			echo ($r+1)." - ".$reported_by[$r];
	                		}
	                	?>
	                </td>
	                <td>
	                	<?php
	                		$reported_at = explode(',', $pr->reported_at);
	                		for ($r=0; $r < count($reported_at); $r++) {
	                			echo ($r+1)." - ".date('m/d/Y', strtotime($reported_at[$r]));
	                		}
	                	?>
	                </td>
	                <td class="text-center">
	                	<a href="<?=base_url('report/restore_item/'.$pr->product_id)?>" class="btn btn-success text-white" title="Delete reports and restore this product" onclick="return confirm('This post\'s reports will be removed and restored also shown to every users..!')">
	                		Restore
	                	</a>
	                	<a href="<?=base_url('report/remove_item/'.$pr->product_id)?>" class="btn btn-danger text-white" title="Delete forever" onclick="return confirm('This post will be removed and it\'s reports also will be deleted forever and can not be restore again..!')">
	                		Delete
	                	</a>
	                </td>
	            </tr>
	        <?php } } ?>
	        </tbody>
	    </table>
	</div>
	
	<!-- deleted reports -->

	
	<div class="col-12">
		<hr>
	    <h5 class="text-center mt-3 ">
	    	Deleted Users
	    </h5>
	    <hr>
	</div>
	<div class="col-12 card p-3 data-table-shadow">
		
	    <table id="example2" class="display" style="width:100%">
	        <thead class="bg-light">
	            <tr>
	                <th>S.no</th>
	                <th>User Id</th>
	                <th>User Name</th>
	                <th>Email</th>
	                <th>Phone no</th>
	                <th class="text-center">Deleted products</th>
	                <th data-bs-toggle="tooltip" data-bs-placement="bottom" title="Charges">Date</th>
	                <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Charges">
	                	Action
	                </th>
	            </tr>

	        </thead>
	        <tbody id="databody1">
	            <?php
	        	$sno = 1;
	        	if(count($users_deleted) > 0){
	        	foreach ($users_deleted as $ur) {
	        ?>
	            <tr>
	                <td>
	                	<?=$sno++;?>
	                </td>
	                <td>
	                	<?php echo $ur->id; ?>
	                </td>
	                <td>
	                	<?php echo $ur->username; ?>
	                </td>
	                <td>
	                	<?php echo $ur->email; ?>
	                </td>
	                <td>
	                	<?php echo $ur->phone; ?>
	                </td>
	                <td class="text-center">
	                	<?php
	                		$dlted_pro = $this->db->get_where('tbl_products', array('user_id'=>$ur->id))->result_array();
	                		echo count($dlted_pro);
	                	?>
	                </td>
	                <td>
	                	<?php echo date('m/d/Y', strtotime($ur->updated_at)); ?>
	                </td>
	                <td>
	                	<a href="<?=base_url('report/restore_user/'.$ur->id)?>" class="btn btn-success text-white" title="Delete reports and restore this user"  onclick="return confirm('This user & user\'s post will be restored also shown to others..!')">
	                		Restore
	                	</a>
	                	<a href="<?=base_url('report/remove_user/'.$ur->id)?>" onclick="return confirm('Are you sure to delete this user & user\'s posts forever?\nAfter delete, this account can not be recover back but same user can able to register again..!')" class="btn btn-danger text-white" title="Delete forever">
	                		Delete
	                	</a>
	                </td>
	            </tr>
	        <?php } } ?>
	        </tbody>
	    </table>
	</div>


	<div class="col-12">
		<hr>
	    <h5 class="text-center mt-3 ">
	    	Deleted Products
	    </h5>
	    <hr>
	</div>
	<div class="col-12 card p-3 data-table-shadow">
		
	    <table id="example3" class="display" style="width:100%">
	        <thead class="bg-light">
	            <tr>
	                <th>S.no</th>
	                <th>Product Id</th>
	                <th>Product Name</th>
	                <th class="text-center">Posted By</th>
	                <th class="text-center">Posted Date</th>
	                <th class="text-center">Expire Date</th>
	                <th class="text-center">Deleted Date</th>
	                <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Charges">
	                	Action
	                </th>
	            </tr>

	        </thead>
	        <tbody id="databody1">
	            <?php
	        	$sno = 1;
	        	if(count($products_deleted) > 0){
	        	foreach ($products_deleted as $pd) {
	        ?>
	            <tr>
	                <td>
	                	<?=$sno++;?>
	                </td>
	                <td>
	                	<?php echo $pd->product_id; ?>
	                </td>
	                <td>
	                	<?php echo $pd->product_name; ?>
	                </td>
	                <td>
	                	<?php
	                		$user = $this->db->get_where('tbl_users', array('id'=>$pd->user_id))->row();
	                		echo $user->username;
	                	?>
	                </td>
	                <td class="text-center">
	                	<?php echo date('m/d/Y', strtotime($pd->created_at)); ?>
	                </td>
	                <td class="text-center">
	                	<?php echo date('m/d/Y', strtotime($pd->expiry)); ?>
	                </td>
	                <td class="text-center">
	                	<?php echo date('m/d/Y', strtotime($pd->updated_at)); ?>
	                </td>
	                <td>
	                	<a href="<?=base_url('report/restore_item/'.$pd->product_id)?>" class="btn btn-success text-white" title="Delete reports and restore this user"  onclick="return confirm('This post will be  restored also shown to others..!')">
	                		Restore
	                	</a>
	                	<a href="<?=base_url('report/remove_item/'.$pd->product_id)?>" onclick="return confirm('Are you sure to delete this user forever?\nAfter delete, this post can not be recover back..!')" class="btn btn-danger text-white" title="Delete forever">
	                		Delete
	                	</a>
	                </td>
	            </tr>
	        <?php } } ?>
	        </tbody>
	    </table>
	</div>

    </div>
</div>

<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
	var dtable = null;
  	$(document).ready(function () {
        dtable =$('#example1').DataTable({
            "searching": true,
            "paging": true,
            "pageLength": 5,
            "lengthMenu": [5, 10, 15, 25],
            // "order": [[1, "desc"]],
            "ordering": true,
            "scrollX": true
        });
        
    });

    var dtable = null;
  	$(document).ready(function () {
        dtable =$('#example2').DataTable({
            "searching": true,
            "paging": true,
            "pageLength": 5,
            "lengthMenu": [5, 10, 15, 25],
            // "order": [[1, "desc"]],
            "ordering": true,
            "scrollX": true
        });
        
    });

    var dtable = null;
  	$(document).ready(function () {
        dtable =$('#example3').DataTable({
            "searching": true,
            "paging": true,
            "pageLength": 5,
            "lengthMenu": [5, 10, 15, 25],
            // "order": [[1, "desc"]],
            "ordering": true,
            "scrollX": true
        });
        
    });

</script>