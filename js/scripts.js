/*!
* Start Bootstrap - Shop Homepage v5.0.5 (https://startbootstrap.com/template/shop-homepage)
* Copyright 2013-2022 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-shop-homepage/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

function handle_slider_change(){
    document.getElementById("max_text").innerText = 
    + document.getElementById("max_range").value + "$";
}

function handle_slider_change_min(){
    document.getElementById("min_text").innerText = 
    + document.getElementById("min_range").value + "$";
}
function handle_qty_change(id){
    console.log(id);
}