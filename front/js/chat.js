/**
 * Initialize basic chat UI
 */
document.addEventListener('DOMContentLoaded', () => {
    const root = document.getElementById('tiao-chat-root');
    const chatBox = document.createElement('div');
    chatBox.id = 'tiao-chat-box';
    root.appendChild(chatBox);

    const input = document.createElement('input');
    input.id = 'tiao-chat-input';
    input.placeholder = 'Digite sua mensagem...';
    root.appendChild(input);

    input.addEventListener('keypress', e => {
        if (e.key === 'Enter' && input.value.trim()) {
            sendMessage(input.value.trim());
            input.value = '';
        }
    });
});

/**
 * Send message stub via AJAX
 */
function sendMessage(text) {
    fetch('plugins/tiao/front/send.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({message: text})
    })
    .then(res => res.json())
    .then(console.log)
    .catch(console.error);
}

