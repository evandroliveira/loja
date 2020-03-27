<h1>Carrinho de Compras</h1>
<div class="container">
<table class="table">
<thead class="thead">
	<tr>
		<th width="100">Produto </th>
		<th></th>
		<th width="60">Quantidade</th>
		<th width="150">Preço</th>
		<th width="120">Total</th>
		<th width="20"></th>
	</tr>
</thead>

<tbody class="">
	
	<?php
	$subtotal = 0;
	?>
	<?php foreach($list as $item): ?>
	<?php
	$subtotal += (floatval($item['price']) * intval($item['qt']));
	?>
	
		<tr>
			<td><img src="<?php echo BASE_URL; ?>media/products/<?php echo $item['image']; ?>" width="80" /></td>
			<td><?php echo $item['name']; ?></td>
			<td>
				<a href="<?php echo BASE_URL; ?>cart/lessqt/<?php echo $item['id']; ?>" class="total_cart" ><img src="<?php echo BASE_URL; ?>assets/images/less.png" width="10" /></a>                  
					<?php echo $item['qt']; ?>
				<a href="<?php echo BASE_URL; ?>cart/addqt/<?php echo $item['id']; ?>" class="total_cart"><img src="<?php echo BASE_URL; ?>assets/images/plus.png" width="10" /></a>
			</td>
			<td><?php echo number_format($item['price'], 2, ',', '.'); ?></td>
			<td>R$
				<?php
					$total_product = $item['price'];
					$qt_prodct = $item['qt'];
					$total_valor = 	$qt_prodct * $total_product;
					echo number_format($total_valor, 2, ',', '.');
				?>
				<?php  
				?></td>
			<td><a href="<?php echo BASE_URL; ?>cart/del/<?php echo $item['id']; ?>"><img src="<?php echo BASE_URL; ?>assets/images/quit.png" width="15" /></a></td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="4" align="right">Sub-total: </td>
			<td><strong>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></strong></td>
		</tr>
		<tr>
			<td colspan="4" align="right">Frete: </td>
			<td>
				<?php if(isset($shipping['price'])): ?>
					<strong>R$ <?php echo $shipping['price']; ?> </strong> (<?php echo $shipping['date']; ?> dia<?php echo ($shipping['date']=='1')?'':'s'; ?>)
				<?php else: ?>
					Qual seu CEP?<br/>
					<form method="POST">
						<input type="number" name="cep" id="cep"/><br/>
						<input type="submit" value="Calcular" />
					</form>
				<?php endif; ?>	
			</td>
		</tr>
		<tr>
			<td colspan="4" align="right">Total: </td>
			<td id="total_compra"><strong>R$ <?php 
				$_SESSION['total'] = $subtotal;

				if(isset($shipping['price'])) {
					$frete = floatval(str_replace(',', '.', $shipping['price']));
					$_SESSION['total'] += floatval($frete);
				} else {
					$frete = 0;
				}
				
				echo number_format($_SESSION['total'], 2, ',', '.') ;		
				
			?></strong></td>
		</tr>		
	</tbody>	
</table>
</div>
<hr/>
<?php if($frete > 0): ?>
	<form method="POST" action="<?php echo BASE_URL; ?>cart/payment_redirect" style="float:right">
		<!--<select name="payment_type">
			<option value="checkout_transparente">Pagseguro Checkout Transparente</option>
			<option value="mp"><img src="<?php echo BASE_URL; ?>assets/images/mp.png" alt="Mercado Pago"></option>
			<option value="paypal">PayPal</option>
			<option value="boleto">Boleto Bancário</option>
		</select>-->
		<input type="checkbox" name="payment_type" value="mp">
		<label for="payment">
			<img class="img_mp" src="<?php echo BASE_URL; ?>assets/images/mp.png" alt="">
		</label>
		<input type="checkbox" name="payment_type" value="boleto">
		<label for="payment">
		<img class="img_boleto" src="<?php echo BASE_URL; ?>assets/images/boleto.png" alt="">
		</label>
		<input type="checkbox" name="payment_type" value="paypal">
		<label for="payment">
		<img  src="<?php echo BASE_URL; ?>assets/images/paypal.png" alt="">
		</label>
		<input type="submit" value="Finalizar Compra" class="button total">
		
	</form>
	
</form>
<?php endif; ?>
