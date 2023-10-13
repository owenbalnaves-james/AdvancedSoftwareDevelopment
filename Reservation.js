const reservations = [];

function addReservation() {
    const customerName = document.getElementById('customerName').value;
    const tableNumberInput = document.getElementById('tableNumber');
    const reservationDateInput = document.getElementById('reservationDate');
    const reservationTimeInput = document.getElementById('reservationTime');

    const tableNumber = parseInt(tableNumberInput.value);
    const reservationDate = reservationDateInput.value;
    const reservationTime = reservationTimeInput.value;

    if (!customerName || isNaN(tableNumber) || !reservationDate || !reservationTime) {
        alert('Please enter a valid customer name, table number, reservation date, and time.');
        return;
    }

    const startTime = new Date(`${reservationDate}T17:00`);
    const endTime = new Date(`${reservationDate}T20:00`);
    const selectedTime = new Date(`${reservationDate}T${reservationTime}`);

    if (selectedTime < startTime || selectedTime > endTime) {
        alert('Please select a time between 5 pm and 8 pm.');
        return;
    }

    const reservation = {
        customerName,
        tableNumber,
        dateTime: `${reservationDate} ${reservationTime}`,
    };

    reservations.push(reservation);

    document.getElementById('customerName').value = '';
    tableNumberInput.value = '';
    reservationDateInput.value = '';
    reservationTimeInput.value = '';

    displayReservations();
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
    const newDateTime = prompt('Enter new date and time:');

    if (newCustomerName && !isNaN(newTableNumber) && newDateTime) {
        reservations[index].customerName = newCustomerName;
        reservations[index].tableNumber = newTableNumber;
        reservations[index].dateTime = newDateTime;

        displayReservations();
    } else {
        alert('Please enter customer name, table number, and a valid date/time.');
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
