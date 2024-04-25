// clipboard.js

function copyToClipboard(text) {
    const textarea = document.createElement('textarea');
    textarea.value = text;
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand('copy');
    document.body.removeChild(textarea);
    alert('Prompt content copied to clipboard!');
}

document.addEventListener('DOMContentLoaded', function() {
    const copyButtons = document.querySelectorAll('.copy-prompt');
    copyButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const promptContent = this.getAttribute('data-prompt');
            copyToClipboard(promptContent);
        });
    });
});
