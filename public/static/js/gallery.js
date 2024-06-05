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
  document.addEventListener('DOMContentLoaded', () => {
    const baseUrl = 'https://bv5hcib5vl.execute-api.us-east-1.amazonaws.com/Prod/resize/';
    const apiKey = 'laoy3M3AnO6MqkJF7uZ3E67HjEUdtZv12pPmj5mx'
    const urls = document.querySelectorAll('.gallery__image');
    urls.forEach(function (value, key) {
        console.log(value.getAttribute('data-filename'));
        ajaxGet(baseUrl + value.getAttribute('data-filename'), apiKey, 
        function (response) {
            console.log(response);
        }, 
        function(status, statusText) {
            console.error('Error:', status, statusText);
        });
    });
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