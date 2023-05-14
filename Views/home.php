<?php 
	headerTienda($data);
  $arrServicio = $data['servicio']; 
 ?>
	<!-- Slider -->
	<section class="section-slide">
		<div class="wrap-slick1">
			<div class="slick1">

      <div class="item-slick1" style="background-image: url(Assets/tienda/images/slide-01.jpg);">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
									
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
								<a href="" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									Ver productos
								</a>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>



	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					Nuestro servicios 
				</h3>
			</div>
			<hr>
			<div class="row isotope-grid">
      <?php foreach ($arrServicio as $servicio) { ?>

				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<!-- Block2 -->
					<div class="block2">

						<div class="block2-pic hov-img0">
<!-- Traemos todos los servicios-->
              <img src="<?php echo $servicio['url_imagen']; ?>" alt="<?php echo $servicio['nom_servicio']; ?>">
							<a href="<?= base_url() ?>/servicios/info/<?= $servicio['id_servicio'].'/'.$servicio['ruta']; ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
								Ver servicio
							</a>
						</div>
          

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									
								</a>

								<span class="stext-105 cl3">
								
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#"
								 id=""
								 class="btn-addwish-b2 dis-block pos-relative js-addwish-b2 js-addcart-detail
								 icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11
								 ">
									
								</a>
							</div>
						</div>
					</div>
				</div>
    <?php } ?>
			</div>
			<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45">
				<a href="<?= base_url() ?>/tienda" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					Ver más
				</a>
			</div>
		</div>

		<div class="container text-center p-t-80">
			<hr>

		</div>
	</section>
<?php 
	footerTienda($data);
 ?>

