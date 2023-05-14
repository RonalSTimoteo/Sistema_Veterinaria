<?php 
headerTienda($data);
$arrServicio = $data['servicio']; //no trae el id 
$arrServicios = $data['servicios']; //trae el id

 ?>
<br><br><br>
<hr>
	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="<?= base_url(); ?>" class="stext-109 cl8 hov-cl1 trans-04">
				Inicio
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			<a href="<?= base_url().'/tienda/categoria/'.$rutacategoria; ?>" class="stext-109 cl8 hov-cl1 trans-04">
				
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			<span class="stext-109 cl4">
			
			</span>
		</div>
	</div>
	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
					
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

							<div class="slick3 gallery-lb">
		<?php foreach ($arrServicio as $servicio) { ?>
								<div class="item-slick3" data-thumb="">
									<div class="wrap-pic-w pos-relative">
										<img src="<?php echo $servicio['url_imagen']; ?>" alt="">
										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
  
							</div>
						</div>
					</div>
				</div>	
				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
            <?= $servicio['nom_servicio']; ?>
						</h4>
						<span class="mtext-106 cl2">
            <p>Precio: <?= $servicio['precio']; ?></p>
						</span>
						<!-- <p class="stext-102 cl3 p-t-23"></p> -->
             <?= $servicio['descripcion']; ?>
	
			 <?php } ?>

	<!-- BOTON DE RESERVA ->tiene q mandar al calendario() y en el calendario hacemos el if else con el login regigsttrio  -->
						<div class="p-t-33">
		
							<div class="flex-w flex-r-m p-b-10">
								<div class="size-204 flex-w flex-m respon6-next">
								<?php
                                    $id_servicio = $arrServicios[0]['id_servicio'];
                                ?>
                                 <a href="<?php echo BASE_URL . '/servicios/citas/' . $id_servicio; ?>" type="button" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">Reservar cita</a>

							</div>
							</div>	
						</div>

						<!--  -->
						<div class="flex-w flex-m p-l-100 p-t-40 respon7">
							<div class="flex-m bor9 p-r-10 m-r-11">
								Compartir en:
							</div>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook"
								onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?= $urlShared; ?> &t=<?= $arrProducto['nombre'] ?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');"
								>
								<i class="fa fa-facebook"></i>
							</a>

							<a href="https://twitter.com/intent/tweet?text= &url= &hashtags=" target="_blank" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
								<i class="fa fa-twitter"></i>
							</a>

							<a href="https://api.whatsapp.com/send?text=" target="_blank" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="WhatsApp">
								<i class="fab fa-whatsapp" aria-hidden="true"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	
	</section>

	<!-- Related Products -->
	<section class="sec-relate-product bg0 p-t-45 p-b-105">

	</section>
<?php 
	footerTienda($data);
?>



