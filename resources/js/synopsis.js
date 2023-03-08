var synF = document.getElementById("synopsisFull");
var syn = document.getElementById("synopsis");
syn.textContent = synF.textContent.slice(0, 100);

function synopsis() {
  syn.textContent = synF.textContent;
}
syn.onclick(function (e) {
  synopsis();
});
