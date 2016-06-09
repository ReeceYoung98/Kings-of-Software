<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; ?>
<?php

if(!$user = Input::get('user')){
	Redirect::to('/');
}else{
	$user = new User($user);
	if(!$user->exists()){
		Redirect::to(404);
	}else{
		$data = $user->data();
	}
}

?>
	<h3><?php echo escape($data->Forename); ?> <?php echo escape($data->Surname); ?></h3>
	<h4>Student <?php echo escape($data->Id); ?></h4>
	<h3>Purchase History</h3>
	<table class="table table-striped table-bordered">
		<tr>
			<th>Purchase Date</th>
			<th>Item Name</th>
			<th>Item Description</th>
			<th>Unit Price</th>
			<th>Quantity</th>
			<th>Total</th>
		</tr>
		<?php
		$purchase = new Purchase();
		if($purchase->retrieve($data->Id)){
			$allPurchases = $purchase->data();
			$item = new Item();
			$grandTotal = 0;
			foreach ($allPurchases as $purchases) {
				if($item->retrieve($purchases->ItemId)){
					$purchaseItem = $item->data();
				}

				echo '<tr>';
					$total = $purchaseItem->UnitPrice * $purchases->Quantity;
					$grandTotal = $grandTotal + $total;
					echo '<td width="15%">';
						echo date("d-m-Y H:i", strtotime($purchases->Date));
					echo '</td>';
					echo '<td width="20%">';
						echo $purchaseItem->Name;
					echo '</td>';
					echo '<td width="35%">';
						echo $purchaseItem->Description;
					echo '</td>';
					echo '<td width="10%">';
						echo '&pound;' . number_format($purchaseItem->UnitPrice, 2);
					echo '</td>';
					echo '<td width="10%">';
						echo $purchases->Quantity;
					echo '</td>';
					echo '<td width="10%">';
						echo '&pound;' . number_format($total, 2);
					echo '</td>';
				echo '</tr>';
			}
			?>
			<tr>
				<td colspan="5" style="text-align:right;font-weight:bold;">Grand Total</td>
				<td>&pound;<?php echo number_format($grandTotal, 2); ?></td>
			</tr>
			<?php
		}else{
			echo '<td colspan="6">No purchase history to show.</td>';
		}
		?>
	</table>
<?php 
?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php';?>
