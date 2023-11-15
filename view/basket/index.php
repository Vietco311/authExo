<!DOCTYPE html>
<html>
<head>
    <title>Your Basket</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        // Function to load and display the basket
        function loadBasket() {
            const user_id = 1;
            //localStorage.getItem('user_id');
            url = 'http://localhost:8080/authExo/view/basket/getBasket.php/basket?';
            let params = new URLSearchParams();
            params.append("user_id",user_id)
            fetch(url + params, {
                method: 'GET'
            })
            .then(response => {
                return response.json();
            })
            .then(response => {
                const { status, status_message, data } = response;
                const product = JSON.parse(data);
                const basketContainer = document.getElementById('basketContainer');
                basketContainer.innerHTML = '';
                product.forEach(item => {
                    basketContainer.innerHTML += `
                        <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white p-4 m-2">
                            <div class="font-bold text-xl mb-2">${item.designation}</div>
                            <p class="text-gray-700 text-base">Price: $${item.prix}</p>
                            <p class="text-gray-700 text-base">Category: ${item.categorie}</p>
                            <p class="text-gray-700 text-base">Quantity: ${item.quantite}</p>
                            <div class="flex items-center justify-between mt-4">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Add More
                                </button>
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Remove
                                </button>
                            </div>
                        </div>
                    `;
                });
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</head>
<body onload="loadBasket()" class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-4xl font-bold mb-5">Basket</h1>
        <div id="basketContainer" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"></div>
    </div>
</body>
</html>