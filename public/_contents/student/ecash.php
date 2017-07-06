<?php
include("_setup.php");

$e = "0.00";

$allow_ecash = "no";
$current_balance = $e;
$previous_balance = $e;
$previous_transaction = "";
$previous_transaction_amount = "";
$previous_transaction_merchant = "";
$previous_transaction_amount = "";
$previous_transaction_month = "";
$previous_transaction_day = "";
$previous_transaction_year = "";
$previous_transaction_time = "";
$daily_limit = $e;

$ecash_id = $db_ecash->get("ecash_id", "user_id", "$user_id");
if(isset($ecash_id)){
	
	$allow_ecash = $db_ecash->get("allow_ecash", "ecash_id", "$ecash_id");
	$daily_limit = $db_ecash->get("daily_limit", "ecash_id", "$ecash_id");
	$current_balance = $db_ecash->get("current_balance", "ecash_id", "$ecash_id");
	if(empty($current_balance)){
		$current_balance = $e;
	} 
	$previous_balance = $db_ecash->get("previous_balance", "ecash_id", "$ecash_id");
	if(empty($previous_balance)){
		$previous_balance = $e;
	}
	$previous_transaction = $db_ecash->get("previous_transaction", "ecash_id", "$ecash_id");
	$previous_transaction_amount = $db_ecash->get("previous_transaction_amount", "ecash_id", "$ecash_id");
	if(empty($previous_transaction_amount)){
		$previous_transaction_amount = $e;
	}
	$previous_transaction_merchant = $db_ecash->get("previous_transaction_merchant", "ecash_id", "$ecash_id");
	$previous_transaction_month = $db_ecash->get("previous_transaction_month", "ecash_id", "$ecash_id");
	$previous_transaction_day = $db_ecash->get("previous_transaction_day", "ecash_id", "$ecash_id");
	$previous_transaction_year = $db_ecash->get("previous_transaction_year", "ecash_id", "$ecash_id");
	$previous_transaction_time = $db_ecash->get("previous_transaction_time", "ecash_id", "$ecash_id");
	$time = date("h:i a", strtotime($previous_transaction_time));
	
	$transaction_array = $db_transaction->where(array("transaction_id"), "user_id", "$user_id");
}
?>

<div class="container">
<br>
<?php
	if($allow_ecash == "yes"){
		
		echo "
		<div class='card z-depth-4 hoverable green lighten-3'>
			<div class='card-content'>
				<center>
					<h4>₱ $current_balance</h4>
				</center>
			</div>
		</div>
		<br>";
		
		if(empty($previous_transaction)){} else {
		echo "
		<h4 class='seagreen-text'>Last Transaction</h4>
		<div class='card'>
			<div class='card-content'>
				<strong>$previous_transaction</strong>
				<p class='grey-text'>
					Merchant: $previous_transaction_merchant<br>
					Amount: ₱ $previous_transaction_amount<br>
					Previous Balance: ₱ $previous_balance<br>
					Date: $previous_transaction_month $previous_transaction_day, $previous_transaction_year<br>
					Time:  $time<br>
				</p>
			</div>
		</div><br><br>
		";}
		
		if(empty($transaction_array)){} else {
			
			echo "<h4 class='seagreen-text'>Transaction History</h4><div class='row'>";
			$transaction_array = array_reverse($transaction_array);			
			foreach($transaction_array as $key){
				foreach($key as $transaction_id){
					
					$transaction_title = $db_transaction->get("transaction_title","transaction_id","$transaction_id");
					if(empty($transaction_title)){
						$transaction_title = "Untitled Transaction";
					}
					$transaction_action = $db_transaction->get("transaction_action","transaction_id","$transaction_id");
					switch($transaction_action){
						case("add"):
							$color = "green lighten-4";
							break;
						case("subtract"):
							$color = "red lighten-4";
							break;
					}
					$transaction_merchant = $db_transaction->get("transaction_merchant","transaction_id","$transaction_id");
					if(empty($transaction_merchant)){
						$transaction_merchant = "Unknown Merchant";
					}
					$transaction_amount = $db_transaction->get("transaction_amount","transaction_id","$transaction_id");
					$transaction_month = $db_transaction->get("transaction_month","transaction_id","$transaction_id");
					$transaction_day = $db_transaction->get("transaction_day","transaction_id","$transaction_id");
					$transaction_year = $db_transaction->get("transaction_year","transaction_id","$transaction_id");
					$transaction_time = $db_transaction->get("transaction_time","transaction_id","$transaction_id");
					$transaction_time = date("h:i a", strtotime($transaction_time));
					echo "
						<div class='col s6'>
						<div class='card $color'>
							<div class='card-content'>
								<strong>$transaction_title</strong>
								<p class='grey-text'>
									Amount: ₱ $transaction_amount<br>
									Merchant: $transaction_merchant<br>
									Date: $transaction_month $transaction_day $transaction_year<br>
									Time: $transaction_time
								</p>
							</div>
						</div>
						</div>
					";
					
				}
				
				
			
			}
			
			
		}
		
		echo "</div>";
		
	} else {
		echo "
			<div class='card'>
				<div class='card-content'>
					<center>
						<p class='grey-text'>
									<i class='material-icons medium'>sentiment_very_dissatisfied</i><br>
									You are not allowed to use E-Cash.<br>
									Tell your parents to activate it.</p>
					</center>
				</div>
			</div>
		";		
	}
?>
</div><br><br><br><br>