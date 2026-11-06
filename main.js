const etapa1 = document.getElementById('etapa1')
const etapa2 = document.getElementById('etapa2')
const btnProximo = document.getElementById('btnProximo')
const btnVoltar = document.getElementById('btnVoltar')

if(btnProximo && btnVoltar){
    btnProximo.addEventListener('click', () =>{
        etapa1.hidden = true;
        etapa2.hidden = false;
    })

    btnVoltar.addEventListener('click', (){
        etapa1.hidden = true;
        etapa1.hidden = false
    })
}


const input = document.getElementById('fInput')

const previewPhoto = () => {
    const file = input.files;
    if(file.length > 0){
        const fReader = new FileReader();
        const preview = document.getElementById('fPreview');
        fReader.onload = function (event) {
            preview.setAttribute('src', event.target.result);
        }
        fReader.readAsDataURL(file[0])
    }
}

if(input){
    input.addEventListener("change", previewPhoto)
}