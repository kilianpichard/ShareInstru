let tab;
let arr = [];
var xhr = new XMLHttpRequest();
console.log(window)
const queryString = window.location.search;
let search = queryString.split('?')[1];
xhr.open('GET', 'BDD.php?function=famille?user='+user, true);
var Cat = function () {
  if (xhr.readyState === 4 && xhr.status === 200) {
    let cat = xhr.response.split('|');
    let div = document.getElementById('cat');
    for (let i = 0; i < cat.length; i++) {
      let option = document.createElement('option');
      option.value = cat[i];
      option.innerText = cat[i];
      if (search.replaceAll("%20","").toLowerCase() == removeAccent(cat[i].toLowerCase())) {
        option.selected = true;
      }
      div.appendChild(option);
    }
  }
}
xhr.addEventListener("readystatechange", Cat, false);
xhr.send(null);

var xhr2 = new XMLHttpRequest();
xhr2.open('GET', 'rechercheP.php', true);
var New = function () {
  if (xhr2.readyState === 4 && xhr2.status === 200) {
    tab = (xhr2.response.split('//||//'));
    affichage(tab);
  }
}
xhr2.addEventListener("readystatechange", New, false);
xhr2.send(null);

function affichage(tab) {
  document.getElementById("other").innerText = "";
  for (let i = 0; i < tab.length - 1; i++) {
    arr[i] = (JSON.parse(JSON.stringify(tab[i].split('|'))));
  }
  arr = arr.filter(el => removeAccent(el[8].toLowerCase()) == removeAccent(search.toLowerCase()));
  let img, ins, marque, utilisateur, desc, uti, ville, cp;

  for (let i = 1; i < arr.length; i++) {
    var original = document.getElementById(1);
    var parent = document.getElementById("other");
    var clone = original.cloneNode(true);
    clone.id = i + 1;
    parent.appendChild(clone);
  }

  if (arr.length > 0) {
    document.getElementById("load").style.display = 'none';
    document.getElementById("search").style.display = 'block';
    document.getElementById("title").style.display = 'block';
    document.getElementById("none").style.display = 'none';
  } else {
    document.getElementById("load").style.display = 'none';
    document.getElementById("none").style.display = 'block';
    document.getElementById("title").style.display = 'none';
    document.getElementById("search").style.display = 'none';
  }

  for (let i = 0; i < arr.length; i++) {
    img = arr[i][6];
    ins = arr[i][4];
    marque = arr[i][0];
    utilisateur = arr[i][1] + ' ' + arr[i][2];
    desc = arr[i][5];
    uti = arr[i][7];
    ville = arr[i][3];
    cp = arr[i][9].slice(0, 2);

    let div = document.getElementById((i + 1).toString());
    div.onclick = function() {
      window.location.href='../ficheinstrument/presentationinstrument.php?'+tab[i].split('|')[10];
    }
    div.childNodes[1].childNodes[1].childNodes[3].innerText = utilisateur;
    div.childNodes[1].childNodes[1].childNodes[1].src = uti;
    div.childNodes[1].childNodes[3].childNodes[1].innerText = ville + " - (" + cp + ")";
    div.childNodes[3].childNodes[1].childNodes[1].childNodes[1].src = img;
    div.childNodes[3].childNodes[1].childNodes[3].childNodes[1].innerText = ins;
    div.childNodes[3].childNodes[1].childNodes[3].childNodes[5].innerText = marque;
    div.childNodes[3].childNodes[5].innerText = desc;

  }
}

function selectChange() {
  search = document.getElementById("cat").value;
  affichage(tab);
}

function removeAccent(s){
  var r=s.toLowerCase();
  r = r.replace(new RegExp(/\s/g),"");
  r = r.replace(new RegExp(/[àáâãäå]/g),"a");
  r = r.replace(new RegExp(/æ/g),"ae");
  r = r.replace(new RegExp(/ç/g),"c");
  r = r.replace(new RegExp(/[èéêë]/g),"e");
  r = r.replace(new RegExp(/[ìíîï]/g),"i");
  r = r.replace(new RegExp(/ñ/g),"n");
  r = r.replace(new RegExp(/[òóôõö]/g),"o");
  r = r.replace(new RegExp(/œ/g),"oe");
  r = r.replace(new RegExp(/[ùúûü]/g),"u");
  r = r.replace(new RegExp(/[ýÿ]/g),"y");
  r = r.replace(new RegExp(/\W/g),"");
  return r;
};
