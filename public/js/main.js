// SIGN UP & SIGN IN BUTTON ACTION
function signUpInSelector() {
    document.getElementById('login-form').style.display = "None";
    document.getElementById('registration-form').style.display = "";
    document.getElementById('right-panel').style.display = "None";
    document.getElementById('left-panel').style.display = "";
  
  }
  
  // LOGIN BUTTON ACTION
  function loginAction(){
    let username = document.getElementById('logUsername').value;
    let password = document.getElementById('logPassword').value;
  
    if (username == "admin" && password == "admin"){
      window.alert("Successfully Login!")
    
    } else if (username == "" || password == ""){
      window.alert("Please Input Credentials!");
  
    } else if (username != "admin" || password != "admin") {
      window.alert("Wrong Credentails");
  
    } else {
      window.alert("No Credentials!");
    }
  
  }
  
  // REGISTER BUTTON ACTION
  function registerAction(){
    let username = document.getElementById('regUsername').value;
    let password = document.getElementById('regPassword').value;
    let email = document.getElementById('regEmail').value;
  
    if (username == "admin" && password == "admin" && email == "admin@gmail.com"){
      window.alert("Successfully Registered!")
      
      document.getElementById('regUsername').value = "";
      document.getElementById('regPassword').value = "";
      document.getElementById('regEmail').value = "";
  
    } else {
      window.alert("Please fill-out the form!")
    }
  }