const express = require('express');
const bodyParser = require('body-parser');
const app = express();
const port = 3000;

// Middleware to parse incoming JSON data
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

// Serve static files (e.g., HTML)
app.use(express.static('AdvancedSoftwareDevelopment'));

// GET route to render the initial form page

// POST route to handle form submission and redirect to another page
app.post('/submit', (req, res) => {
    const formData = req.body;

    // Redirect to another page with query parameters containing the form data
    res.redirect(`/menuResults.html?name=${formData.name}`);
});

app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
});