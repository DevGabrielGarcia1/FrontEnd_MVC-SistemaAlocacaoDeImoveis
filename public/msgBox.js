//let msgExcluir = new MsgBox();
//msgExcluir.showInLine({_idName: 'msgDelete', _type: msgExcluir.SET_TYPE_TEXT('root'), _menssagem: 'Excluir definitivamente?', _title: 'Excluir?', _btnOkName: 'Sim', _btnOkHref: '', _btnCancelName: 'Cancelar',  _onCloseAction: 'window.location.href = ;', _btnFecharView: false});
//Caixas de menssagens (modal)
class MsgBox{
    constructor(){

    }
    //Constantes
    static BTN_OK = 1;
    static BTN_Cancel = 2;
    static BTN_Fechar = 3;
    static BTN_Background = 4;
    
    //Tipos de Entrada/Saida
    async SET_TYPE_TEXT(rootRoute) {await(this.#input = false); await(this.type = "/"+rootRoute +"/public/msg/msg.html.php");};
    SET_TYPE_INPUT(rootRoute) {await(this.#input = true); await(this.type = "/"+rootRoute +"/public/msg/msg.html.php");};
    SET_TYPE_HTML = (URL)=>{return URL};
    SET_TYPE_TEXTHTML = "";

    //Atributos
    idName = null;
    message = null;
    inputMenssage = null;
    inputPlaceholder = null;
    inputPassword = false;
    title = null;
    type = null;
    autoDestroy = false;
    backgroudClose = true;

    #HTML = null;
    #input = false;
    //BtnOK
    btnOKName = null;
    btnOKHref = null;
    btnOKAction = "null;";
    //BtnCancel
    btnCancelName = null;
    btnCancelHref = null;
    btnCancelAction = "null;";
    //btnFechar
    btnFecharView = true;
    onCloseAction = "null;";

    //Javascript Carregado
    JS = null;

    //Retorno
    returnBtnClicked = null;
    visible = false;
    returnInput = null;

    reset(){
        this.idName = null;
        this.message = null;
        this.inputMenssage = null;
        this.inputPlaceholder = null;
        this.inputPassword = false;
        this.title = null;
        this.type = null;
        this.autoDestroy = false;
        this.backgroudClose = true;
    
        this.#HTML = null;
        this.#input = false;
        
        //BtnOK
        this.btnOKName = null;
        this.btnOKHref = null;
        this.btnOKAction = "null;";
        //BtnCancel
        this.btnCancelName = null;
        this.btnCancelHref = null;
        this.btnCancelAction = "null;";
        //btnFechar
        this.btnFecharView = true;
        this.onCloseAction = "null;";

        //Javascript Carregado
        this.JS = null;
    }

    #resetReturns(){
        this.returnBtnClicked = null;
        this.visible = false;
        this.returnInput = null;
    }

    async show(){
        this.#resetReturns();
        //if(this.idName != null && this.message != null){ //Testando...
        if(this.idName != null && this.type != null){
            await this.#request();
            await this.#inject();
            var i = 0;
            while(i < 10)
                try{
                    i++;
                    await new Promise(r => setTimeout(r, 100));
                    window[this.idName].JS.abrir();
                    this.visible = true;
                    break;
                }catch{}
            if(i >= 10){
                throw "Não foi possivel abrir a caixa de menssagem."
            }
        }else
            throw "Menssagem incompleta.";
    }

    async showInLine({_idName= null, 
        _type = null, 
        _menssagem = null, 
        _title = null, 
        _autoDestroy = false,
        _inputMenssage = null, 
        _inputPlaceholder = null, 
        _inputPassword = false, 
        _btnOkName = null,
        _btnOkHref = null,
        _btnOkAction = "null;", 
        _btnCancelName = null, 
        _btnCancelHref = null, 
        _btnCancelAction = "null;", 
        _onCloseAction = "null;",
        _btnFecharView = true,
        _backgroudClose = true}){
        if(_idName == null || _type == null){
            throw "Menssagem incompleta.";
        }
        var obj = document.getElementById(this.idName)
        if(obj != null)
            await this.destroy();
        await this.reset();
        await this.#resetReturns();
        this.idName = _idName;
        this.message = _menssagem;
        this.inputMenssage = _inputMenssage;
        this.inputPlaceholder = _inputPlaceholder;
        this.inputPassword = _inputPassword;
        this.title = _title;
        
        this.autoDestroy = _autoDestroy;
        this.backgroudClose = _backgroudClose;
        //BtnOK
        this.btnOKName = _btnOkName;
        this.btnOKHref = _btnOkHref;
        this.btnOKAction = _btnOkAction;
        //BtnCancel
        this.btnCancelName = _btnCancelName;
        this.btnCancelHref = _btnCancelHref;
        this.btnCancelAction = _btnCancelAction;
        //btnFechar
        this.btnFecharView = _btnFecharView;
        this.onCloseAction = _onCloseAction;
        await this.show();
    }

    abrir(){
        this.JS.abrir();
        this.visible = true;
    }

    fechar(){
        this.JS.fechar();
        this.visible = false;
    }

    destroy(){
        document.getElementById(this.idName).remove();
        this.reset();
        window[this.idName] = null;
    }

    async #request(url = this.type){
        
        var head = true;
        var compile = "";
        var http = new XMLHttpRequest(); // cria o objeto XHR
        http.open("GET", url); // requisita a página .html
        http.send();
        http.onreadystatechange=function(){
            if(http.readyState == 4){ // retorno do Ajax
                var body = document.querySelectorAll("body"); // seleciona os <body>
                
                if(!head)
                    compile = http.responseText.replace(/<html[\s\S]*?>([\s\S]*?)<body>/, "").replace(/<\/body>([\s\S]*?)<\/html>/, "").replace("<!DOCTYPE html>","");
                else
                    compile = http.responseText.replace(/<html[\s\S]*?>([\s\S]*?)/, "").replace(/(<\/body>)([\s\S]*?)<\/html>/, "</body>").replace("<!DOCTYPE html>","");                
            }
        }
        while(compile=="")
            await new Promise(r => setTimeout(r, 100));
        this.#HTML = compile;
    }

    #inject(){
        var idName = this.idName;
        //Injetar
        var body = document.querySelectorAll("body");
        var msgDiv = `<div id='${idName}'>${this.#HTML}</div>`;
        body[0].innerHTML = body[0].innerHTML + msgDiv;

        //Objetos
        var objScript = document.getElementById(idName).getElementsByTagName("script");;
        var objTitle = document.getElementById(idName).getElementsByClassName('msgTitle');
        var objMenssage = document.getElementById(idName).getElementsByClassName('msgMenssage');
        var objBtnOk = document.getElementById(idName).getElementsByClassName('msgOkButton');
        var objBtnCancel = document.getElementById(idName).getElementsByClassName('msgCancelButton');
        var objBtnFecar = document.getElementById(idName).getElementsByClassName('fechar')[0];
        var objInput = document.getElementById(idName).getElementsByClassName("msgInput")[0];
        var objBackground = document.getElementById(idName).getElementsByClassName("janela-modal")[0];

        //Configurar
        if(this.autoDestroy)
            this.onCloseAction = idName+".destroy();" + this.onCloseAction;

        //Imports javascripts
        var obj = objScript;
        for(var i = 0; i < obj.length; i++){
            this.#importJs(obj[i].getAttribute("src"));
        }

        try{
        //Texto
        obj = objTitle;
        if(this.title != null)
            obj[0].innerHTML = this.title;
        else
            obj[0].remove();

        obj = objMenssage;
        if(this.message != null)
            obj[0].innerHTML = this.message;
        else
            obj[0].remove();

        //Input
        if(this.#input){
            obj = objInput.getElementsByTagName("input")[0];
            obj.setAttribute('id',idName+'_input');
            if(this.inputPlaceholder != null)
                obj.setAttribute('placeholder',this.inputPlaceholder);
            
            if(this.inputPassword)
                obj.setAttribute('type',"password");
            
            obj = objInput.getElementsByTagName("p")[0]
            if(this.inputMenssage != null)
                obj.innerHTML = this.inputMenssage;
            else
                obj.remove();
        }else{
            obj = objInput;
            obj.remove();
        }

        //Botões
        //OK
        for(var i = 0, obj = objBtnOk; i < obj.length; i++){
                obj[i].setAttribute('id',idName+'_btnOk'+i);
                obj[i].setAttribute('onclick', idName+".fechar(); " + 
                                    (idName+".returnBtnClicked = " + MsgBox.BTN_OK + "; ") + 
                                    ((this.#input)?(idName+".returnInput = MsgBox.getInputReturn('"+idName+"', '"+objInput.className+"'); "):"") + 
                                    this.btnOKAction + 
                                    this.onCloseAction + 
                                    ((this.btnOKHref != null)?("window.location.href = '"+this.btnOKHref+"';"):""));
                obj[i].innerHTML = this.btnOKName;
                if(this.btnOKName == null)
                    obj[i].remove();
            }
        //Cancel
        for(var i = 0, obj = objBtnCancel;  i < obj.length; i++){
                obj[i].setAttribute('id',idName+'_btnCancel'+i);
                obj[i].setAttribute('onclick',idName+".fechar(); " + 
                                    (idName+".returnBtnClicked = " + MsgBox.BTN_Cancel + "; ") + 
                                    this.btnCancelAction + 
                                    this.onCloseAction +
                                    ((this.btnCancelHref != null)?("window.location.href = '"+this.btnCancelHref+"';"):""));
                obj[i].innerHTML = this.btnCancelName;
                if(this.btnCancelName == null)
                    obj[i].remove();
            }
        //Fechar
            obj = objBtnFecar;
            obj.setAttribute('id',idName+'_btnFechar'+i);
            obj.setAttribute('onclick',idName+".fechar(); " + (idName+".returnBtnClicked = " + MsgBox.BTN_Fechar + "; ") + this.btnCancelAction + this.onCloseAction);
            if(!this.btnFecharView)
                    obj.remove();
        //Background
        obj = objBackground;
        if(this.backgroudClose)
            document.addEventListener('click',(e) => {
                if(e.target.id =='janela-modal'){
                    obj.setAttribute('onclick',idName+".fechar(); " + (idName+".returnBtnClicked = " + MsgBox.BTN_Background + "; ") + this.btnCancelAction + this.onCloseAction);
                    obj.click();
                    /*window[idName].fechar();
                    window[idName].returnBtnClicked = MsgBox.BTN_Background;
                    window[idName].this.btnCancelAction();
                    window[idName].this.onCloseAction();
                    */ // <-- Futuro Update
                }});
        
        }catch{}
    }

    async #importJs(src){
        var id;
        await (id = this.idName);
        //window["msgBox_"+id] = await import(src);
        //document.write(document.querySelectorAll("html")[0].innerHTML);
        this.JS = await import(src);
        window[id] = this;
    }

    static getInputReturn(id, nClass){return document.getElementById(id).getElementsByClassName(nClass)[0].getElementsByTagName("input")[0].value;}
}