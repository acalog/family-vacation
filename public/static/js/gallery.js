function ajaxGet(url, apiKey, onSuccess, onError) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);

    // Set the x-api-key header
    xhr.setRequestHeader('x-api-key', apiKey);

    // Handle the response
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4) {
        if (xhr.status >= 200 && xhr.status < 300) {
          onSuccess(xhr.responseText);
        } else {
          onError(xhr.status, xhr.statusText);
        }
      }
    };

    // Handle network errors
    xhr.onerror = function() {
      onError(xhr.status, xhr.statusText);
    };

    // Send the request
    xhr.send();
}

function fetchGet(url, onSuccess, onError) {
    fetch(url, {
      method: 'GET',
    })
    .then(response => {
      if (!response.ok) {
        throw new Error(`Error: ${response.status} ${response.statusText}`);
      }
      return response.text();
    })
    .then(data => {
      onSuccess(data);
    })
    .catch(error => {
      const [status, statusText] = error.message.split(' ').slice(1);
      onError(status, statusText);
    });
}

document.addEventListener('DOMContentLoaded', () => {

    const placeholders = document.querySelectorAll('.gallery__image.lazy-load');
    const observerOptions = {
        root: null, // Use the viewport as the root
        rootMargin: '0px',
        threshold: 0.1, // Trigger when 10% of the placeholder is visible
    };
    const loadImage = (placeholder) => {
        const imgSrc = placeholder.getAttribute('data-filename');
        const height = String(Math.floor(Math.random() * 750)) + 'px';
        placeholder.setAttribute('src', 'https://via.placeholder.com/200');
        fetchGet('/thumbnail/' + imgSrc,
            function (response) {
                if (response === '') {
                    placeholder.parentNode.parentNode.style.display = 'none';
                }
                else {
                    const source = 'data:image/jpeg;base64,' + response;
                    placeholder.setAttribute('src', source);
                }

            },
            function (status, statusText) {
                console.error(status + ' ' + statusText);

            },
        );

        // placeholder.style.minHeight = height;
        // placeholder.style.height = height;
        // placeholder.style.backgroundColor = 'red';
    };
    fetchGet(
        '/thumbnail/20240518_124342.jpg',
        function (response) {
            console.log(response);
            const testThumb = document.querySelector('#test-thumbnail');
            testThumb.setAttribute('src', 'data:image/jpeg;base64,' + response);
        },
        function (status, statusText) {
            console.error(status + ' ' + statusText);
        },
    );

    const observerCallback = (entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                loadImage(entry.target);
                observer.unobserve(entry.target); // Stop observing once loaded
            }
        });
    };

    const observer = new IntersectionObserver(observerCallback, observerOptions);

    placeholders.forEach((placeholder) => {
        observer.observe(placeholder);
    });

    /*
      urls.forEach(function (value, key) {
          console.log(value.getAttribute('data-filename'));
          fetchGet(baseUrl + value.getAttribute('data-filename'), apiKey,
          function (response) {
              console.log(response);
          },
          function(status, statusText) {
              console.error('Error:', status, statusText);
          });
      });

       */
});

  /*
  // Usage example:
  const url = 'https://api.example.com/resource';
  const apiKey = 'your-api-key';
  ajaxGet(url, apiKey,
    function(response) {
      console.log('Success:', response);
    },
    function(status, statusText) {
      console.error('Error:', status, statusText);
    }
  );
  */
