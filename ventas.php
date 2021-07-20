<?php 
session_start();
$varsession = $_SESSION['email'];
$auth = $_SESSION['var'];
if($varsession==null || $varsession=''){
    echo 'Usted no tiene autorizacion';
	header("Location: index.php");
    die();
}

include("conexion.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">

    <script src="https://kit.fontawesome.com/d248edc114.js" crossorigin="anonymous"></script>
    <script src="assets/script.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <title>Modulo de Ventas</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abel|Poiret+One|ZCOOL+XiaoWei&display=swap">
</head>

<style>
.collapsible {
  background-color: #0275d8;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
    margin-bottom: 8px;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active2, .collapsible:hover {
  background-color: #555;
}

.collapsible:after {
  content: '\002B';
  color: white;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}


.active2:after {
  content: "\2212";
}

.content {
  padding: 0 18px;
    color: black;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
  background-color: #f1f1f1;
}

</style>      
<!-- Style for collapsables -->




<body>

<div class="row align-items-center bg-secondary d-flex justify-content-between px-3">
    <div class="col-3">
        <h5 class="text-light mb-0">Almacén Keka</h4>
    </div>
    <div class="col-6">
        <h2 style="margin-top: 20px; text-align: center;">MODULO DE VENTAS</h2>
    </div>
    <div class="col-3">
    <?php if ($_SESSION['var'] == 'admin'){ ?>
            <a href="dashboard.php" class="btn btn-primary btn-sm">Panel de Administración<i class="fas fa-chart-bar text-dark fa-lg"></i></a>
    <?php } ?>
            <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#sign-out">Cerrar Sesión<i class="fas fa-sign-out-alt text-dark fa-lg"></i></a>
    </div>
</div>

<section>
  <div class="row">
    <div class="col p-4">
    <!-- TABLA CARRITO DE COMPRAS -->
        <div class="row">
                <table class="table nuevaVenta">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre de Producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody class = "tbody">
            
                    </tbody>
                </table>
        </div>

        <div class="row" id="totales"> <!-- CAMBIAR ESTILOS EN CSS -->
            <hr/>
            <div class="col">
                <h3 style = "font-family: impact; font-size: 30px;" class="itemCartTotal text-black">T O T A L : 0</h3>
            </div>
            <div class="col d-flex justify-content-end">
                <button class="btn btn-danger">Anular Compra</h3>   
                <button class="btn btn-success">P A G A R</h3>
            </div>
        </div> 
        </div>

    <div class="col">
        <!-- categorias / productos -->

            <p style="font-size: 18px">Selecciona una Categoria:</p>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar productos..">

            <?php 
            $var=mysqli_query($link,"SELECT * from categorias");
            while($mostrar=$var->fetch_assoc()){
                $nombreC = $mostrar['nombre_categoria'];
                $idC = $mostrar['id_categoria'];
                ?>

                    <button class="collapsible"><?php echo $nombreC ?></button>
                    <div class="content" >
                        <table class="w3-table w3-striped w3-border">        
                        <tr><th>Producto</th><th>Precio</th><th>Acciones</th></tr>

                        <?php 
                        $varProductos=mysqli_query($link,"SELECT * from productos WHERE cod_categoria = $idC ORDER BY nombre ASC");
                         while($mostrarP=$varProductos->fetch_assoc()){
                            ?>
                            <tr class = "producto" id="<?php echo $mostrarP['id_producto'] ?>">
                                <td class = "nombreP"><?php echo $mostrarP['nombre'] ?></td>
                                <td class = "precioP"><?php echo $mostrarP['precio'] ?></td>
                                <td><button class="btn btn-success btn-sm boton"><i class="fas fa-plus text-dark fa-sm"></i></button></td>
                            </tr>
                        <?php } ?>

                        </table>
                    </div>
            <?php
            }
            ?>
        <!-- END CATEGORIAS/PRODUCTOS -->
    </div> <!-- END col -->
  </div> <!-- end row -->
</section>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;
let carrito = []
let boleta = []


for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active2");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}

const Clickbutton = document.querySelectorAll('.boton')
const tbody = document.querySelector('.tbody')

Clickbutton.forEach(btn => {
    btn.addEventListener('click', addToCarritoItem)
})


function addBoleta(e){
    const button = e.target
    const item = button.closest('.producto')
    const itemTitle = item.querySelector('.nombreP').textContent;
    const itemPrize = item.querySelector('.precioP').textContent;

    const newItem = {
        title: itemTitle,
        precio: itemPrize,
        cantidad: 1
    }
    addItemCarrito(newItem)
}



function addToCarritoItem(e){
    const button = e.target
    const item = button.closest('.producto')
    const itemTitle = item.querySelector('.nombreP').textContent;
    const itemPrize = item.querySelector('.precioP').textContent;

    const newItem = {
        title: itemTitle,
        precio: itemPrize,
        cantidad: 1
    }
    addItemCarrito(newItem)
}

function addItemCarrito(newItem){

    const inputElemento = tbody.getElementsByClassName('input__elemento')

    for(let i = 0; i< carrito.length ; i++){
        if(carrito[i].title.trim() === newItem.title.trim()){
            carrito[i].cantidad ++;
            const inputValue = inputElemento[i]
            inputValue.value ++;
            CarritoTotal()
            return null;
        }
    }
    carrito.push(newItem)
    console.log(carrito)

    renderCarrito()

}

function renderCarrito(){
    tbody.innerHTML = ''
    carrito.map(item => {
        const tr = document.createElement('tr')
        tr.classList.add('ItemCarrito')

        const Content = `
        <th scope="row"><button class="btn m-0 p-0 botonDelete">&#9940;</button></th>
        <td class = "title">${item.title}</td>
        <td>${item.precio}</td>
        <input type = "number" min="1" value="${item.cantidad}" class="input__elemento"></td>
        <td>${item.precio * item.cantidad}</td>
        
        `
        tr.innerHTML = Content;
        tbody.append(tr)

        tr.querySelector(".botonDelete").addEventListener('click', removeItemCarrito)
        tr.querySelector(".input__elemento").addEventListener('change', sumaCantidad)
    })
    CarritoTotal()
}

function CarritoTotal(){
    let Total = 0;
    const itemCartTotal = document.querySelector('.itemCartTotal')
    carrito.forEach((item) => {
        const precio = Number(item.precio.replace("$", ''))
        Total = Total + precio*item.cantidad
    })

    itemCartTotal.innerHTML = `Total $${Total}`
}

function removeItemCarrito(e)
{
    const buttonDelete = e.target
    const tr = buttonDelete.closest(".ItemCarrito")
    const title = tr.querySelector('.title').textContent;
    for(let i=0; i<carrito.length; i++){
        if(carrito[i].title.trim() === title.trim()){
            carrito.splice(i, 1)
        }
    }
    tr.remove()
    CarritoTotal()
}

function sumaCantidad(e){
    const sumaInput = e.target
    const tr = sumaInput.closest('.ItemCarrito')
    const title = tr.querySelector('.title').textContent;
    carrito.forEach(item => {
        if(item.title.trim() === title){
            sumaInput.value < 1 ? (sumaInput.value = 1) : sumaInput.value;
            item.cantidad = sumaInput.value;
            CarritoTotal()
        }
    })
}


function myFunction() {
    // Declare variables
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById('myInput');
    filter = input.value.toUpperCase();
    ul = document.getElementsByClassName("producto");
    li = ul.getElementsByClassName('nombreP');
    console.log(ul)
    console.log(li)
    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
      a = li[i];
      txtValue = a.textContent || a.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        li[i].style.display = "";
      } else {
        li[i].style.display = "none";
      }
    }
  }





</script>




<?php include("includes/footer.php"); 
unset($_SESSION["message"]);
?>
