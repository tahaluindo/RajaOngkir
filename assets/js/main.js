//Dark mode
const alterarTema = document.querySelector(
  '.mudar-tema input[type="checkbox"]'
);
  
const temaAtual = localStorage.getItem("tema");

if (temaAtual) {
  document.documentElement.setAttribute("data-tema", temaAtual);
  if (temaAtual === "dark") {
    alterarTema.checked = true;
  }
}
  
function mudarTema(e) {
  if (e.target.checked) {
    document.documentElement.setAttribute("data-tema", "dark");
    localStorage.setItem("tema", "dark");
  }else {
    document.documentElement.setAttribute("data-tema", "light");
    localStorage.setItem("tema", "light");
  }
}
  
alterarTema.addEventListener("change", mudarTema, false);
  
//Cópiar chave PIX
document.querySelector("button").addEventListener("click",
  function (event) {
    var textRange = document.createRange()
    textRange.selectNode(document.getElementById("chave"))
    window.getSelection().removeAllRanges()
    window.getSelection().addRange(textRange)
    document.execCommand("copy")
    window.getSelection().removeAllRanges()
    document.querySelector("button").innerText = 'Copiado!'
})
