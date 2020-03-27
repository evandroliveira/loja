<?php foreach($subs as $sub): ?>

<li>
	<a href="<?php echo BASE_URL.'categories/enter/'.$sub['id']; ?>">
		<?php
		
		echo $sub['name'];
		?>
	</a>
</li>
<?php
if(count($sub['subs']) > 0) {
	$this->loadView('menu_subcategory', array(
		'subs' => $sub['subs']
	));
}
?>
<?php endforeach; ?>