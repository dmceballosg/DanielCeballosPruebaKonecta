<?php
namespace Phppot;

use \Phppot\Member;
//if the user is logged in then show the dashboard or redirect 

if (! empty($_SESSION["userId"])) {
    require_once __DIR__ . './../class/Member.php';
    $member = new Member();
    $memberResult = $member->getMemberById($_SESSION["userId"]);
    $displayName = $memberResult[0]["user_name"];
}else{
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Daniel Ceballos</title>
    <link href="./view/css/style.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- FontAwesome icons -->
    <script src="https://kit.fontawesome.com/c0292cf274.js" crossorigin="anonymous"></script>
    
</head>
<body>
    <div id="app">
        <div>
            <div class="dashboard">
                <div class="member-dashboard">Welcome <b><?php echo $displayName; ?></b><br>This is the Test of Daniel Ceballos!<br>
                    Click to here <a href="./logout.php" class="logout-button">Logout</a>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="jumbotron">
                <h1 class="display-4" style="text-align:center">Gestion de Productos</h1>
                   <!-- <button type="button" class="btn btn-success pull-right">Crear producto</button><br> -->
                <div class="row">  
                    <div class="col-sm-4 offset-sm-5">          
                        <a v-show="!(adding || editing)" v-on:click="addProduct(true)" 
                            href="#" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Crear producto</a>
                        <a v-show="(adding || editing)" v-on:click="clearForm()" 
                                href="#" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
            
        <div class="container">
            <table class="table table-striped">
                <thead>
                <tr class="header-table"> 
                    <th v-show="!(adding || editing)" v-for="item in headers1">{{item.text}}</th>
                    <th v-show="adding" v-for="item in headers2" :class='{ text_center: item.center}'>{{item.text}}</th>
                    <th v-show="editing" v-for="item in headers3" :class='{ text_center: item.center}'>{{item.text}}</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-show="!(adding || editing)" v-for="product in products">
                        <td> {{product.name}}</td>
                        <td> {{product.reference}}</td>
                        <td> {{product.price}}</td>
                        <td> {{product.weight}}</td>
                        <td> {{product.category}}</td>
                        <td> {{product.stock}}</td>
                        <td> {{product.creation_date}}</td>
                        <td> {{product.sell_date}}</td>
                        <td class="text-center"><a href="#" v-on:click.prevent="editProduct(product.id)" class="btn btn-xs"><i class="fa fa-pencil pensil-icon" aria-hidden="true"></i></a></td>
                        <td class="text-center"><a href="#" v-on:click.prevent="deleteProduct(product.id)" class="btn btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                    </tr>

                    <tr v-show="adding">
                        <td v-for="itemForm in saveFormOptions">
                            <input @keypress="isNumber($event, itemForm.isNumber)" class="form-control" 
                                v-model="itemForm.value" :name="itemForm.name" placeholder="">
                        </td>
                        <td>
                            <a v-on:click="saveProduct" class="btn btn-m pull-right btn-create">
                                <i class="fa fa-save " aria-hidden="true"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    
<!-- Reference to vue -->

<!-- <script src="./assets/js/app.js"></script>  -->
<script>
    var app = new Vue({
    el: '#app',
    data: {
        editing: false,  
        adding: false,
        nameProductFilter: '',
        checkedFilters: ['all'],
        idEdit: '',
        headers1: [
            {
                text: 'Nombre del producto',
                center: false
            }, {
                text: 'Referencia:',
                center: false
            }, {
                text: 'Precio:',
                center: false
            }, {
                text: 'Peso:',
                center: false
            }, {
                text: 'Categoría:',
                center: false
            },{
                text: 'Stock:',
                center: false
            },{
                text: 'Fecha de creación:',
                center: false
            },{
                text: 'Fecha de ultima venta:',
                center: false 
            }, {
                text: 'Editar',
                center: true
            }, {
                text: 'Eliminar',
                center: true
            }
        ],
        headers2: [
            {
                text: 'Nombre del producto',
                center: false
            }, {
                text: 'Referencia:',
                center: false
            }, {
                text: 'Precio:',
                center: false
            }, {
                text: 'Peso:',
                center: false
            }, {
                text: 'Categoría:',
                center: false
            },{
                text: 'Stock:',
                center: false
            },{
                text: 'Guardar',
                center: true
            }
        ],
        headers3: [
            {
                text: 'Nombre del producto',
                center: false
            }, {
                text: 'Referencia:',
                center: false
            }, {
                text: 'Precio:',
                center: false
            }, {
                text: 'Peso:',
                center: false
            }, {
                text: 'Categoría:',
                center: false
            },{
                text: 'Stock:',
                center: false
            },{
                text: 'Guardar',
                center: true
            }
        ],
        saveFormOptions: [
            {
                text: 'Nombre del producto',
                name: 'name',
                isNumber: false,
                value: '',
                center: false
            }, {
                text: 'Referencia',
                name: 'reference',
                isNumber: false,
                value: '',
                center: false
            }, {
                text: 'Precio',
                name: 'price',
                isNumber: true,
                value: '',
                center: false
            },{
                text: 'Peso',
                name: 'weight',
                isNumber: true,
                value: '',
                center: false
            },{
                text: 'Categoria',
                name: 'category',
                isNumber: false,
                value: '',
                center: false
            }, {
                text: 'Stock',
                name: 'stock',
                isNumber: true,
                value: '',
                center: false
            }
        ],
        products: [],
    },
    methods: {
        addProduct: function (adding) {
            //hide or show option if the user according the status of a the parameter.
            this.checkedFilters = ['all'],
            this.adding = adding;
            this.getInfo('products.php', 'get');
        },
        isNumber: function (evt, type) {
            //allow control that only typing number
            if (type) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                    evt.preventDefault();;
                } else {
                    return true;
                }
            }
        },
        clearForm: function () {
            this.saveFormOptions.forEach(x => x.value = "")
            this.adding = false;
            this.editing = false;
        },
        getInfo: function (url, type) {
            //retrieve info with a ajax query and save the json result in a variable
            //is used for get products and werehouses.
            var nameObject = url;
            var obj = this;
            $.ajax({
                url: `./class/${url}`,
                headers: {
                    "Content-Type": "application/json;charset=UTF-8"
                },
                type: type,
                async: false,
                success: function (result) {
                    console.log(result)
                    obj["products"] = JSON.parse(result);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        },

        editProduct: function(id){
            this.editing = true;
            var productEdit = this.products.find(x => x.id == id)
            this.idEdit = id;
            this.editFormOptions[0].value= productEdit.name;
            this.editFormOptions[1].value= productEdit.stock;
            this.editFormOptions[2].value= productEdit.description;
            this.dropDowns[1].selectedItem = productEdit.status;
            console.log(id);
        },

        deleteProduct: function(id){
            this.editing = true;
            var productEdit = this.products.find(x => x.id == id)
            this.idEdit = id;
            this.editFormOptions[0].value= productEdit.name;
            this.editFormOptions[1].value= productEdit.stock;
            this.editFormOptions[2].value= productEdit.description;
            this.dropDowns[1].selectedItem = productEdit.status;
            console.log(id);
        },
        saveProduct: function () {
            //function to save a new product
            //check if all the ifo are filled
            if (this.saveFormOptions.some(x => x.value == "") || this.dropDowns.some(x => x.selectedItem == "")) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Por favor diligencie todos los campos',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                })
            } else {
                var obj = this;
                var form = $('#mainForm');
                $.ajax({
                    url: 'products',
                    data: form.serialize(),
                    type: 'Post',
                    success: function (result) {
                        if ($.isEmptyObject(result.error)) {
                            //upate all required variables.
                            obj.adding = false;
                            obj.clearForm();
                            obj.getInfo('products', 'get');
                            obj.footer.added += 1;
                            obj.getSummary();
                            obj.getInfo('summary', 'get');
                            obj.checkedFilters = ['all'],
                            Swal.fire({
                                title: 'Éxito!',
                                html: 'Producto agregado exitosamente',
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            });

                        } else {
                            var mensaje = JSON.stringify(result.error);
                            mensaje = mensaje.replace(/,/g, "</li><li>");
                            mensaje = mensaje.replace(/"/g, "");
                            mensaje = mensaje.replace(/]/g, "");
                            mensaje = mensaje.replace(/\[/g, "<li>");
                            mensaje = '<ul style="text-align:left !important">' + mensaje + "</li></ul>";
                            Swal.fire({
                                title: 'Error!',
                                html: mensaje,
                                icon: 'error',
                                confirmButtonText: 'Aceptar'
                            });
                        }

                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }
        }

    },
    beforeMount() {
        this.getInfo('products.php', 'get');
    }
})
</script>
</body>
</html>