

function submitLogin(){
    var xhr = new XMLHttpRequest();

    console.log("button pressed");
    var token = document.getElementById("user-token-input").value;
    
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
    xhr.send(someStuff);
    console.log(token);

}