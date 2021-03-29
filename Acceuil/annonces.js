let tab;
let arr = [];


var xhr2 = new XMLHttpRequest();
xhr2.open('GET', 'recherche.php', true);
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
  let img, ins, marque, utilisateur, desc, uti, ville, cp;
  console.log(arr);


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
  } else {
    document.getElementById("load").style.display = 'none'
    document.getElementById("none").style.display = 'block'
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
      window.location.href = '../ficheinstrument/presentationinstrument.html?' + arr[i][10];
    };
    div.childNodes[1].childNodes[1].childNodes[3].innerText = utilisateur;
    div.childNodes[1].childNodes[1].childNodes[1].src = uti;
    div.childNodes[1].childNodes[3].childNodes[1].innerText = ville + " - (" + cp + "--)";
    div.childNodes[3].childNodes[1].childNodes[1].childNodes[1].src = img;
    div.childNodes[3].childNodes[1].childNodes[3].childNodes[1].innerText = ins;
    div.childNodes[3].childNodes[1].childNodes[3].childNodes[5].innerText = marque;
    div.childNodes[3].childNodes[5].innerText = desc;
    console.log(div);
  }
}

function selectChange() {
  search = document.getElementById("cat").value;
  affichage(tab);
}
