const reservations = [];

function addReservation() {
    const customerName = document.getElementById('customerName').value;
    const tableNumber = parseInt(document.getElementById('tableNumber').value);

    if (customerName && !isNaN(tableNumber)) {
        const reservation = {
            customerName,
            tableNumber
        };

        reservations.push(reservation);

        document.getElementById('customerName').value = '';
        document.getElementById('tableNumber').value = '';

        displayReservations();
    } else {
        alert('Please enter customer name and table number.');
    }
}

function displayReservations() {
    const reservationList = document.getElementById('reservationList');
    reservationList.innerHTML = '';

    reservations.forEach((reservation, index) => {
        const listItem = document.createElement('li');
        listItem.innerHTML = `${reservation.customerName} - Table ${reservation.tableNumber}`;
        
        const editButton = document.createElement('button');
        editButton.innerText = 'Edit';
        editButton.onclick = () => editReservation(index);

        const deleteButton = document.createElement('button');
        deleteButton.innerText = 'Delete';
        deleteButton.onclick = () => deleteReservation(index);

        listItem.appendChild(editButton);
        listItem.appendChild(deleteButton);

        reservationList.appendChild(listItem);
    });
}

function editReservation(index) {
    const newCustomerName = prompt('Enter new customer name:');
    const newTableNumber = parseInt(prompt('Enter new table number:'));

    if (newCustomerName && !isNaN(newTableNumber)) {
        reservations[index].customerName = newCustomerName;
        reservations[index].tableNumber = newTableNumber;

        displayReservations();
    } else {
        alert('Please enter customer name and table number.');
    }
}

function deleteReservation(index) {
    const confirmDelete = confirm('Are you sure you want to delete this reservation?');

    if (confirmDelete) {
        reservations.splice(index, 1);
        displayReservations();
    }
}

displayReservations();
