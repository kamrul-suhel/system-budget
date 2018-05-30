import Vue from 'vue';

Vue.filter('price_format', (val, suffix = false) => {
    var number = new Number(val);
    var p = number.toFixed(2).split(".");
    var price ='';
    if(suffix){
        price += "TK ";
    }
    price += p[0].split("").reverse().reduce(function(acc, num, i, orig) {
        return  num=="-" ? acc : num + (i && !(i % 3) ? "," : "") + acc;
    }, "") + "." + p[1];

    return price;
})