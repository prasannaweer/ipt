// =============================================
// 10 - Node.js Server Examples
// =============================================

// --- Part 1: Simple Node.js HTTP Server ---
const http = require("http");

const simpleServer = http.createServer((req, res) => {
    res.writeHead(200, { "Content-Type": "text/html" });
    res.end("<h1>Simple Node.js HTTP Server</h1><p>Requested: " + req.url + "</p>");
});

// simpleServer.listen(3000, () => console.log("Simple server on http://localhost:3000"));


// --- Part 2: Express Framework Server with GET Requests ---
const express = require("express");
const app = express();
const bodyParser = require("body-parser");

// Parse form data
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

// Serve the HTML form
app.get("/", (req, res) => {
    res.sendFile(__dirname + "/10_nodejs_form.html");
});

// Handle GET request with query parameters
app.get("/hello", (req, res) => {
    var name = req.query.name || "World";
    res.send("<h1>Hello, " + name + "!</h1><a href='/'>Back</a>");
});

// Handle GET request to display form data
app.get("/greet", (req, res) => {
    res.send("<h1>Greetings, " + req.query.name + "!</h1><a href='/'>Back</a>");
});


// --- Part 3: Form Data Processing (POST) ---
app.post("/submit", (req, res) => {
    var name = req.body.name;
    var email = req.body.email;
    var message = req.body.message;

    var response = `
        <h1>Form Submitted!</h1>
        <ul>
            <li><strong>Name:</strong> ${name}</li>
            <li><strong>Email:</strong> ${email}</li>
            <li><strong>Message:</strong> ${message}</li>
        </ul>
        <a href="/">Back to Form</a>
    `;

    res.send(response);
});

// Start Express server
app.listen(3001, () => {
    console.log("Express server running on http://localhost:3001");
    console.log("Open http://localhost:3001/ to see the form");
});
