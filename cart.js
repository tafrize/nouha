// cart.js
document.addEventListener("DOMContentLoaded", function () {
    const quantityButtons = document.querySelectorAll(".quantity-action");
    const itemQuantities = document.querySelectorAll(".item-quantity");
    const itemTotals = document.querySelectorAll(".item-total");
    const totalSpan = document.getElementById("total-price");

    quantityButtons.forEach(button => {
        button.addEventListener("click", handleQuantityChange);
    });

    function handleQuantityChange(event) {
        const productId = event.target.getAttribute("data-product-id");
        const action = event.target.getAttribute("data-action");
        const itemIndex = Array.from(quantityButtons).indexOf(event.target);

        if (itemIndex !== -1) {
            if (action === "increase") {
                itemQuantities[itemIndex].textContent = parseInt(itemQuantities[itemIndex].textContent) + 1;
            } else if (action === "decrease" && parseInt(itemQuantities[itemIndex].textContent) > 1) {
                itemQuantities[itemIndex].textContent = parseInt(itemQuantities[itemIndex].textContent) - 1;
            } else if (action === "decrease" && parseInt(itemQuantities[itemIndex].textContent) === 1) {
                // Supprimer le produit du panier lorsque la quantité atteint 1
                deleteItem(productId);
                return;
            }

            // Mettez à jour le total de l'article
            const price = parseFloat(itemTotals[itemIndex].textContent.replace(" €", ""));
            itemTotals[itemIndex].textContent = (price * parseInt(itemQuantities[itemIndex].textContent)) + " €";

            // Mettez à jour le total général
            let newTotal = 0;
            itemTotals.forEach(total => {
                newTotal += parseFloat(total.textContent.replace(" €", ""));
            });
            totalSpan.textContent = newTotal + " €";
        }
    }

    function deleteItem(productId) {
        // Supprimer le produit du panier en utilisant AJAX ou en rechargeant la page
        // Vous devez implémenter cette fonction en fonction de votre configuration
        alert("Produit supprimé du panier");
    }
});
