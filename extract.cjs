const fs = require('fs');
const content = fs.readFileSync('resources/views/admin/dashboard.blade.php', 'utf8');
const matches = content.match(/<script>([\s\S]*?)<\/script>/g);
if (matches && matches[0]) {
    let jsContent = matches[0].replace(/<\/?script>/g, '');
    // Replace Blade syntax with valid JS so node can parse it
    jsContent = jsContent.replace(/\{\{.*?\}\}/g, '0');
    jsContent = jsContent.replace(/\{!!.*?!!\}/g, '[]');
    jsContent = jsContent.replace(/@json\(.*?\)/g, '[]');
    fs.writeFileSync('test.js', jsContent);
    console.log('Saved to test.js');
}
