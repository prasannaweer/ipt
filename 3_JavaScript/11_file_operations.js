// =============================================
// 11 - File System Operations (fs module)
// =============================================

const fs = require("fs");

// --- fs.readFile: Read a file ---
fs.readFile("sample.txt", "utf8", (err, data) => {
    if (err) {
        console.log("Error reading file:", err.message);
    } else {
        console.log("=== File Content ===");
        console.log(data);
    }
});

// --- fs.writeFile: Write/overwrite a file ---
var writeContent = "Hello, World!\nThis file was created using Node.js fs.writeFile.\n";

fs.writeFile("output.txt", writeContent, (err) => {
    if (err) {
        console.log("Error writing file:", err.message);
    } else {
        console.log("File 'output.txt' written successfully.");
    }
});

// --- fs.appendFile: Append to a file ---
var appendContent = "This line was added using fs.appendFile.\n";

fs.appendFile("output.txt", appendContent, (err) => {
    if (err) {
        console.log("Error appending to file:", err.message);
    } else {
        console.log("Content appended to 'output.txt' successfully.");
    }
});
