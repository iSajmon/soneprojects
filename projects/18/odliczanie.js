// ustawiamy datę docelową
var countDownDate = new Date("Jun 10, 2023 19:00:00").getTime();

// aktualizujemy licznik co 1 sekundę
var x = setInterval(function() {

    // pobieramy aktualną datę i czas
    var now = new Date().getTime();

    // obliczamy różnicę między datami
    var distance = countDownDate - now;

    // obliczamy dni, godziny, minuty i sekundy
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // wyświetlamy wynik w elemencie o id="countdown"
    document.getElementById("countdown").innerHTML =  days + "d " + hours + "h "
    + minutes + "min " + seconds + "sec";

    // jeśli data docelowa została osiągnięta, zatrzymujemy odliczanie
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("countdown").innerHTML = "Party Time!";
    }
}, 1000);

let czas;

function myFunction() {
    czas = setTimeout(showPage, 3000);
  }
  
  function showPage() {
    document.getElementById("all").style.opacity = "1";
  }