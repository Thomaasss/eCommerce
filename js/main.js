function showPassword_signup() {
  var checkpwd = document.getElementById("showpwd").checked;
  var checkpwd1 = document.getElementsByName("password")[0];
  var checkpwd2 = document.getElementsByName("confirmPassword")[0];

  if (checkpwd == true) {
    checkpwd1.type = "text";
    checkpwd2.type = "text";
  }
  else {
    checkpwd1.type = "password";
    checkpwd2.type = "password";
  }
}

function showPassword_login() {
  var checkpwd = document.getElementById("showpwd").checked;
  var checkpwd1 = document.getElementsByName("password-login")[0];

  if (checkpwd == true) {
    checkpwd1.type = "text";
  }
  else {
    checkpwd1.type = "password";
  }
}

function checkInformation() {
  var firstName = document.getElementsByName("firstName")[0].value;
  if (firstName === "") {
    document.getElementById("error-name-incomplete").classList.add("invalid");
    document.getElementById("error-name-invalid").classList.remove("invalid");
    return false;
    } else if (!/^[a-zA-Zéèêëîïôöûüùç\- ]+$/.test(firstName)) {
      document.getElementById("error-name-invalid").classList.add("invalid");
      document.getElementById("error-name-incomplete").classList.remove("invalid");
      return false;
    } else {
      document.getElementById("error-name-incomplete").classList.remove("invalid");
      document.getElementById("error-name-invalid").classList.remove("invalid");
  }

  var lastName = document.getElementsByName("lastName")[0].value;
  if (lastName === "") {
    document.getElementById("error-lastname-incomplete").classList.add("invalid");
    document.getElementById("error-lastname-invalid").classList.remove("invalid");
    return false;
    } else if (!/^[a-zA-Zéèêëîïôöûüùç\- ]+$/.test(lastName)) {
      document.getElementById("error-lastname-invalid").classList.add("invalid");
      document.getElementById("error-lastname-incomplete").classList.remove("invalid");
      return false;
    } else {
      document.getElementById("error-lastname-incomplete").classList.remove("invalid");
      document.getElementById("error-lastname-invalid").classList.remove("invalid");
  }

  var mail = document.getElementsByName("mail")[0].value;
  if (mail === "") {
    document.getElementById("error-mail-incomplete").classList.add("invalid");
    document.getElementById("error-mail-invalid").classList.remove("invalid");
    return false;
    } else if (!/^[a-zA-Z0-9._-]+@[a-zA-Z]+\.[a-zA-Z]{2,}$/.test(mail)) {
      document.getElementById("error-mail-invalid").classList.add("invalid");
      document.getElementById("error-mail-incomplete").classList.remove("invalid");
      return false;
    } else {
      document.getElementById("error-mail-incomplete").classList.remove("invalid");
      document.getElementById("error-mail-invalid").classList.remove("invalid");
  }

  var password = document.getElementsByName("password")[0].value;
  if (password === "") {
    document.getElementById("error-password-incomplete").classList.add("invalid");
    document.getElementById("error-password-invalid").classList.remove("invalid");
    return false;
    } else if (!/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()-_+~`|}{[\]:;'<>,.?/]).{8,}/.test(password)) {
      document.getElementById("error-password-invalid").classList.add("invalid");
      document.getElementById("error-password-incomplete").classList.remove("invalid");
      return false;
    } else {
      document.getElementById("error-password-incomplete").classList.remove("invalid");
      document.getElementById("error-password-invalid").classList.remove("invalid");
  }

  var confirmPassword = document.getElementsByName("confirmPassword")[0].value;
  if (confirmPassword === "") {
    document.getElementById("error-confirmPassword-incomplete").classList.add("invalid");
    document.getElementById("error-confirmPassword-invalid").classList.remove("invalid");
    return false;
    } else if (confirmPassword !== password) {
      document.getElementById("error-confirmPassword-invalid").classList.add("invalid");
      document.getElementById("error-confirmPassword-incomplete").classList.remove("invalid");
      return false;
    } else {
      document.getElementById("error-confirmPassword-incomplete").classList.remove("invalid");
      document.getElementById("error-confirmPassword-invalid").classList.remove("invalid");
  }


  var birthdateInput = document.getElementById("birthdate");
  var birthdate = birthdateInput.value;
  if (birthdate === "") {
    document.getElementById("error-dob-incomplete").classList.add("invalid");
    document.getElementById("error-dob-invalid").classList.remove("invalid");
    return false;
  } else {
    document.getElementById("error-dob-incomplete").classList.remove("invalid");
  }
  if (!checkAge(birthdate)) {
    document.getElementById("error-dob-invalid").classList.add("invalid");
    return false;
  } else {
    document.getElementById("error-dob-invalid").classList.remove("invalid");
  }
}

function checkAge(birthdate) {
  var currentDate = new Date();
  var minAge = 18;
  var birthdateYear = new Date(birthdate).getFullYear();
  var age = currentDate.getFullYear() - birthdateYear;

  return age >= minAge;
}

function updateSize(newSize) {
  document.getElementById('currentSize').innerText = newSize;
  document.getElementById("size-for-basket").value = newSize;
  document.getElementById("size-for-favorites").value = newSize;
}

function checkSize() {
  var currentSize = document.getElementById('currentSize').innerHTML;
  if (currentSize == 'Aucune') {
    var warningDiv = document.getElementById('size-warning');
    warningDiv.innerHTML = "Sélectionnez une taille avant d'ajouter l'article au panier ou aux favoris";
    warningDiv.style.display = "block";
    warningDiv.style.color = "red";
    return false;
  }
  else {
    document.getElementById('size-warning').style.display = "none";
    return true;
  }
}

function checkUserInformation() {
  var error_number = document.getElementById("error_number");
  var phoneValue = error_number.value;
  var phonePattern = /^(06|07)[0-9]{8}$/;

  if (!phoneValue.match(phonePattern)) {
    error_number.style.border = "1px solid red";
    return false;
  } else {
    error_number.style.border = "none";
  }

  var error_country = document.getElementById("error_country");
  var countryValue = error_country.value;
  var countryPattern = /^(France|Belgique|Suisse)$/;

  if (countryValue == "" || !countryValue.match(countryPattern)) {
    error_country.style.border = "1px solid red";
    return false;
  } else {
    error_country.style.border = "none";
  }

  var error_city = document.getElementById("error_city");
  var cityValue = error_city.value;
  var cityPattern = /^[A-Za-z]+$/;
  
  if (cityValue.length < 2 || cityValue == "" || !cityValue.match(cityPattern)) {
    error_city.style.border = "1px solid red";
    return false;
  } else {
    error_city.style.border = "none";
  }

  var error_postal_code = document.getElementById("error_postal_code");
  var postalValue = error_postal_code.value;
  var postalPattern = /^\d{4,}$/;

  if (!postalValue.match(postalPattern) || postalValue == "") {
    error_postal_code.style.border = "1px solid red";
    return false;
  } else {
    error_postal_code.style.border = "none";
  }
  return true;
}

function checkUserAdress() {
  var error_adress = document.getElementById("error_adress");
  var adressValue = error_adress.value;

  if (adressValue.length < 10 || adressValue === "" || !(/[0-9]/.test(adressValue) && /[a-zA-Z]/.test(adressValue))) {
    error_adress.style.border = "1px solid red";
    return false;
  } else {
    error_adress.style.border = "none";
  }
  return true;
}

function confirmDelete() {
  return confirm("Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.");
}