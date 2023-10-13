const reservations = [];

function addReservation() {
    const customerName = document.getElementById('customerName').value;
    const tableNumber = parseInt(document.getElementById('tableNumber').value);
    const reservationDate = document.getElementById('reservationDate').value;
    const reservationTime = document.getElementById('reservationTime').value;

    const startTime = new Date(`${reservationDate}T17:00`);
    const endTime = new Date(`${reservationDate}T20:00`);
    const selectedTime = new Date(`${reservationDate}T${reservationTime}`);

    if (
        customerName &&
        !isNaN(tableNumber) &&
        reservationDate &&
        reservationTime &&
        selectedTime >= startTime &&
        selectedTime <= endTime
    ) {
        const reservation = {
            customerName,
            tableNumber,
            dateTime: `${reservationDate} ${reservationTime}`,
        };

        reservations.push(reservation);

        document.getElementById('customerName').value = '';
        document.getElementById('tableNumber').value = '';
        document.getElementById('reservationDate').value = '';
        document.getElementById('reservationTime').value = '';

        displayReservations();
    } else {
        alert('Please enter a valid customer name, table number, reservation date, and a time between 5 pm and 8 pm.');
    }
}

function displayReservations() {
    const reservationList = document.getElementById('reservationList');
    reservationList.innerHTML = '';

    reservations.forEach((reservation, index) => {
        const listItem = document.createElement('li');
        listItem.innerHTML = `Customer: ${reservation.customerName}, Table: ${reservation.tableNumber}, Date/Time: ${reservation.dateTime}`;

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

document.getElementById('addReservationButton').addEventListener('click', addReservation);

displayReservations();
