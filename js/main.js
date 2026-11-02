const input = document.getElementById('fInput')
const previewPhoto = () => {
    const file = input.files;
    if(file){
        const fReader = new FileReader();
        const preview = document.getElementById('fPreview');
        fReader.onload = function (event) {
            preview.setAttribute( 'src', event.target.result );
        }
        fReader.readAsDataURL(file[0])
    }
}
input.addEventListener("change", previewPhoto) 