
<span>1 DOGE = </span><span id="response"></span><br>
<span>1 DOGE = </span><span id="response2"></span><br>
<span>1 DOGE = </span><span id="response3"> 1 DOGE &#x1F61C;</span>
<?php

?>
<script>
var request = new XMLHttpRequest();
request.open("GET","https://sochain.com//api/v2/get_price/DOGE/USD");
request.addEventListener('load', function(event) {
    if (request.status >= 200 && request.status < 300) {
        console.log(request.response);
        const respObject = JSON.parse(request.response);
        document.getElementById("response").innerHTML = respObject.data.prices[0].price.toString() + " $";
        console.log(respObject);
    } else {
        console.warn(request.statusText, request.responseText);
    }
    });
request.send();

var request2 = new XMLHttpRequest();
request2.open("GET","https://sochain.com/api/v2/get_price/DOGE/BTC");
request2.addEventListener('load', function(event) {
    if (request2.status >= 200 && request2.status < 300) {
        console.log(request2.response);
        const respObject = JSON.parse(request2.response);
        document.getElementById("response2").innerHTML = respObject.data.prices[1].price.toString() + " ₿";
        console.log(respObject);
    } else {
        console.warn(request2.statusText, request2.responseText);
    }
});
request2.send();

</script>