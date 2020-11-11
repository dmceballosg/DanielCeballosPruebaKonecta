// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });

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
        // headers2: [
        //     {
        //         text: 'ID',
        //         center: false
        //     }, {
        //         text: 'Nombre del producto',
        //         center: false
        //     }, {
        //         text: 'Código',
        //         center: false
        //     }, {
        //         text: 'Existencia',
        //         center: false
        //     }, {
        //         text: 'Descripción',
        //         center: false
        //     }, {
        //         text: 'Id Bodega',
        //         center: false
        //     }, {
        //         text: 'Estado',
        //         center: true
        //     }, {
        //         text: 'Guardar',
        //         center: true
        //     }
        // ],
        // headers3: [
        //     {
        //         text: 'Nombre del producto',
        //         center: false
        //     }, {
        //         text: 'Existencia',
        //         center: false
        //     }, {
        //         text: 'Descripción',
        //         center: false
        //     }, {
        //         text: 'Estado',
        //         center: true
        //     }, {
        //         text: 'Guardar',
        //         center: true
        //     }
        // ],
        // saveFormOptions: [
        //     {
        //         text: 'ID',
        //         name: 'id',
        //         isNumber: true,
        //         value: '',
        //         center: false
        //     }, {
        //         text: 'Nombre del producto',
        //         name: 'product_name',
        //         isNumber: false,
        //         value: '',
        //         center: false
        //     }, {
        //         text: 'Código',
        //         name: 'code',
        //         isNumber: true,
        //         value: '',
        //         center: false
        //     }, {
        //         text: 'Existencia',
        //         name: 'stock',
        //         isNumber: true,
        //         value: '',
        //         center: false
        //     }, {
        //         text: 'Descripción',
        //         name: 'description',
        //         isNumber: false,
        //         value: '',
        //         center: false
        //     }
        // ],
        // editFormOptions: [
        //     {
        //         text: 'Nombre del producto',
        //         name: 'product_name',
        //         isNumber: false,
        //         value: '',
        //         center: false
        //     },{
        //         text: 'Existencia',
        //         name: 'stock',
        //         isNumber: true,
        //         value: '',
        //         center: false
        //     }, {
        //         text: 'Descripción',
        //         name: 'description',
        //         isNumber: false,
        //         value: '',
        //         center: false
        //     }
        // ],
        // dropDowns: [
        //     {
        //         option: [],
        //         option_name: [],
        //         selectedItem: '',
        //         name: 'warehouse'
        //     }, {
        //         option: ['Activo', 'Inactivo', 'Pendiente'],
        //         option_name: ['active', 'inactive', 'pending'],
        //         selectedItem: '',
        //         name: 'status'
        //     }
        // ],
        // filterOptions: [
        //     {
        //         text: 'Mostrar todos',
        //         name: 'all'
        //     }, {
        //         text: 'Activos',
        //         name: 'active'
        //     }, {
        //         text: 'Inactivos',
        //         name: 'inactive'
        //     }, {
        //         text: 'Pendiente',
        //         name: 'pending'
        //     }
        // ],
        // statusName: {
        //     active: '\u00A0\u00A0\u00A0Activo\u00A0\u00A0\u00A0',
        //     inactive: '\u00A0\u00A0Inactivo\u00A0\u00A0',
        //     pending: 'Pendiente',
        // },
        // products: [],
        // warehouses: [],
        // summary: [],
        // footer: {
        //     added: 0,
        //     actives: 0,
        //     inactives: 0,
        //     pendings: 0,
        // }
    },
    methods: {
        // addProduct: function (adding) {
        //     //hide or show option if the user according the status of a the parameter.
        //     this.checkedFilters = ['all'],
        //     this.adding = adding;
        //     this.getInfo('products', 'get');
        // },
        // isNumber: function (evt, type) {
        //     //allow control that only typing number
        //     if (type) {
        //         evt = (evt) ? evt : window.event;
        //         var charCode = (evt.which) ? evt.which : evt.keyCode;
        //         if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
        //             evt.preventDefault();;
        //         } else {
        //             return true;
        //         }
        //     }
        // },
        // findWarehouse: function (id) {
        //     //give the name of a warehouses with the id
        //     function isCherries(warehouse) {
        //         return warehouse.id === id;
        //     };
        //     return (this.warehouses.find(isCherries)).name;
        // },
        // getInfo: function (url, type) {
        //     //retrieve info with a ajax query and save the json result in a variable
        //     //is used for get products and werehouses.
        //     var nameObject = url;
        //     var obj = this;
        //     $.ajax({
        //         url: `/${url}`,
        //         headers: {
        //             "Content-Type": "application/json;charset=UTF-8"
        //         },
        //         type: type,
        //         async: false,
        //         success: function (result) {
        //             // console.log(result)
        //             if (nameObject == 'products') {
        //                 obj[nameObject] = result
        //             } else if (nameObject == 'warehouses') {
        //                 let temArray = [];
        //                 obj[nameObject] = result;
        //                 result.forEach(x => temArray.push(x.id))
        //                 obj['dropDowns'][0].option = temArray
        //                 obj['dropDowns'][0].option_name = temArray
        //             } else if (nameObject == 'summary') {
        //                 obj[nameObject] = result
        //                 // console.log(result);
        //             } else {
        //                 console.log('error');
        //             }
        //         },
        //         error: function (error) {
        //             console.log(error);
        //         }
        //     });
        // },
        // clearForm: function () {
        //     this.saveFormOptions.forEach(x => x.value = "")
        //     this.dropDowns.forEach(x => x.selectedItem = "")
        //     this.adding = false;
        //     this.editing = false;
        // },
        // saveProduct: function () {
        //     //function to save a new product
        //     //check if all the ifo are filled
        //     if (this.saveFormOptions.some(x => x.value == "") || this.dropDowns.some(x => x.selectedItem == "")) {
        //         Swal.fire({
        //             title: 'Error!',
        //             text: 'Por favor diligencie todos los campos',
        //             icon: 'error',
        //             confirmButtonText: 'Aceptar'
        //         })
        //     } else {
        //         var obj = this;
        //         var form = $('#mainForm');
        //         $.ajax({
        //             url: 'products',
        //             data: form.serialize(),
        //             type: 'Post',
        //             success: function (result) {
        //                 if ($.isEmptyObject(result.error)) {
        //                     //upate all required variables.
        //                     obj.adding = false;
        //                     obj.clearForm();
        //                     obj.getInfo('products', 'get');
        //                     obj.footer.added += 1;
        //                     obj.getSummary();
        //                     obj.getInfo('summary', 'get');
        //                     obj.checkedFilters = ['all'],
        //                     Swal.fire({
        //                         title: 'Éxito!',
        //                         html: 'Producto agregado exitosamente',
        //                         icon: 'success',
        //                         confirmButtonText: 'Aceptar'
        //                     });

        //                 } else {
        //                     var mensaje = JSON.stringify(result.error);
        //                     mensaje = mensaje.replace(/,/g, "</li><li>");
        //                     mensaje = mensaje.replace(/"/g, "");
        //                     mensaje = mensaje.replace(/]/g, "");
        //                     mensaje = mensaje.replace(/\[/g, "<li>");
        //                     mensaje = '<ul style="text-align:left !important">' + mensaje + "</li></ul>";
        //                     Swal.fire({
        //                         title: 'Error!',
        //                         html: mensaje,
        //                         icon: 'error',
        //                         confirmButtonText: 'Aceptar'
        //                     });
        //                 }

        //             },
        //             error: function (error) {
        //                 console.log(error);
        //             }
        //         });
        //     }
        // },
        // editProduct: function(id){
        //     this.editing = true;
        //     var productEdit = this.products.find(x => x.id == id)
        //     this.idEdit = id;
        //     this.editFormOptions[0].value= productEdit.name;
        //     this.editFormOptions[1].value= productEdit.stock;
        //     this.editFormOptions[2].value= productEdit.description;
        //     this.dropDowns[1].selectedItem = productEdit.status;
        //     console.log(id);
        // },
        // saveEditProduct: function(){
        //     obj = this;
        //     if (this.editFormOptions.some(x => x.value == "") || this.dropDowns[1].selectedItem == "") {
        //         Swal.fire({
        //             title: 'Error!',
        //             text: 'Por favor diligencie todos los campos',
        //             icon: 'error',
        //             confirmButtonText: 'Aceptar'
        //         })
        //     } else {
        //         let id, name, description, stock, status = 0;
        //         id = this.idEdit;
        //         name = this.editFormOptions[0].value; 
        //         stock = this.editFormOptions[1].value; 
        //         description = this.editFormOptions[2].value;
        //         status =  this.dropDowns[1].selectedItem;
    
        //         var data = {id: id , name: name, description: description, stock: stock, status: status };

        //         $.ajax({
        //             url: '/product-save',
        //             headers: {
        //                 "Content-Type": "application/json;charset=UTF-8"
        //             },
        //             data: JSON.stringify(data),
        //             type: 'Post',
        //             async : false,
        //             success: function (result) {
        //                 console.log("estoy..");

        //                 if ($.isEmptyObject(result.error)) {
        //                     //upate all required variables.
        //                     obj.editing = false;
        //                     obj.getInfo('products', 'get');
        //                     obj.getSummary();
        //                     obj.checkedFilters = ['all'],
        //                     Swal.fire({
        //                         title: 'Éxito!',
        //                         html: 'Producto editado exitosamente',
        //                         icon: 'success',
        //                         confirmButtonText: 'Aceptar'
        //                     });
        //                     console.log("estoy..");
        //                 } else {
        //                     var mensaje = JSON.stringify(result.error);
        //                     mensaje = mensaje.replace(/,/g, "</li><li>");
        //                     mensaje = mensaje.replace(/"/g, "");
        //                     mensaje = mensaje.replace(/]/g, "");
        //                     mensaje = mensaje.replace(/\[/g, "<li>");
        //                     mensaje = '<ul style="text-align:left !important">' + mensaje + "</li></ul>";
        //                     Swal.fire({
        //                         title: 'Error!',
        //                         html: mensaje,
        //                         icon: 'error',
        //                         confirmButtonText: 'Aceptar'
        //                     });
        //                 }
        //             },
        //             error: function (error) {
        //                 console.log(error);
        //             }
        //         });
        //     }
        // },
        // getSummary: function () {
        //     //get the number of product with the different status
        //     obj = this;
        //     obj.footer.actives = 0;
        //     obj.footer.inactives = 0;
        //     obj.footer.pendings = 0;

        //     this.products.forEach(x => {
        //         if (x.status == "active") {
        //             return obj.footer.actives += 1
        //         } else if (x.status == "inactive") {
        //             return obj.footer.inactives += 1
        //         } else {
        //             return obj.footer.pendings += 1
        //         };
        //     })
        // },
        // activeFilter: function(){
        //     var cheklist = this.checkedFilters;
        //     let all, active, inactive, pending, text = 0;
        //     text = this.nameProductFilter;
        //     all = cheklist.includes('all') ? 1 : 0; 
        //     active = cheklist.includes('active') ? 1 : 0; 
        //     inactive = cheklist.includes('inactive') ? 1 : 0; 
        //     pending = cheklist.includes('pending') ? 1 : 0; 

        //     var data = {text: text , all: all, active: active, inactive: inactive, pending: pending };

        //     $.ajax({
        //         url: '/product-filter',
        //         headers: {
        //             "Content-Type": "application/json;charset=UTF-8"
        //         },
        //         data: JSON.stringify(data),
        //         type: 'Post',
        //         dataType: "json",
        //         async : false,
        //         success: function (result) {
        //             // console.log(result)
        //             obj.products = result
        //         },
        //         error: function (error) {
        //             console.log(error);
        //         }
        //     });
        // },
    },
    // beforeMount() {
    //     this.getInfo('products', 'get');
    //     this.getInfo('warehouses', 'get');
    //     this.getInfo('summary', 'get');
    //     this.getSummary();
    // },
})