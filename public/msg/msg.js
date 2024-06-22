export {abrir,fechar}
function abrir(params) {
    var j = document.getElementById('janela-modal')
    var b = document.getElementsByTagName("body")[0];
    j.classList.add('abrirModal')
    j.setAttribute("style","top: "+window.scrollY+"px;")
    b.classList.add('disableScroll')
    b.setAttribute("style","overflow: hidden;")
    var x=window.scrollX;
    var y=window.scrollY;
    window.onscroll=function(){window.scrollTo(x, y);};

    j.addEventListener('click',(e) => {
        if(e.target.id == 'fechar' /*|| e.target.id =='janela-modal'*/){
            j.classList.remove('abrirModal')
            b.classList.remove('disableScroll')
            b.removeAttribute("style")
            window.onscroll = function () {};
        }
    })
}
function fechar(){
    var x = document.getElementById('janela-modal');
    var y = document.getElementsByTagName("body")[0];
    x.classList.remove('abrirModal');
    y.classList.remove('disableScroll')
    y.removeAttribute("style")
    window.onscroll = function () {};
}