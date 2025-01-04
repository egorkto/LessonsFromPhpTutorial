const types = ['image/jpeg', 'image/png'];

let imagesForUpload = [];

let dragAndDrop = document.querySelector('.drag-and-drop'),
    imagesList = document.querySelector('.images-list'),
    uploadBtn = document.querySelector('.upload-btn');

dragAndDrop.addEventListener('dragenter', (e) => {
    e.preventDefault();
    dragAndDrop.classList.add('active');
})

dragAndDrop.addEventListener('dragleave', (e) => {
    e.preventDefault();
    dragAndDrop.classList.remove('active');
})

dragAndDrop.addEventListener('dragover', (e) => {
    e.preventDefault();
    //console.log('over');
})


dragAndDrop.addEventListener('drop', (e) => {
    e.preventDefault();
    dragAndDrop.classList.remove('active');
    const files = e.dataTransfer.files;
    for(let key in files){
        if(!types.includes(files[key].type)) {
            continue;
        }
        imagesForUpload.push(files[key]);
        let imageTmpUrl = URL.createObjectURL(files[key]);
        imagesList.innerHTML += `<img src="${imageTmpUrl}" class="images-list-element">`
    }
    if(imagesForUpload.length > 0) {
        uploadBtn.removeAttribute('disabled');
    }
})

const uploadImages = () => {
    let formData = new FormData();
    for(let key in imagesForUpload){
        formData.append(key, imagesForUpload[key])
    }
    fetch('/core/upload.php', {
        method: "POST",
        body: formData
    }).then(response => response.json())
        .then(result => {
            if(result.status) {
                alert('Success');
                imagesForUpload = [];
                imagesList.innerHTML = ``;
                uploadBtn.setAttribute('disabled', true);
            }
        })
}