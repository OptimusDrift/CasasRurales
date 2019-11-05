function cambiarFormulario(habitacion) {
  document.getElementById("formularioReserva").innerHTML =
    '<form action="controlarreserva" method="post"> <div class="form-inline py-2 mt-2"> <div class="input-group input-group"> <div class="input-group-prepend"> <span class="btn btn-dark"> <i class="fas fa-calendar-alt"></i> </span> </div> <input class="form-control" type="text" id="reservar" name="fechas"> </div> <input class="form-control" size="1" type="telephone" id="area" name="ar" placeholder="Area (011)" hidden=""> <div class="input-group input-group ml-2"> <div class="input-group-prepend"> <span class="btn btn-dark"> <i class="fas fa-phone"></i> </span> </div> <input class="form-control" size="5" maxlength="4" type="telephone" id="area" name="ar" placeholder="Area (011)"> </div> <div class="input-group input-group"> <input class="form-control" type="telephone" id="telefono" name="tel" placeholder="Ingresa tu teléfono sin 15."> </div> </div> <div class="mt-2"> <button class="btn btn-primary btn-lg" type="submit"><i class="fas fa-cart-plus fa-lg mr-2"></i> Reservar</button> </div> </form>' +
    b.name +
    "/1.jpg' class='product-image' alt='Product Image'>";
}
