document.addEventListener('DOMContentLoaded', () => {
    const h1 = document.getElementById('image-title');

    h1.addEventListener('click', () => {
        const originalText = h1.textContent;
        console.log(originalText);
        const h1Width = h1.offsetWidth;
        const h1Text = h1.textContent;

        // Create input element
        const input = document.createElement('input');
        input.type = 'text';
        input.value = h1Text;
        input.style.width = h1Width + 'px';

        // Create button element
        const button = document.createElement('button');
        button.textContent = 'Save';
        button.style.width = h1Width + 'px';

        const cancelButton = document.createElement('button');
        cancelButton.textContent = 'Cancel';
        cancelButton.style.width = h1Width + 'px';

        // Replace h1 with input and button
        h1.parentNode.insertBefore(input, h1);
        h1.parentNode.insertBefore(button, h1);
        h1.parentNode.insertBefore(cancelButton, h1);
        h1.classList.add('hidden');

        // Add button click event to save changes
        button.addEventListener('click', () => {
            h1.textContent = input.value;
            const urlParams = new URLSearchParams(window.location.search);
            const id = urlParams.get('id');
            // Example usage

            const data = {
                id: id,
                title: input.value
            };
            ajaxPost('/edit/title', data, function(err, response) {
                if (err) {
                    console.error('Error:', err);
                } else {
                    console.log('Response:', response);
                }
            });
            input.remove();
            button.remove();
            h1.classList.remove('hidden');
        });

        cancelButton.addEventListener('click', () => {
            h1.textContent = originalText;
            input.remove();
            button.remove()
            cancelButton.remove();
            h1.classList.remove('hidden');
        });
    });
});

function createXHR() {
    const xhr = new XMLHttpRequest();
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    xhr.open = (function (open) {
        return function (method, url, async, user, password) {
            open.call(this, method, url, async, user, password);
            this.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        };
    })(xhr.open);
    return xhr;
}


function ajaxPost(url, data, callback) {
    // Create a new XMLHttpRequest object
    // const xhr = new XMLHttpRequest();
    const xhr = createXHR();
    // Configure it: POST-request for the URL
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Convert data object to URL-encoded string
    const urlEncodedData = Object.keys(data)
        .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(data[key]))
        .join('&');

    // Setup our listener to process completed requests
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            // Call the callback function with the response text
            callback(null, xhr.responseText);
        } else {
            // Call the callback function with the status text
            callback(xhr.statusText);
        }
    };

    // Setup our listener to handle errors
    xhr.onerror = function() {
        callback('Network Error');
    };

    // Send the request
    xhr.send(urlEncodedData);
}

