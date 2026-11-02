//pegar input aqui (troca depois)
const teste = document.getElementById('fInput')
const previwPhoto = () => {
    const file = teste.files;
    if(file){
        const fReader = new FileReader();
        const preview = document.getElementById('fPreview');
        //não faço ideia doque isso faz, pesquisa depois
        fReader.onload = function (event) {
            //não lembro tbm
            preview.setAttribute( 'src', event.target.result );
        }
        fReader.readAsDataURL(file[0])
    }
}
teste.addEventListener("change", previwPhoto)