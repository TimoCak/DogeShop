function isValid(position) {
    var request = new XMLHttpRequest();
    request.open("GET","https://chain.so/api/v2/is_address_valid/DOGE/" + document.getElementsByClassName('validWallet')[position].value);
    request.addEventListener('load', function () {
        console.log(request.response);
        if (request.status >= 200 && request.status < 300) {
            var respObject = JSON.parse(request.response);
            if (respObject.data.is_valid === false) {
                document.getElementsByClassName("walletError")[position].innerHTML = respObject.data.address.toString() + " is invalid!";
                document.getElementsByClassName("validWalletButton")[position].disabled = true;
                document.getElementsByClassName("walletSuccess")[position].style.visibility = "hidden";
                document.getElementsByClassName("walletError")[position].style.visibility = "visible";


            } else if(respObject.data.is_valid === true) {
                    document.getElementsByClassName('walletSuccess')[position].innerHTML = "HELLO SHIBE";
                    document.getElementsByClassName("validWalletButton")[position].disabled = false;
                    document.getElementsByClassName("walletSuccess")[position].style.visibility = "visible";
                    document.getElementsByClassName("walletError")[position].style.visibility = "hidden";
                    console.log(respObject);
            }
        } else {
            console.warn(request.statusText, request.responseText);
        }

    });

    request.send();
}
function isEmpty(position) {
    if (document.getElementsByClassName('validWallet')[position].value==="") {
        document.getElementsByClassName('validWalletButton')[position].disabled = true;
        document.getElementsByClassName('walletError')[position].innerHTML = "empty field!"
    }
}