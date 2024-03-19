function updateCount(count) {
    document.getElementById("personCount").innerText = count;
}

function increase() {
    let count = parseInt(document.getElementById("personCount").innerText);
    count++;
    updateCount(count);
    updateQte(count);
}

function decrease() {
    let count = parseInt(document.getElementById("personCount").innerText);
    if (count > 1) {
        count--;
        updateCount(count);
        updateQte(count);
    }
}

function updateQte(newPersonCount) {
    const personCountInitial = parseInt(document.getElementById("personCountInitial").textContent, 10);
    const quantityElements = document.querySelectorAll('.recipe__ingredient-details .recipe__ingredient-quantity');

    quantityElements.forEach((quantityElement) => {
        const quantityValue = parseFloat(quantityElement.dataset.initialValue);
        const newValue = ((newPersonCount / personCountInitial) * quantityValue).toFixed(2);
        quantityElement.innerText = `${newValue} ${quantityElement.innerText.split(' ').slice(1).join(' ')}`;
    });
}
