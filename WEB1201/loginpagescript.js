// Login Page - Transition Between Login Form and Register Form
const lrformborder = document.querySelector('.lrformborder');
const loginlink = document.querySelector('.loginlink');
const registerlink = document.querySelector('.registerlink');
registerlink.addEventListener('click', ()=> {
    lrformborder.classList.add('active');
});
loginlink.addEventListener('click', ()=> {
    lrformborder.classList.remove('active');
});

// Login Page - Get Data From HTML File By ID
const logform = document.getElementById('logform');
const logname = document.getElementById('logname');
const logpassword = document.getElementById('logpassword');

const regform = document.getElementById('regform');
const regname = document.getElementById('regname');
const regemail = document.getElementById('regemail');
const regpassword= document.getElementById('regpassword');
const regconfpassword = document.getElementById('regconfpassword');

// Login Page - Login Form Validation
logform.addEventListener('submit', (ea) => {
    ea.preventDefault();
    validateloginputs();
});

let lognameval = false;
let logpasswordval = false;

function validateloginputs() {
    const lognamec = logname.value.trim();
    const logpasswordc = logpassword.value.trim();

    if (lognamec === '') {
        setError(logname, 'Username is required.');
    } else {
        setSuccess(logname);
        lognameval = true;
    }

    if (logpasswordc === '') {
        setError(logpassword, 'Password is required.');
    } else {
        setSuccess(logpassword);
        logpasswordval = true;
    }

    if ((lognameval === true) && (logpasswordval === true)) {
        alert('Login successfully. Welcome back, our beloved members.\nReturning to the Home Page.');
        setTimeout(function() {
            window.location.href = "Home Page.html";
        }, 2000);
    }
}

// Login Page - Register Form Validation
regform.addEventListener('submit', (eb) => {
    eb.preventDefault();
    validatereginputs(); 
});

let regnameval = false;
let regemailval = false;
let regpasswordval = false;
let regconfpasswordval = false;

function validatereginputs() {
    const regnamec = regname.value.trim();
    const regemailc = regemail.value.trim();
    const regpasswordc = regpassword.value.trim();
    const regconfpasswordc = regconfpassword.value.trim();

    if (regnamec === '') {
        setError(regname, 'Username is required.');
    } else {
        setSuccess(regname);
        regnameval = true;
    }

    if (regemailc === '') {
        setError(regemail, 'Email Address is required.');
    } else if (!validateEmail(regemailc)){
        setError(regemail, 'Invalid Email Address.');
    } else {
        setSuccess(regemail);
        regemailval = true;
    }

    if (regpasswordc === '') {
        setError(regpassword, 'Password is required.');
    } else {
        setSuccess(regpassword);
        regpasswordval = true;
    }

    if (regconfpasswordc === '') {
        setError(regconfpassword, 'Confirm Password is required.');
    } else if (regpasswordc !== regconfpasswordc){
        setError(regconfpassword, 'Password and Confirm Password do not match.');
    } else {
        setSuccess(regconfpassword);
        regconfpasswordval = true;
    }

    if ((regnameval === true) && (regemailval === true) && (regpasswordval === true) && (regconfpasswordval === true)) {
        alert('Account created. Welcome to Climat Foundation.\nReturning to the Home Page.');
        setTimeout(function() {
            window.location.href = "Home Page.html";
        }, 2000);
    }
}

// Login Page -  validateEmail, setError, setSuccess Functions
function validateEmail(theemail) {
    const emailformat = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return emailformat.test(theemail);
}

function setError(input, message) {
    const lrformcontrol = input.parentElement;
    const small = lrformcontrol.querySelector('small');
    small.innerText = message;
    lrformcontrol.className = 'lrformcontrol error';
}

function setSuccess(input) {
    const lrformcontrol = input.parentElement;
    lrformcontrol.className = 'lrformcontrol success';
}
