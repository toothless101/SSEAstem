function generateUsername(){
    let firstname = document.getElementById('firstname').value.trim();
    let lastname = document.getElementById('lastname').value.trim();

    if(firstname.length > 0 && lastname.length > 0){
        let firstletter = firstname.charAt(0).toUpperCase();
        let username = firstletter + lastname.toLowerCase();
        document.getElementById('username').value = username;
    } else{
        document.getElementById('username').value = " ";
    }
    
}

    document.getElementById('firstname').addEventListener('input', generateUsername);
    document.getElementById('lastname').addEventListener('input', generateUsername);
 // Run the function when the page loads (in case of pre-filled values)
    window.onload = function() {
    generateUsername();
};