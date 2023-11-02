document.addEventListener("DOMContentLoaded", function() {
    // Reference to the table body
    const tableBody = document.getElementById("tableBody");

    // Function to generate a table row
    function generateTableRow(tableNumber, capacity, availability) {
        const tr = document.createElement("tr");
        const tdTableNumber = document.createElement("td");
        const tdCapacity = document.createElement("td");
        const tdAvailability = document.createElement("td");
        const tdAction = document.createElement("td");
        const btn = document.createElement("button");

        tdTableNumber.textContent = `Table ${tableNumber}`;
        tdCapacity.textContent = capacity;
        tdAvailability.textContent = availability;
        btn.textContent = "Request Reservation";

        btn.addEventListener("click", function() {
            requestReservation(`Table ${tableNumber}`);
        });

        tdAction.appendChild(btn);
        tr.appendChild(tdTableNumber);
        tr.appendChild(tdCapacity);
        tr.appendChild(tdAvailability);
        tr.appendChild(tdAction);
        
        return tr;
    }

    // Generate 10 table rows and append them to the table body
    for (let i = 1; i <= 10; i++) {
        const row = generateTableRow(i, 4, "Available");
        tableBody.appendChild(row);
    }

    function requestReservation(tableNumber) {
        alert(`Reservation requested for ${tableNumber}`);
    }
});
