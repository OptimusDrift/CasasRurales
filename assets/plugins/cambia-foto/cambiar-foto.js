function cambiar(b) {
  switch (b.id) {
    case "img0":
      document.getElementById("imgPrincipal").innerHTML =
        "<img src='http://localhost/WoodenHouse/assets/imagenes/propiedad" +
        b.name +
        "/1.jpg' class='product-image' alt='Product Image'>";
      break;
    case "img1":
      document.getElementById("imgPrincipal").innerHTML =
        "<img src='http://localhost/WoodenHouse/assets/imagenes/propiedad" +
        b.name +
        "/2.jpg' class='product-image' alt='Product Image'>";
      break;
  }
}
