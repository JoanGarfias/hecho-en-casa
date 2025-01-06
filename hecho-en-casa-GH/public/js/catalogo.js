document.addEventListener("DOMContentLoaded", () => {
    const menuLinks = document.querySelectorAll(".menu a");
    const categoryTitle = document.getElementById("category-title");
    const dessertCard = document.querySelector(".dessert-card");

    const data = {
        pays: {
            title: "Pays",
            name: "Plátano",
            price: "12 px: $650",
            description:
                "Base galleta de vainilla, capas de plátano con dulce de leche, queso crema, nuez y más dulce de leche.",
            image: "Img_catalogo/Pay/Pay_platano.jpg",
        },
        flanes: {
            title: "Flanes",
            name: "Flan de Vainilla",
            price: "1 pieza: $150",
            description: "Delicioso flan casero con sabor a vainilla y caramelo.",
            image: "Img_catalogo/Flan/Flan_Napolitano.jpg",
        },
        // Agrega más categorías aquí...
    };

    menuLinks.forEach((link) => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const category = link.dataset.category;
            const categoryData = data[category];

            if (categoryData) {
                categoryTitle.textContent = categoryData.title;
                dessertCard.querySelector(".dessert-image").src = categoryData.image;
                dessertCard.querySelector(".dessert-name").textContent = categoryData.name;
                dessertCard.querySelector(".dessert-price").textContent = categoryData.price;
                dessertCard.querySelector(".dessert-description").textContent = categoryData.description;
            }
        });
    });
});