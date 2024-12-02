function qs(a){return document.querySelector(a);}
function qsa(a) {return document.querySelectorAll(a);}

function showJednostka(el) {
    const jednostka = qs('#jednostka_'+el.id);

    jednostka.classList.remove('jednostkaHidden');
    jednostka.classList.add('jednostkaShow');
    
}

qsa('#paliwo input').forEach((el) => {
  const jednostka = qs('#jednostka_'+el.id);
  el.addEventListener('focusout', () => {
    jednostka.classList.remove('jednostkaShow');
    jednostka.classList.add('jednostkaHidden');  
  });
})

function wybranaCena(cena) {
   const inputCena = qs('#cena');
   const wprowadzoneCena = qs('#wprowadzoneCena');
   inputCena.value = cena.toFixed(2)
   wprowadzoneCena.innerText = cena.toFixed(2)
}



function obliczKoszty() {
  const spalanie = parseFloat(qs('#spalanie').value);
  const dystans = parseFloat(qs('#dystans').value);
  const cena = parseFloat(qs('#cena').value);

  const wprowadzoneSpalanie = qs('#wprowadzoneSpalanie');
  const wprowadzoneDystans = qs('#wprowadzoneDystans');
  const wprowadzoneCena = qs('#wprowadzoneCena');

  const wprowadzoneSpalanieMobile = qs('#wprowadzoneSpalanieMobile');
  const wprowadzoneDystansMobile = qs('#wprowadzoneDystansMobile');
  const wprowadzoneCenaMobile = qs('#wprowadzoneCenaMobile');

  const cenaPaliwa = qs('#cenaPaliwa');

  let zuzytePaliwo = spalanie/100*dystans;
  let wynik = (zuzytePaliwo*cena).toFixed(2);

  const [a,b] = wynik.toString().split('.');
  console.log(typeof wynik)

  wprowadzoneCena.innerText = cena.toFixed(2);
  wprowadzoneDystans.innerText = dystans;
  wprowadzoneSpalanie.innerText = spalanie.toFixed(2);

  wprowadzoneCenaMobile.innerText = cena.toFixed(2);
  wprowadzoneDystansMobile.innerText = dystans;
  wprowadzoneSpalanieMobile.innerText = spalanie.toFixed(2);

  showKoszty(wynik)
}

const cenaObecna = qs('#cenaObecna');
cenaObecna.value = '0,00'

function showKoszty(wynik) {

  const cenaMniej = qs('#cenaPaliwaMniej');
  const cenaWiecej = qs('#cenaPaliwaWiecej');
  const cenaWidth = qs('#cenaWidth')
  
  const cenaAktualna = qs('#cenaAktualna');
  cenaWidth.innerText = wynik
  
  const resultNumber = qs('.resultNumber');



 



  if(wynik > cenaObecna.value) {
    console.log(wynik);
    cenaWiecej.innerText = wynik;
    cenaWiecej.style.top = '0px';
    cenaObecna.style.top = '-40px';
    setTimeout(() => {
      cenaObecna.value = wynik;
      cenaObecna.innerText = wynik;
      cenaObecna.style.display = 'none';
      cenaObecna.style.top = '0px';
      setTimeout(() => {
        cenaObecna.style.display = 'block';
        cenaWiecej.style.display = 'none';
        cenaWiecej.style.top = '40px'
        setTimeout(() => {
          cenaWiecej.style.display = 'block'
        },100)
      },1000)
    }, 1000)
  } else if(wynik < cenaObecna.value) {
    console.log(wynik);
    cenaMniej.innerText = wynik;
    cenaMniej.style.top = '0px';
    cenaObecna.style.top = '40px';
    setTimeout(() => {
      cenaObecna.value = wynik;
      cenaObecna.innerText = wynik;
      cenaObecna.style.display = 'none';
      cenaObecna.style.top = '0px';
      setTimeout(() => {
        cenaObecna.style.display = 'block';
        cenaMniej.style.display = 'none';
        cenaMniej.style.top = '-40px'
        setTimeout(() => {
          cenaMniej.style.display = 'block'
        },100)
      },1000)
    }, 1000)
  }

  //  DO ZAPYTANIA
  //  gdy jest przejscie np z 60 na 100 z nieznanych mi powodow funkcja traktuje 60 jako większa liczbe. Problem wystepuje tylko przy zmianie z np 60 na 100, przy zmianie z 60 na 600 nie ma takiego problemu. Przy danych spalanie:100 dystans:100 cena paliwa: 6,38 przy zmienieniu dystansu na 1000 czyli co za tym idzie podniesieniu ceny nie ma problemu jednak przy danych spalanie:9.5 dystans:100 cena paliwa:6,38 przy zmianie dystansu na 200 jest problem

}

 


window.addEventListener("load", (event) => {
  
  const info = qs('#info');
  
  setTimeout(() => {
    info.classList.remove('info');
    info.classList.add('infoShow'); 
  }, 1000);
  

})

function hideInfo() {
  const info = qs('#info');
  setTimeout(() => {
    info.classList.add('info');
    info.classList.remove('infoShow'); 
  }, 1000);
    
}