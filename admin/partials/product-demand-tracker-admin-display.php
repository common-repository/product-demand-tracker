<?php

/**
 * This file is used to display the product table
 *
 * @since      1.0.0
 *
 * @package    Product_Demand_Tracker
 * @subpackage Product_Demand_Tracker/admin/partials
 */

/*
 * Get added to cart products by user ID
*/

//Get users
$users = get_users( array( 'fields' => array( 'ID' ) ) );

$products = array();

foreach($users as $user){

	// The User ID
	$user_id = $user->ID;
	
	// Get carts by ID
	$carts = get_user_meta( $user_id, '_woocommerce_persistent_cart_' . get_current_blog_id(), true );

	if(!empty($carts)) :
		foreach( $carts as $key=>$cart_items ){
			foreach( $cart_items as $cart_item ){

				$product_id = $cart_item['product_id'];
				$quantity = $cart_item['quantity'];
				$variation_id = $cart_item['variation_id'];
				$variation = $cart_item['variation'];

				$products[$product_id][] = [
					'user'	=> $user_id,
					'quantity' => $quantity,
					'variation_id' => $variation_id,
					'variation'	=> $variation
				];
			}
		}
	endif;


} //end forech
/*
 * Array $products
 * Listed all added to cart items data with an array
*/ 
?>
	
<table id="product_demand_tracker_table">
	<thead>
		<tr>
			<th><?php echo esc_html('Product'); ?></th>
			<th><?php echo esc_html('Variation'); ?></th>
			<th><?php echo esc_html('User\'s demand / Quantity'); ?></th>
			<th><?php echo esc_html('Users'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$xx = 0;
		foreach( $products as $product => $product_data ) : 
		?>
		<tr>
			<td class="product-name">
				<p><strong><?php echo get_the_title($product); ?></strong></p>
				<ul>
					<li><a href="<?php echo admin_url('post.php?post='.$product.'&action=edit'); ?>"><?php echo esc_html('Edit'); ?></a></li>
					<li><a href="<?php echo get_the_permalink($product); ?>" target="_blank"><?php echo esc_html('View'); ?></a></li>
				</ul>
			</td>
			<td class="product-variation">
				<div class="variation-items">
				<?php
				$total_quantity = 0;
				foreach( $product_data as $variation_data ){
					$variation_id = $variation_data['variation_id'];

					if($variation_id != 0) :
					
						$variations = $variation_data['variation'];
						$variation_quantity = $variation_data['quantity'];
						$variation_user = get_user_by('id', $variation_data['user']);
						echo '<div class="variation-item">';
						echo '<strong>Variation ID: </strong>' . esc_attr($variation_id) . '<br>';
						foreach( $variations as $variation_key => $variation ){
							$variation_data = ucfirst(str_replace("attribute_pa_","",$variation_key)) .': '. ucfirst($variation).'; ';
							echo esc_html($variation_data);
						}
						echo '<br>';
						echo '<strong>Quantity: </strong>' . esc_attr($variation_quantity) . '<br>';
						echo '<strong>User: </strong>' . esc_html($variation_user->user_login) . '<br>';
						echo '</div>';
					endif;
				}
				?>
				</div>
			</td>

			<td class="product-quantity">
				<?php
				$total_quantity = 0;
				foreach( $product_data as $product_quantity ){
					$total_quantity = $total_quantity + $product_quantity['quantity'];
				}
				echo '<strong>'.esc_attr($total_quantity).'</strong>';;
			?>
			</td>

			<td class="product-user">
			<?php
				$product_users = $product_data;
				$key_array = array_column($product_users, 'user');
				$unique_keys = array_unique($key_array);
				$product_users = array_intersect_key($product_users, $unique_keys);
				?>
				<span><?php echo esc_attr(count($product_users)); ?> user(s)</span>
				<select>
					<?php
					foreach( $product_users as $product_user ){
						$user_data = get_user_by('id', $product_user['user']);
						?>
						<option value=""><?php echo esc_html($user_data->user_login); ?></option>
						<?php
					}
					?>
				</select>
			</td>
		</tr>
		<?php $xx++; endforeach; ?>
	</tbody>
</table>

