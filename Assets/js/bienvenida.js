$(document).ready(function(){
    blog();
})

$(document).on("click","#MiBlog",function(){
    blog();
})

$(document).on("click","#ejemplo",function(){
  $('#myModal2').show();
})

$(document).on("click","#btnClose2",function(){
  $('#myModal2').hide();
})

$(document).on("click","#todo-ok",function(){
  $('#exampleModal').hide();
})

$(document).on("click","#servicio",function(){
  location.href="calendario";
})

$(document).on("click","#dashboard",function(){
  location.href="dashboard";
})


/*
function blog(){
    var miblog=`
    <section id="about">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">¿Quienes somos?</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">
          
          </p>
        </div>
      </div>
    </div>
    <div class="container about-container wow fadeInUp">
      <div class="row">
        <div class="col-md-6 col-md-push-6 about-content">
          <h2 class="about-title">Veterinaria</h2>
          <p class="about-text">
          Nosotros somos un equipo de profesionales altamente capacitados en el cuidado de la salud animal.
          </p>
          <p class="about-text">
          Nos enorgullece poder brindar un servicio de calidad y calidez a cada uno de nuestros pacientes y
          </p>
          <p class="about-text">
          sus dueños. En la clínica creemos que la salud de su mascota es una prioridad y estamos comprometidos
          </p>
          <p class="about-text">
          en ofrecer los mejores tratamientos y cuidados para mantenerlos sanos y felices.
          </p>

          <p class="about-text">
          Nos enorgullece poder brindar un servicio de calidad y calidez a cada uno de nuestros pacientes y
          </p>
          <p class="about-text">
          sus dueños. En la clínica creemos que la salud de su mascota es una prioridad y estamos comprometidos
          </p>
          <p class="about-text">
          en ofrecer los mejores tratamientos y cuidados para mantenerlos sanos y felices.
          </p>
          
        </div>
      </div>
    </div>
  </section>
    `;
    $("#contenedor").html(miblog);
};
*/


