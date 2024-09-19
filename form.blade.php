<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container {
            width: 60%;
        }
    </style>
</head>

<body class="bg-dark">

    <div class="container mx-auto mt-5 text-white">
        <form id="formData">
            <h1 class="pb-4">Leave a Message for Us</h1>
            @csrf
            <div class="mb-3">
                <label for="exampleInputName1" class="form-label">Email Name</label>
                <input type="text" name="name" class="form-control bg-dark-subtle" id="exampleInputName1" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control bg-dark-subtle" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
                <label for="exampleInputMessage1" class="form-label">Message</label>
                <textarea class="form-control bg-dark-subtle" name="message" id="exampleInputMessage1" cols="30" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-primary submitBtn">Submit</button>
            <a href="{{ route('welcome') }}" class="btn bg-secondary float-end">Go Back</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        
        const subBtn = document.querySelector(".submitBtn");
        function onSubmitForm(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);

            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "/form", true);
            const csrf = document.querySelector('input[name="_token"]').value
            xhttp.setRequestHeader('X-CSRF-TOKEN', csrf); // Set the CSRF token
            subBtn.innerHTML = 'Wait...';
            subBtn.disabled = true;
            xhttp.send(formData);

            xhttp.onload = function() {
                if (xhttp.status === 200) {
                    let response = JSON.parse(this.responseText);
                    console.log(response.success);
                    subBtn.innerHTML = 'Submit';
                    subBtn.disabled = false;
                } else {
                    console.error("Request failed with status: " + xhttp.status);
                    subBtn.innerHTML = 'Submit';
                    subBtn.disabled = false;
                }
            };

            xhttp.onerror = function() {
                console.error("Request failed");
                subBtn.innerHTML = 'Submit';
                subBtn.disabled = false;
            };
        }

        document.getElementById('formData').addEventListener('submit', onSubmitForm);
    </script>
    
</body>

</html>
