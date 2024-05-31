
const isAdvancedUpload = function () {
    const div = document.createElement('div');
    return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
}();


function dropHandler(ev) {
    console.log('Video(s) dropped');
  
    // Prevent default behavior (Prevent file from being opened)
    ev.preventDefault();
  
    if (ev.dataTransfer.items) {
      // Use DataTransferItemList interface to access the file(s)
      for (let i = 0; i < ev.dataTransfer.items.length; i++) {
        // If dropped items aren't files, reject them
        if (ev.dataTransfer.items[i].kind === 'file') {
          let file = ev.dataTransfer.items[i].getAsFile();
          console.log('... file[' + i + '].name = ' + file.name);
          console.log('size: ' + file.size + ' modified: ' + file.lastModified);
  
  
        }
      }
    } else {
      // Use DataTransfer interface to access the file(s)
      for (let i = 0; i < ev.dataTransfer.files.length; i++) {
        console.log('... file[' + i + '].name = ' + ev.dataTransfer.files[i].name);
      }
    }
  }
  
  function dragOverHandler(ev) {
    console.log('Over drop zone');
  
    // Prevent default behavior (Prevent file from being opened)
    ev.preventDefault();
  }
  

const test_progress = function (response) {
    console.log(response);
    if (!document.getElementById(response.file)){
        const $resultsContainer = $('div.upload-results-container');
        const $resultsItem = $('<div class="upload-results-item"></div>');
        const $thumbnail = $('<img alt="prev-thumbnail">');
        $resultsItem.attr('id', response.file);
        $thumbnail.attr('src', response.url)
        $resultsItem.append($thumbnail);
        $resultsContainer.append($resultsItem);
    }
}

const dragList = [];
let dragStartIndex;

function dragStart() {
    dragStartIndex = +this.closest("div.edit-image-container").getAttribute("data-index");

}

function dragEnter() {
    this.classList.add("over");

}

function dragLeave() {
    this.classList.remove("over");

}

function dragOver(e) {
    e.preventDefault(); // dragDrop is not executed otherwise
}

function dragDrop() {
    const dragEndIndex = +this.closest("div.edit-image-container").getAttribute("data-index");
    // swap
    this.classList.remove("over");
    // console.log(this);
    swap(dragStartIndex, dragEndIndex);
    saveSwap(dragStartIndex, dragEndIndex);
}

function addListeners() {
    const draggables = document.querySelectorAll(".edit-image-container");
    const dragListItems = document.querySelectorAll(".edit-image-inner-container");


    draggables.forEach((draggable, index) => {
        draggable.setAttribute("data-index", index);
        draggable.addEventListener("dragstart", dragStart);
        dragList.push(draggable);
    });

    dragListItems.forEach((item) => {
        item.addEventListener("dragover", dragOver);
        item.addEventListener("drop", dragDrop);
        item.addEventListener("dragenter", dragEnter);
        item.addEventListener("dragleave", dragLeave);
    });
}



document.addEventListener('DOMContentLoaded', function () {

    addListeners()

})

// Run when the page loads.
document.addEventListener('DOMContentLoaded', function () {
    // Upload form element
    let form = document.querySelector('form.box');
    console.log(form);
    let updatePodcastForm = document.querySelector('form#update-podcast');
    let boxUpdateThumbnail = document.querySelector('.box#update-thumbnail');

    // File input element
    let input = form.querySelector('input[type="file"]');
    // File input (vanilla)
    let file_input = document.getElementById('thumbnailFile');
    let input2 = document.querySelector("form#update-podcast input[type='file']");
    let uploadingDisplay = document.getElementById('upload-display');
    let uploadsResultsContainer = document.querySelector('.upload-results-container');

    const fileInput = document.getElementById('file');
    

    fileInput.addEventListener('change', () => {
        form.classList.add('is-uploading')
        form.submit();
    });

    if (isAdvancedUpload) {
        form.classList.add('has-advanced-upload');
        console.log('Drag n\' drop enabled.');
    }

    if (isAdvancedUpload) {
        let droppedFiles = false;
        let uploaders = [];

        const preventDefaults = (e) => {
            e.preventDefault();
            e.stopPropagation();
        };

        ['drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop'].forEach(event => {
            form.addEventListener(event, preventDefaults, false);
            
        });

        ['dragover', 'dragenter'].forEach(event => {
            form.addEventListener(event, () => form.classList.add('is-dragover'), false);
        });

        ['dragleave', 'dragend', 'drop'].forEach(event => {
            form.addEventListener(event, () => form.classList.remove('is-dragover'), false);
        });

        form.addEventListener('drop', (e) => {
            droppedFiles = e.dataTransfer.files;
            let inputBoxFile = form.querySelector('#file');
            inputBoxFile.files = droppedFiles;
            console.log(inputBoxFile);
            form.submit();
        }, false);
    }

});



