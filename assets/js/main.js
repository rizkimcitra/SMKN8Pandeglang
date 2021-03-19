// Show Navbar
const showMenu = (headerToggle, navbarId) => {
  const toggleBtn = document.getElementById(headerToggle),
    nav = document.getElementById(navbarId);

  // Validate that variables exist
  if (headerToggle && navbarId) {
    toggleBtn.addEventListener("click", () => {
      // We add the show-menu class to the div tag with the nav__menu class
      nav.classList.toggle("show-menu");
      // change icon
      toggleBtn.classList.toggle("bx-x");
    });
  }
};
showMenu("header-toggle", "navbar");

// Link Active
const linkColor = document.querySelectorAll(".nav_link");

function colorLink() {
  linkColor.forEach((l) => l.classList.remove("active"));
  this.classList.add("active");
}

linkColor.forEach((l) => l.addEventListener("click", colorLink));

// show password
function showPassword() {
  var a = document.getElementById("password");
  if (a.type === "password") {
    a.type = "text";
  } else {
    a.type = "password";
  }
}

// says greet
//creat variable
var myDate = new Date();
//create function getHours from user local time on the phone or computer
var hrs = myDate.getHours();
//create variable
var greet;
//if variable hrs smaller than 12
if (hrs < 12) greet = "Selamat Pagi!";
//and if more than 12 and smaller than 15
else if (hrs >= 12 && hrs <= 15) greet = "Selamat Siang!";
//and if more than 15 and smaller than 18
else if (hrs >= 15 && hrs <= 18) greet = "Selamat Sore!";
//and if more than 18 and smaller than 18
else if (hrs >= 18 && hrs <= 24) greet = "Selamat Malam!";
//get document or tag that contain id "greeting"
document.getElementById("greeting").innerHTML = greet;

//show hidden table on petugas page
function showTable() {
  var btnShowList = document.getElementById("hiddenTable");
  if (btnShowList.offsetParent === null) {
    btnShowList.style.display = "flex";
  } else {
    btnShowList.style.display = "none";
  }
}

//show hidden table on kelas page
function showTableTwo() {
  var btnShowListTwo = document.getElementById("hiddenTableTwo");
  if (btnShowListTwo.offsetParent === null) {
    btnShowListTwo.style.display = "flex";
  } else {
    btnShowListTwo.style.display = "none";
  }
}

//show hidden table on spp page
function showTableThree() {
  var btnShowListThree = document.getElementById("hiddenTableThree");
  if (btnShowListThree.offsetParent === null) {
    btnShowListThree.style.display = "block";
  } else {
    btnShowListThree.style.display = "none";
  }
}

//show hidden table on siswa page
function showTableFour() {
  var btnShowListFour = document.getElementById("hiddenTableFour");
  if (btnShowListFour.offsetParent === null) {
    btnShowListFour.style.display = "flex";
  } else {
    btnShowListFour.style.display = "none";
  }
}

//show hidden table on pembayaran page
function showTableFive() {
  var btnShowListFive = document.getElementById("hiddenTableFive");
  if (btnShowListFive.offsetParent === null) {
    btnShowListFive.style.display = "flex";
  } else {
    btnShowListFive.style.display = "none";
  }
}

//
