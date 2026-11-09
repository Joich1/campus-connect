const etapa1 = document.getElementById('etapa1')
const etapa2 = document.getElementById('etapa2')
const btnProximo = document.getElementById('btnProximo')
const btnVoltar = document.getElementById('btnVoltar')
const titulo = document.getElementById('titulo')
const stepTag = document.querySelector('.step-tag')

if(btnProximo && btnVoltar){
    btnProximo.addEventListener('click', () =>{
        for(const field of etapa1.querySelectorAll('input')){
            if(!field.reportValidity()){
                return;
            }
        }

        etapa1.hidden = true;
        etapa2.hidden = false;
        titulo.textContent = 'Adicione sua foto';
        stepTag.textContent = 'PASSO 2 DE 2';
    })

    btnVoltar.addEventListener('click', () =>{
        etapa2.hidden = true;
        etapa1.hidden = false;
        titulo.textContent = 'Crie sua conta';
        stepTag.textContent = 'PASSO 1 DE 2';
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