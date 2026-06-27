const fs = require('fs');
let content = fs.readFileSync('app/Http/Controllers/AdminController.php', 'utf8');
let snippet = fs.readFileSync('admin_controller_snippet.php', 'utf8');

const startIdx = content.indexOf('    private function getDashboardData()');
const endIdx = content.indexOf('    public function index()', startIdx);

if (startIdx === -1 || endIdx === -1) {
    console.error("Could not find getDashboardData block");
    process.exit(1);
}

let newContent = content.substring(0, startIdx) + snippet + "\n" + content.substring(endIdx);
fs.writeFileSync('app/Http/Controllers/AdminController.php', newContent);
console.log("Successfully injected snippet");
