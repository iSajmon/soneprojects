function qs(a) {return document.querySelector(a);}
function qsAll(a) {return document.querySelectorAll(a);}
function cookie(name) {
  let cookies = `; ${document.cookie}`;
  let parts = cookies.split(`; ${name}=`);
  return parts.length == 2 ? parts[1].split(";")[0] : false;
}

function setCookie(name, value, days) {
  if (isNaN(days)) {
    console.error('Liczba dni musi być liczbą');
    return;
  }

  let date = new Date();
  date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); // dni * 24 godziny * 60 minut * 60 sekund * 1000 ms
  let expires = "expires=" + date.toUTCString();

  document.cookie = `${name}=${value}; ${expires}; path=/`;
}

let czas;
const newUpdate = qs('#newUpdate');

function closeUpdateMessage() {
  setCookie('updateMessage', 'closed', 5);
  newUpdate.classList.add('newUpdateHide');
}

function showPage(url) {
    window.location.href = `projects/${url}`;
}

let lastActive = null;

function textActive(clicked) {
  if (lastActive) {
    lastActive.classList.remove("projektActive");
    lastActive.classList.add("projekt");
  }

  if (lastActive != clicked) {
    clicked.classList.add("projektActive");
    lastActive = clicked;
  } else {
    lastActive = null;
  }
}



function cookiesAccept() {
  setCookie('cookies', 'accepted', 365);
  cookiesWarning.classList.add("cookiesWarningHide");
  cookiesWarning.classList.remove("cookiesWarning");
}

window.onload = (()=> {
  const style = qs("#style");
  const styleMobile = qs("#styleMobile");
  const cookiesWarning = qs("#cookiesWarning");
  const load = qs(".load");
  const body = qs("body");

  if (cookie("theme")) {
    style.href = cookie("theme");
    styleMobile.href = cookie("themeMobi");
  }
    load.style.opacity = '0';
    body.style.overflowY = 'scroll';
    setTimeout(() => {
      load.style.display = 'none';
    }, 500);

  setTimeout(() => {
    load.style.display = 'none';
    if (cookie("cookies") != "accepted") {
      cookiesWarning.classList.remove("cookiesWarningHide");
      cookiesWarning.classList.add("cookiesWarning");
    }
  }, 1000);
  if(cookie('updateMessage') != 'closed') {
     newUpdate.classList.remove('newUpdateHide');
     newUpdate.classList.add('newUpdate')
  }
});

function changeStyle() {
  if (cookie("theme") == "style.css" || !cookie("theme")) {
    style.href = "styleDark.css";
    styleMobile.href = "styleMobileDark.css";
    setCookie("theme", style.href, 365);
  } else {
    style.href = "style.css";
    styleMobile.href = "styleMobile.css";
  }

  setCookie("theme", style.href.split("/").pop(), 365); 
  setCookie("themeMobi", styleMobile.href.split("/").pop(), 365);

  console.log(cookie("theme"));
}



