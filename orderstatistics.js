// Sample data for demonstration
const menuItems = ["Pizza", "Burger", "Pasta", "Salad"];
const orders = [45, 30, 25, 20];
const topSellingThisWeek = ["Pizza", "Burger", "Pasta", "Salad"]; // Assuming this data includes other items

// Function to display most ordered menu items as a bar chart
function displayMenuItemsChart() {
    const ctx = document.getElementById("menu-chart").getContext("2d");

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: menuItems,
            datasets: [{
                label: 'Orders',
                data: orders,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Function to display top-selling menu items for the selected date
function displayTopSellingForDate(selectedDate) {
    const topSellingList = document.getElementById("top-selling-list");
    const currentDate = new Date(); // Get the current date

    // Clear any existing list items
    topSellingList.innerHTML = "";

    // Check if the selected date is in the future
    if (new Date(selectedDate) > currentDate) {
        // Display an error notification
        alert("Selected date cannot be in the future.");
    } else {
        // Filter top-selling items for the selected date and menu items
        const filteredTopSelling = topSellingThisWeek
            .filter(item => menuItems.includes(item))
            .filter(item => item.includes(selectedDate));

        // Populate the list with top-selling items for the selected date
        filteredTopSelling.forEach(item => {
            const listItem = document.createElement("li");
            listItem.textContent = item;
            topSellingList.appendChild(listItem);
        });
    }
}

// Display the bar chart when the page loads
window.addEventListener('load', () => {
    displayMenuItemsChart();

    // Add event listener to the "View Top Sellers" button
    const viewDailySalesButton = document.getElementById("view-daily-sales");
    viewDailySalesButton.addEventListener('click', () => {
        const selectedDate = document.getElementById("date-select").value;
        displayTopSellingForDate(selectedDate);
    });
});


